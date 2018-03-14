<?php
/**
 * @see       https://github.com/zendframework/zend-expressive-platesrenderer for the canonical source repository
 * @copyright Copyright (c) 2015-2017 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive-platesrenderer/blob/master/LICENSE.md New BSD License
 */
declare(strict_types=1);

namespace KiwiSuite\Template\Plates;

use KiwiSuite\Contract\ServiceManager\FactoryInterface;
use KiwiSuite\Contract\ServiceManager\ServiceManagerInterface;
use League\Plates\Engine as PlatesEngine;
use Zend\Expressive\Plates\PlatesEngineFactory;
use Zend\Expressive\Plates\PlatesRenderer;

/**
 * Create and return a Plates engine instance.
 *
 * Optionally uses the service 'config', which should return an array. This
 * factory consumes the following structure:
 *
 * <code>
 * 'plates' => [
 *     'extensions' => [
 *         // extension instances, or
 *         // service names that return extension instances, or
 *         // class names of directly instantiable extensions.
 *     ]
 * ]
 * </code>
 *
 * By default, this factory attaches the Extension\UrlExtension
 * and Extension\EscaperExtension to the engine. You can override
 * the functions that extension exposes by providing an extension
 * class in your extensions array, or providing an alternative
 * Zend\Expressive\Plates\Extension\UrlExtension service.
 */
class PlatesRendererFactory implements FactoryInterface
{
    /**
     * @param ServiceManagerInterface $container
     * @param                         $requestedName
     * @param array|null              $options
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @return mixed
     */
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null): PlatesRenderer
    {
        $config = $container->has('config') ? $container->get('config') : [];
        $config = isset($config['templates']) ? $config['templates'] : [];

        // Create the engine instance:
        $engine = $this->createEngine($container);

        // Set file extension
        if (isset($config['extension'])) {
            $engine->setFileExtension($config['extension']);
        }

        // Inject engine
        $plates = new PlatesRenderer($engine);

        // Add template paths
        $allPaths = isset($config['paths']) && \is_array($config['paths']) ? $config['paths'] : [];
        foreach ($allPaths as $namespace => $paths) {
            $namespace = \is_numeric($namespace) ? null : $namespace;
            foreach ((array) $paths as $path) {
                $plates->addPath($path, $namespace);
            }
        }

        return $plates;
    }

    /**
     * Create and return a Plates Engine instance.
     *
     * If the container has the League\Plates\Engine service, returns it.
     *
     * Otherwise, invokes the PlatesEngineFactory with the $container to create
     * and return the instance.
     */
    private function createEngine(ServiceManagerInterface $container): PlatesEngine
    {
        if ($container->has(PlatesEngine::class)) {
            return $container->get(PlatesEngine::class);
        }

        $engineFactory = new PlatesEngineFactory();
        return $engineFactory($container);
    }
}

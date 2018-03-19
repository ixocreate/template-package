<?php
namespace KiwiSuite\Template\Factory;

use KiwiSuite\Contract\ServiceManager\FactoryInterface;
use KiwiSuite\Contract\ServiceManager\ServiceManagerInterface;
use KiwiSuite\Template\Extension\ExtensionMapping;
use KiwiSuite\Template\Extension\ExtensionSubManager;
use KiwiSuite\Template\Renderer;
use KiwiSuite\Template\TemplateConfig;
use League\Plates\Engine;
use Zend\Expressive\Plates\PlatesRenderer;

final class TemplateRendererFactory implements FactoryInterface
{

    /**
     * @param ServiceManagerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {
        /** @var TemplateConfig $templateConfig */
        $templateConfig = $container->get(TemplateConfig::class);

        $plates = new Engine();
        $plates->setFileExtension($templateConfig->getFileExtension());
        foreach ($templateConfig->getDirectories() as $templateDirectory) {
            $plates->addFolder($templateDirectory['name'], $templateDirectory['directory']);
        }

        /** @var ExtensionSubManager $extensionManager */
        $extensionManager = $container->get(ExtensionSubManager::class);

        $extensionMapping = $container->get(ExtensionMapping::class)->getMapping();
        foreach ($extensionMapping as $name => $extension) {
            $plates->registerFunction($name, function ($arguments) use ($extensionManager, $name){
                return call_user_func_array($extensionManager->get($name), $arguments);
            });
        }

        return new Renderer(new PlatesRenderer($plates));

    }
}

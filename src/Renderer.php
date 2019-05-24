<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Template;

use Zend\Expressive\Template\TemplateRendererInterface;

final class Renderer
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /**
     * Renderer constructor.
     *
     * @param TemplateRendererInterface $renderer
     */
    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param string $name
     * @param array $params
     * @param array $globalData
     * @return string
     */
    public function render(string $name, array $params = [], array $globalData = []): string
    {
        foreach ($globalData as $paramName => $value) {
            $this->renderer->addDefaultParam('*', $paramName, $value);
        }
        return $this->renderer->render($name, $params);
    }
}

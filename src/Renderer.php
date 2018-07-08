<?php
/**
 * kiwi-suite/template (https://github.com/kiwi-suite/template)
 *
 * @package kiwi-suite/template
 * @see https://github.com/kiwi-suite/template
 * @copyright Copyright (c) 2010 - 2018 kiwi suite GmbH
 * @license MIT License
 */

declare(strict_types=1);
namespace KiwiSuite\Template;

use Zend\Expressive\Template\TemplateRendererInterface;

final class Renderer
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /**
     * Renderer constructor.
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

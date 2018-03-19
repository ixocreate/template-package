<?php
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
     * @return string
     */
    public function render(string $name, $params = []): string
    {
        return $this->renderer->render($name, $params);
    }
}

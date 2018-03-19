<?php
namespace KiwiSuite\Template;

use Zend\Diactoros\MessageTrait;
use Zend\Diactoros\Response;
use Zend\Diactoros\Stream;

final class TemplateResponse extends Response
{
    use MessageTrait;

    /**
     * @var string
     */
    private $template;

    /**
     * @var array
     */
    private $data;

    /**
     * TemplateResponse constructor.
     * @param string $template
     * @param array $data
     * @param int $status
     * @param array $headers
     */
    public function __construct(string $template, array $data = [], int $status = 200, array $headers = [])
    {
        $this->template = $template;
        $this->data = $data;
        $body = new Stream('php://temp', 'r');
        parent::__construct($body, $status, $headers);
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    public function getData(): array
    {
        return $this->data;
    }
}

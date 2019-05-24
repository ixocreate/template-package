<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Template;

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
     * @var array
     */
    private $globalData;

    /**
     * TemplateResponse constructor.
     *
     * @param string $template
     * @param array $data
     * @param array $globalData
     * @param int $status
     * @param array $headers
     */
    public function __construct(
        string $template,
        array $data = [],
        array $globalData = [],
        int $status = 200,
        array $headers = []
    ) {
        $this->template = $template;
        $this->data = $data;
        $this->globalData = $globalData;
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

    public function getGlobalData(): array
    {
        return $this->globalData;
    }
}

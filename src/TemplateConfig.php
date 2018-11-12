<?php
/**
 * kiwi-suite/template (https://github.com/kiwi-suite/template)
 *
 * @package kiwi-suite/template
 * @link https://github.com/kiwi-suite/template
 * @copyright Copyright (c) 2010 - 2018 kiwi suite GmbH
 * @license MIT License
 */

declare(strict_types=1);
namespace KiwiSuite\Template;

use KiwiSuite\Contract\Application\SerializableServiceInterface;

final class TemplateConfig implements SerializableServiceInterface
{
    /**
     * @var array
     */
    private $config = [
        'fileExtension' => 'phtml',
        'directories' => [],
    ];

    public function __construct(TemplateConfigurator $templateConfigurator)
    {
        $this->config['fileExtension'] = $templateConfigurator->getFileExtension();
        $this->config['directories'] = $templateConfigurator->getDirectories();
    }

    /**
     * @return string
     * @deprecated
     */
    public function getFileExtension(): string
    {
        return $this->config['fileExtension'];
    }

    /**
     * @return array
     * @deprecated
     */
    public function getDirectories(): array
    {
        return $this->config['directories'];
    }

    /**
     * @return string
     */
    public function fileExtension(): string
    {
        return $this->config['fileExtension'];
    }

    /**
     * @return array
     */
    public function directories(): array
    {
        return $this->config['directories'];
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return \serialize($this->config);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $this->config = \unserialize($serialized);
    }
}

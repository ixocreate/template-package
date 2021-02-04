<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Template;

use Ixocreate\Application\Service\SerializableServiceInterface;

final class TemplateConfig implements SerializableServiceInterface
{
    /**
     * @var array
     */
    private $config = [
        'fileExtension',
        'directories',
    ];

    public function __construct(TemplateConfigurator $templateConfigurator)
    {
        $this->config['fileExtension'] = $templateConfigurator->getFileExtension();
        $this->config['directories'] = $templateConfigurator->getDirectories();
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

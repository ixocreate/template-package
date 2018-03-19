<?php
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
     */
    public function getFileExtension(): string
    {
        return $this->config['fileExtension'];
    }

    /**
     * @return array
     */
    public function getDirectories(): array
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

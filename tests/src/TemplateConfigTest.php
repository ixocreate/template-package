<?php

declare(strict_types=1);

namespace Ixocreate\Test\Template;

use Ixocreate\Template\TemplateConfig;
use Ixocreate\Template\TemplateConfigurator;
use PHPUnit\Framework\TestCase;

/**
 * Class TemplateConfigTest
 * @package Ixocreate\Test\Template
 * @covers \Ixocreate\Template\TemplateConfig
 */
class TemplateConfigTest extends TestCase
{
    public function testValues()
    {
        $directories = [
            'demo' => '/path/to/templates',
        ];

        $configurator = $this->createMock(TemplateConfigurator::class);
        $configurator->expects($this->once())->method('getFileExtension')->willReturn('test');
        $configurator->expects($this->once())->method('getDirectories')->willReturn($directories);

        $config = new TemplateConfig($configurator);
        $this->assertEquals('test', $config->fileExtension());
        $this->assertEquals($directories, $config->directories());
    }

    public function testSerialize()
    {
        $directories = [
            'demo' => '/path/to/templates',
        ];

        $configurator = $this->createMock(TemplateConfigurator::class);
        $configurator->expects($this->once())->method('getFileExtension')->willReturn('test');
        $configurator->expects($this->once())->method('getDirectories')->willReturn($directories);

        $config = new TemplateConfig($configurator);
        $serialized = \serialize($config);
        $config = \unserialize($serialized);

        $this->assertEquals('test', $config->fileExtension());
        $this->assertEquals($directories, $config->directories());
    }
}

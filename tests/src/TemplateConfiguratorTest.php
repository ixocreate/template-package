<?php

declare(strict_types=1);

namespace Ixocreate\Test\Template;

use Ixocreate\Template\Exception\InvalidDirectoryException;
use Ixocreate\Template\TemplateConfigurator;
use PHPUnit\Framework\TestCase;

/**
 * Class TemplateConfigTest
 * @package Ixocreate\Test\Template
 * @covers \Ixocreate\Template\TemplateConfigurator
 */
class TemplateConfiguratorTest extends TestCase
{
    public function testExtension()
    {
        $configurator = new TemplateConfigurator();

        $configurator->setFileExtension('testExtension');
        $this->assertEquals('testExtension', $configurator->getFileExtension());
    }

    public function testInvalidDirectory()
    {
        $this->expectException(InvalidDirectoryException::class);

        $configurator = new TemplateConfigurator();
        $configurator->addDirectory('name', 'not/existing/directory');
    }

    public function testDirectory()
    {
        $configurator = new TemplateConfigurator();
        $configurator->addDirectory('name', 'tests/misc');

        $this->assertEquals(['name' => ['name' => 'name', 'directory' => 'tests/misc']], $configurator->getDirectories());
    }

    public function testRegisterService()
    {

    }
}

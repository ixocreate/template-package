<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Template;

use Ixocreate\Misc\Template\TestExtension;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\ServiceManager\SubManager\SubManagerInterface;
use Ixocreate\Template\Exception\InvalidDirectoryException;
use Ixocreate\Template\Extension\ExtensionMapping;
use Ixocreate\Template\Extension\ExtensionSubManager;
use Ixocreate\Template\Factory\TemplateRendererFactory;
use Ixocreate\Template\Renderer;
use Ixocreate\Template\TemplateConfig;
use Ixocreate\Template\TemplateConfigurator;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class TemplateTest
 * @package Ixocreate\Test\Template
 * @covers \League\Plates\Template\Template
 */
class TemplateTest extends TestCase
{
    /**
     * @var Renderer
     */
    private $renderer;

    public function setUp(): void
    {
        $factory = new TemplateRendererFactory();
        /** @var Renderer $renderer */
        $this->renderer = $factory($this->serviceManagerMock(), 'test', []);
    }

    private function serviceManagerMock()
    {
        $serviceManagerMock = $this->createMock(ServiceManagerInterface::class);
        $serviceManagerMock->method('get')
            ->willReturnCallback(function ($request) {
                switch ($request) {
                    case TemplateConfig::class:
                        $configurator = new TemplateConfigurator();
                        $configurator->addExtension(TestExtension::class);
                        $configurator->addDirectory('test', __DIR__ . '/../misc/templates');
                        return new TemplateConfig($configurator);
                    case ExtensionSubManager::class:
                        // $extension = $this->getMockBuilder(ExtensionInterface::class)->getMock();
                        // $extension->method('__invoke')->willReturn(function($message){
                        //     return $message;
                        // });
                        $extension = new TestExtension();
                        /** @var ExtensionSubManager $mock */
                        $manager = $this->getMockBuilder(SubManagerInterface::class)->getMock();
                        // $manager->method('getServices')->willReturn([Subscriber::class]);
                        $manager->method('get')->willReturnMap([
                            [TestExtension::class, $extension],
                        ]);
                        return $manager;
                    case ExtensionMapping::class:
                        return new ExtensionMapping([
                            'test' => TestExtension::class,
                        ]);
                }
                return null;
            });
        return $serviceManagerMock;
    }

    /**
     * @covers \Ixocreate\Template\TemplateConfig
     * @covers \Ixocreate\Template\TemplateConfigurator
     */
    public function testConfig()
    {
        /** @var TemplateConfig $configurator */
        $config = $this->serviceManagerMock()->get(TemplateConfig::class);

        $this->assertSame([
            'test' => ['name' => 'test', 'directory' => __DIR__ . '/../misc/templates'],
        ], $config->directories());
        $this->assertSame('phtml', $config->fileExtension());
    }

    /**
     * @covers \Ixocreate\Template\Factory\TemplateRendererFactory
     * @covers \Ixocreate\Template\Renderer
     */
    public function testRenderer()
    {
        $this->assertInstanceOf(Renderer::class, $this->renderer);

        $name = 'test::test';
        $output = 'bar';
        $params = ['foo' => $output];
        $globalParams = ['globalFoo' => $output];
        $result = $this->renderer->render($name, $params, $globalParams);
        $this->assertSame($output . '/' . $output, $result);
    }

    /**
     * @covers \Ixocreate\Template\Renderer
     */
    public function testRendererStandalone()
    {
        $templateRenderer = $this->createMock(TemplateRendererInterface::class);
        $templateRenderer->method('render')
            ->willReturnCallback(function ($name, $params) {
                return $name . ':' . \implode(',', $params);
            });

        $name = 'test';
        $params = ['foo' => 'bar'];
        $renderer = new Renderer($templateRenderer);
        $result = $renderer->render($name, $params);
        $this->assertSame($result, $name . ':' . \implode(',', $params));
    }

    /**
     * @covers \Ixocreate\Template\Extension\ExtensionMapping
     * @covers \Ixocreate\Template\Extension\ExtensionSubManager
     * @covers \Ixocreate\Template\Factory\TemplateRendererFactory
     * @covers \Ixocreate\Template\TemplateConfigurator::registerService
     */
    public function testExtension()
    {
        $name = 'test::extension';
        $result = $this->renderer->render($name);
        $this->assertSame('EXTENSION CALLED', $result);
    }

    /**
     * @covers \Ixocreate\Template\TemplateConfigurator::addDirectory
     */
    public function testConfiguratorAddInvalidDirectory()
    {
        $configurator = new TemplateConfigurator();
        $this->expectException(InvalidDirectoryException::class);
        $configurator->addDirectory('nope', 'nope');
    }
}

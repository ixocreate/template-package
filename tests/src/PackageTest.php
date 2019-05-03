<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Template;

use Ixocreate\Application\Configurator\ConfiguratorRegistryInterface;
use Ixocreate\Application\Service\ServiceRegistryInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\Template\Package;
use Ixocreate\Template\TemplateBootstrapItem;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    /**
     * @covers \Ixocreate\Template\Package
     */
    public function testPackage()
    {
        $configuratorRegistry = $this->getMockBuilder(ConfiguratorRegistryInterface::class)->getMock();
        $serviceRegistry = $this->getMockBuilder(ServiceRegistryInterface::class)->getMock();
        $serviceManager = $this->getMockBuilder(ServiceManagerInterface::class)->getMock();

        $package = new Package();
        $package->configure($configuratorRegistry);
        $package->addServices($serviceRegistry);
        $package->boot($serviceManager);

        $this->assertSame([TemplateBootstrapItem::class], $package->getBootstrapItems());
        $this->assertNull($package->getConfigDirectory());
        $this->assertNull($package->getConfigProvider());
        $this->assertNull($package->getDependencies());
        $this->assertDirectoryExists($package->getBootstrapDirectory());
    }
}

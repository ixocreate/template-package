<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Template;

use Ixocreate\Template\TemplateBootstrapItem;
use Ixocreate\Template\TemplateConfigurator;
use PHPUnit\Framework\TestCase;

class TemplateBootstrapItemTest extends TestCase
{
    /**
     * @covers \Ixocreate\Template\TemplateBootstrapItem
     */
    public function testBootstrapItem()
    {
        $bootstrapItem = new TemplateBootstrapItem();
        $this->assertSame('template', $bootstrapItem->getVariableName());
        $this->assertSame('template.php', $bootstrapItem->getFileName());
        $this->assertInstanceOf(TemplateConfigurator::class, $bootstrapItem->getConfigurator());
    }
}

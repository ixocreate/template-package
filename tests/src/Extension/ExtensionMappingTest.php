<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Template\Extension;

use Ixocreate\Template\Extension\ExtensionMapping;
use PHPUnit\Framework\TestCase;

/**
 * Class ExtensionMappingTest
 * @package Ixocreate\Test\Template\Extension
 * @covers \Ixocreate\Template\Extension\ExtensionMapping
 */
class ExtensionMappingTest extends TestCase
{
    public function testMapping()
    {
        $map = [
            'element1' => 'foo',
            'element2' => 'bar',
        ];

        $mapping = new ExtensionMapping($map);

        $this->assertEquals($map, $mapping->getMapping());
    }

    public function testSerialize()
    {
        $map = [
            'element1' => 'foo',
            'element2' => 'bar',
        ];

        $mapping = new ExtensionMapping($map);

        $serialized = \serialize($mapping);
        $mapping = \unserialize($serialized);

        $this->assertEquals($map, $mapping->getMapping());
    }
}

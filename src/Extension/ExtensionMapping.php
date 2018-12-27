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
namespace Ixocreate\Template\Extension;

use Ixocreate\Contract\Application\SerializableServiceInterface;

final class ExtensionMapping implements SerializableServiceInterface
{
    /**
     * @var array
     */
    private $mapping;

    public function __construct(array $mapping)
    {
        $this->mapping = $mapping;
    }

    public function getMapping(): array
    {
        return $this->mapping;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return \serialize($this->mapping);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $this->mapping = \unserialize($serialized);
    }
}

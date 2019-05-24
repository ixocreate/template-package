<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Template\Extension;

interface ExtensionInterface
{
    /**
     * @return string
     */
    public static function getName(): string;
}

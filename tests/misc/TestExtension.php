<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Misc\Template;

use Ixocreate\Template\Extension\ExtensionInterface;

final class TestExtension implements ExtensionInterface
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'test';
    }

    public function __invoke($message)
    {
        return $message;
    }
}

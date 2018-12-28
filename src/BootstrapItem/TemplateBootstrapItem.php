<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Template\BootstrapItem;

use Ixocreate\Contract\Application\BootstrapItemInterface;
use Ixocreate\Contract\Application\ConfiguratorInterface;
use Ixocreate\Template\TemplateConfigurator;

final class TemplateBootstrapItem implements BootstrapItemInterface
{
    public function getConfigurator(): ConfiguratorInterface
    {
        return new TemplateConfigurator();
    }

    public function getVariableName(): string
    {
        return 'template';
    }

    public function getFileName(): string
    {
        return 'template.php';
    }
}

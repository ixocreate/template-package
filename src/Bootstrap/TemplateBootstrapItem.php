<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Template\Bootstrap;

use Ixocreate\Application\Service\Bootstrap\BootstrapItemInterface;
use Ixocreate\Application\Service\Configurator\ConfiguratorInterface;
use Ixocreate\Template\Config\TemplateConfigurator;

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

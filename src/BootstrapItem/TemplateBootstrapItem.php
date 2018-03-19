<?php
namespace KiwiSuite\Template\BootstrapItem;

use KiwiSuite\Contract\Application\BootstrapItemInterface;
use KiwiSuite\Contract\Application\ConfiguratorInterface;
use KiwiSuite\Template\TemplateConfigurator;

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

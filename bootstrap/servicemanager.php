<?php
declare(strict_types=1);
namespace Ixocreate\Template\Package;

use Ixocreate\ServiceManager\ServiceManagerConfigurator;
use Ixocreate\Template\Package\Extension\ExtensionSubManager;
use Ixocreate\Template\Package\Factory\TemplateRendererFactory;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addFactory(Renderer::class, TemplateRendererFactory::class);
$serviceManager->addSubManager(ExtensionSubManager::class);

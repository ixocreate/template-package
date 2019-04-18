<?php
declare(strict_types=1);
namespace Ixocreate\Package\Template;

use Ixocreate\ServiceManager\ServiceManagerConfigurator;
use Ixocreate\Package\Template\Extension\ExtensionSubManager;
use Ixocreate\Package\Template\Factory\TemplateRendererFactory;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addFactory(Renderer::class, TemplateRendererFactory::class);
$serviceManager->addSubManager(ExtensionSubManager::class);

<?php
declare(strict_types=1);
namespace KiwiSuite\Template;

use KiwiSuite\ServiceManager\ServiceManagerConfigurator;
use KiwiSuite\Template\Extension\ExtensionSubManager;
use KiwiSuite\Template\Factory\TemplateRendererFactory;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addFactory(Renderer::class, TemplateRendererFactory::class);
$serviceManager->addSubManager(ExtensionSubManager::class);

<?php
declare(strict_types=1);

namespace Ixocreate\Template;

use Ixocreate\Application\Service\ServiceManagerConfigurator;
use Ixocreate\Template\Extension\ExtensionSubManager;
use Ixocreate\Template\Factory\TemplateRendererFactory;

/** @var ServiceManagerConfigurator $serviceManager */

$serviceManager->addFactory(Renderer::class, TemplateRendererFactory::class);
$serviceManager->addSubManager(ExtensionSubManager::class);

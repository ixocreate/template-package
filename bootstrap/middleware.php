<?php
declare(strict_types=1);
namespace KiwiSuite\Template;

use KiwiSuite\ApplicationHttp\Middleware\MiddlewareConfigurator;
use KiwiSuite\Template\Middleware\TemplateMiddleware;

/** @var MiddlewareConfigurator $middleware */
$middleware->addMiddleware(TemplateMiddleware::class);


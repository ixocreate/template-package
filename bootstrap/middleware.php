<?php
declare(strict_types=1);
namespace Ixocreate\Template;

use Ixocreate\ApplicationHttp\Middleware\MiddlewareConfigurator;
use Ixocreate\Template\Middleware\TemplateMiddleware;

/** @var MiddlewareConfigurator $middleware */
$middleware->addMiddleware(TemplateMiddleware::class);


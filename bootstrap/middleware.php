<?php
declare(strict_types=1);
namespace Ixocreate\Package\Template;

use Ixocreate\Application\Http\Middleware\MiddlewareConfigurator;
use Ixocreate\Package\Template\Middleware\TemplateMiddleware;

/** @var MiddlewareConfigurator $middleware */
$middleware->addMiddleware(TemplateMiddleware::class);


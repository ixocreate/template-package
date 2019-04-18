<?php
declare(strict_types=1);
namespace Ixocreate\Template\Package;

use Ixocreate\Application\Http\Middleware\MiddlewareConfigurator;
use Ixocreate\Template\Package\Middleware\TemplateMiddleware;

/** @var MiddlewareConfigurator $middleware */
$middleware->addMiddleware(TemplateMiddleware::class);


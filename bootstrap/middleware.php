<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Template;

use Ixocreate\Application\Http\Middleware\MiddlewareConfigurator;
use Ixocreate\Template\Middleware\TemplateMiddleware;

/** @var MiddlewareConfigurator $middleware */
$middleware->addMiddleware(TemplateMiddleware::class);

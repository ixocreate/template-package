<?php
/**
 * kiwi-suite/template (https://github.com/kiwi-suite/template)
 *
 * @package kiwi-suite/template
 * @see https://github.com/kiwi-suite/template
 * @copyright Copyright (c) 2010 - 2018 kiwi suite GmbH
 * @license MIT License
 */

declare(strict_types=1);
namespace KiwiSuite\Template\Middleware;

use KiwiSuite\Template\Renderer;
use KiwiSuite\Template\TemplateResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;

final class TemplateMiddleware implements MiddlewareInterface
{
    /**
     * @var Renderer
     */
    private $renderer;

    /**
     * TemplateMiddleware constructor.
     * @param Renderer $renderer
     */
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);

        if ($response instanceof TemplateResponse) {
            $response = $this->createHtmlResponse($response);
        }

        return $response;
    }

    private function createHtmlResponse(TemplateResponse $templateResponse): HtmlResponse
    {
        return new HtmlResponse(
            $this->renderer->render($templateResponse->getTemplate(), $templateResponse->getData()),
            $templateResponse->getStatusCode(),
            $templateResponse->getHeaders()
        );
    }
}

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Template\Middleware;

use Ixocreate\Template\Renderer;
use Ixocreate\Template\TemplateResponse;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class TemplateMiddleware implements MiddlewareInterface
{
    /**
     * @var Renderer
     */
    private $renderer;

    /**
     * TemplateMiddleware constructor.
     *
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
            $this->renderer->render(
                $templateResponse->getTemplate(),
                $templateResponse->getData(),
                $templateResponse->getGlobalData()
            ),
            $templateResponse->getStatusCode(),
            $templateResponse->getHeaders()
        );
    }
}

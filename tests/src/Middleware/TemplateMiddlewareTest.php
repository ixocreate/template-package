<?php

declare(strict_types=1);

namespace Ixocreate\Test\Template\Middleware;

use Ixocreate\Template\Middleware\TemplateMiddleware;
use Ixocreate\Template\Renderer;
use Ixocreate\Template\TemplateResponse;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class TemplateMiddlewareTest
 * @package Ixocreate\Test\Template\Middleware
 * @covers \Ixocreate\Template\Middleware\TemplateMiddleware
 */
class TemplateMiddlewareTest extends TestCase
{
    public function testNotInterception()
    {
        $renderer = $this->createMock(Renderer::class);

        $jsonResponse = $this->createMock(JsonResponse::class);

        $request = $this->createMock(ServerRequestInterface::class);
        $handler = $this->createMock(RequestHandlerInterface::class);
        $handler->expects($this->once())
            ->method('handle')
            ->with($this->equalTo($request))
            ->willReturn($jsonResponse);

        $middleware = new TemplateMiddleware($renderer);

        $response = $middleware->process($request, $handler);

        $this->assertEquals($jsonResponse, $response);
    }

    public function testTemplateResponse()
    {
        $content = '<html>this is a test template</html>';
        $header = [
            'Header1' => ['value1'],
            'Header2' => ['value2'],
        ];
        $template = 'template.php';
        $data = [
            'data' => 'value',
        ];
        $globalData = [
            'globalData' => 'otherValue'
        ];

        $renderer = $this->createMock(Renderer::class);
        $renderer->expects($this->once())->method('render')
            ->with(
                $this->equalTo($template),
                $this->equalTo($data),
                $this->equalTo($globalData)
            )
            ->willReturn($content);

        $templateResponse = $this->createMock(TemplateResponse::class);
        $templateResponse->expects($this->once())->method('getTemplate')->willReturn($template);
        $templateResponse->expects($this->once())->method('getData')->willReturn($data);
        $templateResponse->expects($this->once())->method('getGlobalData')->willReturn($globalData);
        $templateResponse->expects($this->once())->method('getStatusCode')->willReturn(222);
        $templateResponse->expects($this->once())->method('getHeaders')->willReturn($header);

        $request = $this->createMock(ServerRequestInterface::class);
        $handler = $this->createMock(RequestHandlerInterface::class);
        $handler->expects($this->once())
            ->method('handle')
            ->with($this->equalTo($request))
            ->willReturn($templateResponse);

        $middleware = new TemplateMiddleware($renderer);

        $header['content-type'] = ['text/html; charset=utf-8'];

        $response = $middleware->process($request, $handler);
        $this->assertInstanceOf(HtmlResponse::class, $response);
        $this->assertEquals($content, $response->getBody()->getContents());
        $this->assertEquals(222, $response->getStatusCode());
        $this->assertEquals($header, $response->getHeaders());
    }
}

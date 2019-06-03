<?php

namespace Farento\Tests\Service\API;

use Farento\SDK\Components\DTO\Advert\Advert;
use Farento\SDK\Components\DTO\Advert\AdvertGroup;
use Farento\SDK\Components\DTO\Estate\Estate;
use Farento\SDK\Service\AuthenticationServiceInterface;
use Farento\SDK\Service\Estate\EstateProvider;
use Farento\SDK\Service\HttpClient;
use Farento\SDK\Service\Router;
use Guzzle\Http\Client;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class EstateProviderTest extends TestCase
{
    /**
     * Main work flow test.
     *
     * @throws \Exception
     */
    public function testWorkFlow()
    {
        $result = \file_get_contents(__DIR__ . '/../../data/Service/API/EstateProvider/item.json');

        /** @var Client|MockObject $http */
        $http = $this->createMock(Client::class);
        $auth = new class () implements AuthenticationServiceInterface {
            public function getToken(): string
            {
                return 'this-is-test-token-string';
            }
        };

        $request = $this->createMock(Request::class);

        $http
            ->expects($this->once())
            ->method('createRequest')
            ->willReturnCallback(function (string $method, string $url, array $headers, ?string $body, array $option) use ($request) {
                $this->assertEquals(Request::GET, $method);
                $this->assertEquals('http://api.test.host/api/v1/estate/1', $url);
                $this->assertNull($body);
                $this->assertEmpty($option);
                $this->assertEquals('this-is-test-token-string', $headers['Authorization']);
                $this->assertRegExp('/^estate-sdk\/1.0\s+[0-9]{4}/ui', $headers['User-Agent']);

                return $request;
            });

        $response = $this->createMock(Response::class);
        $response
            ->expects($this->once())
            ->method('getBody')
            ->with(true)
            ->willReturn($result);

        $http
            ->expects($this->once())
            ->method('send')
            ->with($request)
            ->willReturn($response);

        $client = new HttpClient($http, $auth);
        $router = new Router('http://api.test.host');

        $estateProvider = new EstateProvider($client, $router);

        /** @var Estate $estate */
        $estate = $estateProvider->getById(1);

        $this->assertInstanceOf(Estate::class, $estate);
        $groups = $estate->getAdvertGroups();

        $this->assertEquals('Москва, ленинградское шоссе, 94к1, 125', $estate->getName());
        $this->assertCount(24, $groups);

        /** @var AdvertGroup $first */
        $first = $groups->first();
        $this->assertEquals('avito-1363', $first->getName());
        $this->assertCount(3, $first->getAdverts());

        /** @var Advert $advert */
        $advert = $first->getAdverts()->first();
        $this->assertEquals(1, $advert->getId());
        $this->assertEquals(Advert::STATUS_SUCCESS, $advert->getStatus());
        $this->assertEquals('sell', $advert->getType());
        $this->assertEquals('flat', $advert->getCategory());
        $this->assertEquals(1965063, $advert->getPrice());
        $this->assertEquals(1, $advert->getRooms());
        $this->assertEquals(42, $advert->getArea());
    }
}

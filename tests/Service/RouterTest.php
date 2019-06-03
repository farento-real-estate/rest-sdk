<?php

namespace Farento\Tests\Service;

use Farento\SDK\Service\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    /**
     * Should allow to generate routes automatic.
     *
     * @group unit
     */
    public function testShouldAllowToGenerateRoutesAutomatic()
    {
        $router = new Router('http://base.host');
        $route  = $router->proxyList();

        $expected = 'http://base.host/api/v1/proxy/list';

        $this->assertEquals($expected, $route);

        $route    = $router->advert_group();
        $expected = 'http://base.host/api/v1/advert-group';

        $this->assertEquals($expected, $route);

        $route    = $router->advert_groupList();
        $expected = 'http://base.host/api/v1/advert-group/list';

        $this->assertEquals($expected, $route);
    }
}

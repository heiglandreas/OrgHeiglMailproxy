<?php
/**
 * Copyright (c) Andreas Heigl<andreas@heigl.org>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @since     20.02.2017
 * @link      http://github.com/heiglandreas/org.heigl.Mailproxy
 */

namespace Org_Heigl\MailproxyTest\Controller;

use Org_Heigl\Mailproxy\Controller\ProxyController;
use Mockery as M;
use PHPUnit\Framework\TestCase;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Router\Http\RouteMatch;
use Zend\Stdlib\ResponseInterface;
use Zend\View\Model\ViewModel;

class ProxyControllerTest extends TestCase
{
    /**
     * @dataProvider ResolutionProvider
     * @covers \Org_Heigl\Mailproxy\Controller\ProxyController
     */
    public function testResolution($input, $redirect, $parameters = null)
    {
        $controller = new ProxyController();

        $params = [
            'id' => $input,
            'controller' => '',
            'action' => '',
        ];
        if (is_array($parameters)) {
            $params = array_merge($params, $parameters);
        }
        $routeMatch = M::mock(RouteMatch::class);
        $routeMatch->shouldReceive('getParams')->andReturn($params);

        $response = new Response();

        $event = M::mock(MvcEvent::class);
        $event->shouldReceive('getRouteMatch')->andReturn($routeMatch);
        $event->shouldReceive('getResponse')->andReturn($response);

        $controller->setEvent($event);

        $model = $controller->indexAction();
        $this->assertInstanceOf(ViewModel::class, $model);
        $this->assertTrue($model->terminate());

        $this->assertEquals(['Location' => $redirect], $response->getHeaders()->toArray());
        $this->assertEquals('302', $response->getStatusCode());
    }

    public function resolutionProvider()
    {
        return [
            ['moc.elpmaxe@ofni', 'mailto:info@example.com'],
            ['moc.elpmaxe@ofni', 'mailto:info@example.com?subject=test', ['subject' => 'test']],
        ];
    }
}

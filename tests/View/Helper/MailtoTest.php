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

namespace Org_Heigl\MailproxyTest\View\Helper;

use Mockery as M;
use Org_Heigl\Mailproxy\View\Helper\Mailto;
use PHPUnit\Framework\TestCase;
use Zend\View\Helper\EscapeHtml;
use Zend\View\Helper\EscapeHtmlAttr;
use Zend\View\Helper\HeadStyle;
use Zend\View\Renderer\RendererInterface;

class MailtoTest extends TestCase
{
    /**
     * @param $address
     * @param $expected
     * @dataProvider invocationWorksAsExpectedProvider
     * @covers \Org_Heigl\Mailproxy\View\Helper\Mailto
     */
    public function testThatInvocationWorksAsExpected($address, $expected, $name = null, $params = [])
    {
        $style = M::mock(HeadStyle::class);
        $style->shouldReceive('appendStyle')->with('.orgHeiglMailProxy{
    direction: rtl;
    unicode-bidi: bidi-override;

}');

        $view = M::mock(RendererInterface::class);
        $view->shouldReceive('url')->andReturn('mailproxy/' . strrev($address));
        $view->shouldReceive('headStyle')->andReturn($style);
        $view->shouldReceive('plugin')->with('escapehtml')->andReturn(new EscapeHtml());
        $view->shouldReceive('plugin')->with('escapehtmlattr')->andReturn(new EscapeHtmlAttr());

        $helper = new Mailto();
        $helper->setView($view);

        $this->assertEquals($expected, $helper($address, $name, $params));
    }

    public function invocationWorksAsExpectedProvider()
    {
        return [
            [
                'info@example.com',
                '<a href="mailproxy/moc.elpmaxe@ofni" class="orgHeiglMailProxy">moc.elpmaxe@ofni</a>',
            ],
            [
                'info@example.com',
                '<a href="mailproxy/moc.elpmaxe@ofni">title</a>',
                'title',
            ],
            [
                'info@example.com',
                '<a href="mailproxy/moc.elpmaxe@ofni" class="class" title="this&#x20;is&#x20;a&#x20;title">title</a>',
                'title',
                [
                    'class' => 'class',
                    'title' => 'this is a title'
                ]
            ],
            [
                'info@example.com',
                '<a href="mailproxy/moc.elpmaxe@ofni" class="class&#x20;orgHeiglMailProxy" title="this&#x20;is&#x20;a&#x20;title">moc.elpmaxe@ofni</a>',
                null,
                [
                    'class' => 'class',
                    'title' => 'this is a title'
                ]
            ],
        ];
    }
}

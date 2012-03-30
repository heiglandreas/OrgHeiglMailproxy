<?php
/**
 * Copyright (c) 2011-2012 Andreas Heigl<andreas@heigl.org>
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
 * @category  MailProxy
 * @package   OrgHeiglMailproxy
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright 2011-2012 Andreas Heigl
 * @license   http://www.opesource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @since     06.03.2012
 * @link      http://github.com/heiglandreas/mailproxyModule
 */
return array(
    'di' => array(
        'instance' => array(
           // 'Zend\View\HelperLoader' => array('parameters' => array(
           //     'Zend\View\HelperLoader::registerPlugin:shortName' => 'mailto',
           //     'Zend\View\HelperLoader::registerPlugin:className' => 'OrgHeiglMailproxy\View\Helper\Mailto.php',
           // )),
            'Zend\Mvc\Router\RouteStack' => array('parameters' => array(
                'routes' => array(
                    'mailproxy' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/m/mailproxy[/:id]',
                            'defaults' => array(
                                'controller' => 'OrgHeiglMailproxy\Controller\ProxyController',
                                'action'     => 'index',
                                'id'         => 'gu.php@ofni',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'definition' => array(
                                'type' => 'Wildcard',
                            )
                        ),
                    ),
                ),
            )),
        ),
    ),
);

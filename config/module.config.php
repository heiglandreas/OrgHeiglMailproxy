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

namespace Org_Heigl\Mailproxy;

use Org_Heigl\Mailproxy\Controller\ProxyController;
use Org_Heigl\Mailproxy\View\Helper\Mailto;

return array(
    'view_helpers' => array(
        'invokables' => array(
            'mailto' => Mailto::class,
		),
	),
	'controllers' => array(
		'invokables' => array(
			ProxyController::class => ProxyController::class
		),
	),
	'router' => array(
		'routes' => array(
        	'mailproxy' => array(
            	'type' => 'Segment',
                'options' => array(
                	'route' => '/mailproxy[/:id]',
                    'defaults' => array(
                    	'controller' => ProxyController::class,
                        'action'     => 'index',
                        'id'         => 'moc.elpmaxe@ofni',
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
    ),
    'view_manager' => array(
    	'display_not_found_reason' => true,
    	'display_exceptions'       => true,
    	'doctype'                  => 'HTML5',
    	'not_found_template'       => 'error/404',
    	'exception_template'       => 'error/index',
    	'template_map' => array(),
    	'template_path_stack' => array(
    		__DIR__ . '/../view',
    	),
    ),
);

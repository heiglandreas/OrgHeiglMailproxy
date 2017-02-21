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
namespace Org_Heigl\Mailproxy\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Uri\Mailto;

/**
 * A controller that proxies mailto-requests
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
class ProxyController extends AbstractActionController
{
    /**
     * Proxy a given http-request to a mailto-request
     */
    public function indexAction() : ViewModel
    {
        $params = $this->getEvent()->getRouteMatch()->getParams();
        $id = $params['id'];
        unset($params['id']);
        unset($params['controller']);
        unset($params['action']);
        $querystring = http_build_query($params);
        $mailtoUri = 'mailto:' . strrev($id) . '?' . $querystring;
        $redirect = new Mailto($mailtoUri);
        $this->redirect()->toUrl($redirect);
        
        $result = new ViewModel();
        $result->setTerminal(true);

        return $result;
    }
}

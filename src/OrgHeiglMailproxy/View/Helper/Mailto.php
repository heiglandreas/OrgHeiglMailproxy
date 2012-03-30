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
namespace OrgHeiglMailproxy\View\Helper;

use Zend\View\Helper\HtmlElement;

/**
 * A view helper taht generates a mailto-link with an obfuscated eMail-address
 *
 * The mail-address will be reversed and via RightToLeft-Display is visible the
 * "normal" way. clicking the link will call the ProxyController and redirect to
 * a mailto: url which will open the users Mail-Client
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
class Mailto extends HtmlElement
{
    /**
     * The class to use for marking this element
     *
     * var string $class
     */
    protected $mailtoclass = 'orgHeiglMailProxy';
    /**
     * create a link to the mailproxy-url
     *
     * @param string $address  The Mail-address to proxy to
     * @param string $linktext The optional link text. $address will be used if
     * omited
     * @param array  $params   Optional parameters
     *
     * @return void
     */
    public function __invoke($address, $linktext = null, $params = array())
    {
        $url = $this->getView()->url('mailproxy');

        $params = array_merge(array('href'  => $url . '/' . strrev($address)), $params);
        if ( null === $linktext ) {
            $linktext = strrev($address);
            $classes = $params['class'];
            $classes = explode(' ', $classes);
            if ( ! in_array($this->mailtoclass, $classes) ) {
                $classes[] = $this->mailtoclass;
            }
            $params['class'] = implode(' ', $classes);
        }

        $xhtml = '<a ' . $this->_htmlAttribs($params) . '>' . $linktext . '</a>';

        return $xhtml;

    }
}
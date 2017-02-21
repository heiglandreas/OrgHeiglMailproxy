[![Build Status](https://travis-ci.org/heiglandreas/OrgHeiglMailproxy.svg?branch=master)](https://travis-ci.org/heiglandreas/OrgHeiglMailproxy)
[![Coverage Status](https://coveralls.io/repos/github/heiglandreas/OrgHeiglMailproxy/badge.svg?branch=master)](https://coveralls.io/github/heiglandreas/OrgHeiglMailproxy?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/heiglandreas/OrgHeiglMailproxy/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/heiglandreas/OrgHeiglMailproxy/?branch=master)
[![Code Climate](https://lima.codeclimate.com/github/heiglandreas/OrgHeiglMailproxy/badges/gpa.svg)](https://lima.codeclimate.com/github/heiglandreas/OrgHeiglMailproxy)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/c75ab20539d34ef297c6b3ac5bfd801c)](https://www.codacy.com/app/github_70/OrgHeiglMailproxy?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=heiglandreas/OrgHeiglMailproxy&amp;utm_campaign=Badge_Grade)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f7f08ce9-8d75-4c1b-be51-9d500f871fae/mini.png)](https://insight.sensiolabs.com/projects/f7f08ce9-8d75-4c1b-be51-9d500f871fae)

[![Latest Stable Version](https://poser.pugx.org/org_heigl/mailproxy/v/stable)](https://packagist.org/packages/org_heigl/mailproxy)
[![Total Downloads](https://poser.pugx.org/org_heigl/mailproxy/downloads)](https://packagist.org/packages/org_heigl/mailproxy)
[![License](https://poser.pugx.org/org_heigl/mailproxy/license)](https://packagist.org/packages/org_heigl/mailproxy)
[![composer.lock](https://poser.pugx.org/org_heigl/mailproxy/composerlock)](https://packagist.org/packages/org_heigl/mailproxy)


# Org_Heigl\Mailproxy

This Zend-Framework-module allows creation of mailto-links using obfuscated
eMail-addresses.

The provided eMail-Address will be obfuscated by simply reversing it. Using CSS
the eMail-address will be perfectly readable in the default HTML-output but 
robots greping the site will simply see a 'reversed' eMail-address or some 
garbage.

By clicking on the link the reversed eMail-address will be send to a proxy that
redirects the browser to a mailto-url containing the correct eMail-address.

## Installation

The module is best installed using [composer](https://getcomposer.org).

```bash
    composer require org_heigl/mailproxy
```

## Usage:

1. In your application.conf-file add the Module to the list of modules like this:

    ```php
        return [
            'modules' => [
                …
                'Org_Heigl\Mailproxy'.
                …
            ]
        ];
    ```

2. In your view-script you can then add the following code snippet to create a
mailto-link to the address info@example.com:

    ```php
    <?php echo $this->mailto('info@example.com', 'Send me an Email', ['class' => 'myClass', 'title' => 'click me']);
    ```

The second parameter is optional and its content will be set as link-name (The
stuff between the <a> and </a>) If it's ommited the email-address will be given in a
way that it's hard for bots to retrieve them in cleartext.

The third parameter is also optional. It can be an associative array with further attributes for
the anchor-tag. If you want to set the third parameter but omit the second, pass ``null``` as
second parameter.

## Experiences

This module runs on php.ug for by now 4 years and I didn't get any spam to the email-addresses
that are displayed by the module.
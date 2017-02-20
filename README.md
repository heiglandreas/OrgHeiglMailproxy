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
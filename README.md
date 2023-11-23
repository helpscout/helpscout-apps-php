# New Apps Platform Available! :rocket:

> :loudspeaker: We're thrilled to announce that our new [App Developer Platform](https://developer.helpscout.com/apps/) is now available to all customers. We highly encourage all new apps to be built on the platform to take advantage of its expanded capabilities.
>
> For those looking to migrate from our legacy custom apps, we have prepared a comprehensive [Migration Guide](https://developer.helpscout.com/apps/guides/migrating-legacy-dynamic-apps/). This guide will help you seamlessly transition to the new platform.
>
> All existing legacy custom apps will continue to function as before. If you'd like to use the legacy framework to install a legacy custom app, click [here](https://secure.helpscout.net/apps/custom). You can still access the documentation for Legacy Custom Apps [here](https://developer.helpscout.com/apps/legacy-custom-apps/).

---

*Please note: While we will continue to support this legacy PHP library, future development will be focused on our new Apps Platform.*

Dynamic Apps Client Library
===========================

Client library to assist with building custom apps that integrate with [Help Scout](https://www.helpscout.net/). More information: [http://developer.helpscout.net/custom-apps/](http://developer.helpscout.net/custom-apps/)

Current Version
---------------------
* 1.1.1

Please see the [Changelog](https://github.com/helpscout/helpscout-apps-php/blob/master/CHANGELOG.md) for details.

## Installation

The Help Scout apps client can be installed using [Composer](https://packagist.org/packages/helpscout/apps).

### Composer

Inside of composer.json specify the following:

````
{
  "require": {
    "helpscout/apps": "1.1.*"
  }
}
````

Example Usage (1)
---------------------

```
use HelpScoutApp\DynamicApp;

include 'src/HelpScoutApp/DynamicApp.php';

$app = new DynamicApp('SECRET-KEY-HERE');
if ($app->isSignatureValid()) {
        $customer = $app->getCustomer();
        $user     = $app->getUser();
        $convo    = $app->getConversation();
        $mailbox  = $app->getMailbox();

        $html = array(
        	'<p>Convo</p>',
			'<ul>',
				'<li>Id: ' . $convo->getId() . '</li>',
                '<li>Number: ' . $convo->getNumber() . '</li>',
                '<li>Subject: ' . $convo->getSubject() . '</li>',
            '</ul>',
			'<p>Customer</p>',
			'<ul>',
				'<li>First: ' . $customer->getFirstName() . '</li>',
                '<li>Last: ' . $customer->getLastName() . '</li>',
                '<li>Email: ' . $customer->getEmail() . '</li>',
			'</ul>',
			'<p>User</p>',
			'<ul>',
                '<li>First: ' . $user->getFirstName() . '</li>',
                '<li>Last: ' . $user->getLastName() . '</li>',
                '<li>Id: ' . $user->getId() . '</li>',
			'</ul>',
			'<p>Mailbox</p>',
			'<ul>',
			    '<li>ID: ' . $mailbox->getId() . '</li>',
			    '<li>Email: ' . $mailbox->getEmail() . '</li>',
			'</ul>'
        );
        echo $app->getResponse($html);
} else {
        echo 'Invalid Request';
}
```

Example Usage (2)
---------------------

```
use HelpScoutApp\DynamicApp;

include 'src/HelpScoutApp/DynamicApp.php';

$app = new DynamicApp('SECRET-KEY-HERE');
if ($app->isSignatureValid()) {               
    echo $app->getResponse('<p>Hello World</p>');
} else {
    echo 'Invalid Request';
}
```

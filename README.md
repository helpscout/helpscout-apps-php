Dynamic Apps Client Library
===========================

Client library to assist with building custom apps that integrate with [Help Scout](https://www.helpscout.net/). More inforomation: [http://developer.helpscout.net/custom-apps/](http://developer.helpscout.net/custom-apps/)

Version 1.1 Released
---------------------
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

Help Scout Dynamic App Client Library
=====================================

Client library to assist with building custom apps that integrate with Help Scout. More inforomation: [http://developer.helpscout.net/custom-apps/](http://developer.helpscout.net/custom-apps/)

Version 1.0 Released
---------------------
Please see the [Changelog](https://github.com/helpscout/helpscout-apps-php/blob/master/CHANGELOG.md) for details.

Example Usage
---------------------
<pre><code>
use HelpScoutApp\DynamicApp;

include 'src/HelpScoutApp/DynamicApp.php';

$app = new DynamicApp('SECRET-KEY-HERE');
if ($app->isSignatureValid()) {
        $customer = $app->getCustomer();
        $user     = $app->getUser();
        $convo    = $app->getConversation();

        $html = array(
        	'&lt;p&gt;Convo&lt;/p&gt;',			
			'&lt;ul&gt;',
				'&lt;li&gt;Id: ' . $convo->getId() . '&lt;/li&gt;',
                '&lt;li&gt;Number: ' . $convo->getNumber() . '&lt;/li&gt;',
                '&lt;li&gt;Subject: ' . $convo->getSubject() . '&lt;/li&gt;',
            '&lt;/ul&gt;',
			'&lt;p&gt;Customer&lt;/p&gt;',
			'&lt;ul&gt;',
				'&lt;li&gt;First: ' . $customer->getFirstName() . '&lt;/li&gt;',
                '&lt;li&gt;Last: ' . $customer->getLastName() . '&lt;/li&gt;',
                '&lt;li&gt;Email: ' . $customer->getEmail() . '&lt;/li&gt;',
			'&lt;/ul&gt;',
			'&lt;p&gt;User&lt;/p&gt;',
			'&lt;ul&gt;',
                '&lt;li&gt;First: ' . $user->getFirstName() . '&lt;/li&gt;',
                '&lt;li&gt;Last: ' . $user->getLastName() . '&lt;/li&gt;',
                '&lt;li&gt;Id: ' . $user->getId() . '&lt;/li&gt;',
			'&lt;/ul&gt;'
        );
        echo $app->getResponse($html);
} else {
        echo 'Invalid Request');
}
</code></pre>

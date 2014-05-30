helpscout-apps-php
==================

Client library to help with building custom apps to integrate with Help Scout

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
        echo $app->getResponse('&lt;p&gt;Invalid Request&lt;/p&gt;');
}
</code></pre>
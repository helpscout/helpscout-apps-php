helpscout-apps-php
==================

Client library to help with building custom apps to integrate with Help Scout

Example Usage
---------------------
<pre><code>
include 'sumo.php';
use HelpScoutApp\DynamicApp;

include 'lib/src/HelpScoutApp/DynamicApp.php';

$app = new DynamicApp('1234');
if ($app->isSignatureValid()) {
        $customer = $app->getCustomer();
        $user     = $app->getUser();
        $convo    = $app->getConversation();

        $html = array(
                '<p>Convo</p>',
                '<ul><li>Id: ' . $convo->getId() . '</li>',
                '<li>Number: ' . $convo->getNumber() . '</li>',
                '<li>Subject: ' . $convo->getSubject() . '</li></ul>',
                '<p>Customer</p>',
                '<ul><li>First: ' . $customer->getFirstName() . '</li>',
                '<li>Last: ' . $customer->getLastName() . '</li>',
                '<li>Email: ' . $customer->getEmail() . '</li></ul>',
                '<p>User</p>',
                '<ul><li>First: ' . $user->getFirstName() . '</li>',
                '<li>Last: ' . $user->getLastName() . '</li>',
                '<li>Id: ' . $user->getId() . '</li></ul>'
        );
        echo $app->getResponse($html);
} else {
        echo $app->getResponse('<p>Invalid Request</p>');
}
</code></pre>
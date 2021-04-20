<?php


return [


    // sandbox
    'sandbox.client_id'=> env('PAYPAL_SANDBOX_CLIENT_ID'),
    'sandbox.secret'=> env('PAYPAL_SANDBOX_SECRET'),


    'settings' => [
        'mode' => env('PAYPAL_MODE','sandbox'),
        'http.ConnectionTimeOut' => 3000,
        'log.logEnabled' => true,
        'log.logFileName' => storage_path() .'/logs/paypal.log',
        'log.logLevel' => 'DEBUG'
    ]
]
?>

<?php

return [

    // The default gateway to use
    'default' => 'opayo',

    // Add in each gateway here
    'gateways' => [
        'paypal' => [
            'driver'  => 'PayPal_Express',
            'options' => [
                'solutionType'   => '',
                'landingPage'    => '',
                'headerImageUrl' => ''
            ]
        ],
        'opayo' => [
            'driver'  => 'SagePay_Direct', // Use SagePay_Direct for server-to-server integration, or SagePay_Server for form integration
            'options' => [
                'vendor' => env('OPAYO_VENDOR_NAME'),
                'testMode' => env('OPAYO_TEST_MODE', true),
                '3DSecure' => true, // Enable 3D Secure
                'apply3DSecure' => 2, // Use '2' for conditional, '1' for force, '0' to disable
                // Add other Opayo-specific configuration here
            ]
        ],
    ]

];

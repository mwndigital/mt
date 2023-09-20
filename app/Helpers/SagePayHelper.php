<?php

function getSagePayEndpoint()
{
    if (env('OPAYO_TEST_MODE')) {
        return 'https://test.sagepay.com/gateway/service/vspserver-register.vsp';
    } else {
        return 'https://live.sagepay.com/gateway/service/vspserver-register.vsp';
    }
}

function sendCurlRequest($integrationKey, $integrationPassword, $requestPayload)
{
    // Set up the HTTP headers and authentication
    $headers = [
        'Authorization: Basic ' . base64_encode($integrationKey . ':' . $integrationPassword),
        'Content-Type: application/json',
    ];

    // Initialize cURL session
    $ch = curl_init(getSagePayEndpoint() + '/v1/transactions');
    // Set cURL options
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestPayload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Close the cURL session
    curl_close($ch);

    return $response;
}

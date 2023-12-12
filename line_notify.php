<?php

function sendLineNotify($message) {
    // Line Notify Token
    $token = 'jxxv6V7yuIXx7VegGeD0RIc6D9dEtghbYuoTfgiiYZE';

    // API URL
    $apiURL = 'https://notify-api.line.me/api/notify';

    // Headers
    $headers = [
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Bearer ' . $token,
    ];

    // Message data
    $data = ['message' => $message];

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $apiURL);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session
    $result = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);

    return $result;
}
?>

<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$input_text = "i love you"; // Replace with your input text

try {
    $response = $client->post('https://1e1f-202-65-173-36.ngrok-free.app/predict', [
        'form_params' => [
            'input_text' => $input_text,
        ],
    ]);

    $result = json_decode($response->getBody()->getContents(), true);

    // Display the result
    echo "Predicted Emotion: " . $result['predicted_emotion'];

} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}

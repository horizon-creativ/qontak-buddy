<?php

require_once __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Exception\ClientException;

use Horizondoxa\QontakBuddy\Core\QontakClient;
use Horizondoxa\QontakBuddy\Modules\Broadcast;

$token = "eKe_fWOl3A6ROoreB9-eRovtgRN68pLJWgFBhpr90Ys";

$template_id = '0f10d2b5-f143-4c76-b413-3a9a236677c4';

$integration_id = 'e44eaa46-7a7c-45cb-9cea-1375c241fa66';

$message = 'Test pesan gagal atau tidak';

$client = new QontakClient($token);
$broadcast = new Broadcast($client);

$data = [
    'to_number' => '6285546112267',
    'to_name' => 'Al Ghifari',
    'message_template_id' => $template_id,
    'channel_integration_id' => $integration_id,
    'language' => [
        'code' => 'id',
    ],
    "parameters" => [
        'body' => [
            [
                'key' => '1',
                'value' => 'nama',
                'value_text' => 'Al Ghifari',
            ],
            [
                'key' => '2',
                'value' => 'message',
                'value_text' => trim(preg_replace('/\s+/', ' ', $message)),
            ],
            [
                'key' => '3',
                'value' => 'sender',
                'value_text' => 'System',
            ]
        ]
    ]
];

$response = $broadcast->sendMessage($data);

print_r($response);

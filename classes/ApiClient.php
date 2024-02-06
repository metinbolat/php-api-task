<?php

namespace classes;

require_once '../includes/request-handler.php';
require_once __DIR__ . '/../includes/session.php';
class ApiClient
{

    public function fetchData()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.baubuddy.de/dev/index.php/v1/tasks/select',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['access_token'],
            ],
        ]);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}

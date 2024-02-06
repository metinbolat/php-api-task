<?php

use classes\ApiClient;

require_once __DIR__ . '/../classes/ApiClient.php';


$apiClient = new ApiClient();


$api = json_decode($apiClient->fetchData());


$data = json_encode($api, true);
echo $data;

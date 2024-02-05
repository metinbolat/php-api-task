<?php

class Login
{
    private $apiUrl;
    public $username;
    protected $password;

    public function __construct($username, $password)
    {
        $this->apiUrl = 'https://api.baubuddy.de/index.php/login';
        $this->username = $username;
        $this->password = $password;
        echo $username;
        $this->authenticate($this->username, $this->password);
    }

    private function authenticate($username, $password)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->apiUrl,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                'username' => $username,
                'password' => $password,
            ]),
            CURLOPT_HTTPHEADER => [
                'Authorization: Basic QVBJX0V4cGxvcmVyOjEyMzQ1NmlzQUxhbWVQYXNz ',
                'Content-Type: application/json',
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        session_start();
        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200) {
            $data = json_decode($response, true);
            $_SESSION['access_token'] = $data['oauth']['access_token'];
            $_SESSION['token_expiration'] = time() + $data['oauth']['expires_in'];
            print_r($data);
        } else {
            $_SESSION["error"] = "An error occured during login, please try again.";
            header("Location: ../login.php");
            exit();
        }
    }
}

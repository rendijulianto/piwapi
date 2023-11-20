<?php 
namespace Rendijulianto\Piwapi;

class Main
{
    private $url;
    private $apikey;
    private $sender;

    // Constructor
    public function __construct($url, $apikey, $sender) {
        $this->url = $url;
        $this->apikey = $apikey;
        $this->sender = $sender;
    }

    // Send Message
    public function sendMessage($receiver, $message)
    {
        $postData = [

            "secret" => $this->apikey,
            "account" => $this->sender,
            "recipient" => $receiver,
            "type" => "text",
            "priority" => 1,
            "message" => $message,
        ];

        $cURL = curl_init($this->url);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURL, CURLOPT_POSTFIELDS, $postData);
        $response = curl_exec($cURL);
        curl_close($cURL);

        $result = json_decode($response, true);
        return $result;
    }
    
    public function checkNumber($phone)
    {
        if (substr($phone, 0, 2) != "62") {
            return false;
        }
        if (strlen($phone) < 10 || strlen($phone) > 15) {
            return false;
        }
        if (!is_numeric($phone)) {
            return false;
        }
        return true;
    }
}
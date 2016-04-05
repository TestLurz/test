<?php

class GCM
{
    function __construct()
    {
    }

    public function send_notification($registration_ids, $message) {
        include_once "../DBConnection.php";

        // Set POST variables
        $url = 'https://gcm-http.googleapis.com/gcm/send';

//        $fields = array(
//            'registration_ids' => ["fFfYdjGTSWY:APA91bHINk0h_c57QHDr2lcQ3XPqeVDQJf2jjpaApjP7pZvKM0KoB48B9qB5L9mo_RiKmpqmMfrehCzGUbRr59ijtgYAzee98gM6RVX5-uCNMC6LNZ6ItKMkQ5_BJg2hdKE_7boN96X5", "cjr1ayE5KhI:APA91bFJJwTzvxgzqXWjosqa0CTZ5b34hRNt8KFNEMggUV7sq1HCPvvhNe940tSLQtURXaFqRe9cQQ-qSRXl2RIM7Q3n4bAk6iY6yQTsGmcXNSlvf-8FM6IKFgii-V7_3bMyAfyi02_-"],
//            'data' => $message,
//        );

        $fields = array(
            'registration_ids' => $registration_ids,
            'data' => $message,
        );

        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        if ($result == FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        echo $result;
    }
}
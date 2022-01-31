<?php
    function perform_http_request($method, $url, $data = false) {
        $curl = curl_init();

        if ($data) {
            $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //If SSL Certificate Not Available, for example, I am calling from http://localhost URL

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }
?>
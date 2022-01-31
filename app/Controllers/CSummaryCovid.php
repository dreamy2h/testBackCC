<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class CSummaryCovid extends ResourceController {
    public function today() {
        helper(['curl']);
		$request = perform_http_request('GET', 'https://api.covid19api.com/summary');
        $json = json_decode($request);
        $coutries = $json->Countries;
        $data = [];
        foreach ($coutries as $key) {
            $row = [
                "ID" => $key->ID,
                "Country" => $key->Country,
                "TotalConfirmed" => $key->TotalConfirmed,
                "TotalDeaths" => $key->TotalDeaths,
                "TotalRecovered" => $key->TotalRecovered
            ];

            array_push($data, $row);
        }

        $data = ["payload" => $data];
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        return $this->respond($data, 200);
    }

    public function country($country) {
        helper(['curl']);
		$request = perform_http_request('GET', 'https://api.covid19api.com/country/' . $country);
        $json = json_decode($request);
        $data = [];
        foreach ($json as $key) {
            $row = [
                "ID" => $key->ID,
                "Active" => $key->Active,
                "Confirmed" => $key->Confirmed,
                "Deaths" => $key->Deaths,
                "Recovered" => $key->Recovered,
                "Date" => date('d/m/Y', strtotime($key->Date))
            ];

            array_push($data, $row);
        }

        $data = ["payload" => $data];
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        return $this->respond($data, 200);
    }
}
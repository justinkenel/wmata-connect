<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WmataApi
{
    public function __construct(string $base_uri, string $api_key) {
        $this->api_key = $api_key;
        $this->base_uri = $base_uri;
    }

    private string $api_key;
    private string $base_uri;

    private $station_list_cache;

    public function getStationList() {
        if(!is_null($this->station_list_cache)) {
            Log::info("Using Cached Value");
            return $this->station_list_cache;
        }

        Log::info("Requesting Station List");
        $res = Http::withHeaders([
            'api_key' => $this->api_key
        ])->get("$this->base_uri/Rail.svc/json/jStations");
        $this->station_list_cache = $res->json();
        Log::info("Returning Station List");
        return $this->station_list_cache;
    }

    public function getNextTrains(string $station) {
        $res = Http::withHeaders([
            'api_key' => $this->api_key
        ])->get("$this->base_uri/StationPrediction.svc/json/GetPrediction/$station");
        return $res->json();
    }
}

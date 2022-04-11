<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

// The Wmata API documentation can be found here:
//   https://developer.wmata.com/
// This makes use of two APIs:
//   - Rail Station Information
//       https://developer.wmata.com/docs/services/5476364f031f590f38092507/operations/5476364f031f5909e4fe330c
//   - Real-Time Rail Predictions
//       https://developer.wmata.com/docs/services/547636a6f9182302184cda78/operations/547636a6f918230da855363f
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

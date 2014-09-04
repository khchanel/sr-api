<?php

/**
 * GPS tracker data repository
 * This implementation works as a proxy for external Stream API
 */
class GpsStreamRepo implements IGpsRepo
{

    /**
     * Get all GPS trackers
     */
    public function all()
    {
        $trackers = $this->fetchStreamGps();

        return $trackers;
    }


    /**
     *  Get specific GPS tracker
     */
    public function get($id)
    {
        $trackers = $this->fetchStreamGps();

        foreach ($trackers as $tracker) {
            if ($tracker->Id == $id) {
                return $tracker;
            }
        }

        return null;
    }



    /**
     * Fetch GPS data externally from Stream
     */
    private function fetchStreamGps()
    {
        // init
        $server = Config::get('constants.API_SERVER');
        $api = '/Projects/Services/GPSServices.svc/GetTrackerDevCrossTable';
        $service = $server . $api;

        $cacheKey = 'gps_trackers';
        $expire = 0.5; // minute

        // exec
        $result = Cache::remember($cacheKey, $expire, function() use ($service) {
            // invoke remote service
            $resource = file_get_contents($service);
            $data = json_decode($resource);

            return $data;
        });

        // clear cache if the result is bad
        if (!$result) {
            Cache::forget($cacheKey);
        }

        return $result;
    }
}

<?php

class LocationController extends \BaseController {

    /**
     * Display a listing of SR locations.
     *
     * @return Response JSON
     */
    public function index()
    {
        $sr_locations = array('AIRL', 'BED1', 'HALL');

        return Response::json($sr_locations);
    }

}

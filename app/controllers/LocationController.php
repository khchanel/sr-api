<?php

class LocationController extends \BaseController {

    /**
     * Display a listing of SR locations.
     *
     * @return Response JSON
     */
    public function index()
    {
        $sr_locations = array(
                array('Code' => 1, 'Name' => 'AIRL', 'Description' => 'Air Lock'),
                array('Code' => 2, 'Name' => 'BED1', 'Description' => 'Bedroom 1'),
                array('Code' => 3, 'Name' => 'HALL', 'Description' => 'Hall'),
            );

        return Response::json($sr_locations);
    }

}

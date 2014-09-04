<?php

class GpsController extends \BaseController
{

    private $gps;


    public function __construct(IGpsRepo $gps)
    {
        $this->gps = $gps;
    }


    /**
     * Fetch a listing of the GPS tracker.
     *
     * @return Response
     */
    public function index()
    {
        $trackers = $this->gps->all();

        return Response::json($trackers);
    }


    /**
     * Fetch the specified GPS tracker.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $tracker = $this->gps->get($id);

        return Response::json($tracker);
    }
}

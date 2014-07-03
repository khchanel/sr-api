<?php

class SorsController extends \BaseController {


    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
    }


    /**
     * fetch a listing of the SORs.
     * GET /sor/
     * GET /sor/list
     *
     * @return array of SOR objects
     */
    public function index()
    {
        $sors = Sor::take(20)->get();
        return Response::json($sors);
    }

    /**
     * fetch a specific SOR record
     * GET /sor/{code}
     *
     * @return a SOR object
     */
    public function show($code)
    {
        $sor = Sor::find($code);
        return Response::json($sor);
    }

    /**
     * fetch a list of SOR filtered by location
     * GET /sor/location/{loc}
     *
     * @return array of SOR objects
     */
    public function location($loc)
    {
        $sors = Sor::where('Location', 'LIKE', "%$loc%")->get();
        return Response::json($sors);
    }
}

<?php

class SorsController extends \BaseController {


    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
    }


    /**
     * fetch a listing of the SORs.
     *
     * GET /sor
     * GET /sor?location=AIRL
     *
     * @return array of matching SOR objects
     */
    public function index()
    {
        $sors = Sor::take(20);

        // filter location
        if (Input::has('location')) {
            $loc = Input::get('location');
            $sors = $sors->where('Location', 'LIKE', "%$loc%");
        }

        return Response::json($sors->get());
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

}

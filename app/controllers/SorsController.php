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
        // init eloquent query
        $sors = Sor::getQuery();

        // filter location
        if (Input::has('location')) {
            $loc = Input::get('location');
            $sors = $sors->where('Location', 'LIKE', "%$loc%");
        }

        // paginate result
        if (Input::has('per_page') || Input::has('page')) {
            $perPage = Input::has('per_page') ? Input::get('per_page') : 15;
            $sors = $sors->paginate($perPage);
        } else {
            $sors = $sors->get();
        }

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

}

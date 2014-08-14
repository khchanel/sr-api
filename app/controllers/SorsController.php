<?php

class SorsController extends \BaseController {

    private $sors;

    public function __construct(ISorRepo $sors)
    {
        $this->sors = $sors;

        header('Access-Control-Allow-Origin: *');
    }


    /**
     * fetch a listing of the SORs.
     *
     * GET /sor
     * GET /sor?location=AIRL
     * GET /sor?page=1
     * GET /sor?per_page=20
     * GET /sor?keyword=flooring
     *
     * Can mix and match parameters
     *
     * @return array of matching SOR objects
     */
    public function index()
    {
        // init eloquent query
        $sors = $this->sors->getQuery();

        // filter location
        if (Input::has('location')) {
            $loc = Input::get('location');
            $sors = $sors->where('Location', 'LIKE', "%$loc%");
        }

        // search by keyword
        if (Input::has('keyword')) {
            $keyword = Input::get('keyword');

            $sors = $sors->where(function($sors) use ($keyword) {
                // SORCode
                // Name
                // LongDescription
                // Location
                $sors->where('SORCode', 'LIKE', "%$keyword%")
                    ->orWhere('Name', 'LIKE', "%$keyword%")
                    ->orWhere('LongDescription', 'LIKE', "%$keyword%")
                    ->orWhere('Location', 'LIKE', "%$keyword%");
            });
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
        $sor = $this->sors->findByCode($code);
        return Response::json($sor);
    }

}

<?php

class SorsController extends \BaseController {

    /**
     * Display a listing of the resource.
     * GET /sors
     *
     * @return Response
     */
    public function index()
    {
        //$sors = DB::table('sr_sors')->take(20)->get();
        $sors = Sor::take(20)->get();
        return Response::json($sors, 200, array('Access-Control-Allow-Origin' => '*'));
    }
    public function show($code)
    {
        //$sor = DB::table('sr_sors')->where('SORCode', $id)->first();
        $sor = Sor::find($code);
        return Response::json($sor, 200, array('Access-Control-Allow-Origin' => '*'));
    }


}
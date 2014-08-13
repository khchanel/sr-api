<?php

class ProjectController extends \BaseController {


    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
    }


    /**
     * Wrapper around getAllProjects()
     */
    public function index()
    {
        // verify user credentials are given
        if (!(Input::has('user') && Input::has('passwd'))) {
            return Response::json(array('error' => '401 Unauthorized'), 401);
        }

        $user = Input::get('user');
        $passwd = Input::get('passwd');

        return $this->getAllProjects($user, $passwd);
    }


    /**
     * Proxy to SR Get Project API
     * http://120.151.95.114:8080/projects/services/projects.svc/GetProjectsMethod/inputStr/{user}/{passwd}
     * params: $user, $passwd
     *
     * return array of all projects belonging to the user;
     */
    public function getAllProjects($user, $passwd)
    {
        $server = Config::get('constants.API_SERVER');
        $api = "/projects/services/projects.svc/GetProjectsMethod/inputStr/$user/$passwd";
        $service = $server . $api;
        $cache_key = 'projects_' . sha1($user . $passwd);
        $expire = 10; // minutes

        $result = Cache::remember($cache_key, $expire, $this->fetchAllProjectsClosure($service, $user));

        if (!$result) {
            // clear cache if the result is bad
            Cache::forget($cache_key);

            // make result an empty array if its empty
            $result = [];
        }

        return Response::json($result);
    }


    /**
     * Create a Closure to invoke web service to fetch projects
     *
     * @return Closure
     */
    private function fetchAllProjectsClosure($resourceUrl, $coordinator)
    {
        return function() use ($resourceUrl, $coordinator) {

            // invoke service
            $resource = file_get_contents($resourceUrl);
            $data = json_decode($resource);

            // verify response
            if (!$data) return null;

            // filter projects by coordinator
            $filtered = array();

            foreach ($data as $proj) {
                if (stripos($proj->Coordinator, $coordinator) !== FALSE) {
                    $filtered[] = $proj;
                }
            }

            return $filtered;
        };
    }
}

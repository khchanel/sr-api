<?php

class ProjectController extends \BaseController {


    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
    }


    /**
     * Proxy to SR Get Project API
     * http://120.151.95.114:8080/projects/services/projects.svc/GetProjectsMethod/inputStr/{user}/{passwd}
     * params: $user, $passwd
     *
     * return array of all projects belonging to the user;
     */
    public function getProject($user, $passwd)
    {
        $server = Config::get('constants.API_SERVER');
        $api = "/projects/services/projects.svc/GetProjectsMethod/inputStr/$user/$passwd";
        $cache_key = 'projects_' . sha1($user . $passwd);
        $expire = 10; // minutes

        $result = Cache::remember($cache_key, $expire,
            function() use ($server, $api, $user) {
                $data = json_decode(file_get_contents($server . $api));
                $filtered = array();

                // verify response
                if (!$data) return null;

                // filter projects by coordinator
                foreach ($data as $proj) {
                    if (stripos($proj->Coordinator, $user) !== FALSE){
                        $filtered[] = $proj;
                    }
                }

                return $filtered;
            }
        );

        // workaround: clear cache if the result is bad
        if (!$result) {
            Cache::forget('projects_' . $cache_key);
        }

        return Response::json($result);
    }

}

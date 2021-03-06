<?php

/**
 * IProjectRepo implementation based on Stream
 * This implementation works as a proxy for external Stream API
 */
class ProjectStreamRepo implements IProjectRepo
{
    private $param;


    public function __construct($param = array())
    {
        $this->setParam($param);
    }


    /**
     * Get an array of all projects
     *
     * @return Array
     */
    public function all()
    {
        // invoke Stream API
        $data = $this->fetchProjects();

        // verify response
        if (!$data) return null;

        return $data;
    }


    /**
     * Get an array of projects filtered by coordinator
     *
     * @return Array
     */
    public function getByCoordinator($coordinator)
    {
        // invoke Stream API
        $data = $this->fetchProjects();

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
    }


    /**
     * Get a single project by unique code
     *
     * @return project
     */
    public function get($code)
    {
        // invoke Stream API
        $data = $this->fetchProjects();

        // verify response
        if (!$data) return null;

        // search for the specific project by unique code
        $project = null;
        foreach ($data as $proj) {
            if ($proj->Code == $code) {
                $project = $proj;
                break;
            }
        }

        return $project;
    }


    /**
     * Get parameters
     *
     * @return Array
     */
    public function getParam()
    {
        return $this->param;
    }


    /**
     * Set parameters
     */
    public function setParam($param = array())
    {
        asort($param);
        $this->param = $param;
    }


    /**
     * fetch array of all projects from Stream
     * @return Array of all projects or NULL on error
     */
    private function fetchProjects()
    {
        // NOTE:
        // using user & passwd as cache key can avoid user without
        // correct credential to see cached result from prev genuine user

        // cache config
        $key = $this->param['user'] . '-' . $this->param['passwd'];
        $cacheKey = 'projects_' . $key;
        $expire = 10; // minutes

        // execute
        $result = Cache::remember($cacheKey, $expire, function() {
            // invoke service
            $resource = file_get_contents($this->serviceUri());
            $data = json_decode($resource);

            return $data;
        });

        // clear cache if the result is bad
        if (!$result) {
            Cache::forget($cacheKey);
        }

        return $result;
    }


    /**
     * @return  URI for the Stream get project API
     */
    private function serviceUri()
    {
        // configuration
        $user = $this->param['user'];
        $passwd = $this->param['passwd'];
        $server = Config::get('constants.API_SERVER');
        $api = "/projects/services/projects.svc/GetProjectsMethod/inputStr/$user/$passwd";
        $service =  $server . $api;

        return $service;
    }
}

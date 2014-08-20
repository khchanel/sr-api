<?php

class ProjectController extends \BaseController
{

    private $projects;
    private $errors = array (
            '401' => array('error' => '401 Unauthorized'),
        );


    /**
     * Constructor
     *
     * Using Dependency Injection
     * IProjectRepo for project data access
     */
    public function __construct(IProjectRepo $projectRepo)
    {
        $this->projects = $projectRepo;
    }


    /**
     * Get all project belonging to the user
     */
    public function index()
    {
        if (!$this->auth()) {
            return Response::json($this->errors['401'], 401);
        }

        $coordinator = Input::get('user');

        return Response::json($this->projects->getByCoordinator($coordinator));
    }


    /**
     * Fetch a specific project by project unique code
     */
    public function show($code)
    {
        if (!$this->auth()) {
            return Response::json($this->errors['401'], 401);
        }

        return Response::json($this->projects->get($code));
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
        // dirty hack to make it works with ProjectStreamRepo
        $param = array('user' => $user, 'passwd' => $passwd);
        Input::merge($param);

        return Response::json($this->projects->all());
    }


    /**
     * verify user credentials are given
     *
     * @return boolean
     */
    private function auth()
    {
        return Input::has('user') && Input::has('passwd');
    }


}

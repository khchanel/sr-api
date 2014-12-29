<?php

/**
 * IProjectRepo implementation based on local database
 */
class ProjectRepo implements IProjectRepo {

  private $param;

  public function __construct($param = array()) {
    $this->setParam($param);
  }

  /**
   * Get an array of all projects
   *
   * @return Array
   */
  public function all() {

    $data = Project::all();

    return $data;
  }

  /**
   * Get an array of projects filtered by coordinator
   *
   * @return Array
   */
  public function getByCoordinator($coordinator) {

    $data = Project::where('Coordinator', 'LIKE', "%$coordinator%")->get();

    return $data;
  }

  /**
   * Get a single project by unique code
   *
   * @return project
   */
  public function get($code) {

    $data = Project::find($code);

    return $data;
  }

  /**
   * Get parameters
   *
   * @return Array
   */
  public function getParam() {
    return $this->param;
  }

  /**
   * Set parameters
   */
  public function setParam($param = array()) {
    asort($param);
    $this->param = $param;
  }

}

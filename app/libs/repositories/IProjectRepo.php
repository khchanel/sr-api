<?php

interface IProjectRepo
{
    public function all();
    public function getByCoordinator($coordinator);
    public function get($code);

    public function getParam();
    public function setParam();
}

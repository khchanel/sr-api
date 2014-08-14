<?php

class SorEloquentRepo implements ISorRepo
{

    private $sorModel;


    public function __construct(Sor $sor)
    {
        $this->sorModel = $sor;
    }


    public function findByCode($code)
    {
        return $this->sorModel->find($code);
    }


    public function all()
    {
        return $this->sorModel->all();
    }


    /**
     * trick to forward methods to underlying model
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->sorModel, $method], $args);
    }

}

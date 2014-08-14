<?php

interface ISorRepo
{
    public function findByCode($code);
    public function all();
}

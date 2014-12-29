<?php

class Project extends \Eloquent {
	protected $fillable = [];
	protected $table = 'sr_projects';
	public $primaryKey = 'Code';
	public $timestamps = false;
}

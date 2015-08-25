<?php

class Referer_google extends Application {

	public function __construct()
	{
		parent::__construct();
		$this->ag_auth->restrict('admin');
	}

	public function index()
	{
		$this->ag_auth->view('tools/referer_google/index');
	}
}

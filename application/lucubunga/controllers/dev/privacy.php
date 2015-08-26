<?php

class Privacy extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->helper('view');
	}

	public function index()
	{
		mycache($this);
		load_my_view($this, '/privacy/index');
	}
}

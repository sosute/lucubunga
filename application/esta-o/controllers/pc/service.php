<?php

class Service extends CI_Controller {

    public function __construct()
    {
		parent::__construct();
		$this->config->load('esta_paypal');
        $this->load->helper('view');
	}

	public function index()
	{
		mycache($this);
        $data_contents = array();
        $data_frame = array();
        load_my_view($this, '/service/index', $data_contents, $data_frame);
	}
}

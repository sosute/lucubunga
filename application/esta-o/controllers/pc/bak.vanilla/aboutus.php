<?php

class Aboutus extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->config->load('esta_paypal');
	}

	public function index()
	{
		mycache($this);
		$data_contents = array();
		$contents = $this->load->view('pc/contents/aboutus/index', $data_contents, TRUE);
		$data_frame = array();
		$data_frame['contents'] = $contents;
		$this->load->view('pc/frame/main', $data_frame);
	}
}

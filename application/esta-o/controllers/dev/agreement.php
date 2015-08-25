<?php

class Agreement extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('view');
    }

	public function index()
	{
		mycache($this);
        $data_contents = array();
        $data_frame = array();
        load_my_view($this, '/agreement/index', $data_contents, $data_frame);
	}
}

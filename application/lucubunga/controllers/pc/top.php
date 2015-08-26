<?php

class Top extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->load->helper('view');
    }

    public function index()
    {
        //mycache($this);
		$data_contents = array();
		$contents = $this->load->view('pc/contents/top/index', $data_contents, TRUE);
		$data_frame = array();
		$data_frame['contents'] = $contents;
		$this->load->view('pc/frame/top', $data_frame);
    }
}

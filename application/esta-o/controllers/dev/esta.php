<?php

class Esta extends CI_Controller {

	public function index()
	{
		mycache($this);
		$env = $this->config->item('env');
		$data_contents = array();
		$contents = $this->load->view('pc/contents/'.$env.'/esta/index', $data_contents, TRUE);
		$data_frame = array();
		$data_frame['contents'] = $contents;
		$this->load->view('pc/frame/'.$env.'main', $data_frame);
	}
}

<?php

class Contact extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->config->load('esta_validation');
        $this->config->load('esta_param_ask');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('view');
	}

	public function index()
	{
        $rules = $this->config->item('validation_contact');
        $this->form_validation->set_rules($rules);
		if ($this->form_validation->run() === FALSE)
		{
			$this->_load_view_index();
		}
		else
		{
			$this->session->set_userdata('contact', 'TRUE');
			$this->_load_view_confirm();
		}
	}

	public function done()
	{
		if ($this->session->userdata('contact') !== 'TRUE')
		{
			show_error('not authorized to view this page.');
		}
		$this->_load_view_done();
		$this->session->sess_destroy();

		// データ整形
		$env_url = $this->config->item('env_url');
		$mail_path = 'pc/mail'.$env_url.'/contact/';
		$data = $this->input->post();
		$data['hostname'] = $this->config->item('hostname');

		// お問合せメールを管理者宛てに送信する
		$this->email->to($this->config->item('my_mail_address'));
		$this->email->from($this->input->post('email'));
		$this->email->subject($this->load->view($mail_path.'to_admin_subject', $data, TRUE));
		$this->email->message($this->load->view($mail_path.'to_admin_message', $data, TRUE));
		if ( ! $this->email->send())
		{
			$err_message = ''.
				'!! failed to send mail to admin. contact message is accepted. !!'."\n".
				var_export($data, TRUE);
			trigger_error($err_message, E_USER_ERROR);
		}

		// お問合せメールを受理した事をお客様にメールで伝える
		$this->email->to($this->input->post('email'));
		$this->email->from($this->config->item('my_mail_address'));
		$this->email->subject($this->load->view($mail_path.'to_customer_subject', $data, TRUE));
		$this->email->message($this->load->view($mail_path.'to_customer_message', $data, TRUE));
		if ( ! $this->email->send())
		{
			$err_message = ''.
				'!! failed to send mail to customer. contact message is accepted. !!'."\n".
				var_export($data, TRUE);
			trigger_error($err_message, E_USER_ERROR);
		}
	}

	private function _load_view_index()
	{
        $data_contents = array();
		$data_contents['param_metas'] = $this->config->item('param_metas');
        $data_frame = array();
        load_my_view($this, '/contact/index', $data_contents, $data_frame);
	}

	private function _load_view_confirm()
	{
        $data_contents = array();
        $data_contents = $this->input->post();
        $data_contents['param_metas'] = $this->config->item('param_metas');
        $data_frame = array();
        load_my_view($this, '/contact/confirm', $data_contents, $data_frame);
	}

	private function _load_view_done()
	{
        $data_contents = array();
		$data_contents = $this->input->post();
        $data_frame = array();
        load_my_view($this, '/contact/done', $data_contents, $data_frame);
	}
}

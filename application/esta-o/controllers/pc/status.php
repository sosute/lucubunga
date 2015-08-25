<?php

class Status extends CI_Controller {

	const PAGE_TYPE_INIT      = 'init';
	const PAGE_TYPE_INVALID   = 'invalid';
	const PAGE_TYPE_NOT_FOUND = 'not_found';
	const PAGE_TYPE_HIT       = 'hit';

	private $_issue_id = '';
	private $_status_id = '';

	private $_data_contents = array(
		'page_type'   => self::PAGE_TYPE_INIT,
		'status_desc' => '',
		'app_values'  => array(),
	);

	public function __construct()
	{
		parent::__construct();
		$this->config->load('esta_param');
		$this->config->load('esta_redmine');
		$this->load->helper('view');
		$this->load->library('form_validation');
		$this->load->database();
	}

	public function index()
	{
		// お申込みIDの状態確認、データ取得
		$app_id = $this->input->get('app_id');
		if ($app_id !== FALSE && $app_id !== '')
		{
			$_POST['app_id'] = $app_id;
			if ($this->form_validation->run('status') === FALSE)
			{
				$this->_data_contents['page_type'] = self::PAGE_TYPE_INVALID;
			}
			else
			{
				$this->_set_issue_id_and_status_id($app_id);
				$status_id = $this->_get_status_id();
				if ($status_id === '')
				{
					$this->_data_contents['page_type'] = self::PAGE_TYPE_NOT_FOUND; 
				}
				else
				{
					$issue_id = $this->_get_issue_id();
					$this->_data_contents = array(
						'page_type'   => self::PAGE_TYPE_HIT,
						'status_desc' => $this->config->item('redmine_status_desc_'.$status_id),
						'app_values'  => $this->_get_app_values($issue_id),
					);
				}
			}
		}

		// ページ出力
        $data_contents = $this->_data_contents;
		$data_frame = array();
        load_my_view($this, '/status/index', $data_contents, $data_frame);
	}

	private function _set_issue_id_and_status_id($app_id)
	{
		$query_str = ''.
			'select '.
				'i.id, '.
				'i.status_id '.
			'from '.
				'issues i, custom_values c '.
			'where '.
				'c.customized_id = i.id and '.
				'c.value = "'.$app_id.'" and '.
				'i.tracker_id = "'.$this->config->item('redmine_tracker_id_paid').'"';
		$query = $this->db->query($query_str);
		$issue = $query->row();
		if ( ! empty($issue))
		{
			$this->_issue_id  = $issue->id;
			$this->_status_id = $issue->status_id;
		}
	}

	private function _get_issue_id()
	{
		return $this->_issue_id;
	}

	private function _get_status_id()
	{
		return $this->_status_id;
	}

	private function _get_app_values($issue_id)
	{
		// 取得対象アイテム
		$param_metas = $this->config->item('param_metas');

		// 過去の申請情報取得
		$items = array();
		foreach ($param_metas as $key => $meta)
		{
			if ($meta['redmine_cf_id'] === null) continue;
			$name_mb = (isset($meta['name_mb_uniq'])) ? $meta['name_mb_uniq'] : $meta['name_mb'];
			$items[$key] = array(
				'name_mb' => $name_mb,
				'redmine_cf_id' => $meta['redmine_cf_id'],
			);
		}

		// アイテム取得
		$app_values = array();
		foreach ($items as $param_id => $meta)
		{
			$sql = ''.
				'select '.
					'v.value '.
				'from '.
					'custom_values v '.
				'where '.
					'v.customized_id = "'.$issue_id.'" and '.
					'v.custom_field_id = "'.$meta['redmine_cf_id'].'"';
			$query = $this->db->query($sql);
			$row = $query->row(); 

			if ( ! isset($row->value)) continue;
			$app_values[$param_id] = array(
				'name_mb' => $meta['name_mb'],
				'value' => $row->value,
			);
		}
		return $app_values;
	}
}

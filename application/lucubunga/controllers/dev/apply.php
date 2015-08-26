<?php

class Apply extends CI_Controller {

	const PAST_ORDER_STATUS_NONE  = 'none';
	const PAST_ORDER_STATUS_MATCH = 'match';
	const PAST_ORDER_STATUS_DIFF  = 'diff';

	public function __construct()
	{
		parent::__construct();
		$this->config->load('esta_form');
		$this->config->load('esta_redmine');
		$this->config->load('esta_geo');
		$this->config->load('esta_device');
		$this->config->load('esta_validation');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('redmine');
		$this->load->library('user_agent');
		$this->load->helper('view');
		$this->load->database();

		$env = $this->config->item('env');
		$this->config->load('esta_paypal'.$env);
		$this->config->load('esta_param'.$env);
	}

	public function step1()
	{
		// バリデーション検証
		$rules = $this->config->item('validation_apply');
		if ($this->input->post('has_alias') === 'Yes') {
			$rules = array_merge($rules, $this->config->item('validation_has_alias'));
		}
		if ($this->input->post('has_other_nation') === 'Yes') {
			$rules = array_merge($rules, $this->config->item('validation_has_other_nation'));
		}
		if ($this->input->post('is_set_emg_contact') === 'Yes') {
			$rules = array_merge($rules, $this->config->item('validation_emg'));
		}
		if ($this->input->post('employment_exp') === 'Yes') {
			$rules = array_merge($rules, $this->config->item('validation_employment_exp'));
		}
		$this->form_validation->set_rules($rules);
		// ページ出し分け
		if (
			$this->form_validation->run() === false ||
			$this->input->post('type') === 'modify' // 内容修正
		)
		{
			$this->_load_view_input();
		}
		else
		{
			$this->session->set_userdata('app', 'TRUE');
			$this->_load_view_confirm();
		}
	}

	public function step2()
	{
		$post = $this->input->post();
		if ($this->session->userdata('app') !== 'TRUE' || empty($post))
		{
			show_error('not authorized to view this page.');
		}

		// 決済情報の有無や申請情報の差異を検証し表示ページを出し分ける
		$app_values = $this->_cook_app_values($post);
		$app_values = $this->_get_past_ortder_status_and_values($app_values);
		$this->output->set_header('Cache-Control: no-store');
		switch ($app_values['status'])
		{
			case self::PAST_ORDER_STATUS_NONE:
				$this->_write_issue_new($app_values);
				$this->_load_view_pay($app_values);
				break;
			case self::PAST_ORDER_STATUS_DIFF:
				$this->_load_view_diff($app_values);
				break;
			case self::PAST_ORDER_STATUS_MATCH:
				$this->_load_view_match($app_values);
				$this->session->unset_userdata('app');
				break;
		}
	}

	public function step3()
	{
		if ($this->session->userdata('app') === 'TRUE')
		{
			if ($this->input->post('diff') === 'TRUE') // 修正項目があれば書き込
			{
				$this->_write_issue_diff();
			}
			else // 新規お申込みの場合、paypal経由のアクセス以外は弾く
			{
				$referrer_host = parse_url($this->agent->referrer(), PHP_URL_HOST);
				if ($referrer_host !== NULL && preg_match('/^.*paypal\.com$/', $referrer_host) !== 1)
				{
					show_error('unauthorized access.');
				}
			}
		}
		else
		{
			show_error('after the payment, this page will be displayed only once.');
		}
		$this->_load_view_done();
		$this->session->unset_userdata('app');
	}

	private function _load_view_input()
	{
        $data_contents = array();
		$data_contents['form_birth_year'] = $this->config->item('form_birth_year');
		$data_contents['form_passport_from_year'] = $this->config->item('form_passport_from_year');
		$data_contents['form_passport_to_year'] = $this->config->item('form_passport_to_year');
		$data_contents['form_month'] = $this->config->item('form_month');
		$data_contents['form_day'] = $this->config->item('form_day');
		$data_contents['form_country_national'] = $this->config->item('form_country_national');
		$data_contents['form_country_birth'] = $this->config->item('form_country_birth');
		$data_contents['form_states'] = $this->config->item('form_states');
		$data_contents['form_tel_type'] = $this->config->item('form_tel_type');
		$data_contents['form_country_other_nation'] = $this->config->item('form_country_other_nation');
		$data_contents['form_country_phone_code'] = $this->config->item('form_country_phone_code');
		$data_contents['param_metas'] = $this->config->item('param_metas');
        $data_frame = array();
        load_my_view($this, '/apply/input', $data_contents, $data_frame);
	}

	private function _load_view_confirm()
	{
		$data_contents = array();
		$data_contents = $this->input->post();
		$data_contents['param_metas'] = $this->config->item('param_metas');
        $data_frame = array();
        load_my_view($this, '/apply/confirm', $data_contents, $data_frame); 
	}

	private function _load_view_pay($app_values)
	{
		$data_contents = array();
        $data_contents = $app_values;
        $data_frame = array();
        load_my_view($this, '/apply/pay', $data_contents, $data_frame);
	}

	private function _load_view_diff($app_values)
	{
		$data_contents = array();
        $data_contents = $app_values;
		$data_contents['param_metas'] = $this->config->item('param_metas');
        $data_frame = array();
        load_my_view($this, '/apply/diff', $data_contents, $data_frame);
	}

	private function _load_view_match($app_values)
	{
		$data_contents = array();
        $data_contents = $app_values;
		$data_contents['param_metas'] = $this->config->item('param_metas');
        $data_frame = array();
		load_my_view($this, '/apply/match', $data_contents, $data_frame);
	}

	private function _load_view_done()
	{
		$data_contents = array();
        $data_frame = array();
        load_my_view($this, '/apply/done', $data_contents, $data_frame);
	}

	private function _get_past_ortder_status_and_values($app_values)
	{
		$app_values['past'] = array();
		$app_values['diff'] = array();
		$app_values['status'] = NULL;

		// ユーザの最新決済済み申し込み情報を取り出す
		$query_str = ''.
			'select '.
				'i.id, i.start_date '.
			'from '.
				'issues i, custom_values c '.
			'where '.
				'c.customized_id = i.id and '.
				'c.value = "'.$app_values['user_id'].'" and '.
				'i.tracker_id = "'.$this->config->item('redmine_tracker_id_paid').'" and '.
				'i.start_date >= "'.date('Y-m-d', strtotime('-6 months')).'" '.// 半年以内
			'order by '.
				'i.created_on desc '.
			'limit '.
				'1';
		$query = $this->db->query($query_str);
		$issue = $query->row();

		if (empty($issue)) // 過去の申請情報なし
		{
			$app_values['status'] = self::PAST_ORDER_STATUS_NONE;
			return $app_values;
		}
		else
		{
			// 過去の申請のESTA有効期限が切れていたら、新規扱い
			$query_str = ''.
				'select '.
					'replace(value, "/", "") as value '.
				'from '.
					'custom_values '.
				'where '.
					'customized_id = "'.$issue->id.'" and '.
					'custom_field_id = "'.$this->config->item('redmine_custom_field_id_esta_app_expired').'"';
			$query = $this->db->query($query_str);
			if ($query->num_rows() === 0)
			{
				$app_expired = NULL;
			}
			else
			{
				$row = $query->row();
				$app_expired = $row->value;
			}
			if ( ! empty($app_expired) && (int)$app_expired <= (int)$app_values['app_date'])
			{
				$app_values['status'] = self::PAST_ORDER_STATUS_NONE;
				return $app_values;
			}

			// -----------------------------------------
			// 過去の申請情報を取得して、現在の申請情報と比較する
			// -----------------------------------------

			$app_values_past = array();
			$app_values_past['issue_id'] = $issue->id;
			$app_values_past['start_date'] = $issue->start_date;
			$param_metas = $this->config->item('param_metas');

			// 過去の申請情報（比較対象カスタムフィールド）取得
			foreach ($param_metas as $key => $meta)
			{
				if ($meta['is_diff_check'] === false) continue;
				$query_str = ''.
					'select '.
						'value '.
					'from '.
						'custom_values '.
					'where '.
						'customized_id = "'.$issue->id.'" and '.
						'custom_field_id = "'.$meta['redmine_cf_id'].'"';
				$query = $this->db->query($query_str);
				$row = $query->row();
				$app_values_past[$key] = $row->value;
			}

			// 過去の申請情報（お申込みID）取得	
			$query_str = ''.
				'select '.
					'value '.
				'from '.
					'custom_values '.
				'where '.
					'customized_id = "'.$issue->id.'" and '.
					'custom_field_id = "'.$this->config->item('redmine_custom_field_id_app_id').'"';
			$query = $this->db->query($query_str);
			$row = $query->row();
			$app_values_past['app_id'] = $row->value;

			// 現在の申請情報と過去の申請情報を比較して差異があるか評価
			$app_values_diff = array();
            foreach ($param_metas as $key => $meta)
            {
                if ($meta['is_diff_check'] === false) continue;
				if ($app_values[$key] != $app_values_past[$key])
				{
					$app_values_diff[$key] = TRUE;
				}
			}
			if (empty($app_values_diff) === TRUE) // 同一の申請情報
			{
				$values = array();
				$values['current'] = $app_values;
				$values['past'] = $app_values_past;
				$values['past'] = $app_values_past;
				$values['status'] = self::PAST_ORDER_STATUS_MATCH;
				return $values;
			}
			else // 申請情報に差異あり
			{
				$app_values['past'] = $app_values_past;
				$app_values['diff'] = $app_values_diff;
				$app_values['status'] = self::PAST_ORDER_STATUS_DIFF;
				return $app_values;
			}
		}
	}

	private function _write_issue_new($app_values)
	{
		// 既に申請情報が存在した場合は上書き更新
		$query_str = ''.
			'select '.
				'i.id '.
			'from '.
				'issues i, custom_values c '.
			'where '.
				'c.customized_id = i.id and '.
				'c.value = "' . $app_values['app_id'] . '"';
		$query = $this->db->query($query_str);
		$issue = $query->row();
		$id = (empty($issue) === TRUE) ? NULL : $issue->id;

		// 設定する優先順位を決める
		$priority_id = $this->_get_priority_id($app_values);

		// 書き出すカスタムフィールドを整える
		$redmine_cf_base = array(
			array(
				'id' => $this->config->item('redmine_custom_field_id_user_id'),
				'value' => $app_values['user_id'],
			),
			array(
				'id' => $this->config->item('redmine_custom_field_id_app_id'),
				'value' => $app_values['app_id'],
			),
			array(
				'id' => $this->config->item('redmine_custom_field_id_age_zone'),
				'value' => $app_values['age_zone'],
			),
			array(
				'id' => $this->config->item('redmine_custom_field_id_app_week'),
				'value' => $app_values['app_week'],
			),
			array(
				'id' => $this->config->item('redmine_custom_field_id_where_access_from'),
				'value' => $this->config->item('where_access_from'),
			),
			array(
				'id' => $this->config->item('redmine_custom_field_id_paypal_txn_id'),
				'value' => '',
			),
			array(
				'id' => $this->config->item('redmine_custom_field_id_paypal_receipt_id'),
				'value' => '',
			),
			array(
				'id' => $this->config->item('redmine_custom_field_id_ad'),
				'value' => (string)$this->session->userdata('ad'),
			),
			array(
				'id' => $this->config->item('redmine_custom_field_id_what_device_access_from'),
				'value' => $this->config->item('what_device_access_from'),
			),
		);
		$redmine_cf_ex = array();
		$param_metas = $this->config->item('param_metas');
		foreach ($param_metas as $key => $meta)
		{
			if ($meta['redmine_cf_id'] === null) continue;
			$redmine_cf_ex[] = array(
				'id' => $meta['redmine_cf_id'],
				'value' => $app_values[$key],
			);
		}
		$redmine_cf = array_merge($redmine_cf_base, $redmine_cf_ex);

		$values = array(
			'id' => $id,
			'key' => $this->config->item('redmine_rest_key'),
			'project_id' => $this->config->item('redmine_project_id_esta'),
			'tracker_id' => $this->config->item('redmine_tracker_id_shinsei'),
			'status_id' => $this->config->item('redmine_status_id_wait'),
			'priority_id' => $priority_id,
			'author_id' => $this->config->item('redmine_author_id_admin'),
			'start_date' => $app_values['app_date_sep'],
			'subject' => $app_values['subject'],
			'description' => $app_values['description'],
			'custom_fields' => $redmine_cf,
		);
			/*
			'custom_fields' => array(

				// メタデータ
				array(
					'id' => $this->config->item('redmine_custom_field_id_user_id'),
					'value' => $app_values['user_id'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_app_id'),
					'value' => $app_values['app_id'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_age_zone'),
					'value' => $app_values['age_zone'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_app_week'),
					'value' => $app_values['app_week'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_where_access_from'),
					'value' => $this->config->item('where_access_from'),
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_paypal_txn_id'),
					'value' => '',
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_paypal_receipt_id'),
					'value' => '',
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_ad'),
					'value' => (string)$this->session->userdata('ad'),
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_what_device_access_from'),
					'value' => $this->config->item('what_device_access_from'),
				),

				// 申請者情報
				array(
					'id' => $this->config->item('redmine_custom_field_id_lastname'),
					'value' => $app_values['lastname'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_firstname'),
					'value' => $app_values['firstname'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_has_alias'),
					'value' => $app_values['has_alias'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_alias_lastname'),
					'value' => $app_values['alias_lastname'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_alias_firstname'),
					'value' => $app_values['alias_firstname'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_birth_date'),
					'value' => $app_values['birth_date'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_sex'),
					'value' => $app_values['sex'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_country_national'),
					'value' => $app_values['country_national'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_country_birth'),
					'value' => $app_values['country_birth'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_city_birth'),
					'value' => $app_values['city_birth'],
				),

				// その他の国籍
				array(
					'id' => $this->config->item('redmine_custom_field_id_has_other_nation'),
					'value' => $app_values['has_other_nation'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_country_other_nation'),
					'value' => $app_values['country_other_nation'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_passport_number_other_nation'),
					'value' => $app_values['passport_number_other_nation'],
				),

				// 両親の氏名
				array(
					'id' => $this->config->item('redmine_custom_field_id_parent1_lastname'),
					'value' => $app_values['parent1_lastname'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_parent1_firstname'),
					'value' => $app_values['parent1_firstname'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_parent2_lastname'),
					'value' => $app_values['parent2_lastname'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_parent2_firstname'),
					'value' => $app_values['parent2_firstname'],
				),

				// パスポート情報
				array(
					'id' => $this->config->item('redmine_custom_field_id_passport_number'),
					'value' => $app_values['passport_number'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_passport_from_date'),
					'value' => $app_values['passport_from_date'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_passport_to_date'),
					'value' => $app_values['passport_to_date'],
				),

				// 連絡先情報
				array(
					'id' => $this->config->item('redmine_custom_field_id_email'),
					'value' => $app_values['email'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_tel'),
					'value' => $app_values['tel'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_tel_type'),
					'value' => $app_values['tel_type'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_is_set_emg_contact'),
					'value' => $app_values['is_set_emg_contact'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_emg_lastname'),
					'value' => $app_values['emg_lastname'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_emg_firstname'),
					'value' => $app_values['emg_firstname'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_emg_email'),
					'value' => $app_values['emg_email'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_emg_country_phone_code'),
					'value' => $app_values['emg_country_phone_code'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_emg_tel'),
					'value' => $app_values['emg_tel'],
				),

				// クレジットカード名義 書き出さない

				//ご自宅住所
				array(
					'id' => $this->config->item('redmine_custom_field_id_address_country'),
					'value' => $app_values['billing_country'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_address_zip'),
					'value' => $app_values['billing_zip'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_address_state'),
					'value' => $app_values['billing_state'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_address_city'),
					'value' => $app_values['billing_city'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_address_number'),
					'value' => $app_values['billing_address1'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_address_building'),
					'value' => $app_values['billing_building'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_address_room_number'),
					'value' => $app_values['billing_room_number'],
				),

				// 渡航情報
				array(
					'id' => $this->config->item('redmine_custom_field_id_for_via'),
					'value' => $app_values['for_via'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_us_contact_name'),
					'value' => $app_values['us_contact_name'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_us_contact_address_state'),
					'value' => $app_values['us_contact_address_state'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_us_contact_address_city'),
					'value' => $app_values['us_contact_address_city'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_us_contact_address_number'),
					'value' => $app_values['us_contact_address_number'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_us_contact_address_building'),
					'value' => $app_values['us_contact_address_building'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_us_contact_address_room_number'),
					'value' => $app_values['us_contact_address_room_number'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_us_contact_tel'),
					'value' => $app_values['us_contact_tel'],
				),

				// 雇用情報
				array(
					'id' => $this->config->item('redmine_custom_field_id_employment_exp'),
					'value' => $app_values['employment_exp'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_employment_name'),
					'value' => $app_values['employment_name'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_employment_address_country'),
					'value' => $app_values['employment_address_country'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_employment_address_state'),
					'value' => $app_values['employment_address_state'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_employment_address_city'),
					'value' => $app_values['employment_address_city'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_employment_address_number'),
					'value' => $app_values['employment_address_number'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_employment_address_building'),
					'value' => $app_values['employment_address_building'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_employment_tel'),
					'value' => $app_values['employment_tel'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_employment_job_type'),
					'value' => $app_values['employment_job_type'],
				),

				// その他の質問事項
				array(
					'id' => $this->config->item('redmine_custom_field_id_q1'),
					'value' => $app_values['q1'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_q2'),
					'value' => $app_values['q2'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_q3'),
					'value' => $app_values['q3'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_q4'),
					'value' => $app_values['q4'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_q5'),
					'value' => $app_values['q5'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_q6'),
					'value' => $app_values['q6'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_q6_when'),
					'value' => $app_values['q6_when'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_q6_where'),
					'value' => $app_values['q6_where'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_q7'),
					'value' => $app_values['q7'],
				),
				array(
					'id' => $this->config->item('redmine_custom_field_id_q8'),
					'value' => $app_values['q8'],
				),

				// 一応書き出す情報
				array(
					'id' => $this->config->item('redmine_custom_field_id_country_live'),
					'value' => $app_values['country_live'],
				),
				*/
		$this->redmine->set($values)->save();
		if ($this->redmine->error !== FALSE)
		{
			$message = ''.
				'failed to write redmine db. app values without paid.'."\n".
				'error message is ... '.$this->redmine->error."\n".
				'$values => '.var_export($values, TRUE);
			trigger_error($message, E_USER_ERROR);
		}
	}

	private function _write_issue_diff()
	{
		// 優先順位を決定する
		$priority_id = $this->_get_priority_id($this->input->post());

		$values = array(
			'id' => $this->input->post('issue_id'),
			'key' => $this->config->item('redmine_rest_key'),
			'status_id' => $this->config->item('redmine_status_id_new'),
			'description' => htmlspecialchars_decode($this->input->post('description', FALSE)),
			'priority_id' => $priority_id,
			'assigned_to_id' => '',
		);

		$param_metas = $this->config->item('param_metas');
		foreach ($param_metas as $key => $meta)
		{
			if ($meta['is_diff_check'] === false) continue;
			if ($this->input->post($key) !== FALSE)
			{
				$values['custom_fields'][] = array(
					'id' => $meta['redmine_cf_id'],
					'value' => $this->input->post($key),
				);
			}
		}
		$values['custom_fields'][] = array(
			'id' => $this->config->item('redmine_custom_field_id_esta_app_id'),
			'value' => '',
		);
		$values['custom_fields'][] = array(
			'id' => $this->config->item('redmine_custom_field_id_esta_app_expired'),
			'value' => '',
		);
		$values['custom_fields'][] = array(
			'id' => $this->config->item('redmine_custom_field_id_esta_mail_status'),
			'value' => '未送信',
		);
		$this->redmine->set($values)->save();
		if ($this->redmine->error !== FALSE)
		{
			$message = ''.
				'failed to write redmine db. diff values.'."\n".
				'error message is ... '.$this->redmine->error."\n".
				'$values => '.var_export($values, TRUE);
			trigger_error($message, E_USER_ERROR);
		}
	}

	private function _cook_app_values($app_values)
	{
		$timestamp = time();
		$app_date = date('Ymd', $timestamp);
		$app_date_sep = date('Y-m-d', $timestamp);
		$app_week = get_mb_week($timestamp);
		$app_values['app_date'] = $app_date;
		$app_values['app_date_sep'] = $app_date_sep;
		$app_values['app_week'] = $app_week;
		$app_values['app_id'] = get_esta_app_id($app_values);
		$app_values['user_id'] = get_esta_app_user_id($app_values);
		$app_values['birth_date'] = sprintf(
			'%04d-%02d-%02d',
			$app_values['birth_year'],
			$app_values['birth_month'],
			$app_values['birth_day']
		);
		$birth_date = sprintf(
			'%04d%02d%02d',
			$app_values['birth_year'],
			$app_values['birth_month'],
			$app_values['birth_day']
		);
		$app_values['passport_from_date'] = sprintf(
			'%04d-%02d-%02d',
			$app_values['passport_from_year'],
			$app_values['passport_from_month'],
			$app_values['passport_from_day']
		);
		$app_values['passport_to_date'] = sprintf(
			'%04d-%02d-%02d',
			$app_values['passport_to_year'],
			$app_values['passport_to_month'],
			$app_values['passport_to_day']
		);

		// 空欄だった場合にUNKNOWNを設定する項目
		$unknown_lists = array(
			'city_birth',
			'parent1_lastname',
			'parent1_firstname',
			'parent2_lastname',
			'parent2_firstname',
			'emg_lastname',
			'emg_firstname',
			'emg_email',
		);
		if ($app_values['for_via'] === 'No')
		{
			$unknown_lists[] = 'us_contact_name';
			$unknown_lists[] = 'us_contact_address_city';
			$unknown_lists[] = 'us_contact_address_number';
		}
		if ($app_values['employment_exp'] === 'Yes')
		{
			$unknown_lists[] = 'employment_name';
			$unknown_lists[] = 'employment_address_state';
			$unknown_lists[] = 'employment_address_city';
			$unknown_lists[] = 'employment_address_number';
		}
		foreach ($unknown_lists as $key)
		{
			if ($app_values[$key] === '')
			{
				$app_values[$key] = 'UNKNOWN';
			}
		}

		// 空欄だった場合にXXを設定する項目
		$xx_lists = array();
		if ($app_values['for_via'] === 'No')
		{
			$xx_lists[] = 'us_contact_address_state';
		}
		foreach ($xx_lists as $key)
		{
			if ($app_values[$key] === '')
			{
				$app_values[$key] = 'XX';
			}
		}

		// 空欄だった場合に0を設定する項目
		$zero_lists = array(
			'emg_country_phone_code',
			'emg_tel',
		);
		if ($app_values['for_via'] === 'No')
		{
			$zero_lists[] = 'us_contact_tel';
		}
		foreach ($zero_lists as $key)
		{
			if ($app_values[$key] === '')
			{
				$app_values[$key] = '0';
			}
		}
		$app_values['subject'] = ''.
			$app_values['lastname'].' '.
			$app_values['firstname'].' '.
			$app_values['country_national'];
		$app_values['age_zone'] = floor(($app_values['app_date'] - $birth_date) / 100000) * 10;
		$tmp['bml_apply'] = $this->load->view('pc/contents/parts/bml_apply', $app_values, TRUE);
		$tmp['bml_confirm'] = $this->load->view('pc/contents/parts/bml_confirm', $app_values, TRUE);
		$tmp['bml_search'] = $this->load->view('pc/contents/parts/bml_search', $app_values, TRUE);
		$app_values['description'] = $this->load->view('pc/contents/parts/redmine_description', $tmp, TRUE);
		return $app_values;
	}

	private function _get_priority_id($app_values)
	{
		$priority_id = $this->config->item('redmine_priority_id_normal');
		$question_keys = array('q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8');
		foreach ($question_keys as $question_key)
		{
			if (isset($app_values[$question_key]) && $app_values[$question_key] === 'Yes')
			{
				$priority_id = $this->config->item('redmine_priority_id_attention');
				break;
			}
		}
		if (isset($app_values['no_check_passport']) && $app_values['no_check_passport'] === 'true')
		{
			$priority_id = $this->config->item('redmine_priority_id_attention');
		}
		return $priority_id;
	}
}

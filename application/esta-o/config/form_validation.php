<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
	
	'apply' => array(
		// ---------------------------------
		// 申請者情報
		// ---------------------------------
		array(
			'field' => 'lastname',
			'label' => '姓',
			'rules' => 'convert[single]|convert[space_compress]|trim|max_length[30]|strtoupper|name|strip_tags|xss_clean|required'
		),
		array(
			'field' => 'firstname',
			'label' => '名',
			'rules' => 'convert[single]|convert[space_compress]|trim|max_length[30]|strtoupper|name|strip_tags|xss_clean|required'
		),
		array(
			'field' => 'has_alias',
			'label' => '別名の有無',
			'rules' => 'strip_tags|xss_clean|required'
		),
		array(
			'field' => 'alias_lastname',
			'label' => '姓（別名）',
			'rules' => 'convert[single]|convert[space_compress]|trim|max_length[30]|strtoupper|name|strip_tags|xss_clean'
		),
		array(
			'field' => 'alias_firstname',
			'label' => '名（別名）',
			'rules' => 'convert[single]|convert[space_compress]|trim|max_length[30]|strtoupper|name|strip_tags|xss_clean'
		),
		array(
			'field' => 'birth_year',
			'label' => '生年月日（年）',
			'rules' => 'strip_tags|xss_clean|required'
		),
		array(
			'field' => 'birth_month',
			'label' => '生年月日（月）',
			'rules' => 'strip_tags|xss_clean|required'
		),
		array(
			'field' => 'birth_day',
			'label' => '生年月日（日）',
			'rules' => 'valid_birth_date|strip_tags|xss_clean|required'
		),
		array(
			'field' => 'sex',
			'label' => '性別',
			'rules' => 'strip_tags|xss_clean|required'
		),
		array(
			'field' => 'country_national',
			'label' => '国籍',
			'rules' => 'strip_tags|xss_clean|required'
		),
		array(
			'field' => 'country_national',
			'label' => '出生国',
			'rules' => 'strip_tags|xss_clean|required'
		),
		array(
			'field' => 'city_birth',
			'label' => '出生した市',
			'rules' => 'convert[single]|convert[space_compress]|trim|max_length[30]|strtoupper|single|strip_tags|xss_clean'
		),

		// ---------------------------------
		// その他の国籍・市民権について
		// ---------------------------------
		array(
			'field' => 'has_other_nation',
			'label' => 'その他国籍の有無',
			'rules' => 'strip_tags|xss_clean|required'
		),


		// ---------------------------------
		// 両親の氏名
		// ---------------------------------
		array(
			'field' => 'parent1_lastname',
			'label' => '両親の姓',
			'rules' => 'convert[single]|convert[space_compress]|trim|max_length[30]|strtoupper|name|strip_tags|xss_clean'
		),
		array(
			'field' => 'parent1_firstname',
			'label' => '両親の名',
			'rules' => 'convert[single]|convert[space_compress]|trim|max_length[30]|strtoupper|name|strip_tags|xss_clean'
		),
		array(
			'field' => 'parent2_lastname',
			'label' => '両親の姓',
			'rules' => 'convert[single]|convert[space_compress]|trim|max_length[30]|strtoupper|name|strip_tags|xss_clean'
		),
		array(
			'field' => 'parent2_firstname',
			'label' => '両親の名',
			'rules' => 'convert[single]|convert[space_compress]|trim|max_length[30]|strtoupper|name|strip_tags|xss_clean'
		),

		// ---------------------------------
		// パスポート情報
		// ---------------------------------
		array(
			'field' => 'passport_number',
			'label' => 'パスポート番号',
			'rules' => 'convert[single]|convert[space_strip]|trim|strtoupper|alpha_numeric|passport_number|strip_tags|xss_clean|required'
		),
		array(
			'field' => 'passport_from_year',
			'label' => 'パスポート発行日（年）',
			'rules' => 'strip_tags|xss_clean|required'
		),
		array(
			'field' => 'passport_from_month',
			'label' => 'パスポート発行日（月）',
			'rules' => 'strip_tags|xss_clean|required'
		),
		array(
			'field' => 'passport_from_day',
			'label' => 'パスポート発行日（日）',
			'rules' => 'strip_tags|xss_clean|valid_passport_from_date|required'
		),
		array(
			'field' => 'passport_to_year',
			'label' => 'パスポート有効期限（年）',
			'rules' => 'strip_tags|xss_clean|required'
		),
		array(
			'field' => 'passport_to_month',
			'label' => 'パスポート有効期限（月）',
			'rules' => 'strip_tags|xss_clean|required'
		),
		array(
			'field' => 'passport_to_day',
			'label' => 'パスポート有効期限（日）',
			'rules' => 'strip_tags|xss_clean|valid_passport_to_date|required'
		),

		// ---------------------------------
		// ご連絡先
		// ---------------------------------
		array(
			'field' => 'email',
			'label' => 'メールアドレス',
			'rules' => 'convert[single]|trim|strtolower|valid_email|valid_email_domain|strip_tags|xss_clean|required'
		),
		array(
			'field' => 'email_confirm',
			'label' => 'メールアドレス（確認）',
			'rules' => 'convert[single]|trim|strtolower|valid_email|valid_email_domain|strip_tags|xss_clean|matches[email]|required'
		),
		array(
			'field' => 'tel',
			'label' => '電話番号',
			'rules' => 'convert[single]|convert[space_strip]|convert[phone]|trim|phone|strip_tags|xss_clean|required'
		),
		array(
			'field' => 'tel_type',
			'label' => '電話種別',
			'rules' => 'single|strip_tags|xss_clean|required'
		),
		array(
			'field' => 'is_set_emg_contact',
			'label' => '緊急時連絡先登録',
			'rules' => 'strip_tags|xss_clean|required'
		),
		array(
			'field' => 'emg_lastname',
			'label' => '姓（緊急）',
			'rules' => 'convert[single]|convert[space_compress]|trim|max_length[30]|strtoupper|name|strip_tags|xss_clean'
		),
		array(
			'field' => 'emg_firstname',
			'label' => '名（緊急）',
			'rules' => 'convert[single]|convert[space_compress]|trim|max_length[30]|strtoupper|name|strip_tags|xss_clean'
		),
		array(
			'field' => 'emg_email',
			'label' => 'メールアドレス（緊急）',
			'rules' => 'convert[single]|trim|strtolower|valid_email|valid_email_domain|strip_tags|xss_clean'
		),
		array(
			'field' => 'emg_country_phone_code',
			'label' => '緊急時電話（国）',
			'rules' => 'strip_tags|xss_clean'
		),
		array(
			'field' => 'emg_tel',
			'label' => '緊急時電話（番号）',
			'rules' => 'convert[single]|convert[space_strip]|convert[phone]|trim|phone|strip_tags|xss_clean'
		),

		// ---------------------------------
		// クレジットカード名義
		// ---------------------------------
		array(
			'field' => 'billing_last_name',
			'label' => '姓（カード名義）',
			'rules' => 'convert[single]|convert[space_compress]|trim|strtoupper|name|strip_tags|xss_clean|required',
		),
		array(
			'field' => 'billing_first_name',
			'label' => '名（カード名義）',
			'rules' => 'convert[single]|convert[space_compress]|trim|strtoupper|name|strip_tags|xss_clean|required',
		),

		// ---------------------------------
		// ご自宅住所
		// ---------------------------------
		/*
		array(
			'field' => 'billing_country',
			'label' => '自宅住所 居住国',
			'rules' => 'convert[space_strip]|trim|strip_tags|xss_clean|required',
		),
		*/
		array(
			'field' => 'billing_zip',
			'label' => '郵便番号',
			'rules' => 'convert[postal]|convert[space_strip]|trim|postal|strip_tags|xss_clean|required',
		),
		array(
			'field' => 'billing_state',
			'label' => '都道府県',
			'rules' => 'convert[single]|convert[space_compress]|trim|strip_tags|single|xss_clean|required',
		),
		array(
			'field' => 'billing_city',
			'label' => '市区町村',
			'rules' => 'convert[single]|convert[space_compress]|trim|strip_tags|single|xss_clean|required',
		),
		array(
			'field' => 'billing_address1',
			'label' => '丁番号',
			'rules' => 'convert[single]|convert[space_compress]|trim|strip_tags|numeric_dash|xss_clean|required',
		),
		array(
			'field' => 'billing_building',
			'label' => '建物名',
			'rules' => 'convert[single]|convert[space_compress]|trim|strip_tags|single|xss_clean|required',
		),
		array(
			'field' => 'billing_address1',
			'label' => '部屋番号',
			'rules' => 'convert[single]|convert[space_compress]|trim|strip_tags|single|xss_clean|required',
		),

		// ---------------------------------
		// 渡航情報
		// ---------------------------------
		array(
			'field' => 'for_via',
			'label' => '第三国への乗り継ぎですか',
			'rules' => 'strip_tags|xss_clean|required',
		),
		array(
			'field' => 'us_contact_name',
			'label' => '滞在先 名称',
			'rules' => 'convert[single]|convert[space_compress]|trim|max_length[50]|strtoupper|single|strip_tags|xss_clean',
		),
		array(
			'field' => 'us_contact_state',
			'label' => '州',
			'rules' => 'strip_tags|xss_clean',
		),
		array(
			'field' => 'us_contact_city',
			'label' => '都市名',
			'rules' => 'convert[single]|convert[space_compress]|trim|strip_tags|single|xss_clean',
		),
		array(
			'field' => 'us_contact_address1',
			'label' => '通り名 丁番号',
			'rules' => 'convert[single]|convert[space_compress]|trim|strip_tags|single|xss_clean',
		),
		array(
			'field' => 'us_contact_building',
			'label' => '建物名',
			'rules' => 'convert[single]|convert[space_compress]|trim|strip_tags|single|xss_clean',
		),
		array(
			'field' => 'us_contact_room_number',
			'label' => '部屋番号',
			'rules' => 'convert[single]|convert[space_compress]|trim|strip_tags|single|xss_clean',
		),

		// ---------------------------------
		// 雇用情報
		// ---------------------------------
		array(
			'field' => 'employment_exp',
			'label' => '雇用経験有無',
			'rules' => 'required',
		),

		// ---------------------------------
		// その他質問事項
		// ---------------------------------
		array(
			'field' => 'q1',
			'label' => '質問1',
			'rules' => 'strip_tags|xss_clean|required',
		),
		array(
			'field' => 'q2',
			'label' => '質問2',
			'rules' => 'strip_tags|xss_clean|required',
		),
		array(
			'field' => 'q3',
			'label' => '質問3',
			'rules' => 'strip_tags|xss_clean|required',
		),
		array(
			'field' => 'q4',
			'label' => '質問4',
			'rules' => 'strip_tags|xss_clean|required',
		),
		array(
			'field' => 'q5',
			'label' => '質問5',
			'rules' => 'strip_tags|xss_clean|required',
		),
		array(
			'field' => 'q6',
			'label' => '質問6',
			'rules' => 'strip_tags|xss_clean|required',
		),
		/*
		array(
			'field' => 'q6_when',
			'label' => '質問F いつ',
			'rules' => 'convert[space_strip]|trim|max_length[30]|strip_tags|xss_clean',
		),
		array(
			'field' => 'q6_where',
			'label' => '質問F どこで',
			'rules' => 'convert[space_strip]|trim|max_length[30]|strip_tags|xss_clean',
		),
		*/
		array(
			'field' => 'q7',
			'label' => '質問7',
			'rules' => 'strip_tags|xss_clean|required',
		),
		array(
			'field' => 'q8',
			'label' => '質問8',
			'rules' => 'strip_tags|xss_clean|required',
		),

		// ---------------------------------
		// その他質問事項
		// ---------------------------------
		array(
			'field' => 'kiyaku1',
			'label' => '規約1',
			'rules' => 'exact_value[Yes]|required'
		),
		array(
			'field' => 'kiyaku2',
			'label' => '規約2',
			'rules' => 'exact_value[Yes]|required'
		),
	),

	'has_other_nation' => array(
		array(
			'field' => 'country_other_nation',
			'label' => '市民権のある国',
			'rules' => 'required'
		),
		array(
			'field' => 'passport_number_other_nation',
			'label' => 'パスポート番号',
			'rules' => 'convert[single]|convert[space_strip]|trim|strtoupper|alpha_numeric|passport_number|strip_tags|xss_clean'
		),
	),

	'employment_exp' => array(
		/*
		array(
			'field' => 'employment_address_country',
			'label' => '雇用者住所 - 国',
			'rules' => 'convert[single]|convert[space_strip]|trim|strip_tags|single|xss_clean',
		),
		*/
		array(
			'field' => 'employment_address_state',
			'label' => '都道府県',
			'rules' => 'convert[single]|convert[space_strip]|trim|max_length[30]|strtoupper|single|strip_tags|xss_clean',
		),
		array(
			'field' => 'employment_address_city',
			'label' => '市区町村',
			'rules' => 'convert[single]|convert[space_compress]|trim|strtoupper|single|strip_tags|xss_clean',
		),
		array(
			'field' => 'employment_address_number',
			'label' => '丁番号',
			'rules' => 'convert[single]|convert[space_strip]|trim|strtoupper|numeric_dash|strip_tags|xss_clean',
		),
		array(
			'field' => 'employment_address_building',
			'label' => '建物名',
			'rules' => 'convert[single]|convert[space_compress]|trim|strip_tags|single|xss_clean',
		),
		array(
			'field' => 'employment_address_room_number',
			'label' => '部屋番号',
			'rules' => 'convert[single]|convert[space_compress]|trim|strip_tags|single|xss_clean',
		),
		array(
			'field' => 'employment_tel',
			'label' => '電話番号',
			'rules' => 'convert[single]|convert[space_strip]|convert[phone]|trim|phone|strip_tags|xss_clean'
		),
		array(
			'field' => 'employment_job_type',
			'label' => '職名',
			'rules' => 'convert[single]|convert[space_compress]|trim|strtoupper|single|strip_tags|xss_clean',
		),
	),

	'contact' => array(
		array(
			'field' => 'name',
			'label' => 'お名前',
			'rules' => 'convert[single]|convert[space_compress]|trim|strtoupper|strip_tags|xss_clean|required'
		),
		array(
			'field' => 'email',
			'label' => 'メールアドレス',
			'rules' => 'convert[single]|trim|strtolower|valid_email|valid_email_domain|strip_tags|xss_clean|required'
		),
		array(
			'field' => 'message',
			'label' => 'メッセージ',
			'rules' => 'trim|strip_tags|xss_clean|required'
		),
	),
	'status' => array(
		array(
			'field' => 'app_id',
			'label' => '申請ID',
			'rules' => 'convert[single]|convert[space_strip]|trim|strip_tags|alpha_numeric|xss_clean|required'
		),
	),
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */

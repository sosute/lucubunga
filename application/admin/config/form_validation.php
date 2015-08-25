<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
	'mail2bookmarklet' => array(
		array(
			'field' => 'lastname',
			'label' => '姓',
			'rules' => 'convert[single]|convert[space_compress]|trim|strtoupper|required|name|strip_tags|xss_clean'
		),
		array(
			'field' => 'firstname',
			'label' => '名',
			'rules' => 'convert[single]|convert[space_compress]|trim|strtoupper|required|name|strip_tags|xss_clean'
		),
		array(
			'field' => 'country_birth',
			'label' => '出生国',
			'rules' => 'trim'
		),
		array(
			'field' => 'country_national',
			'label' => '国籍',
			'rules' => 'trim'
		),
		array(
			'field' => 'country_live',
			'label' => '居住国',
			'rules' => 'trim'
		),
		array(
			'field' => 'birth_year',
			'label' => '生年月日（年）',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'birth_month',
			'label' => '生年月日（月）',
			'rules' => 'trim|required'
		),
		array(
			'field' => 'birth_day',
			'label' => '生年月日（日）',
			'rules' => 'trim|required|valid_birth_date'
		),
		array(
			'field' => 'sex',
			'label' => '性別',
			'rules' => 'required'
		),
		array(
			'field' => 'passport_number',
			'label' => 'パスポート番号',
			'rules' => 'convert[single]|convert[space_strip]|trim|required|alpha_numeric|passport_number|strip_tags|xss_clean'
		),
		array(
			'field' => 'passport_from_year',
			'label' => 'パスポート発行日（年）',
			'rules' => 'required'
		),
		array(
			'field' => 'passport_from_month',
			'label' => 'パスポート発行日（月）',
			'rules' => 'required'
		),
		array(
			'field' => 'passport_from_day',
			'label' => 'パスポート発行日（日）',
			'rules' => 'required|valid_passport_from_date'
		),
		array(
			'field' => 'passport_to_year',
			'label' => 'パスポート有効期限（年）',
			'rules' => 'required'
		),
		array(
			'field' => 'passport_to_month',
			'label' => 'パスポート有効期限（月）',
			'rules' => 'required'
		),
		array(
			'field' => 'passport_to_day',
			'label' => 'パスポート有効期限（日）',
			'rules' => 'required|valid_passport_to_date'
		),
		array(
			'field' => 'q1',
			'label' => '質問A',
			'rules' => 'required',
		),
		array(
			'field' => 'q2',
			'label' => '質問B',
			'rules' => 'required',
		),
		array(
			'field' => 'q3',
			'label' => '質問C',
			'rules' => 'required',
		),
		array(
			'field' => 'q4',
			'label' => '質問D',
			'rules' => 'required',
		),
		array(
			'field' => 'q5',
			'label' => '質問E',
			'rules' => 'required',
		),
		array(
			'field' => 'q6',
			'label' => '質問F',
			'rules' => 'required',
		),
		array(
			'field' => 'q6_when',
			'label' => '質問F いつ',
			'rules' => 'convert[space_strip]|trim|max_length[10]|strip_tags|xss_clean',
		),
		array(
			'field' => 'q6_where',
			'label' => '質問F どこで',
			'rules' => 'convert[space_strip]|trim|max_length[10]|strip_tags|xss_clean',
		),
		array(
			'field' => 'q7',
			'label' => '質問G',
			'rules' => 'required',
		),
	),
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */

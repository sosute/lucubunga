<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['param_metas'] = array(
	'ask_lastname' => array(
		'name_mb' => '姓',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => false,
		'redmine_cf_id' => null,
	),
	'ask_firstname' => array(
		'name_mb' => '名',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => false,
		'redmine_cf_id' => null,
	),
	'ask_email' => array(
		'name_mb' => 'Eメールアドレス',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => null,
	),
	'ask_appid' => array(
		'name_mb' => '申請ID',
		'is_must' => false,
		'is_hint' => true,
		'hint' => ''.
            '（例）a1u654300f132928fce1643e3a6fextmp<br />'.
            '<br />'.
            '当該IDは、申請完了時にお送りしているメールに記載しております。<br />'.
            'メールのご確認が出来ない場合、下記のケースが考えられますのでご確認下さい。<br />'.
            '<br />'.
            '・迷惑メールフォルダに振り分けられてしまっている場合<br />'.
            '・フィルタ設定等でメールが届いていない場合<br />'.
            '・メールアドレスのご入力間違いがある場合<br />',
		'is_diff_check' => false,
		'redmine_cf_id' => null,
	),
	'ask_message' => array(
		'name_mb' => 'お問合せ内容',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => false,
		'redmine_cf_id' => null,
	),
);

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Redmine用設定
|--------------------------------------------------------------------------
*/

// API関連
$config['redmine_rest_key'] = '5378f40c6b498a4e0f642fd37ec81a7b373bea2f';

// プロジェクト
$config['redmine_project_id_esta'] = 'esta_onlinecenter';

// トラッカー
$config['redmine_tracker_id_paid'] = '4';
$config['redmine_tracker_id_shinsei'] = '5';

// 優先度
$config['redmine_priority_id_normal'] = '2';
$config['redmine_priority_id_attention'] = '3';

// ユーザー
$config['redmine_author_id_admin'] = '1';

// カスタムフィールド
$config['redmine_custom_field_id_lastname'] = '1';
$config['redmine_custom_field_id_firstname'] = '2';
$config['redmine_custom_field_id_country_birth'] = '3';
$config['redmine_custom_field_id_country_national'] = '4';
$config['redmine_custom_field_id_country_live'] = '5';
$config['redmine_custom_field_id_birth_date'] = '6';
$config['redmine_custom_field_id_sex'] = '7';
$config['redmine_custom_field_id_passport_number'] = '8';
$config['redmine_custom_field_id_passport_from_date'] = '9';
$config['redmine_custom_field_id_passport_to_date'] = '10';
$config['redmine_custom_field_id_email'] = '11';
$config['redmine_custom_field_id_tel'] = '12';
$config['redmine_custom_field_id_where_access_from'] = '13';
$config['redmine_custom_field_id_esta_app_id'] = '14';
$config['redmine_custom_field_id_esta_app_expired'] = '15';
$config['redmine_custom_field_id_esta_mail_status'] = '16';
$config['redmine_custom_field_id_ad'] = '17';
$config['redmine_custom_field_id_q1'] = '18';
$config['redmine_custom_field_id_q2'] = '19';
$config['redmine_custom_field_id_q3'] = '20';
$config['redmine_custom_field_id_q4'] = '21';
$config['redmine_custom_field_id_q5'] = '22';
$config['redmine_custom_field_id_q6'] = '23';
//$config['redmine_custom_field_id_q6_when'] = '24';
//$config['redmine_custom_field_id_q6_where'] = '25';
$config['redmine_custom_field_id_q7'] = '26';
$config['redmine_custom_field_id_q8'] = '51';
$config['redmine_custom_field_id_app_week'] = '27';
$config['redmine_custom_field_id_age_zone'] = '28';
$config['redmine_custom_field_id_paypal_txn_id'] = '29';
$config['redmine_custom_field_id_paypal_receipt_id'] = '30';
$config['redmine_custom_field_id_paypal_repay'] = '31';
$config['redmine_custom_field_id_user_id'] = '32';
$config['redmine_custom_field_id_app_id'] = '33';
$config['redmine_custom_field_id_what_device_access_from'] = '34';
$config['redmine_custom_field_id_address_country'] = '49';
$config['redmine_custom_field_id_address_zip'] = '48';
$config['redmine_custom_field_id_address_state'] = '35';
$config['redmine_custom_field_id_address_city'] = '36';
$config['redmine_custom_field_id_address_number'] = '37';
$config['redmine_custom_field_id_for_via'] = '38';
$config['redmine_custom_field_id_employment_exp'] = '39';
$config['redmine_custom_field_id_employment_name'] = '40';
$config['redmine_custom_field_id_employment_address_country'] = '50';
$config['redmine_custom_field_id_employment_address_state'] = '41';
$config['redmine_custom_field_id_employment_address_city'] = '42';
$config['redmine_custom_field_id_employment_address_number'] = '43';
$config['redmine_custom_field_id_parent1_lastname'] = '44';
$config['redmine_custom_field_id_parent1_firstname'] = '45';
$config['redmine_custom_field_id_parent2_lastname'] = '46';
$config['redmine_custom_field_id_parent2_firstname'] = '47';
$config['redmine_custom_field_id_has_alias'] = '52';
$config['redmine_custom_field_id_alias_lastname'] = '53';
$config['redmine_custom_field_id_alias_firstname'] = '54';
$config['redmine_custom_field_id_city_birth'] = '55';
$config['redmine_custom_field_id_has_other_nation'] = '56';
$config['redmine_custom_field_id_country_other_nation'] = '57';
$config['redmine_custom_field_id_passport_number_other_nation'] = '58';
$config['redmine_custom_field_id_tel_type'] = '59';
$config['redmine_custom_field_id_is_set_emg_contact'] = '60';
$config['redmine_custom_field_id_emg_lastname'] = '61';
$config['redmine_custom_field_id_emg_firstname'] = '62';
$config['redmine_custom_field_id_emg_email'] = '63';
$config['redmine_custom_field_id_emg_country_phone_code'] = '64';
$config['redmine_custom_field_id_emg_tel'] = '65';
$config['redmine_custom_field_id_address_building'] = '66';
$config['redmine_custom_field_id_address_room_number'] = '67';
$config['redmine_custom_field_id_us_contact_name'] = '68';
$config['redmine_custom_field_id_us_contact_address_state'] = '69';
$config['redmine_custom_field_id_us_contact_address_city'] = '70';
$config['redmine_custom_field_id_us_contact_address_number'] = '71';
$config['redmine_custom_field_id_us_contact_address_building'] = '72';
$config['redmine_custom_field_id_us_contact_address_room_number'] = '73';
$config['redmine_custom_field_id_us_contact_tel'] = '74';
$config['redmine_custom_field_id_employment_address_building'] = '75';
$config['redmine_custom_field_id_employment_address_room_number'] = '76';
$config['redmine_custom_field_id_employment_tel'] = '77';
$config['redmine_custom_field_id_employment_job_type'] = '78';

// 情報の一致確認をする項目
$config['checked_elements'] = array(
	/*
	'姓（申請者の父）' => 'father_lastname',
	'名（申請者の父）' => 'father_firstname',
	'姓（申請者の母）' => 'mother_lastname',
	'名（申請者の母）' => 'mother_firstname',
	*/
	'出生国' => 'country_birth',
	'国籍' => 'country_national',
	//'居住国' => 'country_live',
	'生年月日' => 'birth_date',
	'性別' => 'sex',
	'パスポート発行日' => 'passport_from_date',
	'パスポート有効期限' => 'passport_to_date',
	'第三国への乗り継ぎか' => 'for_via',
	'雇用実績有無' => 'employment_exp',
	'雇用者名' => 'employment_name',
	//'雇用者住所 - 国' => 'employment_address_country',
	'雇用者住所 - 都道府県' => 'employment_address_state',
	'雇用者住所 - 市区町村' => 'employment_address_city',
	'雇用者住所 - 番地' => 'employment_address_number',
	'質問1' => 'q1',
	'質問2' => 'q2',
	'質問3' => 'q3',
	'質問4' => 'q4',
	'質問5' => 'q5',
	'質問6' => 'q6',
	'質問7' => 'q7',
	'質問8' => 'q8',
);

// ステータスID
$config['redmine_status_id_new'] = '1';
$config['redmine_status_id_done'] = '7';
$config['redmine_status_id_canceled'] = '8';
$config['redmine_status_id_app_reject'] = '9';
$config['redmine_status_id_repay'] = '10';
$config['redmine_status_id_pending'] = '11';
$config['redmine_status_id_wait'] = '12';

// ステータス説明
$config['redmine_status_desc_'.$config['redmine_status_id_new']] =
	'現在、申請手続きを進めております。<br />'.
	'認証結果メールがお手元に届くまで、今しばらくお待ちください。';
$config['redmine_status_desc_'.$config['redmine_status_id_done']] =
	'お手続きが問題なく完了し、米国への渡航認証が許可されました。<br />'.
	'渡航認証許可のご案内メールをお送りしておりますので、合わせてご確認下さい。';
$config['redmine_status_desc_'.$config['redmine_status_id_canceled']] =
	'ご返金の手続きを完了しました。';
$config['redmine_status_desc_'.$config['redmine_status_id_app_reject']] =
	'米国への渡航認証が拒否されました。<br>'.
	'詳しい情報は開示されない為、弊社ではご案内する事ができません。<br />'.
	'大使館・領事館でビザを申請すれば渡米する条件を満たすことが可能です。';
$config['redmine_status_desc_'.$config['redmine_status_id_repay']] =
	'現在、ご返金のお手続きを行っておりますので、今暫くお待ちいただけますと幸いです。';
$config['redmine_status_desc_'.$config['redmine_status_id_pending']] =
	'現在、一時的に申請手続きを保留とさせていただいております。<br />'.
	'保留の原因としては、お客様の申請情報が既に登録済みである事等が考えられますが、<br />'.
	'詳細につきましては、弊社からお送りしておりますメールをご確認頂けますと幸いです。';

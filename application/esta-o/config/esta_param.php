<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['param_metas'] = array(
	'lastname' => array(
		'name_mb' => '姓',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => false,
		'redmine_cf_id' => '1',
	),
	'firstname' => array(
		'name_mb' => '名',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => false,
		'redmine_cf_id' => '2',
	),
	'has_alias' => array(
		'name_mb' => '別名の有無',
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '52',
	),
	'alias_lastname' => array(
		'name_mb' => '姓（別名）',
		'parent' => 'has_alias',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '53',
	),
	'alias_firstname' => array(
		'name_mb' => '名（別名）',
		'parent' => 'has_alias',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '54',
	),
	'birth_date' => array(
		'name_mb' => '生年月日',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
        'is_diff_check' => true,
        'redmine_cf_id' => '6',
	),
	'sex' => array(
		'name_mb' => '性別',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '7',
	),
	'country_national' => array(
		'name_mb' => '国籍',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '4',
	),
	'country_birth' => array(
		'name_mb' => '出生国',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '3',
	),
	'city_birth' => array(
		'name_mb' => '出生した市',
		'is_must' => false,
		'is_hint' => true,
		'hint' => ''.
			'申請者の出生した市、町、村または集落を英字でご入力下さい。<br />'.
			'ご不明な場合は、空欄のままで構いません。',
		'is_diff_check' => true,
		'redmine_cf_id' => '55',
	),
	'has_other_nation' => array(
		'name_mb' => 'その他国籍の有無',
		'is_hint' => true,
		'hint' => ''.
			'「国籍」欄で選択した国籍以外の市民権を保有される場合は<br />'.
			'「あります」を選択し、対象国の情報を入力して下さい。',
		'is_diff_check' => true,
		'redmine_cf_id' => '56',
	),
	'country_other_nation' => array(
		'name_mb' => '市民権のある国',
		'parent' => 'has_other_nation',
		'is_must' => true,
		'is_hint' => true,
		'hint' => 'その他の国籍を保有する場合、こちらの項目は必須選択となります。',
		'is_diff_check' => true,
		'redmine_cf_id' => '57',
	),
	'passport_number_other_nation' => array(
		'name_mb' => '該当国パスポート番号',
		'parent' => 'has_other_nation',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '58',
	),
	'parent1_lastname' => array(
		'name_mb' => '姓',
		'name_mb_uniq' => '姓（両親1）',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '44',
	),
	'parent1_firstname' => array(
		'name_mb' => '名',
		'name_mb_uniq' => '名（両親1）',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '45',
	),
	'parent2_lastname' => array(
		'name_mb' => '姓',
		'name_mb_uniq' => '姓（両親2）',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '46',
	),
	'parent2_firstname' => array(
		'name_mb' => '名',
		'name_mb_uniq' => '名（両親2）',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '47',
	),
	'passport_number' => array(
		'name_mb' => 'パスポート番号',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '8',
	),
	'passport_from_date' => array(
		'name_mb' => 'パスポート発行日',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '9',
	),
	'passport_to_date' => array(
		'name_mb' => 'パスポート有効期限',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '10',
	),
	'no_check_passport' => array(
		'name_mb' => '訂正旅券・公用旅券',
		'is_must' => false,
		'is_hint' => true,
		'hint' => ''.
			'・姓の変更手続き等、旅券情報の修正を行い、新しいパスポートを発行された場合<br />'.
			'・公用旅券をご利用の場合<br />'.
			'<br />'.
			'対象のパスポートが上記のいずれかに該当する場合、チェックをお願い致します。<br />'.
			'チェックをされた場合、パスポート有効期間の自動チェックを行いませんので、<br />'.
			'入力内容にお間違いがないかどうかご確認頂くよう、お願い申し上げます。 <br />'.
			'通常のパスポートであれば、チェックはご不要でございます',
		'is_diff_check' => true,
		'redmine_cf_id' => '81',
	),
	'email' => array(
		'name_mb' => 'Eメールアドレス',
		'is_must' => true,
		'is_hint' => true,
		'hint' => ''.
            'お申込み完了時や認証結果のご案内をこちらのメールアドレス宛にお送りしますので、<br />'.
            '受信・ご確認可能なアドレスをご入力下さい。<br />'.
            'ご利用のメールサーバによっては、フィルタ機能などが設定されており<br />'.
            '送信させて頂いたメールが未達となってしまう事がございます。（特に携帯メールなど）<br />'.
            '申請完了後、メールのご確認が頂けない場合、<br />'.
            '上述の設定等によってメールが届いていない可能性がございますので、<br />'.
            '受信可能なアドレスと合わせてお問合せフォームよりご連絡頂けますと幸いでございます。',
		'is_diff_check' => true,
		'redmine_cf_id' => '11',
	),
	'email_confirm' => array(
		'name_mb' => 'Eメールアドレス（確認）',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => false,
		'redmine_cf_id' => null,
	),
	'tel' => array(
		'name_mb' => '電話番号',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '12',
	),
	'tel_type' => array(
		'name_mb' => '電話種別',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '59',
	),
	'is_set_emg_contact' => array(
		'name_mb' => '緊急時連絡先',
		'is_hint' => true,
		'hint' => ''.
			'当該情報をご登録される場合は、緊急時連絡者の情報をご入力下さい。<br />'.
			'（例）家族、友人、仕事関係者',
		'is_diff_check' => true,
		'redmine_cf_id' => '60',
	),
	'emg_lastname' => array(
		'name_mb' => '姓（緊急）',
		'parent' => 'is_set_emg_contact',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '61',
	),
	'emg_firstname' => array(
		'name_mb' => '名（緊急）',
		'parent' => 'is_set_emg_contact',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '62',
	),
	'emg_email' => array(
		'name_mb' => 'Eメールアドレス（緊急）',
		'parent' => 'is_set_emg_contact',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '63',
	),
	'emg_country_phone_code' => array(
		'name_mb' => '緊急時電話（国）',
		'parent' => 'is_set_emg_contact',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '64',
	),
	'emg_tel' => array(
		'name_mb' => '緊急時電話（番号）',
		'parent' => 'is_set_emg_contact',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '65',
	),
	'billing_last_name' => array(
		'name_mb' => '姓',
		'name_mb_uniq' => 'カード名義 姓',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '79',
	),
	'billing_first_name' => array(
		'name_mb' => '名',
		'name_mb_uniq' => 'カード名義 名',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '80',
	),
	'billing_zip' => array(
		'name_mb' => '郵便番号',
		'is_must' => true,
		'is_hint' => true,
		'hint' => ''.
			'ご自宅住所の郵便番号がご不明な場合は、下記リンク先より検索する事が可能でございます。<br />'.
			'<a href="http://www.post.japanpost.jp/zipcode/" target="_blank">http://www.post.japanpost.jp/zipcode/</a>',
		'is_diff_check' => true,
		'redmine_cf_id' => '48',
	),
	'billing_state' => array(
		'name_mb' => '都道府県',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '35',
	),
	'billing_city' => array(
		'name_mb' => '市区町村',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '36',
	),
	'billing_address1' => array(
		'name_mb' => '丁番地',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '37',
	),
	'billing_building' => array(
		'name_mb' => '建物名',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '66',
	),
	'billing_room_number' => array(
		'name_mb' => '部屋番号',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '67',
	),
	'for_via' => array(
		'name_mb' => '第三国への乗り継ぎですか',
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '38',
	),
	'us_contact_name' => array(
		'name_mb' => '滞在先 名称',
		'parent' => 'for_via',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '68',
	),
	'us_contact_address_state' => array(
		'name_mb' => '滞在先 州',
		'parent' => 'for_via',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '69',
	),
	'us_contact_address_city' => array(
		'name_mb' => '滞在先 都市名',
		'parent' => 'for_via',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '70',
	),
	'us_contact_address_number' => array(
		'name_mb' => '滞在先 通り名 丁番地',
		'parent' => 'for_via',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '71',
	),
	'us_contact_address_building' => array(
		'name_mb' => '滞在先 建物名',
		'parent' => 'for_via',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '72',
	),
	'us_contact_address_room_number' => array(
		'name_mb' => '滞在先 部屋番号',
		'parent' => 'for_via',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '73',
	),
	'us_contact_tel' => array(
		'name_mb' => '滞在先 電話番号',
		'parent' => 'for_via',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '74',
	),
	'employment_exp' => array(
		'name_mb' => '就労の有無',
		'is_hint' => false,
		'hint' => '現在（あるいは以前）の就労有無を選択してください。',
		'is_diff_check' => true,
		'redmine_cf_id' => '39',
	),
	'employment_name' => array(
		'name_mb' => '雇用者名',
		'parent' => 'employment_exp',
		'is_must' => true,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '40',
	),
	'employment_address_state' => array(
		'name_mb' => '雇用者 都道府県',
		'parent' => 'employment_exp',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '41',
	),
	'employment_address_city' => array(
		'name_mb' => '雇用者 市区町村',
		'parent' => 'employment_exp',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '42',
	),
	'employment_address_number' => array(
		'name_mb' => '雇用者 丁番地',
		'parent' => 'employment_exp',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '43',
	),
	'employment_address_building' => array(
		'name_mb' => '雇用者 建物名',
		'parent' => 'employment_exp',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '75',
	),
	'employment_tel' => array(
		'name_mb' => '雇用者 電話番号',
		'parent' => 'employment_exp',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '77',
	),
	'employment_job_type' => array(
		'name_mb' => '職名',
		'parent' => 'employment_exp',
		'is_must' => false,
		'is_hint' => false,
		'hint' => '',
		'is_diff_check' => true,
		'redmine_cf_id' => '78',
	),
	'q1' => array(
		'name_mb' => '質問1',
		'is_must' => false,
		'is_hint' => true,
        'hint' => '',
		'desc' => ''.
            '身体的あるいは精神的な障害があるか、'.
            '薬物乱用者あるいは中毒者であるか、<br />'.
            '現在以下に挙げる疾病のいずれかに罹患していますか？<br />'.
            '・軟性下疳<br />'.
            '・りん病<br />'.
            '・鼠径部肉芽腫<br />'.
            '・感染性らい病<br />'.
            '・性病性リンパ肉芽腫<br />'.
            '・感染性梅毒<br />'.
            '・活動性結核症',
		'is_diff_check' => true,
		'redmine_cf_id' => '18',
	),
	'q2' => array(
		'name_mb' => '質問2',
		'is_must' => false,
		'is_hint' => true,
        'hint' => '',
		'desc' => '他者あるいは政府当局に対する重大な器物破損または傷害行為を招いた犯罪で逮捕されたり有罪判決を受けたりしたことがありますか？',
		'is_diff_check' => true,
		'redmine_cf_id' => '19',
	),
	'q3' => array(
		'name_mb' => '質問3',
		'is_must' => false,
		'is_hint' => true,
        'hint' => '',
		'desc' => '違法薬物の所持、使用、流通に関連した法律に違反したことがありますか？',
		'is_diff_check' => true,
		'redmine_cf_id' => '20',
	),
	'q4' => array(
		'name_mb' => '質問4',
		'is_diff_check' => true,
		'is_must' => false,
		'is_hint' => true,
        'hint' => '',
		'desc' => 'テロ行為、スパイ活動、破壊工作、大量虐殺に関与するつもりですか？あるいはこれまでに関与したことがありますか？',
		'redmine_cf_id' => '21',
	),
	'q5' => array(
		'name_mb' => '質問5',
		'is_must' => false,
		'is_hint' => true,
        'hint' => '',
		'desc' => '自らあるいは他者が米国査証を入手したり米国に入国したりするために、これまで詐欺を行ったり、自身あるいは他者を偽ったりしたことがありますか？',
		'is_diff_check' => true,
		'redmine_cf_id' => '22',
	),
	'q6' => array(
		'name_mb' => '質問6',
		'is_must' => false,
		'is_hint' => true,
        'hint' => '',
		'desc' => '現在米国において雇用を求めているか、以前に米国政府の事前許可を受けずに米国で雇用されたことがありますか？',
		'is_diff_check' => true,
		'redmine_cf_id' => '23',
	),
	'q7' => array(
		'name_mb' => '質問7',
		'is_must' => false,
		'is_hint' => true,
        'hint' => '',
		'desc' => '現在または以前に所有した旅券で申請した米国査証が却下されたり、米国への入国が拒否されたり、米国通関手続地で入国申請を撤回されたことがありますか？',
		'is_diff_check' => true,
		'redmine_cf_id' => '26',
	),
	'q8' => array(
		'name_mb' => '質問8',
		'is_must' => false,
		'is_hint' => true,
        'hint' => '',
		'desc' => '米国政府により承認された期間を超えて米国内に滞在したことがありますか？',
		'is_diff_check' => true,
		'redmine_cf_id' => '51',
	),
	'kiyaku1' => array(
		'name_mb' => '規約1',
		'is_must' => false,
		'is_hint' => false,
        'hint' => '',
        'desc' => ''.
            '規約1．米国Webサイトに掲示されている下記の内容について同意しますか？'.
            '<div class="kiyaku_text">'.
            '<p>電子渡航認証システム（ESTA）は、法施行機関のデータベースとの照合を行ないます。'.
            'ビザ免除プログラムを利用して米国に入国するすべての渡航者は、'.
            '搭乗前にこのシステムを用いて電子渡航認証を取得することが義務付けられています。<br /><br />'.
            '渡航認証申請が承認されている場合、渡航資格があることが証明されたことになりますが、'.
            'ビザ免除プログラムに基づき米国に入国が認められることを証明するものではありません。'.
            '米国に到着すると、入国地で税関国境警備局審査官の審査を受けることになりますが、'.
            'ビザ免除プログラムに基づき、または米国法による何 らかの理由で入国拒否と判定されることがあります。<br /><br />'.
            '電子渡航認証の資格がないと判定されても、渡米のためのビザ申請ができないということではありません。<br /><br />'.
            'あなた自身または第三者の代行者により提供されたすべての情報は、真実、かつ正確なものでなければなりません。'.
            '電子渡航認証資格に影響を与える新しい情報な ど、何らかの理由によりいつでも取り消されることがあります。'.
            'あなた自身または代行により提出された電子渡航認証申請において'.
            '故意に重大な偽り、虚偽、または詐欺の供述あるいは表明を行なった場合には、行政処分や刑事処分を受けることがあります。</p>'.
            '<p>・権利の放棄<br />'.
            '私は、ESTAで取得した渡航認証の期間中、'.
            '米国税関国境警備局審査官の入国に関する決定に対して審査または不服申立を行う、'.
            'あるいは亡命の申請事由を除き、ビザ免除プログラムでの入国申請から生じる除外措置について'.
            '異議を申し立てる権利を放棄する旨の説明を読み、了解しました。<br />'.
            '上記の権利放棄に加え、ビザ免除プログラムに基づく米国への入国の条件として、'.
            '私は、米国に到着時の審査において、生体認証識別（指紋や写真など）を提出することにより、'.
            '米国税関国境警備局審査官の入国に関する決定に対して審査または不服申立を行う、'.
            'あるいは亡命の申請事由を除き、ビザ免除プログラムによる入国申請から生じる除外措置について'.
            '異議を申し立てる権利を放棄することが再確認されるものであることに同意します。<br /><br />'.
            '・証明<br />'.
            '私、申請者は、本申請書のすべての質問事項および記載事項を読み、または代読してもらい、'.
            '本申請書のすべての質問事項および記載事項を理解したことを証明します。'.
            '本申請書で記述した回答および内容は、私の知る限り、また信じる限りにおいて真実、かつ正確なものです。<br />'.
            '申請者の代行者として申請書を提出する第三者として、'.
            '私は、本申請書に名前が記載された人（申請者）に本申請書のすべての質問事項および記載事項を読み上げたことを証明します。'.
            '私は、さらに、申請者が本申請書のすべての質問事項および記載内容を読み、または代読してもらい、理解し、'.
            'また、米国税関国境警備局審査官の入国に関する決定に対して審査または不服申立を行う、'.
            'あるいは亡命の申請事由を除き、ビザ免除プログラムによる入国申請から生じる除外措置について、'.
            '異議を唱える権利を放棄することを証明していることを証明します。<br />'.
            '本申請書で記述した回答および内容は、申請者の知る限り、また信じる限りにおいて 真実、かつ正確なものです。</p>'.
            '</div>',
		'is_diff_check' => false,
		'redmine_cf_id' => null,
	),
	'kiyaku2' => array(
		'name_mb' => '規約2',
		'is_must' => false,
		'is_hint' => false,
        'hint' => '',
        'desc' => ''.
            '規約2．当Webサイトに掲示されている下記の内容について同意しますか？'.
            '<div class="kiyaku_text">'.
            '<p>ESTA Online Centerの利用者は、このサイト内で規定している個人情報保護方針を順守します。'.
            '個人情報保護方針で、当サイトという言葉はESTA Online Centerを指します。'.
            '個人情報保護方針で、申請者･利用者･お客様と第三者を表現する言葉や文章は、<br />'.
            '当サイトを通して契約する人を指します。'.
            '当サイトの利用者はサイト内に記載されている規約及び規定に同意します。'.
            '当サイトとはサイト内で使用されているすべての情報・デザイン・システムを含みます。'.
            '当サイトの利用者は、不法な目的で利用しない事に同意します。'.
            '当サイトの利用者は、著作権、特許権、知的財産権を侵害しない事に同意します。'.
            '当サイトの利用者は、意図的なソフトウェアのコピー、保存、製作、ホスティング、配布をしない事に同意します。'.
            '著作権には、当サイトが持つシステム、イメージ、テキスト、グラフィックなどが含まれています。'.
            '当サイトは個人情報保護方針により運営されており、お客様にESTA申請のために情報を求めることができます。'.
            'サービスの進行によりサービス料が発生します。'.
            '米国国土安全保障省申請料 (14$) + 申請代行サービス料 = 6,700円 (税込7,236円)'.
            '当サイトが定める申請手数料には、米国国土安全保障省および旅行促進法により定められた14$が含まれています。<br />'.
            'これらの支払いはクレジットカードおよびPayPalでの決済が可能です。'.
            'お客様からのサービスの進行の要請とお支払いが確認できた時点からサービスが進行されます。'.
            '当サービスでは、お客様からのご依頼に基づき、お客様に代わりESTA申請を行います。'.
            '当サービスに関するご質問はお問い合わせフォームよりご連絡下さい。 </p>'.
            '</div>',
		'is_diff_check' => false,
		'redmine_cf_id' => null,
	),
);

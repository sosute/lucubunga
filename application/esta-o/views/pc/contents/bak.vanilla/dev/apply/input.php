<script type="text/javascript">
$(function () {
	// ヒント表示
	$('.f_hint_box').hide();
	$('#f_hint_no_check_passport').show(); // 初期表示
	$('a.f_hint').click(function (){
		$('#' + $(this).attr('name')).toggle();
		return false;
	});
	// 初期表示 設定
	$('.f_box_hide').hide();
	// 展開式フォームの表示制御
	if ($('#has_alias_y').is(':checked')) {
		$('.child_f_box_has_alias').show();
	}
	if ($('#has_other_nation_y').is(':checked')) {
		$('.child_f_box_has_other_nation').show();
	}
	if ($('#is_set_emg_contact_y').is(':checked')) {
		$('.child_f_box_is_set_emg_contact').show();
	}
	if ($('#for_via_n').is(':checked')) {
		$('.child_f_box_for_via').show();
	}
	if ($('#employment_exp_y').is(':checked')) {
		$('.child_f_box_employment_exp').show();
	}
	// 表示切替
	$('input:radio').change(function(){
		var children = '.child_f_box_' + $(this).attr('name');
		$(children).toggle();
	});
});
</script>

<div id="container">
<noscript>
<div class="js_error">[注意] JavaScriptが無効になっています。弊社サイトを正しくご利用頂く為、JavaScriptの設定を有効にして下さい。</div>
</noscript>
<div class="apply_flow"><img src="/assets/esta-o/img/201504/step01.jpg" width="830" height="50" /></div>

<?php //echo validation_errors();?>

<div class="f_frame_guide">
<div class="f_box">
<div class="f_center2"><span class="f_must">必須</span></div>
<div class="f_text">は必須入力項目です。</div>
</div>
<div class="f_box">
<div class="f_center1"><span class="f_hint">？</span></div>
<div class="f_text">を押すと質問事項の詳細な説明をご確認頂けます。</div>
</div>
</div>

<form name="apply_form" id="apply_form" method="post" action="<?php echo $env_url;?>/apply/step1.html">
<!--=============申請者情報=============-->
<div class="f_frame">
<h3 class="f_label">申請者情報</h3>
<div class="f_line"></div>
<?php
// 姓
$id = 'lastname';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '苗字：（例）YAMADA',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 名
$id = 'firstname';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '名前：（例）TARO',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 別名の有無
$id = 'has_alias';
$selected_y = ($this->input->post($id) === 'Yes') ? TRUE : FALSE;
$selected_n = ($this->input->post($id) !== 'Yes') ? TRUE : FALSE;
$element = ''.
	form_radio(array(
		'name' => $id,
		'id' => $id.'_y',
		'value' => 'Yes',
		'checked' => $selected_y,
	))."\n".'<label for="'.$id.'_y">別名があります</label>'."\n".
	form_radio(array(
		'name' => $id,
		'id' => $id.'_n',
		'value' => 'No',
		'checked' => $selected_n,
	))."\n".'<label for="'.$id.'_n">別名はありません</label>'."\n";
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 別名 - 姓
$id = 'alias_lastname';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '苗字：（例）YAMADA',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 別名 - 名
$id = 'alias_firstname';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '名前：（例）JIRO',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 生年月日
$id = 'birth_date';
$selected_y = ($this->input->post('birth_year'))  ? $this->input->post('birth_year') : '';
$selected_m = ($this->input->post('birth_month')) ? $this->input->post('birth_month') : '';
$selected_d = ($this->input->post('birth_day'))   ? $this->input->post('birth_day') : '';
$element = ''.
	form_dropdown('birth_year', $form_birth_year, $selected_y)."年\n".
	form_dropdown('birth_month', $form_month, $selected_m)."月\n".
	form_dropdown('birth_day', $form_day, $selected_d)."日\n";

$errors = array();
if (form_error('birth_year') != '') {
	$errors[] = form_error('birth_year');
}
if (form_error('birth_month') != '') {
	$errors[] = form_error('birth_month');
}
if (form_error('birth_day') != '') {
	$errors[] = form_error('birth_day');
}
$error = implode("\n", $errors);
echo output_html_f_box($id, $element, $error, $param_metas);

// 性別
$id = 'sex';
$selected_m = ($this->input->post($id) === 'M') ? TRUE : FALSE;
$selected_f = ($this->input->post($id) === 'F') ? TRUE : FALSE;
$element = ''.
	form_radio(array(
		'name' => $id,
		'id' => $id.'_m',
		'value' => 'M',
		'checked' => $selected_m,
	))."\n".'<label for="'.$id.'_m">男性</label>'."\n".
	form_radio(array(
		'name' => $id,
		'id' => $id.'_f',
		'value' => 'F',
		'checked' => $selected_f,
	))."\n".'<label for="'.$id.'_f">女性</label>'."\n";
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 国籍
$id = 'country_national';
$selected = ($this->input->post($id)) ? $this->input->post($id) : 'JP';
$element = form_dropdown($id, $form_country_national, $selected);
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 出生国
$id = 'country_birth';
$selected = ($this->input->post($id)) ? $this->input->post($id) : 'JP';
$element = form_dropdown($id, $form_country_birth, $selected);
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 出生した市
$id = 'city_birth';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '英字入力：空欄可',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);
?>
</div>

<!--=============その他の国籍があるか=============-->
<div class="f_frame">
<h3 class="f_label">その他の国籍・市民権について</h3>
<div class="f_line"></div>
<?php

// 他の国の市民ですか
$id = 'has_other_nation';
$selected_y = ($this->input->post($id) === 'Yes') ? TRUE : FALSE;
$selected_n = ($this->input->post($id) !== 'Yes') ? TRUE : FALSE;
$element = ''.
	form_radio(array(
		'name' => $id,
		'id' => $id.'_y',
		'value' => 'Yes',
		'checked' => $selected_y,
	))."\n".'<label for="'.$id.'_y">あります</label>'."\n".
	form_radio(array(
		'name' => $id,
		'id' => $id.'_n',
		'value' => 'No',
		'checked' => $selected_n,
	))."\n".'<label for="'.$id.'_n">ありません</label>'."\n";
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 市民権のある国
$id = 'country_other_nation';
$selected = ($this->input->post($id)) ? $this->input->post($id) : '';
$element = form_dropdown($id, $form_country_other_nation, $selected);
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// パスポート番号
$id = 'passport_number_other_nation';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '空欄可',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);
?>
</div>

<!--=============ご両親情報=============-->
<div class="f_frame">
<h3 class="f_label">両親の氏名</h3>
<div class="f_line"></div>
<div class="f_info">
片親または両親の氏名が不明な場合は、空欄のままで構いません。<br />
血縁上の親、養子縁組による親、義父母、後見人を含むことができます。
</div>
<?php
// 両親の名前 姓1
$id = 'parent1_lastname';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '苗字：（例）YAMADA',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 両親の名前 名1
$id = 'parent1_firstname';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '名前：（例）ICHIRO',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 両親の名前 姓2
$id = 'parent2_lastname';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '苗字：（例）YAMADA',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 両親の名前 名2
$id = 'parent2_firstname';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '名前：（例）HANAKO',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);
?>
</div>

<!--=============パスポート情報=============-->
<div class="f_frame">
<h3 class="f_label">パスポート情報</h3>
<div class="f_line"></div>
<?php
// パスポート番号
$id = 'passport_number';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '（例）TH1234567',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);
?>
<div class="f_info">
日本の普通パスポート例<br />
TX1234567（10年旅券）：Tで始まる英字2文字、数字7文字<br />
MX1234567（5年旅券）：Mで始まる英字2文字、数字7文字
</div>
<?php
// パスポート発行日
$id = 'passport_from_date';
$selected_y = ($this->input->post('passport_from_year'))  ? $this->input->post('passport_from_year') : '';
$selected_m = ($this->input->post('passport_from_month')) ? $this->input->post('passport_from_month') : '';
$selected_d = ($this->input->post('passport_from_day'))   ? $this->input->post('passport_from_day') : '';
$element = ''.
	form_dropdown('passport_from_year', $form_passport_from_year, $selected_y)."年\n".
	form_dropdown('passport_from_month', $form_month, $selected_m)."月\n".
	form_dropdown('passport_from_day', $form_day, $selected_d)."日\n";

$errors = array();
if (form_error('passport_from_year') != '') {
	$errors[] = form_error('passport_from_year');
}
if (form_error('passport_from_month') != '') {
	$errors[] = form_error('passport_from_month');
}
if (form_error('passport_from_day') != '') {
	$errors[] = form_error('passport_from_day');
}
$error = implode("\n", $errors);
echo output_html_f_box($id, $element, $error, $param_metas);

// パスポート有効期限
$id = 'passport_to_date';
$selected_y = ($this->input->post('passport_to_year'))  ? $this->input->post('passport_to_year') : '';
$selected_m = ($this->input->post('passport_to_month')) ? $this->input->post('passport_to_month') : '';
$selected_d = ($this->input->post('passport_to_day'))   ? $this->input->post('passport_to_day') : '';
$element = ''.
	form_dropdown('passport_to_year', $form_passport_to_year, $selected_y)."年\n".
	form_dropdown('passport_to_month', $form_month, $selected_m)."月\n".
	form_dropdown('passport_to_day', $form_day, $selected_d)."日\n";

$errors = array();
if (form_error('passport_to_year') != '') {
	$errors[] = form_error('passport_to_year');
}
if (form_error('passport_to_month') != '') {
	$errors[] = form_error('passport_to_month');
}
if (form_error('passport_to_day') != '') {
	$errors[] = form_error('passport_to_day');
}
$error = implode("\n", $errors);
echo output_html_f_box($id, $element, $error, $param_metas);

// ----------
// 訂正旅券・公用旅券
// ----------

if (
	// 日本旅券でエラーが出た時のみ表示
	$this->input->post('no_check_passport') === 'true' ||
	(
		$this->input->post('country_national') === 'JP' &&
		strlen($this->input->post('passport_number')) === 9 &&
		(
			form_error('passport_number') !== '' ||
			form_error('passport_to_day') !== ''
		)
	)
) {
	$id = 'no_check_passport';
	$selected_y = ($this->input->post($id) === 'true') ? TRUE : FALSE;
	$selected_n = ($this->input->post($id) !== 'true') ? TRUE : FALSE;
	$element = ''.
		form_radio(array(
			'name' => $id,
			'id' => $id.'_y',
			'value' => 'true',
			'checked' => $selected_y,
		))."\n".'<label for="'.$id.'_y">該当する</label>'."\n".
		form_radio(array(
			'name' => $id,
			'id' => $id.'_n',
			'value' => 'false',
			'checked' => $selected_n,
		))."\n".'<label for="'.$id.'_n">該当しない</label>'."\n";
	echo output_html_f_box($id, $element, form_error($id), $param_metas);
} else {
	echo '<input type="hidden" name="no_check_passport" id="no_check_passport" value="false" />'."\n";
}
?>
</div>

<!--=============ご連絡先=============-->
<div class="f_frame">
<h3 class="f_label">ご連絡先</h3>
<div class="f_line"></div>
<?php
// Eメールアドレス
$id = 'email';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '（例）yamada_taro@example.co.jp',
	'type' => 'text',
	'class' => 'size_long',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// Eメールアドレス確認用
$id = 'email_confirm';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '再度ご確認・ご入力をお願い致します',
	'type' => 'text',
	'class' => 'size_long',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 電話番号
$id = 'tel';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '（例）00-1234-5678',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 電話番号種別
$id = 'tel_type';
$selected = ($this->input->post($id)) ? $this->input->post($id) : 'JP';
$element = form_dropdown($id, $form_tel_type, $selected);
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 緊急時の連絡先登録
$id = 'is_set_emg_contact';
$selected_y = ($this->input->post($id) === 'Yes') ? TRUE : FALSE;
$selected_n = ($this->input->post($id) !== 'Yes') ? TRUE : FALSE;
$element = ''.
	form_radio(array(
		'name' => $id,
		'id' => $id.'_y',
		'value' => 'Yes',
		'checked' => $selected_y,
	))."\n".'<label for="'.$id.'_y">登録する</label>'."\n".
	form_radio(array(
		'name' => $id,
		'id' => $id.'_n',
		'value' => 'No',
		'checked' => $selected_n,
	))."\n".'<label for="'.$id.'_n">登録しない</label>'."\n";
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 緊急連絡先 - 姓
$id = 'emg_lastname';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '苗字：（例）YAMADA：空欄可',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 緊急連絡先 - 名
$id = 'emg_firstname';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '名前：（例）ICHIRO：空欄可',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 緊急連絡先 - Eメールアドレス
$id = 'emg_email';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '（例）yamada_ichiro@example.co.jp：空欄可',
	'type' => 'text',
	'class' => 'size_long',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 緊急連絡先 - 電話（国番号）
$id = 'emg_country_phone_code';
$selected = ($this->input->post($id)) ? $this->input->post($id) : '81';
$element = form_dropdown($id, $form_country_phone_code, $selected);
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 緊急連絡先 - 電話番号
$id = 'emg_tel';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '（例）00-1234-5678：空欄可',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);
?>
</div>


<!--=============クレジットカード名義=============-->
<div class="f_frame">
<h3 class="f_label">クレジットカード名義</h3>
<div class="f_line"></div>
<div class="f_info">
この後の決済にご利用頂くクレジットカードの御名義を英字でご入力下さい
</div>
<?php
// 姓
$id = 'billing_last_name';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '（例）YAMADA',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 名
$id = 'billing_first_name';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '（例）TARO',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);
?>
</div>


<!--=============ご自宅住所=============-->
<div class="f_frame">
<h3 class="f_label">ご自宅住所</h3>
<div class="f_line"></div>
<?php
// 郵便番号
$id = 'billing_zip';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '163-8001',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 都道府県
$id = 'billing_state';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '英字入力：（例）Tokyo',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 市区町村
$id = 'billing_city';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '英字入力：（例）Shinjukuku Nishishinjuku',
	'type' => 'text',
	'class' => 'size_long',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 丁番地
$id = 'billing_address1';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '（例）2-8-1',
	'type' => 'text',
	'class' => 'size_long',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// ビル名
$id = 'billing_building';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '英字入力：（例）ABC Apart：空欄可',
	'type' => 'text',
	'class' => 'size_long',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 部屋番号
$id = 'billing_room_number';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '（例）102：空欄可',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);
?>
</div>

<!--=============渡航情報=============-->
<div class="f_frame">
<h3 class="f_label">渡航情報</h3>
<div class="f_line"></div>
<?php
// 第三国への乗継ですか？
$id = 'for_via';
$selected_y = ($this->input->post($id) !== 'No') ? TRUE : FALSE;
$selected_n = ($this->input->post($id) === 'No') ? TRUE : FALSE;
$element = ''.
	form_radio(array(
		'name' => $id,
		'id' => $id.'_y',
		'value' => 'Yes',
		'checked' => $selected_y,
	))."\n".'<label for="'.$id.'_y">はい、乗継です</label>'."\n".
	form_radio(array(
		'name' => $id,
		'id' => $id.'_n',
		'value' => 'No',
		'checked' => $selected_n,
	))."\n".'<label for="'.$id.'_n">いいえ、米国に滞在します</label>'."\n";
echo output_html_f_box($id, $element, form_error($id), $param_metas);
?>
<div class="f_box_hide f_info child_f_box_for_via">
滞在先の情報がご不明な場合や未決定の場合、下記の項目は空欄でも構いません
</div>
<?php
// 滞在先名称
$id = 'us_contact_name';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '英字入力：（例）ABC Hotel：空欄可',
	'type' => 'text',
	'class' => 'size_long',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 滞在先 - 州
$id = 'us_contact_address_state';
$selected = ($this->input->post($id)) ? $this->input->post($id) : 'JP';
$element = form_dropdown($id, $form_states, $selected);
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 滞在先 - 都市
$id = 'us_contact_address_city';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '英字入力：（例）Los Angels：空欄可',
	'type' => 'text',
	'class' => 'size_long',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 滞在先 - ストリート名
$id = 'us_contact_address_number';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '英字入力：（例）ABC Blvd 8555：空欄可',
	'type' => 'text',
	'class' => 'size_long',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// ビル名
$id = 'us_contact_address_building';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '英字入力：空欄可',
	'type' => 'text',
	'class' => 'size_long',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 部屋番号
$id = 'us_contact_address_room_number';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '英字入力：空欄可',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 滞在先 - 電話番号
$id = 'us_contact_tel';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '（例）310-123-4567：空欄可',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);
?>
</div>

<!--=============雇用情報=============-->
<div class="f_frame">
<h3 class="f_label">雇用情報</h3>
<div class="f_line"></div>
<?php

// ----------
// 就労の有無
// ----------

$id = 'employment_exp';
$selected_y = ($this->input->post($id) === 'Yes') ? TRUE : FALSE;
$selected_n = ($this->input->post($id) !== 'Yes') ? TRUE : FALSE;
$element = ''.
	form_radio(array(
		'name' => $id,
		'id' => $id.'_y',
		'value' => 'Yes',
		'checked' => $selected_y,
	))."\n".'<label for="'.$id.'_y">あり</label>'."\n".
	form_radio(array(
		'name' => $id,
		'id' => $id.'_n',
		'value' => 'No',
		'checked' => $selected_n,
	))."\n".'<label for="'.$id.'_n">なし</label>'."\n";
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 雇用者名
$id = 'employment_name';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '英字入力：（例）EMPLOYEE',
	'type' => 'text',
	'class' => 'size_long',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);
?>
<div class="f_box_hide f_info child_f_box_employment_exp">
現在（或いは以前）の雇用者名をご記入頂くか、<br />
現在の雇用状態または状況を説明する表記でも構いません。<br />
（例：会社員）EMPLOYEE<br />
（例：派遣社員）TEMPORARY EMPLOYEE<br />
（例：自営業）SELF-EMPLOYED<br />
（例：パート）PART-TIME JOB<br />
（例：専業主婦）HOMEMAKER<br />
（例：アルバイト学生）WORKING-STUDENT
</div>
<?php
// 雇用者 - 都道府県
$id = 'employment_address_state';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '英字入力：（例）Tokyo：空欄可',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 勤務先 - 市区町村
$id = 'employment_address_city';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '英字入力：（例）Minatoku Roppongi：空欄可',
	'type' => 'text',
	'class' => 'size_long',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 勤務先 - 丁番地
$id = 'employment_address_number';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '（例）2-8-1：空欄可',
	'type' => 'text',
	'class' => 'size_long',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// ビル名
$id = 'employment_address_building';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '英字入力：空欄可',
	'type' => 'text',
	'class' => 'size_long',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 雇用者 - 電話番号
$id = 'employment_tel';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '（例）00-1234-5678：空欄可',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 雇用者 - 職名
$id = 'employment_job_type';
$element = form_input(array(
	'name' => $id,
	'placeholder' => '英字入力：空欄可',
	'type' => 'text',
	'class' => 'size_normal',
	'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);
?>
</div>

<!--=============その他の質問事項=============-->
<div class="f_frame">
<h3 class="f_label">その他質問事項&nbsp;&nbsp;<span class="f_must">必須</span></h3>
<div class="f_line"></div>

<div id="q1" class="q_box">
<div class="q_left">
<?php $selected = ($this->input->post('q1') === 'Yes') ? TRUE : FALSE; ?>
<?php echo form_radio('q1', 'Yes', $selected)."\nYes\n"; ?>
<?php $selected = ($this->input->post('q1') !== 'Yes') ? TRUE : FALSE; ?>
<?php echo form_radio('q1', 'No', $selected)."\nNo\n"; ?>
</div>
<div class="q_right">質問1：<br />
身体的あるいは精神的な障害があるか、薬物乱用者あるいは中毒者であるか、現在以下に挙げる疾病のいずれかに罹患していますか？<br />
・軟性下疳<br />
・りん病<br />
・鼠径部肉芽腫<br />
・感染性らい病<br />
・性病性リンパ肉芽腫<br />
・感染性梅毒<br />
・活動性結核症
</div>
</div>

<div id="q2" class="q_box">
<div class="q_left">
<?php $selected = ($this->input->post('q2') === 'Yes') ? TRUE : FALSE; ?>
<?php echo form_radio('q2', 'Yes', $selected)."\nYes\n"; ?>
<?php $selected = ($this->input->post('q2') !== 'Yes') ? TRUE : FALSE; ?>
<?php echo form_radio('q2', 'No', $selected)."\nNo\n"; ?>
</div>
<div class="q_right">質問2：<br />
他者あるいは政府当局に対する重大な器物破損または傷害行為を招いた犯罪で逮捕されたり有罪判決を受けたりしたことがありますか？
</div>
</div>

<div id="q3" class="q_box">
<div class="q_left">
<?php $selected = ($this->input->post('q3') === 'Yes') ? TRUE : FALSE; ?>
<?php echo form_radio('q3', 'Yes', $selected)."\nYes\n"; ?>
<?php $selected = ($this->input->post('q3') !== 'Yes') ? TRUE : FALSE; ?>
<?php echo form_radio('q3', 'No', $selected)."\nNo\n"; ?>
</div>
<div class="q_right">
質問3：<br />
違法薬物の所持、使用、流通に関連した法律に違反したことがありますか？
</div>                                                                                                              
</div> 

<div id="q4" class="q_box">
<div class="q_left">
<?php $selected = ($this->input->post('q4') === 'Yes') ? TRUE : FALSE; ?>
<?php echo form_radio('q4', 'Yes', $selected)."\nYes\n"; ?>
<?php $selected = ($this->input->post('q4') !== 'Yes') ? TRUE : FALSE; ?>
<?php echo form_radio('q4', 'No', $selected)."\nNo\n"; ?>
</div>
<div class="q_right">
質問4：<br /> 
テロ行為、スパイ活動、破壊工作、大量虐殺に関与するつもりですか？あるいはこれまでに関与したことがありますか？
</div>
</div>

<div id="q5" class="q_box">
<div class="q_left">
<?php $selected = ($this->input->post('q5') === 'Yes') ? TRUE : FALSE; ?>
<?php echo form_radio('q5', 'Yes', $selected)."\nYes\n"; ?>
<?php $selected = ($this->input->post('q5') !== 'Yes') ? TRUE : FALSE; ?>
<?php echo form_radio('q5', 'No', $selected)."\nNo\n"; ?>
</div>
<div class="q_right">
質問5：<br />
自らあるいは他者が米国査証を入手したり米国に入国したりするために、これまで詐欺を行ったり、自身あるいは他者を偽ったりしたことがありますか？
</div>
</div>

<div id="q6" class="q_box">
<div class="q_left">
<?php $selected = ($this->input->post('q6') === 'Yes') ? TRUE : FALSE; ?>
<?php echo form_radio('q6', 'Yes', $selected)."\nYes\n"; ?>
<?php $selected = ($this->input->post('q6') !== 'Yes') ? TRUE : FALSE; ?>
<?php echo form_radio('q6', 'No', $selected)."\nNo\n"; ?>
</div>
<div class="q_right">
質問6：<br />
現在米国において雇用を求めているか、以前に米国政府の事前許可を受けずに米国で雇用されたことがありますか？
</div>
</div>

<div id="q7" class="q_box">
<div class="q_left">
<?php $selected = ($this->input->post('q7') === 'Yes') ? TRUE : FALSE; ?>
<?php echo form_radio('q7', 'Yes', $selected)."\nYes\n"; ?>
<?php $selected = ($this->input->post('q7') !== 'Yes') ? TRUE : FALSE; ?>
<?php echo form_radio('q7', 'No', $selected)."\nNo\n"; ?>
</div>
<div class="q_right">
質問7：<br />
現在または以前に所有した旅券で申請した米国査証が却下されたり、米国への入国が拒否されたり、米国通関手続地で入国申請を撤回されたことがありますか？
</div>
</div>

<div id="q8" class="q_box">
<div class="q_left">
<?php $selected = ($this->input->post('q8') === 'Yes') ? TRUE : FALSE; ?>
<?php echo form_radio('q8', 'Yes', $selected)."\nYes\n"; ?>
<?php $selected = ($this->input->post('q8') !== 'Yes') ? TRUE : FALSE; ?>
<?php echo form_radio('q8', 'No', $selected)."\nNo\n"; ?>
</div>
<div class="q_right">
質問8：<br />
米国政府により承認された期間を超えて米国内に滞在したことがありますか？
</div>
</div>

</div>

<!--=============ESTAお申し込みに関する同意事項=============-->
<div class="f_frame">
<h3 class="f_label">ESTAお申し込みに関する同意事項&nbsp;&nbsp;<span class="f_must">必須</span></h3>
<div class="f_line"></div>
<div id="kiyaku1" class="q_box">
<div class="q_left">
<input type="checkbox" name="kiyaku1" value="Yes" id="kiyaku1" <?php echo set_checkbox('kiyaku1', 'Yes');?> />
<label for="kiyaku1">同意する</label>
</div>
<!--/q_left-->
<div class="q_right">規約1．米国Webサイトに掲示されている下記の内容について同意しますか？
<div class="kiyaku_text">
<p>電子渡航認証システム（ESTA）は、法施行機関のデータベースとの照合を行ないます。ビザ免除プログラムを利用して米国に入国するすべての渡航者は、搭乗前にこのシステムを用いて電子渡航認証を取得することが義務付けられています。<br />
<br />
渡航認証申請が承認されている場合、渡航資格があることが証明されたことになりますが、ビザ免除プログラムに基づき米国に入国が認められることを証明するものではありません。米国に到着すると、入国地で税関国境警備局審査官の審査を受けることになりますが、ビザ免除プログラムに基づき、または米国法による何 らかの理由で入国拒否と判定されることがあります。<br />
<br />
電子渡航認証の資格がないと判定されても、渡米のためのビザ申請ができないということではありません。<br />
<br />
あなた自身または第三者の代行者により提供されたすべての情報は、真実、かつ正確なものでなければなりません。電子渡航認証資格に影響を与える新しい情報な ど、何らかの理由によりいつでも取り消されることがあります。あなた自身または代行により提出された電子渡航認証申請において故意に重大な偽り、虚偽、または詐欺の供述あるいは表明を行なった場合には、行政処分や刑事処分を受けることがあります。</p>
<p>・権利の放棄<br />
私は、ESTAで取得した渡航認証の期間中、米国税関国境警備局審査官の入国に関する決定に対して審査または不服申立を行う、あるいは亡命の申請事由を除き、ビザ免除プログラムでの入国申請から生じる除外措置について異議を申し立てる権利を放棄する旨の説明を読み、了解しました。<br />
上記の権利放棄に加え、ビザ免除プログラムに基づく米国への入国の条件として、私は、米国に到着時の審査において、生体認証識別（指紋や写真など）を提出することにより、米国税関国境警備局審査官の入国に関する決定に対して審査または不服申立を行う、あるいは亡命の申請事由を除き、ビザ免除プログラムによる入国申請から生じる除外措置について異議を申し立てる権利を放棄することが再確認されるものであることに同意します。<br />
<br />
・証明<br />
私、申請者は、本申請書のすべての質問事項および記載事項を読み、または代読してもらい、本申請書のすべての質問事項および記載事項を理解したことを証明します。本申請書で記述した回答および内容は、私の知る限り、また信じる限りにおいて真実、かつ正確なものです。<br />
申請者の代行者として申請書を提出する第三者として、私は、本申請書に名前が記載された人（申請者）に本申請書のすべての質問事項および記載事項を読み上げたことを証明します。私は、さらに、申請者が本申請書のすべての質問事項および記載内容を読み、または代読してもらい、理解し、また、米国税関国境警備局審査官の入国に関する決定に対して審査または不服申立を行う、あるいは亡命の申請事由を除き、ビザ免除プログラムによる入国申請から生じる除外措置について、異議を唱える権利を放棄することを証明していることを証明します。<br />
本申請書で記述した回答および内容は、申請者の知る限り、また信じる限りにおいて 真実、かつ正確なものです。</p>
</div>
<?php
$error = form_error('kiyaku1');
if ($error != '')
{
	echo '<div class="f_error_kiyaku_box">'.$error.'</div>';
}
?>
</div>
<!--/q_right--> 
</div>
<!--/q_box-->
<div class="q_hint_box" id="q_hint_kiyaku1"></div>
<div id="kiyaku2" class="q_box">
<div class="q_left">
<input type="checkbox" name="kiyaku2" value="Yes" id="kiyaku2" <?php echo set_checkbox('kiyaku2', 'Yes');?> />
<label for="kiyaku2">同意する</label>
</div>
<!--/q_left-->
<div class="q_right">規約2．当Webサイトに掲示されている下記の内容について同意しますか？
<div class="kiyaku_text">
<p>エスタ・オンラインの利用者は、このサイト内で規定している個人情報保護方針を順守します。</p>
<p>個人情報保護方針で、当サイトという言葉はエスタ・オンラインを指します。</p>
<p>個人情報保護方針で、申請者･利用者･お客様と第三者を表現する言葉や文章は、<br />
当サイトを通して契約する人を指します。</p>
<p>当サイトの利用者はサイト内に記載されている規約及び規定に同意します。</p>
<p>当サイトとはサイト内で使用されているすべての情報・デザイン・システムを含みます。</p>
<p>当サイトの利用者は、不法な目的で利用しない事に同意します。</p>
<p>当サイトの利用者は、著作権、特許権、知的財産権を侵害しない事に同意します。</p>
<p>当サイトの利用者は、意図的なソフトウェアのコピー、保存、製作、ホスティング、配布をしない事に同意します。</p>
<p>著作権には、当サイトが持つシステム、イメージ、テキスト、グラフィックなどが含まれています。</p>
<p>当サイトは個人情報保護方針により運営されており、お客様にESTA申請のために情報を求めることができます。</p>
<p>サービスの進行によりサービス料が発生します。</p>
<p>米国国土安全保障省申請料 (14$) + 申請代行サービス料 = <?php echo number_format($this->config->item('paypal_base_fee'));?>円 (税込<?php echo number_format($this->config->item('paypal_hidden_subtotal'));?>円)</p>
<p>当サイトが定める申請手数料には、米国国土安全保障省および旅行促進法により定められた14$が含まれています。<br />
これらの支払いはクレジットカードおよびPayPalでの決済が可能です。</p>
<p>お客様からのサービスの進行の要請とお支払いが確認できた時点からサービスが進行されます。</p>
<p>当サービスでは、お客様からのご依頼に基づき、お客様に代わりESTA申請を行います。</p>
<p>当サービスに関するご質問はお問い合わせフォームよりご連絡下さい。 </p>
</div>
<?php
$error = form_error('kiyaku2');
if ($error != '')
{
	echo '<div class="f_error_kiyaku_box">'.$error.'</div>';
}
?>
</div>
<!--/q_right--> 
</div>
<!--/q_box-->
<div class="q_hint_box" id="q_hint_kiyaku2"></div>
</div>
<div style="text-align:center;">
<input class="btn_big2" type="submit" value="送信確認画面へ移動する"/>
</div>

</form>
</div>

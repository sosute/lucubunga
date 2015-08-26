<script type="text/javascript">
$(function () {
    $('.f_hint_box').hide();
    $('a.f_hint').click(function (){
        $('#' + $(this).attr('name')).toggle();
        return false;
    });
});
</script>

<form name="apply_form" id="apply_form" method="post" action="<?php echo $env_url;?>/contact/index.html">
<div id="container">
<noscript>
<div class="js_error">[注意] JavaScriptが無効になっています。当サイトを正しくご利用頂く為、JavaScriptの設定を有効にして下さい。</div>
</noscript>
<h2>お問い合わせ</h2>

<div class="f_frame_guide">
<div class="f_box">
<div class="f_center2"><span class="f_must">必須</span></div>
<div class="f_text">は必須入力項目です。</div>
</div>
<div class="f_box">
<div class="f_center1"><span class="f_hint">？</span></div>
<div class="f_text">を押すと詳細な説明をご確認頂けます。</div>
</div>
</div>

<div class="f_frame">
<h3 class="f_label">お問い合わせ内容</h3>
<div class="f_line"></div>
<?php
// 姓
$id = 'ask_lastname';
$element = form_input(array(
    'name' => $id,
    'placeholder' => '申請対象者様の姓を英字でご入力ください：（例）YAMADA',
    'type' => 'text',
    'class' => 'size_normal',
    'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 名
$id = 'ask_firstname';
$element = form_input(array(
    'name' => $id,
    'placeholder' => '申請対象者様の名を英字でご入力ください：（例）TARO',
    'type' => 'text',
    'class' => 'size_normal',
    'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// メールアドレス
$id = 'ask_email';
$element = form_input(array(
    'name' => $id,
    'placeholder' => '申請時にご入力頂きましたアドレスをご入力ください',
    'type' => 'text',
    'class' => 'size_normal',
    'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// 申請ID
$id = 'ask_appid';
$element = form_input(array(
    'name' => $id,
    'placeholder' => '申請IDが分かる場合はご入力ください',
    'type' => 'text',
    'class' => 'size_normal',
    'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);

// お問合せ内容
$id = 'ask_message';
$element = form_textarea(array(
    'name' => $id,
    'placeholder' => 'お問合せ内容をご入力ください',
    'class' => 'size_normal f_textarea',
    'value' => set_value($id),
));
echo output_html_f_box($id, $element, form_error($id), $param_metas);
?>
</div>
<input class="btn_big2" type="submit" value="送信確認画面へ移動する"/>
</div>
</form>

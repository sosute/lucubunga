<div id="container">
<noscript>
<div class="js_error">JavaScriptが無効になっています。サイトを正しくご利用頂く為、JavaScriptの設定を有効にして下さい。</div>
</noscript>
<h2>申請状況確認</h2>

<ul class="service">
<li>お客様の申請IDを入力して「申請状況確認」をクリックして下さい。</li>
<li><span class="style_p01red">申請IDは、お申込み完了時に弊社から送信する
メールに記載しております。</span></li>
<li><span class="style_p01red">当ページでは、弊社にて申請されたお客様の情報
のみ検索可能となります。</span></li>
</ul>
<div class="status_input_box_wrapper">
<div class="status_input_box">
<div class="status_input_content">
<form method="get" action="<?php echo $env_url;?>/status/index.html">
<span>申請ID</span>
<input name="app_id" type="text" class="status_input_input" value="<?php echo set_value('app_id');?>" />
<input type="submit" value="" class="status_input_submit" />
</form>
</div>
</div>
</div>

<?php if ($page_type !== 'init'):?>
<div class="status_output">
<p>
<?php if ($page_type === 'hit'):?>
<?php echo $status_desc;?>
<?php elseif($page_type === 'invalid'):?>
<?php echo form_error('app_id');?>
<?php elseif($page_type === 'not_found'):?>
入力されたお申込みIDの情報が見つかりませんでした。
<?php endif;?>
</p>
</div>
<?php endif;?>


<?php if ($page_type === 'hit'):?>
<table border="0" cellpadding="0" cellspacing="0" class="table_status_output">
<tr>
<th>項目名</th>
<th>内容</th>
</tr>
<?php foreach ($app_values as $param_id => $value):?>
<tr>
<td class="td_left"><?php echo $value['name_mb'];?></td>
<td class="td_right"><?php echo $value['value'];?></td>
</tr>
<?php endforeach;?>
</table>



<?php if (isset($_GET['force']) && $_GET['force'] === 'on'):?>
<form method="post" action="<?php echo $env_url;?>/apply/step1.html">
<?php foreach ($app_values as $param_id => $value):?>
<input type="hidden" name="<?php echo $param_id?>" value="<?php echo $value['value'];?>"/>
<?php endforeach;?>
<?php
$tmp = array(
	'birth' => $app_values['birth_date']['value'],
	'passport_from' => $app_values['passport_from_date']['value'],
	'passport_to' => $app_values['passport_to_date']['value'],
);
foreach ($tmp as $key => $val)
{
	$param = $key . '_date';
	list($y, $m, $d) = explode('-', $val);
	echo '<input type="hidden" name="'.$key.'_year" value="'.(int)$y.'"/>'."\n";
	echo '<input type="hidden" name="'.$key.'_month" value="'.(int)$m.'"/>'."\n";
	echo '<input type="hidden" name="'.$key.'_day" value="'.(int)$d.'"/>'."\n";
}
?>
<input type="hidden" name="email_confirm" value="<?php echo $app_values['email']['value'];?>"/>
<input type="hidden" name="type" value="modify"/>
<input type="hidden" name="kiyaku1" value="Yes"/>
<input type="hidden" name="kiyaku2" value="Yes"/>
<input type="submit" value="." />
</form>
<?php endif;?>
<?php endif;?>


</div>

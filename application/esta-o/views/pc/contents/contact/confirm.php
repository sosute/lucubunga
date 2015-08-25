<div id="container">
<noscript>
<div class="js_error">[注意] JavaScriptが無効になっています。弊社サイトを正しくご利用頂く為、JavaScriptの設定を有効にして下さい。</div>
</noscript>
<h2>お問い合わせ内容確認</h2>

<table class="table_confirm">
<tr>
<th class="th_left">項目名</th>
<th class="th_right">ご入力内容</th>
</tr>
<?php foreach ($param_metas as $id => $meta):?>
<tr>
<td class="td_left"><?php echo isset($meta['name_mb_uniq']) ? $meta['name_mb_uniq'] : $meta['name_mb'];?></td>
<td class="td_right"><?php echo ${$id};?></td>
</tr>
<?php endforeach;?>
</table>

<form action="<?php echo $env_url;?>/contact/done.html" method="post">
<input type="hidden" name="lastname" value="<?php echo $ask_lastname;?>" />
<input type="hidden" name="firstname" value="<?php echo $ask_firstname;?>" />
<input type="hidden" name="email" value="<?php echo $ask_email;?>" />
<input type="hidden" name="appid" value="<?php echo $ask_appid;?>" />
<input type="hidden" name="message" value="<?php echo $ask_message;?>" />
<input class="btn_big2" type="submit" value="送信確認画面へ移動する"/>
</form>

</div>

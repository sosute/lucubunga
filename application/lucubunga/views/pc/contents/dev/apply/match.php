<div id="container">
<noscript>
	<div class="js_error">[注意] JavaScriptが無効になっています。弊社サイトを正しくご利用頂く為、JavaScriptの設定を有効にして下さい。</div>
  </noscript>
    <h2 class="title">ESTAお申込み</h2>

<div class="same_textbox">
<p>同一内容にて決済済みの情報が見つかりました。<br />
お手続きの状況は<a href="<?php echo $env_url;?>/status/index.html?app_id=<?php echo $past['app_id'];?>">コチラ</a>からご確認下さい。
</p>
</div>

<table border="0" cellpadding="0" cellspacing="0" class="table_same">
<tr>
<th>項目名</th>
<th>情報</th>
</tr>
<tr>
<td class="td_left">過去の申請日</td>
<td class="td_right"><?php echo $past['start_date'];?></td>
</tr>
<?php foreach ($param_metas as $id => $meta):?>
<tr>
<td class="td_left"><?php echo $meta['name_mb'];?></td>
<td class="td_right"><?php echo $current[$id];?></td>
</tr>
<?php endforeach;?>
</table>

<form action="<?php echo $env_url;?>/" method="post">
<input class="btn_big2" type="submit" value="トップページへ戻る"/>
</form>
</div>

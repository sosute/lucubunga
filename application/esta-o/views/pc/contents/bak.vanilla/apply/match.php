<div id="conts">
<h2 id="apply">ESTAお申込み</h2>

<div class="same_textbox">
<p class="style_p06">
同一内容にて決済済みの情報が見つかりました。<br />
申請状況は<a href="/status/index.html?app_id=<?php echo $past['app_id'];?>">コチラ</a>からご確認下さい。
</p>
</div>

<table class="table_same2">
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

<form action="/" method="post">
<div class="btn01">
<input id="btn01_copy" type="submit" value="トップページへ戻る" />
</div>
</form>

<div class="space_30"></div>

</div>

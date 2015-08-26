<div id="container">
<noscript>
<div class="js_error">[注意] JavaScriptが無効になっています。弊社サイトを正しくご利用頂く為、JavaScriptの設定を有効にして下さい。</div>
</noscript>
<div class="apply_flow"><img src="/assets/esta-o/img/201504/step02.jpg" width="830" height="50" /></div>
<table class="table_confirm">
<tr>
<th class="th_left">項目名</th>
<th class="th_right">ご入力内容</th>
</tr>
<?php foreach ($param_metas as $id => $meta):?>
<tr>
<?php if ($id === 'birth_date'): ?>
<td class="td_left">生年月日</td>
<td class="td_right"><?php echo $birth_year.'年'.$birth_month.'月'.$birth_day.'日';?></td>
<?php elseif ($id === 'passport_from_date'):?>
<td class="td_left">パスポート発行日</td>
<td class="td_right"><?php echo $passport_from_year.'年'.$passport_from_month.'月'.$passport_from_day.'日';?></td>
<?php elseif ($id === 'passport_to_date'):?>
<td class="td_left">パスポート有効期限</td>
<td class="td_right"><?php echo $passport_to_year.'年'.$passport_to_month.'月'.$passport_to_day.'日';?></td>
<?php else:?>
<td class="td_left"><?php echo isset($meta['name_mb_uniq']) ? $meta['name_mb_uniq'] : $meta['name_mb'];?></td>
<td class="td_right"><?php echo ${$id};?></td>
<?php endif;?>
</tr>
<?php endforeach;?>
</table>

<div id="f_box_submit">
<div id="f_box_submit_left">
<form class="apply_confirm_form01" action="<?php echo $env_url;?>/apply/step1.html" method="post">
<fieldset class="apply_confirm_form01">
<?php foreach ($param_metas as $id => $meta):?>
<?php if ($id === 'birth_date'): ?>
<input type="hidden" name="birth_year" value="<?php echo $birth_year; ?>">
<input type="hidden" name="birth_month" value="<?php echo $birth_month; ?>">
<input type="hidden" name="birth_day" value="<?php echo $birth_day; ?>">
<?php elseif ($id === 'passport_from_date'):?>
<input type="hidden" name="passport_from_year" value="<?php echo $passport_from_year; ?>">
<input type="hidden" name="passport_from_month" value="<?php echo $passport_from_month; ?>">
<input type="hidden" name="passport_from_day" value="<?php echo $passport_from_day; ?>">
<?php elseif ($id === 'passport_to_date'):?>
<input type="hidden" name="passport_to_year" value="<?php echo $passport_to_year; ?>">
<input type="hidden" name="passport_to_month" value="<?php echo $passport_to_month; ?>">
<input type="hidden" name="passport_to_day" value="<?php echo $passport_to_day; ?>">
<?php else:?>
<input type="hidden" name="<?php echo $id;?>" value="<?php echo ${$id};?>">
<?php endif;?>
<?php endforeach;?>
<input type="hidden" name="kiyaku1" value="Yes" />
<input type="hidden" name="kiyaku2" value="Yes" />
<input type="hidden" name="type" value="modify" />
<input class="btn_big3" type="submit" value="内容を修正する"/>
</fieldset>
</form>
</div>

<div id="f_box_submit_right">
<form class="apply_confirm_form02" action="<?php echo $env_url;?>/apply/step2.html" method="post">
<fieldset class="apply_confirm_form02">
<?php foreach ($param_metas as $id => $meta):?>
<?php if ($id === 'birth_date'): ?>
<input type="hidden" name="birth_year" value="<?php echo $birth_year; ?>">
<input type="hidden" name="birth_month" value="<?php echo $birth_month; ?>">
<input type="hidden" name="birth_day" value="<?php echo $birth_day; ?>">
<?php elseif ($id === 'passport_from_date'):?>
<input type="hidden" name="passport_from_year" value="<?php echo $passport_from_year; ?>">
<input type="hidden" name="passport_from_month" value="<?php echo $passport_from_month; ?>">
<input type="hidden" name="passport_from_day" value="<?php echo $passport_from_day; ?>">
<?php elseif ($id === 'passport_to_date'):?>
<input type="hidden" name="passport_to_year" value="<?php echo $passport_to_year; ?>">
<input type="hidden" name="passport_to_month" value="<?php echo $passport_to_month; ?>">
<input type="hidden" name="passport_to_day" value="<?php echo $passport_to_day; ?>">
<?php else:?>
<input type="hidden" name="<?php echo $id;?>" value="<?php echo ${$id};?>">
<?php endif;?>
<?php endforeach;?>
<input type="hidden" name="kiyaku1" value="Yes" />
<input type="hidden" name="kiyaku2" value="Yes" />
<input class="btn_big2" type="submit" value="上記内容で送信する"/>
</fieldset>
</form>
</div>
</div>


</div>

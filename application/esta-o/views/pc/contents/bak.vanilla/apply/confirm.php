<div id="conts">
<h2 id="apply">ESTAお申込み</h2>
<div id="apply_flow">
<ul class="clearfix">
<li class="flowbox" id="box1"><p>申請書内容入力</p></li>
<li class="flowarrow"><img src="/assets/esta-o/img/common/arrow_flow_box.png" /></li>
<li class="flowbox" id="box2b"><p>申請書内容確認</p></li>
<li class="flowarrow"><img src="/assets/esta-o/img/common/arrow_flow_box.png" /></li>
<li class="flowbox" id="box3"><p>申請料お支払い</p></li>
<li class="flowarrow"><img src="/assets/esta-o/img/common/arrow_flow_box.png" /></li>
<li class="flowbox" id="box4"><p>申請完了</p></li>
</ul>
</div>
<p class="style_p05center">内容に誤りが無いか、ご確認お願い致します。</p>    


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


<form class="apply_confirm_form01" action="/apply/step2.html" method="post">
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
<div class="btn01">
<input id="btn01_copy" type="submit" value="上記内容で送信する"/>
</div>
</fieldset>
</form>


<form class="apply_confirm_form02" action="/apply/step1.html" method="post">
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
<input type="hidden" name="type" value="modify" />
<div class="btn01">
<input id="btn01_copy" type="submit" value="内容を修正する"/>
</div>
</fieldset>
</form>

<div class="space_50"></div>

</div>

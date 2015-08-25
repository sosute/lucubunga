<?php

$birth_day           = (int)$birth_day;
$birth_month         = (int)$birth_month;
$passport_from_day   = (int)$passport_from_day;
$passport_from_month = (int)$passport_from_month;
$passport_to_day     = (int)$passport_to_day;
$passport_to_month   = (int)$passport_to_month;

$js1 = ($id_sex === '') ? '' : "document.getElementById('applicant.sex".$id_sex."').checked=true;";
$js1 .= <<<EOT
document.getElementById('applicant.lastName').value='${lastname}';
document.getElementById('applicant.firstName').value='${firstname}';
document.getElementById('applicant.dobDay').value='${birth_day}';
document.getElementById('applicant.dobMonth').value='${birth_month}';
document.getElementById('applicant.dobYear').value='${birth_year}';
document.getElementById('applicant.countryOfBirth').value='${country_birth}';
document.getElementById('applicant.countryOfCitizenship').value='${country_national}';
document.getElementById('applicant.countryOfLiving').value='${country_live}';
document.getElementById('passport.passportNumber').value='${passport_number}';
document.getElementById('passport.countryOfIssue').value='${country_national}';
document.getElementById('passport.whenIssuedDay').value='${passport_from_day}';
document.getElementById('passport.whenIssuedMonth').value='${passport_from_month}';
document.getElementById('passport.whenIssuedYear').value='${passport_from_year}';
document.getElementById('passport.expiresDay').value='${passport_to_day}';
document.getElementById('passport.expiresMonth').value='${passport_to_month}';
document.getElementById('passport.expiresYear').value='${passport_to_year}';
document.getElementById('vwp.communicableDisease${id_q1}').checked=true;
document.getElementById('vwp.criminalHistory${id_q2}').checked=true;
document.getElementById('vwp.terroristOrNazi${id_q3}').checked=true;
document.getElementById('vwp.seekingWork${id_q4}').checked=true;
document.getElementById('vwp.childCustodyViolation${id_q5}').checked=true;
document.getElementById('vwp.visaRefused${id_q6}').checked=true;
document.getElementById('vwp.visaRefusedWhen').value='${q6_when}';
document.getElementById('vwp.visaRefusedWhere').value='${q6_where}';
document.getElementById('vwp.immunity${id_q7}').checked=true;
document.getElementById('acceptWaiver1').checked=true;
document.getElementById('thirdParty1').checked=true;
window.scroll(0,document.body.scrollHeight);
EOT;

$js2 = <<<EOT
document.getElementById('passport.verifyNumber').value='${passport_number}';
document.getElementById('applicant.lastNameVerify').value='${lastname}';
document.getElementById('applicant.countryOfCitizenshipVerify').value='${country_national}';
document.getElementById('applicant.dobDayVerify').value='${birth_day}';
document.getElementById('applicant.dobMonthVerify').value='${birth_month}';
document.getElementById('applicant.dobYearVerify').value='${birth_year}';
window.scroll(0,document.body.scrollHeight);
EOT;

$js3 = <<<EOT
document.getElementById('checkStatus.passportNumber').value='${passport_number}';
document.getElementById('checkStatus.applicant.dobDay').value='${birth_day}';
document.getElementById('checkStatus.applicant.dobMonth').value='${birth_month}';
document.getElementById('checkStatus.applicant.dobYear').value='${birth_year}';
document.getElementById('checkStatus.applicant.lastName').value='${lastname}';
document.getElementById('checkStatus.applicant.firstName').value='${firstname}';
document.getElementById('checkStatus.applicant.countryOfCitizenship').value='${country_national}';
window.scroll(0,document.body.scrollHeight);
EOT;

if ((($lastname === '' || $q7 === '') && $mail_body !== '') || $is_valid === FALSE)
{
	$bookmarklet = '<font color="red">やり直し！</font>';
}
else
{
	$bookmarklets = array();
	$js1 = preg_replace('/\s/', '', $js1);
	$bookmarklets['apply'] = '<a href="javascript:(function(){'.$js1.'})();">'.$lastname.' '.$firstname.'</a>';
	$js2 = preg_replace('/\s/', '', $js2);
	$bookmarklets['verify'] = '<a href="javascript:(function(){'.$js2.'})();">認証用</a>';
	$js3 = preg_replace('/\s/', '', $js3);
	$bookmarklets['check'] = '<a href="javascript:(function(){'.$js3.'})();">検索用</a>';
	$bookmarklet = implode('&nbsp|&nbsp', $bookmarklets);
}
?>


<h2>Mail to Bookmarklet</h2>


<form method="post">
<div class="box">
<input type="submit" value="ブックマークレット作成">
<input type="button" value="リセット" onclick="location.href=''">
<?php if ($mail_body !== ''):?>
<?php echo $bookmarklet;?>
<?php endif;?>
</div>
<div class="box" id="m2b_mail">
<textarea name="mail_body" cols="40" rows="25">
<?php echo $mail_body;?>
</textarea>
</div>
</form>


<?php if ($is_valid === FALSE && $mail_body !== ''):?>
	<div class="box" id="m2b_error">
	<?php echo validation_errors();?>
	</div>
<?php elseif ($is_valid === TRUE && $mail_body !== ''):?>
	<script language="JavaScript">
	$(document).ready(function() {
		var swf = "/assets/admin/js/ZeroClipboard.swf";
		var clip = new ZeroClipboard($("#clip_button1"), {moviePath: swf});
		var clip = new ZeroClipboard($("#clip_button2"), {moviePath: swf});
		var clip = new ZeroClipboard($("#clip_button3"), {moviePath: swf});
		var clip = new ZeroClipboard($("#clip_button4"), {moviePath: swf});
		var clip = new ZeroClipboard($("#clip_button5"), {moviePath: swf});
		var clip = new ZeroClipboard($("#clip_button6"), {moviePath: swf});
		var clip = new ZeroClipboard($("#clip_button7"), {moviePath: swf});
		var clip = new ZeroClipboard($("#clip_button8"), {moviePath: swf});
	})
	</script>
	<div class="box" id="m2b_table">
	<table>
		<tr>
			<td>氏名</td>
			<td><?php echo $lastname.' '.$firstname;?></td>
			<td><button class="clip_button" id="clip_button1" data-clipboard-text="<?php echo $lastname.' '.$firstname;?>">Copy</button></td>
		</tr>
		<tr>
			<td>性別</td>
			<td><?php echo $sex;?></td>
			<td><button class="clip_button" id="clip_button2" data-clipboard-text="<?php echo $sex;?>">Copy</button></td>
		</tr>
		<tr>
			<td>国籍</td>
			<td><?php echo $country_national;?></td>
			<td><button class="clip_button" id="clip_button3" data-clipboard-text="<?php echo $country_national;?>">Copy</button></td>
		</tr>
		<tr>
			<td>出生国</td>
			<td><?php echo $country_birth;?></td>
			<td><button class="clip_button" id="clip_button4" data-clipboard-text="<?php echo $country_birth;?>">Copy</button></td>
		</tr>
		<tr>
			<td>居住国</td>
			<td><?php echo $country_live;?></td>
			<td><button class="clip_button" id="clip_button5" data-clipboard-text="<?php echo $country_live;?>">Copy</button></td>
		</tr>
		<tr>
			<td>パスポート番号</td>
			<td><?php echo $passport_number;?></td>
			<td><button class="clip_button" id="clip_button6" data-clipboard-text="<?php echo $passport_number;?>">Copy</button></td>
		</tr>
		<tr>
			<td>パスポート発行日</td>
			<td><?php echo $passport_from_date = sprintf('%d年%d月%d日', $passport_from_year, trim($passport_from_month), trim($passport_from_day));?></td>
			<td><button class="clip_button" id="clip_button7" data-clipboard-text="<?php echo $passport_from_date;?>">Copy</button"></td>
		</tr>
		<tr>
			<td>パスポート有効期限</td>
			<td><?php echo $passport_to_date = sprintf('%d年%d月%d日', $passport_to_year, trim($passport_to_month), trim($passport_to_day));?></td>
			<td><button class="clip_button" id="clip_button8" data-clipboard-text="<?php echo $passport_to_date;?>">Copy</button></td>
		</tr>
	</table>
	</div>
<?php endif;?>



<div class="clear"></div>

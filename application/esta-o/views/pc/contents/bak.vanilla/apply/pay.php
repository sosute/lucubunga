<div id="conts">
<h2 id="apply">ESTAお申込み</h2>

<div id="apply_flow">
<ul class="clearfix">
<li class="flowbox" id="box1"><p>申請書内容入力</p></li>
<li class="flowarrow"><img src="/assets/esta-o/img/common/arrow_flow_box.png" alt="矢印" /></li>
<li class="flowbox" id="box2"><p>申請書内容確認</p></li>
<li class="flowarrow"><img src="/assets/esta-o/img/common/arrow_flow_box.png" alt="矢印" /></li>
<li class="flowbox" id="box3b"><p>申請料お支払い</p></li>
<li class="flowarrow"><img src="/assets/esta-o/img/common/arrow_flow_box.png" alt="矢印" /></li>
<li class="flowbox" id="box4"><p>申請完了</p></li>
</ul>
</div>

<div class="payment_textbox">
<h3 class="style_h3_02">お申込みはまだ完了していません。</h3>
<p class="style_p10">下記支払方法のいずれかをお選び下さい。お支払い画面が表示されるまでしばらくお待ち下さい。</p>
<p class="style_p10">Visa, Mastercard, JCBのクレジットカード支払いの場合はカード情報を下の枠にご入力の上、「今すぐ支払う」ボタンをクリックして下さい。<br />
（「住所エラー」が表示された場合、画面を戻り、請求書先住所とカード会社の登録住所が同じことをご確認下さい）</p>
<p class="style_p11">※ご注意 AMEX, Dinersカードをご利用のお客様、またはエラーが表示されてしまう場合は<br />
「PayPalでお支払い」ボタンをクリックし、次の画面に従って決済のお手続きを進めて下さい。<br />
支払い完了後、「申請及び審査処理中」画面が表示するまでブラウザを閉じないで下さい。</p>
</div>

<?php if ($this->config->item('what_device_access_from') === 'pc'):?>
<div class="payment_iframebox_pc">
<iframe name="hss_iframe" class="payment_iframe_pc"></iframe>
</div>
<?php else:?>
<div class="payment_iframebox_other">
<iframe name="hss_iframe" class="payment_iframe_other"></iframe>
</div>
<?php endif;?>

<form style="display:none" target="hss_iframe" name="form_iframe" method="post" action="<?php echo $this->config->item('paypal_iframe_action_url');?>">
<input type="hidden" name="cmd" value="_hosted-payment" />
<input type="hidden" name="template" value="templateD" />
<input type="hidden" name="business" value="<?php echo $this->config->item('paypal_hidden_business');?>" />
<input type="hidden" name="cbt" value="<?php echo $this->config->item('paypal_hidden_cbt');?>"/>
<input type="hidden" name="custom" value="<?php echo $app_id;?>"/>
<input type="hidden" name="subtotal" value="<?php echo $this->config->item('paypal_hidden_subtotal');?>" />
<input type="hidden" name="item_name" value="<?php echo $this->config->item('paypal_hidden_item_name');?>" />
<input type="hidden" name="currency_code" value="<?php echo $this->config->item('paypal_hidden_currency_code');?>" />
<input type="hidden" name="notify_url" value="<?php echo $this->config->item('paypal_hidden_notify_url');?>" />
<input type="hidden" name="billing_email" value="<?php echo $email;?>"/>
<input type="hidden" name="billing_last_name" value="<?php echo $billing_last_name;?>"/>
<input type="hidden" name="billing_first_name" value="<?php echo $billing_first_name;?>"/>
<input type="hidden" name="billing_country" value="JP"/>
<input type="hidden" name="billing_zip" value="<?php echo $billing_zip;?>"/>
<input type="hidden" name="billing_state" value="<?php echo $billing_state;?>"/>
<input type="hidden" name="billing_city" value="<?php echo $billing_city;?>"/>
<input type="hidden" name="billing_address1" value="<?php echo $billing_address1;?>"/>
</form>

<script type="text/javascript">
document.form_iframe.submit();
</script>

<div class="space_10"></div>
<!--
<p style="color:red; text-align:center;">* クレジットカード有効期限の年は、西暦下2ケタでご入力下さい。</p>
-->

</div>

<div class="space_30"></div>


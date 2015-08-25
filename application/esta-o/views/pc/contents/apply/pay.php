<div id="container">
<noscript>
<div class="js_error">[注意] JavaScriptが無効になっています。弊社サイトを正しくご利用頂く為、JavaScriptの設定を有効にして下さい。</div>
</noscript>
<h2>ESTAお申込み</h2>
<div class="apply_flow"><img src="/assets/esta-o/img/201504/step03.jpg" width="830" height="50" /></div>
<div class="payment_textbox">
<h3 class="subtitle2">ご注文はまだ完了していません。</h3>
<p>下記支払方法のいずれかをお選び下さい。お支払い画面が表示されるまでしばらくお待ち下さい。</p>
<p class="mt10">Visa, Mastercard, JCBのクレジットカード支払いの場合はカード情報を下の枠にご入力の上、「今すぐ支払う」ボタンをクリックして下さい。<br />
（万一「住所エラー」が表示された場合、画面を戻り、請求書先住所とカード会社の登録住所が同じことをご確認下さい）<br />
AMEX, DinersまたはPayPalアカウントからのお支払いの場合は「PayPalでお支払い」をクリックし、次の画面に従ってお進み下さい。</p>
<p class="mt10 Text-Color-red">***お支払い完了後、「申請及び審査処理中」画面が表示するまでブラウザを閉じないで下さい***</p>
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

</div>

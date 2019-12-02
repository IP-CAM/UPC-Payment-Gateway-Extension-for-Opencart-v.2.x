<form action="<?php echo $action; ?>" method="post">
    <input name="Version" type="hidden" value="1" />
    <input name="MerchantID" type="hidden" value="<?php echo $merchant_id; ?>" />
    <input name="TerminalID" type="hidden" value="<?php echo $terminal_id; ?>" />
    <input name="TotalAmount" type="hidden" value="<?php echo $amount; ?>" />
    <input name="Currency" type="hidden" value="<?php echo $curr; ?>" />
    <input name="locale" type="hidden" value="<?php echo $language; ?>" />
    <input name="PurchaseTime" type="hidden" value="<?php echo $time; ?>" />
    <input name="PurchaseDesc" type="hidden" value="<?php echo $description; ?>" />
    <input name="OrderID" type="hidden" value="<?php echo $order_id; ?>" />
    <input name="Signature" type="hidden" value="<?php echo $b64sign; ?>" />
  <div class="buttons">
    <div class="pull-right">
      <input type="submit" value="<?php echo $button_confirm; ?>" class="btn btn-primary" />
    </div>
  </div>
</form>
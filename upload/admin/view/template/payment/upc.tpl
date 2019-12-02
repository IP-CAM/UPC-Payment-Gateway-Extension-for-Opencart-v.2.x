<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-upc" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
<div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
	
<div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
  </div>
  
<div class="panel-body">

<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-upc" class="form-horizontal">
  
<div class="form-group required">
<label class="col-sm-2 control-label" for="input-merch"><?php echo $entry_merch_id; ?></label>
<div class="col-sm-10">
<input type="text" name="upc_merch_id" id="input-merch" value="<?php echo $upc_merch_id; ?>" class="form-control" />
<?php if ($error_merch_id) { ?>
<div class="text-danger"><?php echo $error_merch_id; ?></div>
<?php } ?>
</div>
</div>
<div class="form-group required">
<label class="col-sm-2 control-label" for="input-terminal"><?php echo $entry_terminal_id; ?></label>
<div class="col-sm-10">
<input type="text" name="upc_terminal_id" id="input-terminal" value="<?php echo $upc_terminal_id; ?>" 	 class="form-control" />
<?php if ($error_terminal_id) { ?>
<div class="text-danger"><?php echo $error_terminal_id; ?></div>
<?php } ?>
</div>
</div>
<div class="form-group required">
<label class="col-sm-2 control-label" for="input-kmerch"><?php echo $entry_key_merchant; ?></label>
<div class="col-sm-10">
<input type="text" name="upc_key_merchant" id="input-kmerch" value="<?php echo $upc_key_merchant; ?>" placeholder="<?php echo $_SERVER['DOCUMENT_ROOT'].'/...'; ?>" class="form-control" />
<?php if ($error_key_merchant) { ?>
<div class="text-danger"><?php echo $error_key_merchant; ?></div>
<?php } ?>
</div>
</div>
<div class="form-group required">
<label class="col-sm-2 control-label" for="input-kterminal"><?php echo $entry_key_server; ?></label>
<div class="col-sm-10">
<input type="text" name="upc_key_server" id="input-kterminal" placeholder="<?php echo $_SERVER['DOCUMENT_ROOT'].'/...'; ?>" value="<?php echo $upc_key_server; ?>"    class="form-control" />
<?php if ($error_key_server){ ?>
<div class="text-danger"><?php echo $error_key_server; ?></div>
<?php } ?>
</div>
</div>
<div class="form-group">
            <label class="col-sm-2 control-label" for="input-server"><?php echo $entry_server; ?></label>
            <div class="col-sm-10">
              <select name="upc_server" id="input-server" class="form-control">
                <?php if ($upc_server == 'live') { ?>
                <option value="live" selected="selected"><?php echo $text_live; ?></option>
                <?php } else { ?>
                <option value="live"><?php echo $text_live; ?></option>
                <?php } ?>
                <?php if ($upc_server == 'test') { ?>
                <option value="test" selected="selected"><?php echo $text_test; ?></option>
                <?php } else { ?>
                <option value="test"><?php echo $text_test; ?></option>
                <?php } ?>
              </select>
    </div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label"><?php echo $entry_result_url; ?></label>
<div class="col-sm-10">
<div class="input-group"> <span class="input-group-addon"><i class="fa fa-link"></i></span>
<input type="text" value="<?php echo $upc_result_url; ?>" class="form-control" />
</div>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label"><?php echo $entry_success_url; ?></label>
<div class="col-sm-10">
<div class="input-group"> <span class="input-group-addon"><i class="fa fa-link"></i></span>
<input type="text" value="<?php echo $upc_success_url; ?>" class="form-control" />
</div>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label"><?php echo $entry_fail_url; ?></label>
<div class="col-sm-10">
<div class="input-group"> <span class="input-group-addon"><i class="fa fa-link"></i></span>
<input type="text" value="<?php echo $upc_fail_url; ?>" class="form-control" />
</div>
</div>
</div>

 <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
            <div class="col-sm-10">
              <select name="upc_order_status_id" id="input-order-status" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $upc_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
            <div class="col-sm-10">
              <select name="upc_geo_zone_id" id="input-geo-zone" class="form-control">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $upc_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="upc_status" id="input-status" class="form-control">
                <?php if ($upc_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
<div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">
              <input type="text" name="upc_sort_order" value="<?php echo $upc_sort_order; ?>" id="input-sort-order" class="form-control" />
            </div>
</div>
<div class="form-group">
            <div class="col-sm-2"><?php echo $entry_dev; ?></div>
            <div class="col-sm-10"><strong><a href="http://annas.com.ua/" target="_blank">Anna S.</a><strong></div>
</div>
</form>	  
    </div>
	</div>
	</div>
	</div>
<?php echo $footer; ?>
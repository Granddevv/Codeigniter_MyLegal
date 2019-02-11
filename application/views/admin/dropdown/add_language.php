<?php echo form_open(uri_string());?>
<div class="row">
      <div class="col-md-12">
            <div class="page-header">
                  <h1>
                        Add Language
                  </h1>
            </div>
            <?php if(!empty($status)) { ?>
                  <div class="alert alert-<?php echo ($status == "Success") ? "success" : "warning"; ?>">
                        <strong><?php echo $status; ?>!</strong>
                        <?php echo $message; ?>
                  </div>
            <?php } ?>
            <div class="form-group">
                  <label for="language">Language:</label>
                  <input type="text" name="language" id="language" class="form-control" value="<?php echo set_value('language', $language)?>" />
            </div>
            <p>
                  <?php echo form_submit('submit', 'Add Module', array('class' => 'btn btn-primary'));?>
                  <a class="btn btn-default" href="<?php echo base_url('dropdown_manager'); ?>">Go back</a>
            </p>
      </div>
</div>
<?php echo form_close();?>


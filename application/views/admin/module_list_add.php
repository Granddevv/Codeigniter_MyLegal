<?php echo form_open(uri_string());?>
<div class="row">
      <div class="col-md-12">
            <div class="page-header">
                  <h1>Add Module
                  </h1>
            </div>
            <?php if(!empty($status)) { ?>
                  <div class="alert alert-<?php echo ($status == "Success") ? "success" : "warning"; ?>">
                        <strong><?php echo $status; ?>!</strong>
                        <?php echo $message; ?>
                  </div>
            <?php } ?>
            <div class="form-group">
                  <label for="class_name">Class Name:</label>
                  <input type="text" name="class_name" id="class_name" class="form-control" value="<?php echo set_value('class_name', $class_name)?>" />
            </div>

            <div class="form-group">
                  <label for="method_name">Method Name:</label>
                  <input type="text" name="method_name" id="method_name" class="form-control" value="<?php echo set_value('method_name', $method_name)?>" />
            </div>

            <div class="form-group">
                  <label for="module_name">Module Name:</label>
                  <input type="text" name="module_name" id="module_name" class="form-control" value="<?php echo set_value('module_name', $module_name)?>" />
            </div>

            <p><?php echo form_submit('submit', 'Add Module', array('class' => 'btn btn-primary'));?></p>
      </div>
</div>

<?php echo form_close();?>

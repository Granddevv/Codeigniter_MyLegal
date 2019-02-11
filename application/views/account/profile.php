
<?php echo form_open(uri_string());?>
<div class="row">
      <div class="col-md-12">
            <div class="page-header">
                  <h1>My Profile <small></small>
                        <?php if($access_on_law_area) { ?>
                              <input type="button" class="btn btn-opp pull-right" onclick="window.location='<?php echo base_url("account/law_areas_update"); ?>'" value="Update Law Areas" />
                        <?php } ?>
                  </h1>
            </div>
            <div class="form-group">
                  <label for="first_name">First Name:</label>
                  <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo set_value('first_name', $user->first_name)?>" />
            </div>

            <div class="form-group">
                  <label for="last_name">Last Name:</label>
                  <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo set_value('last_name', $user->last_name)?>" />
            </div>

            <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="text" name="email" id="email" class="form-control" value="<?php echo set_value('email', $user->email)?>" />
            </div>

            <div class="form-group">
                  <label for="phone">Phone:</label>
                  <input type="text" name="phone" id="phone" class="form-control" value="<?php echo set_value('phone', $user->phone)?>" />
            </div>

            <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" name="password" id="password" class="form-control" value="<?php echo set_value('password')?>" />
            </div>

            <div class="form-group">
                  <label for="password_confirm">Confirm Password:</label>
                  <input type="password" name="password_confirm" id="password_confirm" class="form-control" value="" />
            </div>

            <p><?php echo form_submit('submit', 'Update Profile', array('class' => 'btn'));?></p>
      </div>
</div>

<?php echo form_close();?>

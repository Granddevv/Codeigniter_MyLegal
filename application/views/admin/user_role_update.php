<?php echo form_open('admin/update_role/'.$role->id, array('class' => 'form-horizontal'));  ?>
	<div class="row">
		<div class="header">
			<h2>User Role Access Control</h2>
		</div>
		<?php if(!empty($messages)) { ?>
			<div class="col-md-12">
				<div class="alert alert-success" role="alert"><?php echo $messages; ?></div>
			</div>
		<?php } ?>
		<div class="col-xs-12">
			<h4>Role: <?php echo $role->type; ?></h4>
			<table class="table table-bordered table-striped table-hover text-center">
				<thead>
					<td>Module Name</td>
					<td>Have Access?</td>
				</thead>
				<tbody>
					<?php foreach($module_list as $module) { ?>
						<tr>

							<td><?php echo $module->module_name; ?></td>
							<td><input type="checkbox" value="<?php echo $module->id; ?>" name="role_module_access[]" <?php echo (in_array($module->id, $role_access)) ? "checked" : ""; ?> /></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="col-xs-12 text-left">
			<button class="btn btn-success" type="submit">Update Access</button>
		</div>
	</div>
</form>
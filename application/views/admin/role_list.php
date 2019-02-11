<div class="row">
	<div class="header">
		<h2>User Role Access Control <a class="btn btn-primary pull-right" href="<?php echo base_url()."module_list/manager"; ?>">Module List</a></h2>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered table-striped table-hover text-center">
			<thead>
				<td>Role Name</td>
				<td>Action</td>
			</thead>
			<tbody>
				<?php foreach($role_list as $role) { ?>
					<tr>
						<td><?php echo $role->type; ?></td>
						<td>
							<?php if($role->id != 1) { ?>
								<button class="btn btn-warning" onclick="window.location='<?php echo base_url("admin/update_role/").$role->id; ?>'">Update Access</button>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
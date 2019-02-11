<div class="row">
	<div class="header">
		<h2>User Role Access Control</h2>
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
						<td><button class="btn btn-warning" onclick="window.location='<?php echo base_url("admin/update_role/").$role->id; ?>'">Edit</button>&nbsp;<button class="btn btn-default">Delete</button></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="header">
		<h2>Module List <a class="btn btn-primary pull-right" href="<?php echo base_url()."module_list/add"; ?>">Add New Module</a></h2>
	</div>
	<div class="col-md-12">
		<?php if($this->session->flashdata('message')) echo $this->session->flashdata('message'); ?>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered table-striped table-hover text-center">
			<thead>
				<td>Class Name</td>
				<td>Method Name</td>
				<td>Module Name</td>
				<td>Action</td>
			</thead>
			<tbody>
				<?php foreach($module_list as $module) { ?>
					<tr>
						<td><?php echo $module->class_name; ?></td>
						<td><?php echo $module->method_name; ?></td>
						<td><?php echo $module->module_name; ?></td>
						<td>
							<button class="btn btn-warning" onclick="window.location='<?php echo base_url("Module_list/add/").$module->id; ?>'">Edit</button>
							<button class="btn btn-default" onclick="window.location='<?php echo base_url("Module_list/delete/").$module->id; ?>'">Delete</button>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1>Manage Area Options <small></small></h1>
		</div>

		<div class="content">
			<div class="row">
				<div class="col-md-6">
					<div class="col-md-12">
						<h4><?php if($this->uri->segment(2)=='edit')echo 'Edit'; else echo 'Create child'; ?> option <?php if($this->uri->segment(2)=='edit'){?><a class="btn btn-default	 btn-sm" href="<?php echo site_url('admin_area_options')?>">Create child option</a><?php } ?></h4>
						<hr>
						<?php if($this->session->flashdata('message')) echo $this->session->flashdata('message'); ?>

						<div class="panel panel-default">
							<div class="panel-heading">
								Children of <strong><?php echo $parent->name; ?></strong> <small><a href="<?php echo site_url('admin_area_options/edit/'.$this->uri->segment(3)); ?>">(Edit)</a> <a href="<?php echo site_url('admin_area_options/delete/'.$this->uri->segment(3)); ?>">(Delete)</a>  <a href="<?php echo site_url('admin/add_questions/'.$this->uri->segment(3)); ?>">(Add Questions)</a></small>
							</div>
							<div class="panel-body">
							<div class="bordered padding_10 margin_bottom_10 areas_attached"> 
								<div class="heading">Areas Attached <small><a href="<?php echo site_url('admin_area_options/edit/'.$this->uri->segment(3)); ?>">(add more)</a></small></div>
								<?php if(count($parent_areas)>0){
									foreach ($parent_areas as $area ) {
										echo "<button class='btn btn-sm btn-default disabled'>".$area->name."</button> ";
									}
								} else echo "<button class='btn btn-sm btn-default disabled'>No Areas Attached</button>"
							?>
							<!-- <hr> -->
							</div>
							<div>
								<?php foreach ($children as $child): ?>
										<p>
											<small>
											<a href="<?php echo site_url('admin_area_options/view/'.$child->id); ?>" class="text-success btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="fa fa-bars"></i></a>
												<a href="<?php echo site_url('admin_area_options/edit/'.$child->id); ?>" class="text-warning btn btn-sm btn-default" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a> 
												<a href="<?php echo site_url('admin_area_options/delete/'.$child->id); ?>" class="text-danger btn btn-sm btn-default" title="Delete" data-toggle="tooltip"><i class="fa fa-times"></i></a>
												<a href="<?php echo site_url('admin_area_options/create/'.$child->id); ?>" class="text-primary btn btn-sm btn-default" title="Create Child" data-toggle="tooltip"><i class="fa fa-plus"></i></a>
											</small>
											<a href="<?php echo site_url('admin_area_options/view/'.$child->id); ?>"><?php echo $child->name; ?></a> 
										</p>
									<?php endforeach ?>
							</div>
									<hr>
								<div class="row">
									<div class="col-md-9">
						<form class="form form-horizontal" method="post" action="<?php if($this->uri->segment(2)=='edit')echo site_url('admin_area_options/edit/'.$edit->id);else echo site_url('admin_area_options/create/'.$this->uri->segment(3)); ?>">
							<div class="form-group">
								<label for="name" class="col-md-4">Name*</label>
								<div class="col-md-8"><input type="text" id="name" value="<?php if($this->uri->segment(2)=='edit')echo $edit->name;?>" name="name" required="" class="form-control"></div>
							</div>
						<div class="hidden">
								<div class="form-group">
								<label for="name" class="col-md-4">Slug</label>
								<div class="col-md-8"><input type="text" id="slug" value="<?php if($this->uri->segment(2)=='edit')echo $edit->slug;?>" name="slug" required="" class="form-control"></div>
							</div>
							<div class="form-group">
								<label for="name" class="col-md-4">Label for users</label>
								<div class="col-md-8"><input type="text" id="user_label" value="<?php if($this->uri->segment(2)=='edit')echo $edit->user_label;?>" name="user_label" class="form-control"></div>
							</div>
							<div class="form-group">
								<label for="name" class="col-md-4">Label for lawyers</label>
								<div class="col-md-8"><input type="text" id="lawyer_label" value="<?php if($this->uri->segment(2)=='edit')echo $edit->lawyer_label;?>" name="lawyer_label" class="form-control"></div>
							</div>
						</div>
								<div class="form-group">
									<label for="areas" class="col-md-4">Attach Law Areas</label>
									<div class="col-md-8">
										<select class="form-control" name="areas[]" id="areas" multiple="multiple">
											<option value="">Select</option>
											<?php foreach ($areas as $area) { ?>
												<option value="<?php echo $area->id; ?>"><?php echo $area->name; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
						<!-- <div class="form-group">
							<label for="" class="col-md-4">Child of (option) <br> <small>(Choose when you want to nest this option in another)</small></label>
							<div class="col-md-8">
								<select name="category" id="category" class="form-control">
									<option value="">Select</option>
									<?php foreach ($categories as $category) { ?>
										<option value="<?php echo $category->id; ?>" <?php if(isset($edit)){if($category->id == $edit->category_id) echo 'selected';} ?>><?php echo $category->name; ?></option>
									<?php } ?>

								</select>
							</div>
						</div> -->
						<div class="form-group">
							<div class="col-md-5">
								<button class="btn btn-primary">Save</button>
								<?php if($this->uri->segment(2)=='edit'){?>
									<a href="<?php echo site_url('admin_areas');?>" class="btn btn-warning">Cancel</a>
									<?php } ?>
								</div>

							</div>
						</form>

					</div>
				</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">

					<h4>Listing all child/ sub options</h4>
					<hr>
					<?php if(count($children)>0){?>
						<?php foreach ($children as $option) {
								echo "<p class='item'>";
							echo "<a class='btn btn-sm btn-warning' href='".site_url('admin_area_options/edit/'.$option->id)."'><i class='fa fa-pencil'></i></a> <a class='btn btn-sm btn-danger' href='".site_url('admin_area_options/delete/'.$option->id)."?redirect=".uri_string()."'><i class='fa fa-times'></i></a> <a class='' href='".site_url('admin_area_options/create/'.$option->id)."'><i class='fa fa-tasks'></i> ".$option->name;
							if($option->category_id!=NULL) echo '</strong>';
							echo "</a></p>";
						} ?>
						<?php }else { ?>
							<p class="text-bold bold">No Records found! <a href="<?php echo site_url('admin_area_options'); ?>">&laquo; Go Back</a></p>
							<?php } ?>

						</div>
					</div>
				</div>
			</div>
		</div>

		<script>
			var slug = function(str) {
				var $slug = '';
				var trimmed = $.trim(str);
				$slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
				replace(/-+/g, '-').
				replace(/^-|-$/g, '');
				return $slug.toLowerCase();
			}

			$('#name').on('change', function(event){
				event.preventDefault();
				$('#slug').val(slug($(this).val()));
			});

			$('#areas').select2({'placeholder': 'Select Areas',   allowClear: true});
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
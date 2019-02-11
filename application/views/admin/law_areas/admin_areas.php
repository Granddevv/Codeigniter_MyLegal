<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1>Manage <small>Areas of Law</small></h1>
		</div>

		<div class="content">
			<div class="row">
				<div class="col-md-12">
				<div class="">
						<h4><?php if($this->uri->segment(2)=='edit')echo 'Edit'; else echo 'Create new'; ?> area <?php if($this->uri->segment(2)=='edit'){?><a class="btn btn-default	 btn-sm" href="<?php echo site_url('admin_areas')?>">Create new area</a><?php } ?></h4>
						<hr>
						<?php if($this->session->flashdata('message')) echo $this->session->flashdata('message'); ?>
						<form class="form" method="post" action="<?php if($this->uri->segment(2)=='edit')echo site_url('admin_areas/edit/'.$edit->id);else echo site_url('admin_areas/create'); ?>">

							<div class="form-group col-md-4">
								<div class="row">
									<label for="name" class="col-md-3">Name</label>
									<div class="col-md-9"><input type="text" id="name" value="<?php if($this->uri->segment(2)=='edit')echo $edit->name;?>" name="name" required="" class="form-control"></div>
								</div>
							</div>
							<div class="form-group col-md-3">
								<div class="row">
									<label for="name" class="col-md-3">Slug</label>
									<div class="col-md-9"><input type="text" id="slug" value="<?php if($this->uri->segment(2)=='edit')echo $edit->slug;?>" name="slug" required="" class="form-control"></div>
								</div>
							</div>
							<div class="hidden">
								<div class="form-group">
									<label for="name" class="col-md-4">Label for users</label>
									<div class="col-md-8"><input type="text" id="user_label" value="<?php if($this->uri->segment(2)=='edit')echo $edit->user_label;?>" name="user_label" class="form-control"></div>
								</div>
								<div class="form-group">
									<label for="name" class="col-md-4">Label for lawyers</label>
									<div class="col-md-8"><input type="text" id="lawyer_label" value="<?php if($this->uri->segment(2)=='edit')echo $edit->lawyer_label;?>" name="lawyer_label" class="form-control"></div>
								</div>
							</div>
							<div class="form-group col-md-4">
								<div class="row">
									<label for="" class="col-md-3">Lawyer Profile Category 
									</label>
									<div class="col-md-9">
										<select name="category" id="category" class="form-control">
											<option value="">Select</option>
											<?php foreach ($categories as $category) { ?>
												<option value="<?php echo $category->id; ?>" <?php if(isset($edit)){if($category->id == $edit->category_id) echo 'selected';} ?>><?php echo $category->name; ?></option>
												<?php } ?>

											</select>
										</div>
									</div>
								</div>
								<div class="form-group col-md-1">
									<div class="col-md-12">
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
						<div class="row">
						<div class="col-md-12">

							<h4>Listing Areas by categories</h4>
							<hr>
							<?php foreach ($categories as $category) {
								echo "<div class='col-md-4' style='border: 1px solid #eee; '><div style='border-bottom: 1px solid #ccc; margin-bottom: 5px; padding-bottom: 4px;padding-top: 4px; text-transform: uppercase; font-weight: bold;'>".$category->name."</div>";
								foreach ($areas as $area) {
									if($area->category_id!=NULL) echo '<strong>';
									if($area->category_id==$category->id){
										echo "<p class='item'><a class='btn btn-sm btn-warning' href='".site_url('admin_areas/edit/'.$area->id)."'><i class='fa fa-pencil'></i></a> <a class='btn btn-sm btn-danger' href='".site_url('admin_areas/delete/'.$area->id)."'><i class='fa fa-times'></i></a> ".$area->name."</p>";
										if($area->category_id!=NULL) echo '</strong>';
									}
								} 
								echo "</div>";
							} ?>
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
		</script>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1>Manage  <small>Lawyer profile categories <small></small></small></h1>
		</div>

		<div class="content">
		<div class="row">
			<div class="col-md-8">
				<div class="col-md-9">
				<h4><?php if($this->uri->segment(2)=='edit')echo 'Edit'; else echo 'Create new'; ?> category <?php if($this->uri->segment(2)=='edit'){?><a class="btn btn-default	 btn-sm" href="<?php echo site_url('admin_lawyer_profile_categories')?>">Create new category</a><?php } ?></h4>
				<hr>
				<?php if($this->session->flashdata('message')) echo $this->session->flashdata('message'); ?>
					<form class="form form-horizontal" method="post" action="<?php if($this->uri->segment(2)=='edit')echo site_url('admin_lawyer_profile_categories/edit/'.$edit->id);else echo site_url('admin_lawyer_profile_categories/create'); ?>">
						<div class="form-group">
							<label for="name" class="col-md-4">Name</label>
							<div class="col-md-8"><input type="text" id="name" value="<?php if($this->uri->segment(2)=='edit')echo $edit->name;?>" name="name" required="" class="form-control"></div>
						</div>
						<div class="form-group">
							<label for="name" class="col-md-4">Slug</label>
							<div class="col-md-8"><input type="text" id="slug" value="<?php if($this->uri->segment(2)=='edit')echo $edit->slug;?>" name="slug" required="" class="form-control"></div>
						</div>
						<div class="form-group hidden">
							<label for="" class="col-md-4">Parent Category <br><small>(select only for creating sub-category)</small></label>
							<div class="col-md-8">
								<select name="category" id="category" class="form-control">
									<option value="">Select</option>
									<?php foreach ($categories as $category) { ?>
										<option value="<?php echo $category->id; ?>" <?php if(isset($edit)){if($category->id == $edit->parent_id) echo 'selected';} ?>><?php echo $category->name; ?></option>
									<?php } ?>

								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-5">
								<button class="btn btn-primary">Save</button>
								<?php if($this->uri->segment(2)=='edit'){?>
								<a href="<?php echo site_url('admin_lawyer_profile_categories');?>" class="btn btn-warning">Cancel</a>
								<?php } ?>
							</div>
							
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-4">
	
			<h4>Listing Categories</h4>
			<hr>
			<!-- <div class="well"><p>Note: <strong>Bold text</strong> are the sub categories</p></div> -->
				<? foreach ($categories as $category) {
					if($category->parent_id!=NULL) echo '<strong>';
					echo "<p class='item'><a class='btn btn-sm btn-warning'  href='".site_url('admin_lawyer_profile_categories/edit/'.$category->id)."'><i class='fa fa-pencil'></i></a> <a class='btn btn-sm btn-danger'  href='".site_url('admin_lawyer_profile_categories/delete/'.$category->id)."'><i class='fa fa-times'></i></a> ".$category->name."</p>";
					if($category->parent_id!=NULL) echo '</strong>';
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
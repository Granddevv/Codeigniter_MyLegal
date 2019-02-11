<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1>Manage <small>Job Options <small>(for the user)</small></small></h1>
		</div>

		<div class="content">
			<div class="row">
				<div class="col-md-12">
					<p><?php if(!isset($selected_category)){ ?>Please choose category of law or <a href="<?php echo site_url('admin_law_categories'); ?>">create a new one</a> <?php } else{?> Choose sub category or <a href="<?php echo site_url('admin_law_categories'); ?>">create a new one</a><?php } ?></p>

					<div>
						<?php 
						if(count($categories)>0){
							foreach ($categories as $category) {

								if(!isset($selected_category))
								{
									echo '<a href="'.site_url('admin_area_options/index/'.$category->id).'" class="field text-center"><i class="fa  fa-balance-scale"></i> <br>'.$category->name.'</a>';

								}
								else
								{
									echo '<a href="'.site_url('admin_area_options/show_options/'.$category->id).'" class="field text-center">';
									echo $category->name.'</a><br>';}
								}
							}else echo '<div class="well">No categories found! <a href="'.site_url('admin_area_options').'" class=" text-center">&laquo; Go back</a></div>';

							?>
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
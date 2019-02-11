<section id="lawyer_signup_section">
	<div class="row">
		<div class="col-md-12 text-center">
			<h1 class="title-header light_font"><?php echo $category->name; ?> Questionaire</h1>
		</div>
	</div>
</section>

<div class="module-header">
	<h4>Please answer the following questions:</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="content text-center">
			<!-- <h4><?php echo $category->name; ?> Questionaire</h4> -->

			<!-- <div class="col-md-4"> -->
				<?php
					foreach ($sub_categories as $category) {
						echo '<h3 onClick="window.location=\''.site_url('jobs/find/select_options/'.$category->id).'\'" class="col-md-4 box-gray field field_options text-center">'.$category->name.'</h3>';
					}
				?>
		</div>
				<br>
				<div>
					<a href="<?php echo site_url('jobs/find'); ?>" class="btn btn-opp btn-small">&nbsp;<i class="fa fa-chevron-left"></i>&nbsp;</a>
			<!-- </div> -->
				</div>
		
	</div>
</div>
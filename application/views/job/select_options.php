<section id="lawyer_signup_section">
	<div class="row">
		<div class="col-md-12 text-center">
			<h1 class="title-header light_font"><?php echo $parent_category->name; ?> Questionaire</h1>
		</div>
	</div>
</section>
<div class="module-header">
	<h4>Please answer the following questions:</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="content">

			<div class="col-md-12 option-panel">
				<div>
					<!-- <div class="panel-heading"> -->
					<div class="option-header col-md-12 text-center">
						<h3>
							<?php 
							if($category) echo ($category->user_label)?$category->user_label:$category->name ?>
						</h3>
					</div>
					<div class="col-md-12 text-center">
					<!-- </div> -->
					<!-- <div class="panel-body"> -->
						<?php 
						if($options && count($options)>0)
						{
							$ctr = 0;
							foreach ($options as $option) {
								echo '
									<div class="col-md-2 text-right" style="height:30px;">
										<div class="radio radio-primary">
									    	<input type="radio" class="clicked_radio" name="option_choice" id="radio'.$ctr.'" value="'.$option->id.'" checked>
										    <label for="radio'.$ctr.'">
										        
										    </label>
										</div>
									</div>
									<div class="col-md-10 text-left" style="height:30px;padding-top:10px;color:#fff;">
										<label for="radio'.$ctr.'">'.$option->name.'</label>
									</div>';

								// <a href="'.site_url('jobs/find/select_next_options/'.$option->id).'" class="field field_options text-left">'.$option->name.'</a>
								$ctr++;
							}
						}
						else{
							redirect(site_url('jobs/questions'));
						}

						?>
					</div>
					<!-- </div> -->
				</div>

			</div>
			<div>
				<a href="<?php echo site_url('jobs/find'); ?>" class="btn btn-opp btn-small">&nbsp;<i class="fa fa-chevron-left"></i>&nbsp;</a>
				<a class="next_go btn pull-right" href="<?php echo site_url('jobs/find/select_next_options/'); ?>" class="btn btn-small"> Next</a>
		<!-- </div> -->
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		var baseurl = "<?php echo site_url('jobs/find/select_next_options/'); ?>";

		$(".clicked_radio").click(function() { 
			$(".next_go").attr("href", baseurl+$(".clicked_radio:checked").val());
		});
	});
</script>
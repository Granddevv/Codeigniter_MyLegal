<section id="lawyer_signup_section">
	<div class="row">
		<div class="col-md-12 text-center">
			<h1 class="title-header light_font">Find a Lawyer</h1>
		</div>
	</div>
</section>

<div class="module-header">
	<h4>Field of Law</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="content">
			<div>
				<?php foreach ($categories as $category) {
					echo '<a href="'.site_url('jobs/find/category/'.$category->id).'" class="btn btn-default btn-small button-spacing text-center"><i class="fa fa-balance-scale"></i>'.$category->name.'</a>';
				}
				?>
			</div>
		</div>
	</div>
</div>
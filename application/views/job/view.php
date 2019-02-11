<?php if(count($job)>0) $job = $job[0]; ?>
<div class="row">
	<div class="col-md-12">
		
		<div class="page-header">
			<div class="row">
				<div class="col-md-12">
					<h1 class=""><?php echo $job->title; ?></h1>
					<!-- <button class="pull-right btn btn-sm disabled"><?php echo 'FREE WORK'; ?></button> -->
				</div>
				<!-- <div class="col-md-2">
					<div class="item"><?php echo ($job->pro_bono) ? 'FREE WORK' : 'FREE WORK' ; ?></div>
				</div> -->
			</div>
		</div>
		<div class="row">
			<div class="col-md-9">
				<div>
					<p>
						<?php 
						echo '<strong>Requested</strong>: <i class="fa fa-clock-o"></i> '.date('d-m-Y H:i', strtotime($job->created));
						echo '&nbsp; <strong>Expiring</strong>: <i class="fa fa-clock-o"></i> '.date('d-m-Y H:i', strtotime($job->expiry));
						foreach ($areas as $area) {
							echo '<br><button class="btn btn-sm disabled">'.$area_cat->name.'</button> <button class="btn btn-sm disabled">'.$area->name.'</button>';
						} 
						?>
					</p>
				</div>
				<p>
					<?php echo $job->about ?>
				</p>
			</div>
			<div class="col-md-3">
				<?php if($job->pro_bono){?>
				<button class="btn btn-sm disabled btn-block"><?php echo 'FREE WORK'; ?></button><br>
				<?php } ?>

				<?php if($job->budget){?>
					<div class="item" style="padding: 10px"><h3  style="padding: 0px; margin: 0px;">Pays <small><?php echo $job->budget; ?></small></h3></div><br>
				<?php } ?>

				<div class="item" style="padding: 10px; padding-top: 0px">
					<h3>Looking for</h3>
					<p>
						<strong><?php 
						$language = ($job->language);
						$language = $language.'</strong> speaking, <strong>';
						$gender = ($job->gender!="Doesn't matter")?$job->gender:'';
						$ethnicity = ($job->ethnicity!="Doesn't matter")?$job->ethnicity:'';
						$ethnicity = ($ethnicity)?', '.$ethnicity:'';
						echo $language.$gender.$ethnicity; ?></strong> lawyer
					</p>
				</div>
				<br>
				<div class="well">
					<?php if(!$my_bid){ ?>
					<a href="<?php echo site_url('jobs/place_bid/'.$job->id) ?>" class="btn btn-primary">Place Bid</a>
					<?php }else if($my_bid){ echo 'You have already submitted a bid!<br> <a href="'.site_url('jobs/cancel_bid/'.$job->id.'/'.$my_bid[0]->id).'">Cancel my Bid</a>';} ?>
				</div>
			</div>
		</div>
	</div>
</div>
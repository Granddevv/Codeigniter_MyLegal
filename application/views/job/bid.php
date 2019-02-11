<?php if(count($job)>0) $job = $job[0]; ?>
<div class="row">
	<div class="col-md-12">
		
		<div class="page-header">
			<div class="row">
				<div class="col-md-12">
					<h1 class="">Placing bid on <small><a href="<?php echo site_url('jobs/view/'.$job->id); ?>"><?php echo $job->title; ?></a></small></h1>
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
					<div>
						<form action="" method="post" class="form-horizontal">
							<div class="form-group">
								<div class="col-md-12">
								<p>Write your proposal below,</p>
								<textarea class="form-control" name="proposal" required id="proposal" rows="8" placeholder="Write your proposal here"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-md-2">Pro bono (free)</label>
								<div class="col-md-1"><input type="checkbox" name="pro_bono" id="pro_bono" class="form-control"></div>
							</div>
							<div class="form-group">
								<label for="" class="col-md-2">Quote</label>
								<div class="col-md-3"><input  name="price" required id="price" type="text" class="form-control"></div>
							</div>
							<div class="form-group">
								<div for="" class="col-md-3">
									<button class="btn btn-primary" type="submit" name="submit">Place my bid</button>
								</div>
							</div>
						</form>
					</div>
				</div>

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
			</div>
		</div>
	</div>
</div>
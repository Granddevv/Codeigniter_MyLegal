<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1>Quick Questions <small>please answer the questions below to proceed</small></h1>
		</div>

		<div class="content">

			<div class="col-md-4">
			<?php if(empty($this->uri->segment(3))) $step =1;
						else $step = intval($this->uri->segment(3))+1;
						?>
				<form action="<?php echo site_url('jobs/questions/'.$step); ?>" method="post">
					<?php 
					if($question && count($question)>0)
					{ 
						$id=$question[0]->id; 
						$type=$question[0]->type; 
						$choices = json_decode($question[0]->choices); 

						?>

						<div class="panel panel-default">
							<div class="panel-heading">
								<?php echo $question[0]->text; ?>
							</div>
							<div class="panel-body">

								<?php if($type=='text'): ?>
								<input type="text" name="answer">
							<?php endif; ?>

							<?php if($type=='radio'):
							foreach ($choices as $choice) {?>
								<label for="answer">
									<input type="radio" required value="<?php echo $choice->value ?>" name="answer" id="answer"> <?php echo $choice->value; ?>
								</label>
								<br>
								<?php } endif; ?>

								<?php if($type=='checkbox'): 
								foreach ($choices as $choice => $value) {?>
									<input type="checkbox" name="answer"> <?php echo $value; ?>
									<?php } endif; ?>

									<?php if($type=='select'): ?>
									<select name="answer" id="">
										<?php foreach ($choices as $choice => $value): ?>
										<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
									<?php endforeach ?>
								</select>
							<?php endif; ?>

							<?php if($type=='multi-select'): ?>
							<select multiple name="answer" id="">
								<?php foreach ($choices as $choice => $value): ?>
								<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
							<?php endforeach ?>
						</select>
					<?php endif; ?>
					
				</div>
			</div>
			<? } else redirect(site_url('jobs/create')); ?>

			<div>
			<?php if($this->uri->segment(2)=='select_next_options'): ?>
				<?php $ops = count($this->session->selected_options); ?>
				<a href="<?php echo site_url('jobs/find/select_next_options/'.$this->session->selected_options[$ops-1]); ?>" class="btn btn-warning">Go Back</a>
				<?php endif; 

				if($this->uri->segment(2)=='questions' && !$this->uri->segment(3) || intval($this->uri->segment(3))==1): ?>
				<a href="<?php echo site_url('jobs/find/questions'); ?>" class="btn btn-warning">Go Back</a>
			<?php endif; 
			if($this->uri->segment(2)=='questions' && !empty($this->uri->segment(3)) && intval($this->uri->segment(3))!=1): ?>
				<a href="<?php echo site_url('jobs/questions/'.(intval($this->uri->segment(3))-1)); ?>" class="btn btn-warning">Go Back</a>
			<?php endif; ?>
				<button class="btn btn-primary" type="submit" name="submit">Submit</button>
			</div>
		</form>
	</div>

</div>
</div>
</div>
</div>
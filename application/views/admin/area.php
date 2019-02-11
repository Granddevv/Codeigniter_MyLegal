<?php echo anchor('admin/questions', '< Return to listings'); ?>
<hr/>
<div class="row">
	<div class="col-md-12">
	<?php if($this->session->flashdata('message')) echo $this->session->flashdata('message'); ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				Questions in <strong><?php echo $selected_area[0]->name; ?></strong>
			</div>
			<div class="panel-body">
				<?php 
				if($questions){
				 foreach ($questions as $question): ?>
					<p>
						<a class="btn btn-sm btn-primary" href="<?php echo site_url('admin/questions_view/'.$question->id); ?>"><i class="fa fa-bars"></i></a>
						<a class="btn btn-sm btn-warning" href="<?php echo site_url('admin/question_edit/'.$question->id); ?>"><i class="fa fa-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="<?php echo site_url('admin/question_delete/'.$question->id.'/'.$this->uri->segment(3)); ?>"><i class="fa fa-times"></i></a>
						<a href="<?php echo site_url('admin/question_edit/'.$question->id); ?>"><?php echo $question->text; ?></a>
					</p>
				<?php endforeach;
				} else echo 'No Questions found, please use the form below to add questions.'; ?>

			</div>
		</div>
	</div>
</div>
<?php echo form_open(uri_string(), array('class' => 'form-horizontal repeater'));?>

<div data-repeater-list="questions">
	<div data-repeater-item style="display:none;">
		<?php 
			// Create blank hidden repeater, prevents options doubling up on update
		$this->load->view(
			'/templates/item-repeater.php', 
			array('choices' => array())
			); ?>
		</div>
		<?php
		// If this is a new questions section, display blank template
		if(empty($questions)) { ?>
			<div data-repeater-item>
				<?php $this->load->view(
					'/templates/item-repeater.php', 
					array('choices' => array())
					); ?>
			</div>
			<?php } else {
			// Loop each question with a new repeater
			/*foreach ($questions as $q) {?>
				<div data-repeater-item>
					<?php $this->load->view(
							'/templates/item-repeater.php', 
							array('text' => $q->text, 
									'selected' => $q->type, 
									'choices' => json_decode($q->choices))
							);
					?>
				</div>
				<?php }*/ }?>
			</div>


			<input data-repeater-create type="button" class="btn btn-primary" value="Add"/>
			<input type="submit" value="Save questions" class="btn btn-success">
			<?php echo form_close(); ?>

			<script>
				$(document).ready(function () {
					$('.repeater').repeater({
            // (Required if there is a nested repeater)
            // Specify the configuration of the nested repeaters.
            // Nested configuration follows the same format as the base configuration,
            // supporting options "defaultValues", "show", "hide", etc.
            // Nested repeaters additionally require a "selector" field.
        	// initEmpty: true,
        	repeaters: [{
                // (Required)
                // Specify the jQuery selector for this nested repeater
                selector: '.inner-repeater',
                // initEmpty: true,
             //    defaultValues: {
	            //     'value': ''
	            // },
	        }],
	    });
				});
			</script>





			<script>
    // $(document).ready(function () {
    //     $('.repeater').repeater({

    //     })
    // });
</script>

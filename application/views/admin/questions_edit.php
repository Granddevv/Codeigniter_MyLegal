<?php echo anchor('admin/questions', '< Return to listings'); ?>
<hr/>
<?php echo form_open(uri_string(), array('class' => 'form-horizontal repeater'));?>

<h4>Edit Question</h4>
<hr>
<div data-repeater-list="questions">
		<?php
		// If this is a new questions section, display blank template
		// print_r($questions);
		if(empty($questions)) { ?>
			<!--<div data-repeater-item>-->
				<?php /*$this->load->view(
					'/templates/item-repeater.php', 
					array('choices' => array())
					);*/ ?>
			<!--</div>-->
			<?php } else {
			// Loop each question with a new repeater
			foreach ($questions as $q) {?>
				<div data-repeater-item>
					<?php $this->load->view(
							'/templates/item-repeater.php', 
							array('text' => $q->text, 
									'selected' => $q->type, 
									'choices' => json_decode($q->choices))
							);
					?>
				</div>
				<?php } }?>
			</div>
			
			<input type="submit" value="Save question" class="btn btn-success">
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

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
  		Lawyer Information 
  	<!-- <div class="col-xs-12 pull-right"> -->
  	<!-- </div> -->
  </div>
  <div class="panel-body">
  	<div class="row">
  		<div class="col-xs-1">&nbsp;</div>
  		<div class="col-xs-11">
    		<img src="<?php echo $lawyer_information->photo; ?>" class="img-thumbnail" alt="NO IMAGE UPLOADED" />
    		<?php if($show_buttons) { ?>
		  		<div class="btns pull-right">
			  		<button class="btn btn-success approve_lawyer" rel="<?php echo $lawyer_information->id; ?>"><i class="fa fa-thumbs-up"></i></button>
			  		<button class="btn btn-danger decline_lawyer" rel="<?php echo $lawyer_information->id; ?>"><i class="fa fa-thumbs-down"></i></button>
			  	</div>
		  	<?php } ?>
    	</div>
    </div>
    <hr />

    <div class="row">
	    <div class="col-xs-1">&nbsp;</div>
		<div class="col-xs-3">
		  	<label>Name:</label>
		</div>
		<div class="col-xs-5">
		  	<?php echo $lawyer_information->name; ?>
		</div>
	</div>

    <div class="row">
	    <div class="col-xs-1">&nbsp;</div>
		<div class="col-xs-3">
		  	<label>Languages:</label>
		</div>
		<div class="col-xs-5">
		  	<?php echo $lawyer_information->languages; ?>
		</div>
	</div>
	<input type="hidden" name="p_id" id="p_id" value="<?php echo $lawyer_information->practice_id; ?>" />
	<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
	<div class="row">
		<div class="col-xs-1">&nbsp;</div>
		<div class="col-xs-3">
		 	<label>Ethnicity:</label>
		</div>
		<div class="col-xs-5">
		  	<?php echo $lawyer_information->ethnicity; ?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-1">&nbsp;</div>
		<div class="col-xs-3">
		  	<label>Location:</label>
		</div>
		<div class="col-xs-5">
		  	<?php echo $lawyer_information->location; ?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-1">&nbsp;</div>
		<div class="col-xs-3">
		  	<label>About:</label>
		</div>
		<div class="col-xs-5">
		 	<?php echo $lawyer_information->about; ?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-1">&nbsp;</div>
		<div class="col-xs-3">
		  	<label>Experience:</label>
		</div>
		<div class="col-xs-5">
		  	<?php echo $lawyer_information->experience; ?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-1">&nbsp;</div>
		<div class="col-xs-3">
		  	<label>Specialties:</label>
		</div>
		<div class="col-xs-5">
		  	<?php echo $lawyer_information->specialities; ?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-1">&nbsp;</div>
		<div class="col-xs-3">
		  	<label>Certificates:</label>
		</div>
		<div class="col-xs-5">
		  	<?php echo $lawyer_information->certificates; ?>
		</div>
	</div>
  </div>
</div>

<script>
	$(document).ready(function() {
		$(document).on("click", ".approve_lawyer", function(){
			if(confirm("Are you sure you want to approve this lawyer?")) {
				$.ajax({
					url: $("#base_url").val()+"practice_management/approve",
					data: "id="+$(this).attr("rel")+"&p_id="+$("#p_id").val(),
					dataType: "json",
					type: "post",
					success: function(response) {
						if(response.status) {
							$(".btns").hide();
							alert(response.msg);
						} else {
							alert(response.msg);
						}
					}
				});
			}
		});

		$(document).on("click", ".decline_lawyer", function(){
			if(confirm("Are you sure you want to decline this lawyer?")) {
				$.ajax({
					url: $("#base_url").val()+"practice_management/decline",
					data: "id="+$(this).attr("rel")+"&p_id="+$("#p_id").val(),
					dataType: "json",
					type: "post",
					success: function(response) {
						if(response.status) {
							$(".btns").hide();
							alert(response.msg);
						} else {
							alert(response.msg);
						}
					}
				});
			}
		});
	});
</script>
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
              <h1>Update Law Areas <small></small> <input type="button" class="btn btn-opp pull-right" onclick="window.location='<?php echo base_url("account/profile"); ?>'" value="Update Profile" /></h1>
        </div>
		<form method="post">
			<?php if(!empty($status)) { ?>
				<div class="alert alert-<?php echo ($status == "Success") ? "success" : "warning"; ?>">
					<strong><?php echo $status; ?>!</strong>
					<?php echo $message; ?>
				</div>
			<?php } ?>
			<div class="row">
				<?php $new_cat = "";
				foreach($lpc as $lc) {
					if($new_cat != $lc->cname) { ?>
						<div class="col-md-12">
							<div class="page-header" style="background-color: #68A3B7;color:#fff;padding:15px;">
								<b><?php echo $lc->cname; ?></b>
							</div>
						</div>
						<div class="col-md-12">
								<div class="row">
									<div class="col-md-1">&nbsp;</div>
									<div class="col-md-3">
										<!-- <b>Law Area</b> -->
									</div>
									<div class="col-md-1 text-center">
										<b>Law Area</b>
									</div>
									<div class="col-md-1 text-center">
										<b>Specialty</b>
									</div>
									<div class="col-md-1 text-center">
										<b>Pro-bono</b>
									</div> 
									<div class="col-md-5">
										&nbsp;
									</div>
								</div>
							<br />
						</div>
					<?php $new_cat = $lc->cname; } else { $new_cat = $lc->cname; } ?>
						<div class="col-md-12">
								<div class="row">
									<div class="col-md-1">&nbsp;</div>
									<div class="col-md-3">
										 <?php echo $lc->name; ?>
									</div>
									<div class="col-md-1 text-center">

										<div class="checkbox">
										    <label>
										      <input type="checkbox" class="checked_area" rel="<?php echo $lc->id; ?>" name="area[<?php echo $lc->id; ?>]" <?php if(in_array($lc->id, $law_areas_data['area'])) echo "checked"; ?>>
										      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
										    </label>
										</div>

										<!-- <input type="checkbox" class="checked_area" rel="<?php echo $lc->id; ?>" name="area[<?php echo $lc->id; ?>]" /> -->
									</div>
									<div class="col-md-1 text-center">
										<div class="checkbox">
										    <label>
										      <input type="checkbox"  class="toggle_<?php echo $lc->id; ?>" name="specialties[<?php echo $lc->id; ?>]" <?php if(in_array($lc->id, $law_areas_data['specialties'])) echo "checked"; if(!in_array($lc->id, $law_areas_data['area'])) echo "disabled"; ?>>
										      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
										    </label>
										</div>
										<!-- <input type="checkbox" class="toggle_<?php echo $lc->id; ?>" name="specialties[<?php echo $lc->id; ?>]" disabled /> -->
									</div>
									<div class="col-md-1 text-center">
										<div class="checkbox">
										    <label>
										      <input type="checkbox" class="toggle_<?php echo $lc->id; ?>" name="pro_bono[<?php echo $lc->id; ?>]" <?php if(in_array($lc->id, $law_areas_data['pro_bono'])) echo "checked"; if(!in_array($lc->id, $law_areas_data['area'])) echo "disabled"; ?>>
										      <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
										    </label>
										</div>
										<!-- <input type="checkbox" class="toggle_<?php echo $lc->id; ?>" name="pro_bono[<?php echo $lc->id; ?>]" disabled /> -->
									</div> 
									<div class="col-md-5">
										&nbsp;
									</div>
								</div>
							<br />
						</div>
				<?php } ?>
			</div>
			<hr />
			<div class="row text-right">
				<input type="submit" class="btn" value="Save Changes" /><br /><br />
			</div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function() {
		$(".checked_area").click(function() {
			if($(this).is(":checked")) {
				$(".toggle_"+$(this).attr("rel")).attr("disabled", false);
			} else {
				$(".toggle_"+$(this).attr("rel")).attr("disabled", true);
				$(".toggle_"+$(this).attr("rel")).prop("checked", false);
			}
		});
	});
</script>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
		<h1>Create Job <small></small></h1>
		</div>

		<div class="col-md-7">

			<?php if(isset($response)){?>
				<?php if($response==TRUE){?>
					<div class="alert alert-success alert-dismissable">
						Job has been created successfully!  
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					</div>
					<?php } else if($response==FALSE){?>		
						<div class="alert alert-danger alert-dismissable">
							Job could not be created! Please try again later!  
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php }else{?>
							<div class="alert alert-danger alert-dismissable">
								<?php echo $response; ?>
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							</div>
							<?php } }?>

							<form action="" method="post" class="form form-horizontal">
								<div class="form-group">
									<label for="title" class="col-md-3">Job Title*</label>
									<div class="col-md-9"><input type="text" class="form-control" name="title" id="title" required=""></div>
								</div>
								<div class="form-group">
									<label for="about" class="col-md-3">Details*</label>
									<div class="col-md-9"><textarea class="form-control" name="about" id="about" required=""></textarea></div>
								</div>
								<div class="form-group">
									<label for="pro_bono" class="col-md-3">Pro Bono</label>
									<div class="col-md-9 text-left"><input type="checkbox" class="form-control" name="pro_bono" id="pro_bono"></div>
								</div>
								<div class="form-group">
									<label for="Budget" class="col-md-3">Budget</label>
									<div class="col-md-9"><input type="text"  class="form-control" name="budget" id="budget"></div>
								</div>
								<div class="form-group">
									<label for="expiry" class="col-md-3">Expiry Date*</label>
									<div class="col-md-9">
										<div class="input-group date">
											<input type="text" class="form-control" name="expiry" id="expiry" required="">
											<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="language" class="col-md-3">Language</label>
									<div class="col-md-9">
										<select class="form-control" name="language" id="language">
											<option value="Afrikanns">Afrikanns</option>
											<option value="Albanian">Albanian</option>
											<option value="Arabic">Arabic</option>
											<option value="Armenian">Armenian</option>
											<option value="Basque">Basque</option>
											<option value="Bengali">Bengali</option>
											<option value="Bulgarian">Bulgarian</option>
											<option value="Catalan">Catalan</option>
											<option value="Cambodian">Cambodian</option>
											<option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
											<option value="Croation">Croation</option>
											<option value="Czech">Czech</option>
											<option value="Danish">Danish</option>
											<option value="Dutch">Dutch</option>
											<option value="English" selected>English</option>
											<option value="Estonian">Estonian</option>
											<option value="Fiji">Fiji</option>
											<option value="Finnish">Finnish</option>
											<option value="French">French</option>
											<option value="Georgian">Georgian</option>
											<option value="German">German</option>
											<option value="Greek">Greek</option>
											<option value="Gujarati">Gujarati</option>
											<option value="Hebrew">Hebrew</option>
											<option value="Hindi">Hindi</option>
											<option value="Hungarian">Hungarian</option>
											<option value="Icelandic">Icelandic</option>
											<option value="Indonesian">Indonesian</option>
											<option value="Irish">Irish</option>
											<option value="Italian">Italian</option>
											<option value="Japanese">Japanese</option>
											<option value="Javanese">Javanese</option>
											<option value="Korean">Korean</option>
											<option value="Latin">Latin</option>
											<option value="Latvian">Latvian</option>
											<option value="Lithuanian">Lithuanian</option>
											<option value="Macedonian">Macedonian</option>
											<option value="Malay">Malay</option>
											<option value="Malayalam">Malayalam</option>
											<option value="Maltese">Maltese</option>
											<option value="Maori">Maori</option>
											<option value="Marathi">Marathi</option>
											<option value="Mongolian">Mongolian</option>
											<option value="Nepali">Nepali</option>
											<option value="Norwegian">Norwegian</option>
											<option value="Persian">Persian</option>
											<option value="Polish">Polish</option>
											<option value="Portuguese">Portuguese</option>
											<option value="Punjabi">Punjabi</option>
											<option value="Quechua">Quechua</option>
											<option value="Romanian">Romanian</option>
											<option value="Russian">Russian</option>
											<option value="Samoan">Samoan</option>
											<option value="Serbian">Serbian</option>
											<option value="Slovak">Slovak</option>
											<option value="Slovenian">Slovenian</option>
											<option value="Spanish">Spanish</option>
											<option value="Swahili">Swahili</option>
											<option value="Swedish ">Swedish </option>
											<option value="Tamil">Tamil</option>
											<option value="Tatar">Tatar</option>
											<option value="Telugu">Telugu</option>
											<option value="Thai">Thai</option>
											<option value="Tibetan">Tibetan</option>
											<option value="Tonga">Tonga</option>
											<option value="Turkish">Turkish</option>
											<option value="Ukranian">Ukranian</option>
											<option value="Urdu">Urdu</option>
											<option value="Uzbek">Uzbek</option>
											<option value="Vietnamese">Vietnamese</option>
											<option value="Welsh">Welsh</option>
											<option value="Xhosa">Xhosa</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="ethnicity" class="col-md-3">Ethnicity</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="ethnicity" id="ethnicity" class="ethnicity">
						<!-- <select class="form-control" name="gender" id="gender" required="">
							<option value="">Select</option>
							<option value="european">European</option>
							<option value="fijian">Fijian</option>
							<option value="samoan">Samoan</option>
							<option value="tongan">Tongan</option>
							<option value="maori">Maori</option>
							<option value="filipino">Filipino</option>
							<option value="indian">Indian</option>
							<option value="japanese">Japanese</option>
							<option value="chinese">Chinese</option>
						</select> -->
					</div>
				</div>
				<div class="form-group">
					<label for="gender" class="col-md-3">Gender</label>
					<div class="col-md-9">
						<select class="form-control" name="gender" id="gender" class="gender">
							<option value="">Select</option>
							<option value="male">Male</option>
							<option value="femlae">Female</option>
							<option value="femlae">Doesn't Matter</option>
						</select>
					</div>
				</div>
				<!-- <div class="form-group">
					<label for="areas" class="col-md-3">Areas</label>
					<div class="col-md-9">
						<select class="form-control" name="areas[]" id="areas" multiple="multiple">
							<option value="">Select</option>
							<?php //foreach ($areas as $area) { ?>
								<option value="<?php //echo $area->id; ?>"><?php //echo $area->name; ?></option>
								<?php //} ?>
							</select>
						</div>
					</div> -->
					<div class="form-group">
						<label for="submit" class="col-md-3"><input type="submit" class="btn btn-primary" class="form-control" name="submit" id="submit" value="Create Job"></label>
						<div class="col-md-9"></div>
					</div>
				</form>
			</div>
			<div class="col-md-5 hidden">
			<h4>Selection Criteria</h4>
			<hr>
			<div class="well">
				Selected Category: <a href="<?php echo site_url('admin_law_categories/edit/'.$this->session->selected_category); ?>"><?php echo $selected_category->name; ?> (<?php echo $selected_category->user_label; ?>)</a>
				<br>Selected Sub Category: <a href="<?php echo site_url('admin_law_categories/edit/'.$this->session->selected_category); ?>"><?php echo $selected_sub_category->name; ?> (<?php echo $selected_sub_category->user_label; ?>)</a>
				<?php if($this->session->selected_area){?>
				<br>Selected Area: <a href="<?php echo site_url('admin_areas/edit/'.$this->session->selected_area); ?>"><?php echo $selected_area->name; ?> (<?php echo $selected_area->user_label; ?>)</a>
				<?php }
				$soptions = $this->session->selected_options;
				if($soptions){
					echo "<br>Selected Options: ";
				 foreach ($soptions as $option){ ?>
					<?php echo $option.', ' ?>
				<?php } }

				 $questions_answers = $this->session->questions_answers;
				if($questions_answers){
					// print_r($questions_answers);
					echo "<br>Quesitons Answered: ";
				 foreach ($questions_answers as $qa){ 
				 	print_r($qa); 
				 	echo '<br>';//echo $qa['question_id'].': '.$qa['answer'].', '
					 }
				} ?>
			</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function() {

			$('.input-group.date').datepicker({
				autoclose: true,
				todayHighlight: true,
				orientation: 'bottom',
				format: 'dd-mm-yyyy',
				startDate: new Date()
			})
			$('#areas').select2({'placeholder': 'Select Areas',   allowClear: true});
		});
	</script>

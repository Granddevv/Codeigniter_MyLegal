<div class="form-group">
		<label for="text" class="col-sm-2 control-label">Question</label>
		
		<div class="col-sm-10">
			<input type="text" name="text" class="form-control" value="<?php echo (isset($text)) ? $text : ''?>">
		</div>
		
	</div>
	<div class="form-group">
		<label for="type" class="col-sm-2 control-label">Type</label>
		<div class="col-sm-10">
			<?php 
			$types = array(
				"" => "Select question type",
				"radio" => "Radio",
				"checkbox" => "Checkbox",
				"text" => "Text",
				"select" => "Select",
				"multi-select" => "Multi Select"
			);
			$chosen = (isset($selected)) ? $selected : null;  
			echo form_dropdown('type', $types, $chosen, array('class' => 'form-control'));
			 ?>
		</div>
	</div>
	<div class="form-group">
		<label for="Choices" class="col-sm-2 control-label">Choices</label>
		<div class="col-sm-10">
			<!-- innner repeater -->
	        <div class="inner-repeater">
	          <div data-repeater-list="choices">
				
	          	<?php 
	          	if(empty($choices)) { ?>
	          		<div data-repeater-item>
		              <input type="text" name="value" value=""/>
			          <input data-repeater-delete type="button" class="btn btn-danger" value="Delete"/>
		            </div>
	          	<?php
		        }

	          	foreach ($choices as $item) { ?>
					<div data-repeater-item>
		              <input type="text" name="value" value="<?php echo $item->value;?>"/>
			          <input data-repeater-delete type="button" class="btn btn-danger" value="Delete"/>
		            </div>
				<?php } ?>
	            
	          </div>
	          <input data-repeater-create type="button" class="btn btn-primary" value="Add option"/>
	        </div>
		</div>
	</div>
	<?php if ($this->uri->segment(2)!='question_edit'): ?>
    <input data-repeater-delete type="button" class="btn btn-danger" value="Delete question"/>
	<?php endif ?>
<hr />
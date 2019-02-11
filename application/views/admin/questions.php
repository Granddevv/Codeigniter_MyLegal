<div class="page-header">
		<h1>Manage <small>Job Creation Questions <small>(for the users)</small></small></h1>
		</div>

<table class="table"> 
	<thead> 
		<tr> 
			<th>Add questions by clicking "Manage Questions" for options listed below</th> 
			<!-- <th>Manage</th> -->
		</tr> 
	</thead> 
	<tbody>
	<tr><td scope="row">
		<?php /*foreach ($areas as $area) { ?>
			<tr>
				<td scope="row">
				<?php echo $area['name']; ?> <?php echo anchor('admin/add_questions/'.$area['id'], '(Manage Questions)'); ?>
						<?php 
						if(isset($area['children'])){?>
						<br>
						<?php foreach ($area['children'] as $sub) {
							echo "---- <em>".$sub['name']."</em> ".anchor('admin/add_questions/'.$sub['id'], '(Manage Questions)')."<br>";
						}?>
						<?php } ?>

				</td>

			</tr>
		<?php 
		}
*/
		$this->la_model->print_options_tree();
		?>
		</tr></td>
	</tbody> 
</table>

<script>
	$(document).ready(function() {
		$('.multi-select').select2({allowClear: true});
	});
</script>
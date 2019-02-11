<section id="lawyer_signup_section">
	<div class="row">
		<div class="col-md-12 text-center">
			<h1 class="title-header light_font">Practice Billing</h1>
			<h2 class="second-title-header ">Your complete billing</h2>
		</div>
	</div>
</section>
<div class="row text-right">
	<div class="col-md-12">
		<a class="btn btn-opp btn-small" href="<?php echo base_url(); ?>practice_management/index">Go to Practice Management</a>
	</div>
</div>
<br />
<div class="row">
	<div class="col-md-12">
		<!-- <input type="button" class="btn btn-success pull-left" value="Mark check as paid" /><br /><br /> -->
		<table class="table table-bordered table-striped table-hover text-center">
			<thead>
				<td>Billing Type</td>
				<td>Amount</td>
				<td>Date Created</td>
				<td>Billing Month</td>
				<td>Status</td>
			</thead>
			<tbody>
				<?php 
				foreach($billing_list as $billing) { ?>
					<tr>
						<td><?php echo $billing->billing_type_name; ?></td>
						<td><?php echo "$".number_format($billing->amount, 2, ".", ","); ?></td>
						<td><?php echo date("M d Y H:i:s", strtotime($billing->created)); ?></td>
						<td><?php echo (!is_null($billing->billing_month)) ? date("F", strtotime($billing->billing_month)) : ""; ?></td>
						<td><?php echo (is_null($billing->paid)) ? "<span style='color:RED;'>Not Paid</span>" : "<span style='color:GREEN;'>Paid</span>"; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php require("sidebar.php"); ?>
<title>Donations History</title>
<script>
    $(document).ready(function(){
        $("#history").addClass('active-menu');
    });
</script>

<h1 class="page-header">Donations History</h1>
<!-- Row -->
<div class="row">
	<div class="col-md-12">
		<!-- PH History -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-gift"></i> Donations made</h3> <!-- <a href="index.php" class="pull-right">Go home</a> -->
			</div> <!-- /.panel-heading -->
			<div class="panel-body">
				<!-- <h4 class="page-title" style="visibility: hidden;">You have not provided any help yet</h4> -->
				
				<!-- Responsive table container -->
				<div class="table-responsive">
					<!-- Hover table -->
					<table class="table table-hover">
						<!-- Table head -->
						
						<?php $donations_made = getDonationsMadeByUser($this->session->user_id); ?>
						<?php if (isset($donations_made) AND !empty($donations_made)): ?>
							<thead>
								<td>Name</td>
								<td>Bank</td>
								<td>Acc name</td>
								<td>Acc number</td>
								<td>Phone</td>
								<td>Status</td>
							</thead>
							<!-- Table body -->
							<tbody>
							<?php foreach ($donations_made as $donation): ?>
								<?php $receiver = getUserById($donation->made_to); ?>
								<tr>
									<td><?php echo $receiver->username ?></td>
									<td><?php echo $receiver->bank_name ?></td>
									<td><?php echo $receiver->account_name ?></td>
									<td><?php echo $receiver->account_no ?></td>
									<td><?php echo $receiver->phone ?></td>
									<td><div class="label label-default"><?php echo $donation->status ?></div></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						<?php else: ?>
							<center>Nothing to show yet</center>
						<?php endif; ?>
						
					</table>
				</div>
			</div>
		</div>
		
	</div>
</div>

<!-- Row -->
<div class="row">
	<div class="col-md-12">
		<!-- GH History -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="panel-title"><i class="fa fa-money"></i> Donations received</h4>
			</div>
			<div class="panel-body">
				<!-- <h4 class="page-title">You are yet to get help from any user</h4> -->

				<!-- Responsive table container -->
				<div class="table-responsive text-center">
					<!-- Hover table -->
					<table class="table table-hover">
						<!-- Table head -->
						<?php $donations_received = getDonationsReceivedByUser($this->session->user_id); ?>
						<?php if (isset($donations_received) AND !empty($donations_received)): ?>
							<thead style="font-weight: bold">
								<td>Full name</td>
								<td>Phone number</td>
								<td>Status</td>
							</thead>
							<?php foreach ($donations_received as $donation): ?>
								<?php $helper = getUserById($donation->made_by); ?>
								
								<!-- Table body -->
								<tbody>
									<tr>
										<td><?php echo $helper->username ?></td>
										<td><?php echo $helper->phone; ?></td>
										<td><div class="label label-default"><?php echo $donation->status ?></div></td>
									</tr>
								</tbody>
							<?php endforeach; ?>
						<?php else: ?>
							Nothing to show yet
						<?php endif; ?>
					</table>
				</div>
			</div>
		</div>
		
	</div>
</div>



<?php require("sidebar.php"); ?>
<title>Provide Help</title>
<script>
    $(document).ready(function(){
        $("#ph").addClass('active-menu');
    });
</script>

<h1 class="page-header">Provide Help</h1>
<!-- <p class="alert alert-info">Please verify the package you selected while signing up</p> -->
<?php echoBootstrapAlert() ?>

<!-- Row -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-body">
				<?php if (userAlreadyPaired($this->session->user_id)): ?>
					You have already being paired
					<a href="<?php echo site_url('user/viewpairing') ?>" class="btn btn-primary">View pairing</a>
				<?php elseif (yetToReceiveCompleteDonations($this->session->user_id) OR hasPendingDonation($this->session->user_id)): ?>
					You need to have receieved your complete donations before you can provide help again
				<?php else: ?>
				<form action="<?php echo site_url('user/submitpairingrequest') ?>" method="post">
					<div class="form-group">
						<label>Package</label>
						<select class="form-control" disabled>
							<?php $user_package = getPackageById(getUserById($this->session->user_id)->package_id); ?>
							<option><?php echo $user_package->package_name ?> - <?php echo $user_package->package_price ?></option>
						</select>
					</div>
					<?php echo csrf_tokener() ?>
					<div class="form-group">
						<button type="submit" class="btn btn-success">Submit</button>
					</div>
				</form>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<!-- Row -->
<!-- <div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-body">
				<h3>Paired member</h3>
				<hr>
				<p><strong>Full name: </strong></p>
				<p><strong>Bank name: </strong></p>
				<p><strong>Account name: </strong></p>
				<p><strong>Account number: </strong></p>
				<p><strong>Phone: </strong></p>
				<p><strong>Proof of Payment: </strong> <label class="btn btn-primary btn-sm"><i class="fa fa-camera"></i> Choose file <input type="file" style="display: none" accept="image/*"></label></p>
				<p><button class="btn btn-primary">Provide Help</button></p>
			</div>
		</div>
	</div>
</div>
 -->

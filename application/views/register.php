
<script>
	$(document).ready(function(){
		$("#register").attr("class", "active");
	});
</script>

<!-- Row -->
<div class="row">
	<div class="col-md-offset-2 col-md-7">
		<div class="panel panel-primary">
			<div class="panel-body">
				<h2>Registration</h2>
				<?php echoBootstrapAlert() ?>
				<?php echo validation_errors() ?>
				<hr>
				<!-- Form -->
				<form role="form" autocomplete="no" method="post">
					<div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo set_value('username') ?>">
					</div>

					<div class="form-group">
						<label>Phone</label>
						<input type="tel" class="form-control" placeholder="Phone" name="phone" value="<?php echo set_value('phone') ?>">
					</div>

					<div class="form-group">
						<label>Full name</label>
						<input type="text" class="form-control" placeholder="Full name" name="fname" value="<?php echo set_value('fname') ?>">
					</div>

					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" placeholder="Email address" name="email" value="<?php echo set_value('email') ?>">
					</div>

					<div class="form-group">
						<label>Bank</label>
						<select class="form-control" name="bank_name">
							<option value="">Choose one</option>
							<option>United Bank for Africa</option>
							<option>First Bank of Nigeria</option>
							<option>Diamond Bank</option>
							<option>Access Bank</option>
							<option>EcoBank</option>
							<option>Fidelity Bank Nigeria</option>
							<option>First City Monument Bank</option>
							<option>Guaranty Trust Bank</option>
							<option>Heritage Bank PLC</option>
							<option>Keystone Bank Limited</option>
							<option>Skye Bank</option>
							<option>Stanbic IBTC Bank Nigeria</option>
							<option>Standard Chartered Bank</option>
							<option>Sterling Bank</option>
							<option>Union Bank of Nigeria</option>
							<option>Unity Bank PLC</option>
							<option>Zenith Bank</option>
						</select>
					</div>

					<div class="form-group">
						<label>Account name</label>
						<input type="text" class="form-control" placeholder="Account name" name="account_name" value="<?php echo set_value('account_name') ?>">
					</div>

					<div class="form-group">
						<label>Account number</label>
						<input type="number" class="form-control" placeholder="Account number" name="account_no" value="<?php echo set_value('account_no') ?>">
					</div>

					<div class="form-group">
						<label>Package</label>
						<select class="form-control" name="package_id">
							<option value="">Select a package</option>
							<?php $packages = getPackages() ?>
								<?php if (!empty($packages)): ?>
									<?php foreach ($packages as $package): ?>
										<option value="<?php echo $package->id ?>"><?php echo $package->package_name ?> - <?php echo $package->package_price ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
						</select>
					</div>

					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" placeholder="Password" name="password">
					</div>

					<div class="form-group">
						<label>Confirm Password</label>
						<input type="password" class="form-control" placeholder="Confirm Password" name="confirmpassword">
					</div>
					<?php echo csrf_tokener() ?>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Register</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


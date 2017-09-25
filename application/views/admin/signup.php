<?php
require("header.php");
require("sidebar.php");
?>
<title>Admin Sign up</title>

<div id="page-wrapper">
	<div id="page-inner">
		<h1 class="page-header">Admin Sign up</h1>
		<div class="row">
			<div class="col-md-12">
				<form role="form">
					<div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" placeholder="Username">
					</div>

					<div class="form-group">
						<label>Phone number</label>
						<input type="tel" class="form-control" placeholder="Phone number">
					</div>

					<div class="form-group">
						<label>E-Mail Address</label>
						<input type="email" class="form-control" placeholder="E-Mail Address">
					</div>

					<div class="form-group">
						<label>Bank</label>
						<select class="form-control">
							<option>Choose one</option>
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
						<label>Account Name</label>
						<input type="text" class="form-control" placeholder="Account name">
					</div>

					<div class="form-group">
						<label>Account number</label>
						<input type="number" class="form-control" placeholder="Account number" required>
					</div>

					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" placeholder="Password" required>
					</div>

					<div class="form-group">
						<label>Confirm Password</label>
						<input type="password" class="form-control" placeholder="Confirm Password" required>
					</div>

					<div class="form-group">
						<label>Admin secret key</label>
						<input type="text" class="form-control" placeholder="Admin secret key">
					</div>

					<button type="button" class="btn btn-primary btn-md">
						Register
					</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php require("footer.php"); ?>
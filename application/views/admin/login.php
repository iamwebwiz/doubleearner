<?php
require("header.php");
require("sidebar.php");
?>
<title>Admin Login</title>

<div id="page-wrapper">
	<div id="page-inner">
		<h1 class="page-header">Admin Sign in</h1>
		<div class="row">
			<div class="col-md-6">
				<form role="form">
					<div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" placeholder="Username">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" placeholder="Password">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php require("footer.php"); ?>
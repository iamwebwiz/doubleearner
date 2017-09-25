
<script>
	$(document).ready(function(){
		$("#login").attr("class", "active");
	});
</script>

<!-- Row -->
<div class="row">
	<div class="col-md-offset-2 col-md-7">
		<div class="panel panel-primary">
			<div class="panel-body">
				<h2>Login</h2>
				<?php echoBootstrapAlert() ?>
				<?php echo validation_errors() ?>
				<hr>
				<!-- Form -->
				<form role="form" method="post">
					<div class="form-group">
						<label>Email</label>
						<input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo set_value('email') ?>">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" placeholder="Password" name="password">
					</div>
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
					<div class="form-group">
						<button type="submit" class="btn btn-success">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


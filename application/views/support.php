
<script>
	$(document).ready(function(){
		$("#support").attr("class", "active");
	});
</script>

<!-- Row -->
<div class="row">
	<div class="col-md-offset-2 col-md-7">
		<div class="panel panel-default">
			<div class="panel-body">
				<h2>Contact Support</h2>
				<hr>
				<?php echo validation_errors() ?>
				<?php echoBootstrapAlert() ?>
				<!-- Form -->
				<form method="post">
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" placeholder="Email" name="email">
					</div>
					<!-- <div class="form-group">
						<label>Phone</label>
						<input type="tel" class="form-control" placeholder="Phone" name="">
					</div> -->
					<div class="form-group">
						<label>Subject</label>
						<input type="text" name="message_subject" class="form-control">
					</div>
					<div class="form-group">
						<label>Message</label>
						<textarea rows="5" class="form-control" placeholder="Message" name="message"></textarea>
					</div>
					<?php echo csrf_tokener() ?>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


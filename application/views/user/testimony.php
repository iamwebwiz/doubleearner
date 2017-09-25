<?php require("sidebar.php"); ?>

<script>
	$(document).ready(function(){
		$("#testimony").addClass("active-menu");
	});
</script>

<h1 class="page-header">Give Testimony</h1>

<!-- Row -->
<div class="row">
	<div class="col-md-7">
		<?php echo validation_errors() ?>
		<?php echoBootstrapAlert() ?>
		<form method="post">
			<div class="form-group">
				<label>Testimony</label>
				<textarea rows="6" class="form-control" placeholder="Write your testimony here" name="message"></textarea>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
			<?php echo csrf_tokener() ?>
		</form>
	</div>
</div>

<?php require("footer.php"); ?>
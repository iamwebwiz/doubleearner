<?php $user = getUserById($this->session->user_id) ?>

<title>Support</title>
<script>
    $(document).ready(function(){
        $("#support").addClass('active-menu');
    });
</script>

<h1 class="page-header">Support Service</h1>

<div class="row">
	<div class="col-md-7">
		<div class="alert alert-info">
			Use our 24-hour support service to ask whatever question you have for us. Simply fill the form below.
		</div>
		<?php echo validation_errors() ?>
		<?php echoBootstrapAlert() ?>
		<form method="post">
			
			<div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" placeholder="Email address" value="<?php echo $user->email ?>" name="email" >
			</div>
			<div class="form-group">
						<label>Subject</label>
						<input type="text" name="message_subject" class="form-control">
					</div>
			<div class="form-group">
				<label>Message</label>
				<textarea rows="5" class="form-control" placeholder="Your message" name="message"></textarea>
			</div>
			<?php echo csrf_tokener() ?>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</form>
	</div>
</div>


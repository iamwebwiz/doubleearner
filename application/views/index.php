
<script>
	$(document).ready(function(){
		$("#home").attr("class", "active");
	});
</script>

	<!-- Row -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<h2 class="text-info">About us</h2>
					<hr>
					<?php echo $this->config->item('app_name') ?> is a new peer-to-peer donation platform which uses a 2x1 Matrix system. You get double the amount you invested with in a very short time.
				</div>
			</div>
		</div>
	</div>

	<!-- Row -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<span class="fa fa-bullhorn"></span> Testimonies
				</div>
				<div class="list-group">
					<?php $testimonies = getTestimonies() ?>
					<?php if (isset($testimonies) AND !empty($testimonies)): ?>
					<div class="list-group-item">
						<?php foreach ($testimonies as $testimony): ?>
							<p class="list-group-item-text">
								<?php echo $testimony->body ?>
								<br>
								<div class="pull-right text-primary">&mdash; by <?php echo $testimony->username ?></div>
							</p>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>

	<!-- Row -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-body text-danger text-center">
					<i class="fa fa-users fa-4x"></i>
					<h2>Total Users</h2>
					<h3><?php echo countUsers() ?></h3>
				</div>
			</div>
		</div>
	</div>

	<!-- Row -->
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-danger">
				<div class="panel-body">
					<div class="text-center text-primary">
						<span class="fa fa-gift fa-3x"></span><h3>Our Packages</h3>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-4">
							<div class="panel panel-default text-center">
								<div class="panel-heading">
									<span class="fa fa-gift"></span> Aluminium package
								</div>
								<div class="panel-body">
									Donate: N5,000
									<br>
									Return: N10,000
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="panel panel-primary text-center">
								<div class="panel-heading">
									<span class="fa fa-gift"></span> Bronze package
								</div>
								<div class="panel-body">
									Donate: N10,000
									<br>
									Return: N20,000
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="panel panel-success text-center">
								<div class="panel-heading">
									<span class="fa fa-gift"></span> Silver package
								</div>
								<div class="panel-body">
									Donate: N20,000
									<br>
									Return: N40,000
								</div>
							</div>
						</div>
					</div>

					<!-- Row -->
					<div class="row">
						<div class="col-md-4">
							<div class="panel panel-warning text-center">
								<div class="panel-heading">
									<span class="fa fa-gift"></span> Gold package
								</div>
								<div class="panel-body">
									Donate: N50,000
									<br>
									Return: N100,000
								</div>
							</div>
						</div>

						<!-- <div class="col-md-4">
							<div class="panel panel-danger text-center">
								<div class="panel-heading">
									<span class="fa fa-gift"></span> Diamond package
								</div>
								<div class="panel-body">
									Donate: N100,000
									<br>
									Return: N200,000
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="panel panel-info text-center">
								<div class="panel-heading">
									<span class="fa fa-gift"></span> Sapphire package
								</div>
								<div class="panel-body">
									Donate: N200,000
									<br>
									Return: N400,000
								</div>
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>

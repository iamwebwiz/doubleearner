<?php

require("header.php");
require("sidebar.php");

?>
<title>DoubleEarners &mdash; Users Administration</title>

<!-- Page Wrapper -->
<div id="page-wrapper">
	<!-- Page Inner -->
	<div id="page-inner">
		<h1 class="page-header">Users Administration</h1>
		<!-- Row -->
		<div class="row">
			<!-- col-md-12 -->
			<div class="col-md-12">
				<!-- Responsive table -->
				<div class="table-responsive">
					<table class="table table-hover">
						<thead style="font-weight: bold">
							<td width="6%">S/N</td>
							<td>Username</td>
							<td>E-mail</td>
							<td>Status</td>
							<td>Action</td>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>omoelu</td>
								<td>omoelu1@gmail.com</td>
								<td><div class="label label-success">Active</div></td>
								<td><button class="btn btn-default">Block</button></td>
							</tr>
							<tr>
								<td>2</td>
								<td>iamwebwiz</td>
								<td>iamwebwiz@outlook.com</td>
								<td><div class="label label-default">Blocked</div></td>
								<td><button class="btn btn-default">Unblock</button></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require("footer.php"); ?>
<?php
require("sidebar.php");
$user = getUserById($this->session->user_id);
?>
<title>My Profile</title>
<script>
    $(document).ready(function(){
        $("#profile").attr("class", "active-menu");
    });
</script>

<h1 class="page-header">My Profile</h1>

<div class="row">
	<div class="col-md-12">
		<p><b>Full Name: <?php echo $user->fname ?></b></p>
		<p><b>Username: <?php echo $user->username ?></b></p>
		<p><b>Phone number: <?php echo $user->phone ?> </b></p>
		<p><b>E-mail: <?php echo $user->email ?></b></p>
		<p><b>Bank: <?php echo $user->bank_name ?></b></p>
		<p><b>Account name: <?php echo $user->account_name ?></b></p>
		<p><b>Account number: <?php echo $user->account_no ?></b></p>
		<p><b>Joined DoubleEarner about: <?php echo $user->date_registered ?></b></p>
		<p><b>Donations made: <?php echo count(getDonationsMadeByUser($this->session->user_id, 0)) ?></b></p>
		<p><b>Donations received: <?php echo count(getDonationsReceivedByUser($this->session->user_id, 0)) ?> </b></p>
		<p><b>Referral Bonus: <?php echo $user->referral_bonus ?></b></p>
	</div>
</div>


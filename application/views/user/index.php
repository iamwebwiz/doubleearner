<?php $user = getUserById($this->session->user_id) ?>
<script>
    $(document).ready(function(){
        $("#dash").addClass('active-menu');
    });
</script>
<?php $this->load->view('user/sidebar') ?>
<h1 class="page-header">Dashboard</h1>

<!-- Row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echoBootstrapAlert() ?>
                <!-- <p><img src="assets/img/1.jpg" width="200" class="img-thumbnail"></p>
                <p class="text-info">Username made a donation of #amount to you. <button type="button" class="btn btn-success btn-sm">Confirm</button></p> -->
                <div class="container-fluid">    
                    <center>Your referral link</center>
                    <div class="row">
                        <div class="col-xs-9">
                            <input type="text" value="<?php echo site_url('register?ref='.$user->username) ?>" class="form-control col-md-2">
                        </div>
                         <span class="label label-warning">new</span> 

                    </div>
                    <div class="info">
                        User your referral link to refer your friends and you get 5% of their first donation.
                        You can check your referral bonus on your <a href="<?php echo site_url('profile') ?>"> page</a>
                    </div>  
                </div>
                <?php if (hasDonation($this->session->user_id)): ?>
                    <div class="top-margin">
                        <?php $pending_donation = getDonation($this->session->user_id); ?>
                        <a href="<?php echo base_url('uploads/pops/' . $pending_donation->proof_of_payment) ?>" target="_blank"><img src="<?php echo base_url('uploads/pops/' . $pending_donation->proof_of_payment) ?>" width=150 class="img-thumbnail"><figcaption>Click on image to view full size</figcaption></a>
                        <div class="panel panel-success">
                            <div class="panel-body">
                                <?php echo getUserById($pending_donation->made_by)->username ?> made a donation to you

                            </div>
                        </div>
                        <form action="<?php echo site_url('user/editdonation') ?>" method="post">
                            <div class="form-group">
                                <input type="hidden" name="donation_id" value="<?php echo $pending_donation->id ?>">
                                <?php echo csrf_tokener() ?>
                                <button class="btn btn-success" name="action" value="confirm">Confirm</button>
                                <!-- <button class="btn btn-danger" name="action" value="deny">Deny</button> -->
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php $pairings = hasPendingPairings($this->session->user_id); ?>
        <?php if (!empty($pairings)): ?>
            <div class="panel panel-primary top-margin">
                <div class="panel-heading">
                    Pairing Information
                </div>
                <ul class="list-group">
                <?php foreach ($pairings as $pairing): ?>
                    <li class="list-group-item"><?php echo getUserById($pairing->user_id)->username ?> has been selected to pay you 
                    <?php echo "N" . $pairing->package_price ?><br>
                    Contact: <?php echo getUserById($pairing->user_id)->phone ?>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-bullhorn"></i> Important Information
            </div>
            <div class="list-group">
                <div class="list-group-item">
                    After you receive a 100% increase of your donation, you are required to give a testimony to prevent your account from being blocked.
                </div>
                <div class="list-group-item">
                    Use our 24-hour support service to in case there is any problem with your donations.
                </div>
            </div>
        </div>
    </div>
</div>

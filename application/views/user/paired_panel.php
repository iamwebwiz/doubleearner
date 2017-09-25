
<!-- Paired recipient -->

			<div class="panel panel-default">
				
				<div class="panel-heading">
					Upload Proof of payment to provide help
				</div>
				<div class="panel-body">
					<?php echoBootstrapAlert() ?>
					<div class="row">
						<div class="col-xs-12 col-md-offset-4 col-md-4">
							You should make payment before:
							<div id="clockdiv" style="background-color: red; color: white; font-size: 24px;" class="well text-center">
								<span id="hours"></span> Hours
								<span id="minutes" style="padding-left: 10px"></span> Minutes
								<span id="seconds" style="padding-left: 10px">Seconds</span> seconds
							</div>
						</div>
					</div>
					<h4 class="text-info">Paired member</h4>
					<p class="alert alert-info">Please donate the sum of <s>N</s><?php echo $package_price ?> to this member</p>

					<div class="top-margin">

						<p><b>Username: <?php echo $available_user->username ?> </b></p>
						<p><b>Bank name: <?php echo $available_user->bank_name ?> </b></p>
						<p><b>Account name: <?php echo $available_user->account_name ?></b></p>
						<p><b>Account number: <?php echo $available_user->account_no ?> </b></p>
						<p><b>Phone: <?php echo $available_user->phone ?></b></p>
						
						<form action="<?php echo site_url('user/uploadpop') ?>" method="post" enctype="multipart/form-data">	
							<input type="hidden" name="made_to" value="<?php echo $available_user->id ?>">
							<p><b>Proof of payment (optional): </b> <input type="file" name="userfile"></p>
							<?php echo csrf_tokener() ?>
							<button class="btn btn-primary" type="submit">
								Provide help
							</button>
						</form>
						<br>
						<form action="<?php echo site_url('user/refusepayment') ?>" method="post">
							<input type="hidden" name="paired_to" value="<?php echo $available_user->id ?>">
							<?php echo csrf_tokener() ?>
							<button class="btn btn-danger" type="submit">Refuse Payment</button>
						</form>
					</div>
				</div>
			</div>

<script>
	var date = "<?php echo $pairing_data->deadline_date ?>";
	// var date = "2017-03-27 18:00:00";
	// console.log("start")
	console.log(Date.parse(date) - Date.parse(new Date()));
	initializeClock("clockdiv", date);
	function getTimeRemaining(endtime){
	  var t = Date.parse(endtime) - Date.parse(new Date());
	  var seconds = Math.floor( (t/1000) % 60 );
	  var minutes = Math.floor( (t/1000/60) % 60 );
	  var hours = Math.floor( (t/(1000*60*60)) % 24 );
	  var days = Math.floor( t/(1000*60*60*24) );
	  return {
	    'total': t,
	    'days': days,
	    'hours': hours,
	    'minutes': minutes,
	    'seconds': seconds
	  };
	}

	function initializeClock(id, endtime){
	  var clock = document.getElementById(id);
	  var hours = document.getElementById('hours');
	  var minutes = document.getElementById('minutes');
	  var seconds = document.getElementById('seconds');
	  var timeinterval = setInterval(function(){
	    var t = getTimeRemaining(endtime);
	    // clock.innerHTML = 'days: ' + t.days + '<br>' +
	    //                   'hours: '+ t.hours + '<br>' +
	    //                   'minutes: ' + t.minutes + '<br>' +
	    //                   'seconds: ' + t.seconds;
	    hours.innerHTML = t.hours;
	    minutes.innerHTML = t.minutes;
	    seconds.innerHTML = t.seconds;
	    if(t.total<=0){
	      clearInterval(timeinterval);
	    }
	  },1000);
	}
</script>
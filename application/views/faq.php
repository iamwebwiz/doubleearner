
<title>Frequently Asked Questions</title>
<script>
	$(document).ready(function(){
		$("#faqs").attr("class", "active");
		$("#q1answer, #q2answer, #q3answer, #q4answer, #q5answer").hide();
		$("#q1").click(function(){
			$("#q1answer").slideToggle("fast");
		});
		$("#q2").click(function(){
			$("#q2answer").slideToggle("fast");
		});
		$("#q3").click(function(){
			$("#q3answer").slideToggle("fast");
		});
		$("#q4").click(function(){
			$("#q4answer").slideToggle("fast");
		});
		$("#q5").click(function(){
			$("#q5answer").slideToggle("fast");
		});
	});
</script>
<script>
	$(document).ready(function(){
		$("#faq").addClass("active-menu");
	});
</script>

<!-- Row -->
<div class="row">
	<div class="col-md-offset-2 col-md-7">
		<h2 class="text-info">Frequently Asked Questions</h2>
		<hr>
		<div class="panel panel-primary">
			<div class="panel-heading" id="q1">
				How much can I donate?
			</div>
			<div class="panel-body" id="q1answer">
				You can select from our package list the amount you want to donate and get back twice your donation within few hours.
			</div>
		</div>

		<div class="panel panel-primary">
			<div class="panel-heading" id="q2">
				What can get me blocked?
			</div>
			<div class="panel-body" id="q2answer">
				You get blocked by the system when you:
				<ol>
					<li>Fail to make a donation within the time given to pay to your recipient (the member paired to you).</li>
					<li>Do not give testimony after 24 hours of receiving twice the donation you made.</li>
					<li>Do not confirm a donation made to you and you were reported by the donor.</li>
				</ol>
			</div>
		</div>

		<div class="panel panel-primary">
			<div class="panel-heading" id="q3">
				When can I recycle my donations package?
			</div>
			<div class="panel-body" id="q3answer">
				You get to recycle your donations package when you have received double of the donation you made when you joined the system. In other words, when you get your two donations complete, you can recycle. Recycling is quite important as it helps keep the funding in circulation.
			</div>
		</div>

		<div class="panel panel-primary">
			<div class="panel-heading" id="q4">
				<h3 class="panel-title">What do I do if someone refuses to confirm my payment to him/her?</h3>
			</div>
			<div class="panel-body" id="q4answer">
				When this happens, feel free to contact the administrator on the Support page immediately explaining what you are encountering and specify the recipient's username and phone number.
			</div>
		</div>

		<div class="panel panel-primary">
			<div class="panel-heading" id="q5">
				Do I need to refer someone to get donations?
			</div>
			<div class="panel-body" id="q5answer">
				Absolutely not! You do not need to refer anybody to get donations from other members, the system pairs you with available users within your package automatically.
			</div>
		</div>
	</div>
</div>

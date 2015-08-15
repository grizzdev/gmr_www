@extends('layouts.master')

@section('content')
<div class="faq-header full-width">
	<div class="row">
		<div class="col-sm-12 col-md-6 col-md-offset-6 wow fadeInRight pt-50">
			<img src="{{ asset('img/faq/faq-text.png') }}" alt="FAQ - You have questions, we have answers." class="img-responsive" />
		</div>
	</div>
</div>
<div class="faq-content">
	<div class="row">
		<div class="col-sm-12 col-md-10 col-md-offset-1 pt-70 pb-70">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">How much of my purchase goes to a child?</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
							<p>There’s no exact formula as each product costs us different amounts. After we recoup our costs (cost of the garment and printing), we give EVERY PENNY to a child’s campaign.  We focus on GENEROSITY as our platform for giving. We’re proud to give more than most non-profits give from a retail end.</p>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingTwo">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">What if someone buys my child an iPad before my campaign ends?</a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						<div class="panel-body">
							<p>THAT’S FANTASTIC!  When a campaign has to end before it reaches it’s goal there are two options; the funds can be transferred to different Hero that you request.  Or we can purchase a gift for the value of the amount raised.</p>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingThree">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">How long till a little hero gets their package?</a>
						</h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						<div class="panel-body">
							<p>Great question! It all depends on how fast the campaign gets funded. These things can take days or weeks depending on how hard the community pushes. Crowd-funding is funny like that. Once a campaign gets funded, we will place the order within 24 hours and will ship within 5-7 business days to the Little Hero.</p>
							<p>As far as the retail end, when you purchase apparel on a Hero Page, we will ship out your apparel within 5-7 business days (normally sooner). The time it takes to get from USPS to you depends on your shipment choice.</p>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingFour">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">What are you printing on?</a>
						</h4>
					</div>
					<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
						<div class="panel-body">
							<p>We’ve worked hard to provide you with the LOWEST possible prices with the BEST possible quality.  We’ve been continually impressed with the quality of District Apparel and most of our garments are printed on that.</p>
							<p>A few other items are printed on American Apparel and Bella. Our children’s clothes are printed on Port &amp; Company, Gildan, and American Apparel.</p>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingFive">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">Why iPad's? Why not pay their bills or cancer research?</a>
						</h4>
					</div>
					<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
						<div class="panel-body">
							<p>Ah yes, why don’t we help fund cancer research? Well, we do and we don’t. Practically, that’s not our role in the childhood cancer community.  There are many organizations (FANTASTIC ONES) that focus on curing cancer and taking care of bills. AND WE SUPPORT THEM both practically and financially. Our role, however, is to come alongside the child. We KNOW the child’s perspective because Manny was in the same bed they were in. In fact, let’s let him speak:</p>
							<blockquote>
								<p>“Should people fund St. Baldricks, and St. Judes? YES! I’m very proud to make contributions to those organizations personally. But my experience as a childhood cancer patient had little to do with insurance bills or whether or not cancer as a whole was being funded for research. I was in a bed, nausious, exhausted, halfway numb, and bald. I couldn’t go to school and be with my friends, and I couldn’t leave my house for fear of infection.  I had a Gameboy Color, and it helped me get through some of the worst days of my life."</p>
								<p>Let that sink in for a second...</p>
								<p>A simple Gameboy. Now fastfoward 13 years. Gameboys are fossils now (yikes!). An iPad can revolutionalize the treatment experience. They can play games (heck, they even have a Tetris app!), watch movies, use netflix, play games, and even do their homework. With an iPad, we’re tapping into an experience that most of these kids are MISSING out on as they’re receiving treatment. Can you imagine the change we can make in the treatment experience if nurses don’t have to worry about smiles or frowns and can focus on treatment? This is what we’re about. A positive mental and emotional outlook pays dividends for treatment. There’s something to be said about being able to put a smile on the face of a child who’s, for lack of a better term, being ROBBED of their childhood. That’s what we’re about."</p>
							</blockquote>
							<p>If that’s not enough for you to get on board, how about the simple fact that the Little Hero would LOVE one, and your simple purchase is a piece of their puzzle!</p>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingSix">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="true" aria-controls="collapseSix">The size doesn't fit. Can I exchange?</a>
						</h4>
					</div>
					<div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
						<div class="panel-body">
							<p>Yes, of course! Simply email <a href="mailto:returns@gamerosity.com">returns@gamerosity.com</a> and explain the nature of your exchange. We will provide the information you need to setup an exchange.</p>
							<p>Refunds are not available as resources directly get forwarded to a child’s campaign, contact us and we’ll work with you.</p>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingSeven">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">My Nomination got denied. What's that about?</a>
						</h4>
					</div>
					<div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
						<div class="panel-body">
							<p>We do our best to be as sensitive and caring as possible. To ensure that we help as many kids as possible, we do have a vetting process to confirm that a child is:</p>
							<ul>
								<li>Between the age of 2-17</li>
								<li>Undergoing chemotherapy treatment for a childhood cancer</li>
								<li>Within the Continental US</li>
								<li>Permitted by their parent/guardian to be nominated</li>
							</ul>
							<p>There’s very few reasons why we’d deny a child from a Campaign. If you feel there’s an error, please forward your inquiry to heroes@gamerosity.com</p>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingEight">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="true" aria-controls="collapseEight">My child already has an iPad. Can we still be a part of it?</a>
						</h4>
					</div>
					<div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
						<div class="panel-body">
							<p>Well…. Yes! Everything is handled on a case by case basis, and if your child has an iPad already and you’d still like his friends and/or family to band together to gift your child something, please make note of that on the Nomination form and we’ll see what alternatives we can come up with.</p>
							<p>We try to keep everything in iOS as we have plans for special Gamerosity apps in the future. Until then, all that matters is smiles on kids faces!</p>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingNine">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="true" aria-controls="collapseNine">How many employees do you have?</a>
						</h4>
					</div>
					<div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
						<div class="panel-body">
							<p>ZERO.  We are completely volunteer ran.  From our Board, to our Executive Director, to our order fulfillment peeps, we give our time for these children.</p>
							<p>Obviously with that comes complications.  Most of our volunteers are here 1 day a week, which means sometimes things can take a while to get done, but we’re working hard to close those gaps!  We’re committed to ensuring the resources that come in are dedicated to our cause, that is, the children.</p>
							<p>While this may change in the future, at present, we’re focussed on a sustainable platform that serves as many children as possible!</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

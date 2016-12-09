@extends('layouts.master')

@section('content')
<div class="gameon-1 full-width pt-100 pb-100">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3 text-center pb-100">
			<h1 class="pt-100">GAME ON</h1>
			<h3>A SUPER STORY</h3>
			<a href="{{ url('product/game-on-a-super-story-book') }}" class="btn btn-danger">BUY THE BOOK</a>
		</div>
	</div>
</div>
<div class="gameon-2 pt-30 pb-30">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1">
			<p>I’M NOT AN AUTHOR! I really ain’t. Over the last few years, I’ve been told I should write a book to “share my story.” Truth is, Gamerosity is my story, and it’s still being written. So after confiding in friends, months (AND MONTHS) of a painstaking, heart-tugging process, Rebekah and myself combined powers and wrote this book. The story is a mix of things, and that’s on purpose. It’s an introduction to Gamerosity and the value of community and compassion our Charity brings. It’s a look into the realities of Childhood Cancer you may have never considered. And it’s a message of hope that took me 13 years after surviving cancer to learn. We hope you see our hearts in this book. We hope it’s a valuable tool and brings you to the comforting reality that we’re all in this together.</p>
		</div>
	</div>
</div>
<div class="gameon-3 full-width">
	<div class="row">
		<div class="col-xs-5 col-xs-offset-1 pt-40 pb-20">
			<h2>DOWNLOAD A PREVIEW!</h2>
			<p>First off, I have no idea how Authors do this.  Like, REAL Authors.  This whole time, I’m terrified you’re going to hate this book.  And then there’s the fact that we bought 1000 copies of this and OH MY GOSH WHAT IF PEOPLE DON’T BUY IT? !  I can’t imagine the pain and fear of getting a book published!  We are self-published, we printed this ourselves, wrote it ourselves, and hired an old friend from high school to illustrate the book for us.  It really is a grassroots effort to share a real, meaninful, special message about community and strength.  We need you to buy it.  But also, we need you to love the message behind it.  Because it’s real.  I mean, I was in tears writing the last 2 pages.  And in a 2-week emotional funk when someone heavily critiqued it to the point where I thought about not sending this to print.</p>
			<p>What is YOUR Source of Power?</p>
			<p>That’s what this story is about (And yeah, we talk about ourselves a bit in this book because, hey, it’s our book.  We believe in our mission.  Why wouldn’t we put it in a book?</p>
			<br />
			<p>So download a preview and check it out.  We put our whole hearts into this and didn’t cut corners. I hope it’s worth your time.</p>
			<br />
			<a href="{{ url('uploads/2016/12/Gamerosity_Childrens_Book_Preview.pdf') }}" class="btn btn-primary">DOWNLOAD A PREVIEW</a>
			<a href="{{ url('product/game-on-a-super-story-book') }}" class="btn btn-danger">BUY THE BOOK</a>
		</div>
		<div class="col-xs-6">
			<img src="{{ url('img/gameon/section-3_757x882@1x.png') }}" class="img-responsive" />
		</div>
	</div>
</div>
<div class="gameon-4">
	<div class="row">
		<div class="col-xs-5 col-xs-offset-1 pt-20 pb-20">
			<img src="{{ url('img/gameon/super-story-cover_517x752@1x.png') }}" class="img-responsive" />
		</div>
		<div class="col-xs-5 pt-50 pb-20">
			<p>Co-Writer, Manny Munoz is a Childhood Cancer Suvivor that volunteers as Executive Director of Gamerosity.  Professionally, he is a Graphic Designer and Screen Printer in Southern Oregon.</p>
			<p>Co-Writer, Rebekah Ratcliff volunteers as Operations Manager at Gamerosity while juggling responsibilities as College Student and Administrator at a Screen Printing company in Southern Oregon.</p>
			<p>Our Illustrator, Adolfo Rodriguez, is a high school Computer Animation Teacher in Southern California and has a passion for both doing good and character art.</p>
			<p>This fancy little book is printed on high quality gloss book stock with a thick, durable cover stock for the front and back covers.  52 pages of our hearts poured out on paper.  In some ways, it’s a Children’s Book, in others, it’s not at all.</p>
			<br />
			<div class="text-center">
				<a href="{{ url('product/game-on-a-super-story-book') }}" class="btn btn-danger">BUY THE BOOK</a>
			</div>
		</div>
	</div>
</div>
@endsection

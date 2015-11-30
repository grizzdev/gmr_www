<div class="stats-wrapper wow fadeIn" data-wow-delay="0.8s" data-wow-duration="1.5s">
	<div class="row">
		<div class="col-xs-6 col-sm-3">
			<div class="stat-number">{{ \App\Hero::where('funded', '=', 1)->get()->count() }}</div>
			<div class="stat-desc">
				<i class="fa fa-tablet"></i>
				<span class="stat-title">hero packages shipped</span>
			</div>
		</div>
		<div class="col-xs-6 col-sm-3">
			<div class="stat-number">{{ \App\Hero::where('funded', '=', 0)->where('active', '=', 1)->get()->count() }}</div>
			<div class="stat-desc">
				<i class="fa fa-clock-o"></i>
				<span class="stat-title">current open campaigns</span>
			</div>
		</div>
		<div class="col-xs-6 col-sm-3">
			<div class="stat-number">{{ \App\Http\Controllers\ShopController::monthly_total() }}</div>
			<div class="stat-desc">
				<i class="fa fa-money"></i>
				<span class="stat-title">raised this month</span>
			</div>
		</div>
		<div class="col-xs-6 col-sm-3">
			<div class="stat-number">43</div>
			<div class="stat-desc">
				<i class="fa fa-meh-o"></i>
				<span class="stat-title">children diagnosed today</span>
			</div>
		</div>
	</div>
</div>

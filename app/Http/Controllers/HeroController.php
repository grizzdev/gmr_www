<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Hero;
use App\Location;
use App\Nomination;

class HeroController extends Controller {

	public function heroes(Request $request) {
		$longest = Hero::longest(4);

		$closest = Hero::closest(4);

		$heroes = Hero::where('active', '=', 1)->where('funded', '=', 0)->paginate(24);

		if ($heroes->count()) {
			return view('hero.heroes', [
				'title' => 'Heroes',
				'longest' => $longest,
				'closest' => $closest,
				'heroes' => $heroes,
				'page' => $request->input('page')
			]);
		} else {
			return redirect('');
		}
	}

	public function search(Request $request) {
		if (!empty($request->input('hero-search'))) {
			$heroes = Hero::where('active', '=', 1)
				->where('funded', '=', 0)
				->where(function($query) use($request) {
					$query->where('name', 'LIKE', "%{$request->input('hero-search')}%")
						->orWhere('cancer_type', 'LIKE', "%{$request->input('hero-search')}%")
						->orWhere('hospital_name', 'LIKE', "%{$request->input('hero-search')}%")
						->orWhere('hospital_location', 'LIKE', "%{$request->input('hero-search')}%");
				})
				->get();
				$paginate = false;
		} else {
			$heroes = Hero::where('active', '=', 1)->where('funded', '=', 0)->paginate(24);
			$heroes->setPath('heroes');
			$paginate = true;
		}

		return view('includes.heroes', [
			'heroes' => $heroes,
			'paginate' => $paginate
		]);
	}

	public function hero($slug) {
		$hero = Hero::where('slug', '=', $slug)->where('active', '=', 1)->first();
		if (!$hero->funded) {
			session(['hero_slug' => $slug]);
		}

		if (!empty($hero->id)) {
			return view('hero.hero', ['title' => $hero->name, 'hero' => $hero]);
		} else {
			return redirect('');
		}
	}

	public function hall() {
		$heroes = Hero::where('active', '=', 1)->where('funded', '=', 1)->paginate(24);

		if ($heroes->count()) {
			return view('hero.hall', ['title' => 'Hall of Heroes', 'heroes' => $heroes]);
		} else {
			return redirect('');
		}
	}

	public function nominate() {
		$months = [
			1 => 'January',
			2 => 'February',
			3 => 'March',
			4 => 'April',
			5 => 'May',
			6 => 'June',
			7 => 'July',
			8 => 'August',
			9 => 'September',
			10 => 'October',
			11 => 'November',
			12 => 'December'
		];

		for ($d = 1; $d < 32; $d++) {
			$days[$d] = $d;
		}

		for ($y = date('Y'); $y >= (date('Y') - 21); $y--) {
			$years[$y] = $y;
		}

		$sizes = [
			'ys' => 'YS',
			'ym' => 'YM',
			'yl' => 'YL',
			'yxl' => 'YXL',
			's' => 'S',
			'm' => 'M',
			'l' => 'L',
			'xl' => 'XL'
		];

		$lstates = Location::states(224);
		foreach ($lstates as $state) {
			$states[$state->id] = $state->name;
		}

		return view('hero.nominate', [
			'title' => 'Nominate a Hero',
			'months' => $months,
			'days' => $days,
			'years' => $years,
			'sizes' => $sizes,
			'states' => $states
		]);
	}

	public function postNominate(Request $request) {
		$nominee = User::where('email', '=', $request->input('email'))->first();

		if (!$nominee) {
			$nominee = User::Create([
				'email' => $request->input('email'),
				'name' => $request->input('name')
			]);
		}

		$birth_date = date('Y-m-d', strtotime($request->input('hero_dob_month').'/'.$request->input('hero_dob_day').'/'.$request->input('hero_dob_year')));

		$nomination = Nomination::create([
			'name' => $request->input('hero_name'),
			'overview' => $request->input('overview'),
			'birth_date' => $birth_date,
			'gender' => $request->input('hero_gender'),
			'address' => $request->input('hero_address'),
			'city' => $request->input('hero_city'),
			'state_id' => $request->input('hero_state_id'),
			'zip' => $request->input('hero_zip'),
			'shirt_size' => $request->input('hero_shirt_size'),
			'hospital_name' => $request->input('hospital_name'),
			'hospital_location' => $request->input('hospital_location'),
			'cancer_type' => $request->input('cancer'),
			'facebook_url' => $request->input('facebook_url'),
			'twitter_url' => $request->input('twitter_url'),
			'youtube_url' => $request->input('youtube_url'),
			'caringbridge_url' => $request->input('caringbridge_url'),
			'file_id' => $request->input('file_id'),
			'nominee_id' => $nominee->id,
			'relationship' => $request->input('relationship')
		]);

		$nomination->sendEmail();
	}

	public function raf() {
		$heroes = Hero::all();
		return view('hero.raf', ['heroes' => $heroes]);
	}

	public function raf_post(Request $request) {
		$hero = Hero::find($request->input('id'));
		$hero->raised = $request->input('raised');
		$hero->funded = $request->input('funded');
		$hero->active = $request->input('active');
		$hero->save();
		return \Response::json($request->all());
	}

}

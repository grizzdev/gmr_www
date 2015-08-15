<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class TeamController extends Controller {

	public function team() {
		return view('team.team', ['title' => 'Team']);
	}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SurveyController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function submit(Request $request) {
		Mail::send('emails.survey-html', [
			'title' => $request->input('survey').' Survey',
			'logo' => config('mail.view.logo'),
			'survey_data' => $request->all()
		], function ($message) {
			$message->to('info@gamerosity.com')->subject('New Survey Submission');
		});
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function gameOnDayWisconsin2016() {
		return view('survey.game-on-day-wisconsin-2016', [
			'title' => 'Game On Day Wisconsin 2016 Survey'
		]);
	}

}

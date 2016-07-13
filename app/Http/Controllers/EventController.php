<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\User;
use App\Event;
use App\EventJob as Job;
use App\EventShift as Shift;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EventController extends Controller {

	public function index() {
		return view('events.index', [
			'title' => 'Events',
			'events' => Event::where('end_at', '>', date('Y-m-d H:i:s'))->orderBy('start_at')->get()
		]);
	}

	public function event($slug) {
		$event = Event::where('slug', '=', $slug)->first();

		if ($event) {
			return view('events.event', [
				'title' => $event->title,
				'event' => $event
			]);
		} else {
			return redirect()->to('/events');
		}
	}

	public function volunteer($slug, $shift_id) {
		$event = Event::where('slug', '=', $slug)->first();
		$shift = Shift::whereNull('user_id')->where('id', '=', $shift_id)->first();
		$shifts = [];

		$shifts_list = $event->shifts()->whereNull('user_id')->get();
		foreach ($shifts_list as $sl) {
			$shifts[$sl->id] = $sl->job->title.' '.date('m/d/Y', strtotime($sl->start_at)).' '.date('g:i A', strtotime($sl->start_at)).'-'.date('g:i A', strtotime($sl->end_at));
		}

		if ($event && $shift) {
			return view('events.volunteer', [
				'title' => 'Volunteer for '.$shift->job->title.' at '.$event->title,
				'event' => $event,
				'events' => ['' => ''] + Event::where('end_at', '>', date('Y-m-d H:i:s'))->orderBy('start_at')->lists('title', 'id')->toArray(),
				'shift' => $shift,
				'shifts' => ['' => ''] + $shifts,
			]);
		} else {
			return redirect()->to('/events');
		}
	}

	public function postVolunteer(Request $request) {
		$shift = Shift::find($request->input('shift_id'));

		if ($shift) {
			$user = User::firstOrCreate([
				'email' => $request->input('email')
			]);

			if (empty($user->name)) {
				$user->name = $request->input('name');
				$user->save();
			}

			$shift->user_id = $user->id;
			$shift->save();

			Mail::queue([
				'emails.volunteer-html',
				'emails.volunteer-text'
			], [
				'title' => 'New Event Volunteer',
				'logo' => config('mail.view.logo'),
				'shift' => $shift,
				'user' => $user,
				'notes' => $request->input('notes')
			], function ($message) use ($shift) {
				$message->to($shift->event->lead->email)->subject('New Event Volunteer');
				$message->to('info@gamerosity.com')->subject('New Event Volunteer');
				$message->to('kevin@grizzdev.com')->subject('New Event Volunteer');
			});
		}
	}

}

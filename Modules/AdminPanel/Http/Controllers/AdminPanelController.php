<?php

namespace Modules\AdminPanel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\AdminPanel\Jobs\SendNotificationsToUsers;

class AdminPanelController extends Controller {
	/**
	 * Display a listing of the resource.
	 * @return Response
	 */
	public function index() {
		return view('adminpanel::index')->with('title', trans('adminpanel::adminpanel.index'));
	}

	public function quick_email() {

		$data = request()->validate([

			'subject' => 'required|string',
			'message' => 'required',

		]);


		SendNotificationsToUsers::dispatch($data, $users);

		return response(['success'], 200);

	}

}

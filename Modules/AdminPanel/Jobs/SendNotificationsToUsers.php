<?php

namespace Modules\AdminPanel\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\AdminPanel\Notifications\SendNotifications;

class SendNotificationsToUsers implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	protected $data, $users;

	public function __construct($data, $users) {
		$this->users = $users;
		$this->data = $data;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {

		foreach ($this->users as $user) {

			$user->notify(new SendNotifications($this->data));

		}

	}
}

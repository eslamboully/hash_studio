<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Admin\Repositories\AdminRepository;

class AdminDatabaseSeeder extends Seeder {
	public function __construct(AdminRepository $adminRepository) {
		$this->adminRepository = $adminRepository;
	}
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	public function run() {
		Model::unguard();

		$admin = $this->adminRepository->create([

			'full_name' => 'احمد بركات',
			'email' => 'admin@admin.com',
			'password' => bcrypt('admin'),

		]);
        $admin->assignRole('super_admin');

	}
}

<?php

use Illuminate\Database\Seeder;
use Modules\Admin\Database\Seeders\AdminDatabaseSeeder;
use Modules\Config\Database\Seeders\ConfigDatabaseSeeder;
use Modules\User\Database\Seeders\UserDatabaseSeeder;
use Modules\Post\Database\Seeders\PostDatabaseSeeder;
use Modules\Admin\Database\Seeders\SpatieTableSeederTableSeeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
	    $this->call(SpatieTableSeederTableSeeder::class);
		$this->call(AdminDatabaseSeeder::class);

	}
}

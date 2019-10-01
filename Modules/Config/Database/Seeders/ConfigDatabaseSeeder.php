<?php

namespace Modules\Config\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Config\Repositories\ConfigRepository;

class ConfigDatabaseSeeder extends Seeder {

	public function __construct(ConfigRepository $configRepository) {
		$this->configRepository = $configRepository;
	}
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard();

		$data = [

			'logo' => null,
			'email' => 'email',
			'background' => null,
			'phone' => 'phone',
			'en' => [

				'title' => 'Title',
				'desc' => 'Description',
				'address' => 'Address',
                'commission' => '00000',
                'install_advertising' => '00000',
                'laws' => '00000',
                'why_banned' => '00000',
                'what_i_do' => '00000',
            ],
            'ar' => [

                'title' => 'العنوان',
                'desc' => 'الوصف',
                'address' => 'العنوان',
                'commission' => '00000',
                'install_advertising' => '00000',
                'laws' => '00000',
                'why_banned' => '00000',
                'what_i_do' => '00000',
            ],


		];

		$this->configRepository->create($data);
	}
}

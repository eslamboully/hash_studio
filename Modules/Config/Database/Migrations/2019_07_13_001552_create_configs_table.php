<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('configs', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('logo')->nullable();
			$table->string('background')->nullable();
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
            $table->string('bank1')->nullable();
            $table->string('bank2')->nullable();
            $table->string('bank3')->nullable();
			$table->timestamps();
		});

		Schema::create('config_translations', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('config_id')->unsigned();
			$table->foreign('config_id')->references('id')->on('configs')->onDelete('cascade');
			$table->string('title')->nullable();
			$table->text('desc')->nullable();
			$table->text('commission')->nullable();
			$table->text('install_advertising')->nullable();
			$table->text('laws')->nullable();
			$table->text('why_banned')->nullable();
			$table->text('what_i_do')->nullable();

			$table->string('locale')->index();
			$table->unique(['config_id', 'locale']);
			$table->string('address')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('configs');
		Schema::dropIfExists('config_translations');
	}
}

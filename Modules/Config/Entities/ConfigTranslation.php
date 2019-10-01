<?php

namespace Modules\Config\Entities;

use Illuminate\Database\Eloquent\Model;

class ConfigTranslation extends Model {
	protected $fillable = ['title', 'desc', 'address','commission','install_advertising','laws','why_banned','what_i_do'];

	public $timestamps = false;
}

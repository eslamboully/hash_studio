<?php

namespace Modules\Config\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Config extends Model {

	use Translatable;

	protected $fillable = ['logo', 'background', 'phone','email','bank1','bank2','bank3'];

	protected $translationModel = ConfigTranslation::class;

	protected $translatedAttributes = ['title', 'desc', 'address','commission','install_advertising','laws','why_banned','what_i_do'];

	public function getBackgroundAttribute($image) {
		return 'upload/configs/' . $image;
	}

	public function getLogoAttribute($image) {
		return 'upload/configs/' . $image;
	}

}

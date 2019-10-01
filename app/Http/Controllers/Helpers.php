<?php

include __DIR__ . '/../../../Modules/AdminPanel/Helpers/functions.php';

if (!function_exists('lang')) {

	function lang() {

		return app()->getLocale();

	}
}

if (!function_exists('app_name')) {

	function app_name() {

		return __('front::front.estgmam');

	}
}

if (!function_exists('user')) {

	function user() {

		return auth('web')->user();

	}

}

if (!function_exists('link')) {

	function our_link($string) {

		$num = strcspn($string, "=");
		return substr($string, $num);

	}

}

if (!function_exists('quick_sort')) {
	function quick_sort($my_array) {

		$loe = $gt = [];

		if (count($my_array) < 2) {
			return $my_array;
		}
		$pivot_key = key($my_array);
		$pivot = array_shift($my_array);
		foreach ($my_array as $val) {
			if ($val >= $pivot) {
				$loe[] = $val;
			} elseif ($val < $pivot) {
				$gt[] = $val;
			}
		}

		return array_merge(quick_sort($loe), array($pivot_key => $pivot), quick_sort($gt));
	}
}

if (!function_exists('active')) {
	function active($url) {

		if (\Request::segment(3) == $url) {

			return 'active';
		}

	}
}
if (!function_exists('yajra_lang')) {
	function yajra_lang() {
		return [
			"sProcessing" => __('adminpanel::adminpanel.download'),
			"sLengthMenu" => __('adminpanel::adminpanel.show') . " _MENU_" . __('adminpanel::adminpanel.records'),
			"sZeroRecords" => __('adminpanel::adminpanel.zero_records'),
			"sEmptyTable" => __('adminpanel::adminpanel.none_record_table'),
			"sInfo" => __('adminpanel::adminpanel.showing') . " " . __('adminpanel::adminpanel.records') . __('adminpanel::adminpanel.ofthe') . " _START_ " . __('adminpanel::adminpanel.of') . " _END_ " . __('adminpanel::adminpanel.ofatotalof') . " _TOTAL_ " . __('adminpanel::adminpanel.records'),
			"sInfoEmpty" => __('adminpanel::adminpanel.zero_records'),
			"sInfoFiltered" => "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix" => "",
			"sSearch" => __('adminpanel::adminpanel.search'),
			"sUrl" => "",
			"sInfoThousands" => ",",
			"sLoadingRecords" => "Cargando...",
			"oPaginate" => [
				"sFirst" => __('adminpanel::adminpanel.first'),
				"sLast" => __('adminpanel::adminpanel.last'),
				"sNext" => __('adminpanel::adminpanel.next'),
				"sPrevious" => __('adminpanel::adminpanel.previous'),
			],
			"oAria" => [
				"sSortAscending" => "=> Activar para ordenar la columna de manera ascendente",
				"sSortDescending" => "=> Activar para ordenar la columna de manera descendente",
			],
		];
	}
}
//if (App()->getLocale() == 'ar'){
//    \Carbon\Carbon::setLocale('ar');
//}else{
//    \Carbon\Carbon::setLocale('en');
//}

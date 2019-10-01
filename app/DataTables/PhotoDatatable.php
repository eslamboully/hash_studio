<?php

namespace App\DataTables;

use Modules\Photo\Entities\Photo;
use URL;
use Yajra\DataTables\Services\DataTable;

class PhotoDatatable extends DataTable {

	public function dataTable($query) {
		return datatables($query)
			->addColumn('control', 'photo::datatables.control')
			->addColumn('image', 'photo::datatables.image')
			->rawColumns(['image', 'control']);
	}

	public function query() {
		return Photo::all();
	}

	public function html() {
		return $this->builder()
			->columns($this->getColumns())
			->minifiedAjax()
			->parameters([
				'dom' => 'Blfrtip',
				'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, trans('adminpanel::adminpanel.all')]],
				'buttons' => [
                    auth()->guard('admin')->user()->can('add_photos') ? [
                        'text' => trans('adminpanel::adminpanel.add_new'),
                        'className' => 'btn btn-info',
                        'action' => "function(){
                                    window.location.href ='" . URL::Current() . "/create';
                                }",
                    ] : [
                        'text' => trans('adminpanel::adminpanel.add_new'),
                        'className' => 'btn btn-info disabled',
                    ],
					[
						'extend' => 'export', 'text' => '<i class="fa fa-file-archive-o"></i>' . __('adminpanel::adminpanel.export'), 'className' => 'btn btn-primary', 'init' => 'function(api, node, config) {$(node).removeClass("dt-button")}',
					],
					[
						'extend' => 'print', 'text' => '<i class="fa fa-print"></i>' . __('adminpanel::adminpanel.print'), 'className' => 'btn btn-success', 'init' => 'function(api, node, config) {$(node).removeClass("dt-button")}',
					],
					[
						'extend' => 'reset', 'text' => '<i class="fa fa-refresh"></i>', 'className' => 'btn btn-info', 'init' => 'function(api, node, config) {$(node).removeClass("dt-button")}',
					],
				],
				'language' => yajra_lang(),
			]);
	}

	protected function getColumns() {
		return [
//			[
			//				'name' => 'checkbox',
			//				'data' => 'checkbox',
			//				'title' => '<input type="checkbox" name="check_all" class="form-check check_all">',
			//				'sortable' => false,
			//				'printable' => false,
			//				'exportable' => false,
			//				'orderable' => false,
			//			],
			[
				'name' => 'id',
				'data' => 'id',
				'title' => trans('photo::photo.id'),
			],
			[
				'name' => 'title',
				'data' => 'title',
				'title' => trans('photo::photo.title'),
			],
            [
                'name' => 'user_id',
                'data' => 'user_id',
                'title' => trans('photo::photo.user_id'),
            ],
			[
				'name' => 'image',
				'data' => 'image',
				'title' => trans('photo::photo.image'),
				'printable' => false,
				'searchable' => false,
				'orderable' => false,
			],
//
			[
				'name' => 'control',
				'data' => 'control',
				'title' => trans('adminpanel::adminpanel.control'),
				'printable' => false,
				'searchable' => false,
				'orderable' => false,
			],

		];
	}

	protected function filename() {
		return 'Photo_' . date('YmdHis');
	}
}

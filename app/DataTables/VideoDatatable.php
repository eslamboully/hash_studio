<?php

namespace App\DataTables;

use Modules\Video\Repositories\VideoRepository;
use URL;
use Yajra\DataTables\Services\DataTable;

class VideoDatatable extends DataTable {

	public function dataTable($query) {
		return datatables($query)
			->addColumn('control', 'video::datatables.control')
			->addColumn('video', 'video::datatables.video')
			->rawColumns(['video', 'control']);
	}

	public function query(VideoRepository $videoRepository) {
		return $videoRepository->query();
	}

	public function html() {
		return $this->builder()
			->columns($this->getColumns())
			->minifiedAjax()
			->parameters([
				'dom' => 'Blfrtip',
				'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, trans('adminpanel::adminpanel.all')]],
				'buttons' => [
                    auth()->guard('admin')->user()->can('add_videos') ? [
						'text' => trans('adminpanel::adminpanel.add_new'),
						'className' => 'btn btn-info',
						'action' => "function(){
                                    window.location.href ='" . URL::Current() . "/create';
                                }",
					] : [
                        'text' => trans('adminpanel::adminpanel.add_new'),
                        'className' => 'btn btn-info disabled',
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
				'title' => trans('video::video.id'),
			],
			[

				'name' => 'title_' . App()->getLocale(),
				'data' => 'title_' . App()->getLocale(),
				'title' => trans('admin::admin.title'),

				'name' => 'title',
				'data' => 'title',
				'title' => trans('video::video.title'),
			],
//			[
//				'name' => 'video',
//				'data' => 'video',
//				'title' => trans('video::video.video'),
//				'printable' => false,
//				'searchable' => false,
//				'orderable' => false,
//			],
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

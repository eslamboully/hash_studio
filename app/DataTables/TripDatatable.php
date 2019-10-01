<?php

namespace App\DataTables;

use Modules\Trip\Repositories\TripRepository;
use URL;
use Yajra\DataTables\Services\DataTable;

class TripDatatable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		return datatables($query)
			->addColumn('control', 'trip::trips.datatables.control')
			->addColumn('short_desc', 'trip::trips.datatables.short_desc')
			->addColumn('image', 'trip::trips.datatables.image')
			->addColumn('status', 'trip::trips.datatables.status')
			->rawColumns(['control', 'image','status', 'short_desc'])

			->rawColumns(['control', 'short_desc','status']);

	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\User $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(TripRepository $tripRepository) {
		return $tripRepository->query();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		return $this->builder()
			->columns($this->getColumns())
			->minifiedAjax()
			->parameters([
				'dom' => 'Blfrtip',
				'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, trans('adminpanel::adminpanel.all')]],
				'buttons' => [
//					[
//						'text' => trans('adminpanel::adminpanel.add_new'),
//						'className' => 'btn btn-info',
//						'action' => "function(){
//                                    window.location.href ='" . URL::Current() . "/create';
//                                }",
//					],
				],
				'language' => yajra_lang(),
			]);
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns() {
		return [
			[
				'name' => 'id',
				'data' => 'id',
				'title' => trans('trip::trip.id'),
			],
			[
				'name' => 'berth',
				'data' => 'berth',
				'title' => trans('trip::trip.berth'),
			],
			[
				'name' => 'short_desc',
				'data' => 'short_desc',
				'title' => trans('trip::trip.short_desc'),
			],
			[
				'name' => 'price',
				'data' => 'price',
				'title' => trans('trip::trip.price'),
			],
            [
                'name' => 'status',
                'data' => 'status',
                'title' => trans('trip::trip.status'),
                'printable' => false,
            ],
			[
				'name' => 'passenger_price',
				'data' => 'passenger_price',
				'title' => trans('trip::trip.passenger_price'),
				'printable' => false,
				'searchable' => false,
				'orderable' => false,
			],

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

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'Service_' . date('YmdHis');
	}
}

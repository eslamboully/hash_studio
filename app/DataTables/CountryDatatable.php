<?php

namespace App\DataTables;

use Modules\Country\Entities\Country;
use URL;
use Yajra\DataTables\Services\DataTable;

class CountryDatatable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		return datatables($query)
			->addColumn('control', 'country::datatables.control')
			->rawColumns(['control']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\User $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query() {
		return Country::query()->with(['translations','states'])->get();
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
					[
						'text' => trans('adminpanel::adminpanel.add_new'),
						'className' => 'btn btn-info',
						'action' => "function(){
                                    window.location.href ='" . URL::Current() . "/create';
                                }",
					],
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
				'title' => trans('country::country.id'),
			],
			[
				'name' => 'name',
				'data' => 'name',
				'title' => trans('country::country.name'),
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
		return 'Country_' . date('YmdHis');
	}
}

<?php

namespace App\DataTables;


use Modules\Post\Entities\Plan;
use URL;
use Yajra\DataTables\Services\DataTable;

class PlanDatatable extends DataTable {
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query) {
        return datatables($query)
            ->addColumn('control', 'post::plans.datatables.control')
            ->rawColumns(['control']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query() {
        return Plan::query()->get();
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
                    auth()->guard('admin')->user()->can('add_plans') ? [
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
                'title' => trans('post::post.id'),
            ],
            [
                'name' => 'date',
                'data' => 'date',
                'title' => trans('front::front.date'),
            ],
            [
                'name' => 'money',
                'data' => 'money',
                'title' => trans('front::front.money'),
            ],
            [
                'name' => 'currency',
                'data' => 'currency',
                'title' => trans('front::front.currency'),
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
        return 'Plan_' . date('YmdHis');
    }
}

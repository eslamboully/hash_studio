<?php

namespace App\DataTables;

use Modules\Post\Entities\Post;
use Modules\Post\Repositories\PostRepository;
use URL;
use Yajra\DataTables\Services\DataTable;

class PostDatatable extends DataTable {
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query) {
        return datatables($query)
            ->addColumn('control', 'post::posts.datatables.control')
            ->addColumn('image', 'post::posts.datatables.image')
            ->addColumn('status', 'post::posts.datatables.status')
            ->addColumn('desc', 'post::posts.datatables.desc')
            ->rawColumns(['control', 'image','status','desc']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PostRepository $postRepository) {
        return Post::query();
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
                    auth()->guard('admin')->user()->can('add_posts') ? [
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
                'name' => 'status',
                'data' => 'status',
                'title' => trans('post::post.status'),
                'printable' => false,
            ],
            [
                'name' => 'desc',
                'data' => 'desc',
                'title' => trans('post::post.desc'),
                'printable' => false,
            ],
            [
                'name' => 'image',
                'data' => 'image',
                'title' => trans('post::post.image'),
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

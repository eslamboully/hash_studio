<?php

namespace App\DataTables;

use Modules\Comment\Entities\Comment;
use Modules\Photo\Entities\Photo;
use URL;
use Yajra\DataTables\Services\DataTable;

class CommentDatatable extends DataTable {

	public function dataTable($query) {
		return datatables($query);
	}

	public function query() {
		return Comment::with(['user','trip'])
            ->select('*');
	}

	public function html() {
		return $this->builder()
			->columns($this->getColumns())
			->minifiedAjax()
			->parameters([
				'dom' => 'Blfrtip',
				'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, trans('adminpanel::adminpanel.all')]],
				'buttons' => [

				],
				'language' => yajra_lang(),
			]);
	}

	protected function getColumns() {
		return [
			[
				'name' => 'id',
				'data' => 'id',
				'title' => trans('comment::comment.id'),
			],
            [
                'name' => 'comment',
                'data' => 'comment',
                'title' => trans('comment::comment.comment'),
            ],
            [
                'name' => 'user.full_name',
                'data' => 'user.full_name',
                'title' => trans('comment::comment.user_id'),
            ],
            [
                'name' => 'trip.id',
                'data' => 'trip.id',
                'title' => trans('comment::comment.trip_id'),
            ],


		];
	}

	protected function filename() {
		return 'Comment_' . date('YmdHis');
	}
}

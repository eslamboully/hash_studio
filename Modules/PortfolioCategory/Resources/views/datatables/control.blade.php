@if ( auth()->guard('admin')->user()->can('edit_categories'))
  <a class="btn btn-primary" href="{{ route('categories.edit' , $id) }}">
      <i class="fa fa-edit"></i>
  </a>
@else
  <a class="btn btn-primary disabled" href="#">
    <i class="fa fa-edit"></i>
  </a>
@endif
@if ( auth()->guard('admin')->user()->can('delete_categories'))
<a class="btn btn-danger" href="{{ route('categories.destroy' , $id) }}" data-toggle="modal" data-target="#del_admin{{ $id }}">
	<i class="fa fa-trash"></i>
</a>
@else
  <a class="btn btn-danger disabled" href="#" data-toggle="modal">
    <i class="fa fa-trash disabled"></i>
  </a>
@endif


<div id="del_admin{{ $id }}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('adminpanel::adminpanel.delete')</h4>
      </div>
      {!! Form::open(['route'=>['categories.destroy',$id],'method'=>'DELETE']) !!}
      <div class="modal-body">

      	@php
      		$admin = trans('admin::admin.categories')
      	@endphp

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">@lang('adminpanel::adminpanel.close')</button>
        {!! Form::submit(trans('adminpanel::adminpanel.yes'),['class'=>'btn btn-danger']) !!}
      </div>
      {!! Form::close() !!}
    </div>

  </div>
</div>
@if ( auth()->guard('admin')->user()->can('edit_admins'))
  <a class="btn btn-primary" href="{{ route('admins.edit' , $id) }}">
      <i class="fa fa-edit"></i>
  </a>
@else
  <a class="btn btn-primary disabled" href="#">
    <i class="fa fa-edit"></i>
  </a>
@endif
@if ( auth()->guard('admin')->user()->can('delete_admins'))
<a class="btn btn-danger" href="{{ route('admins.destroy' , $id) }}" data-toggle="modal" data-target="#del_admin{{ $id }}">
	<i class="fa fa-trash"></i>
</a>
@else
  <a class="btn btn-danger disabled" href="#" data-toggle="modal">
    <i class="fa fa-trash disabled"></i>
  </a>
@endif
{{--<a class="btn btn-warning" href="{{ route('admins.show' , $id) }}">--}}
{{--	<i class="fa fa-eye"></i>--}}
{{--</a>--}}


<div id="del_admin{{ $id }}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('adminpanel::adminpanel.delete')</h4>
      </div>
      {!! Form::open(['route'=>['admins.destroy',$id],'method'=>'DELETE']) !!}
      <div class="modal-body">

      	@php
      		$admin = trans('admin::admin.admin')
      	@endphp

        <h4>@lang('adminpanel::adminpanel.delete_this',[ 'type' => $admin , 'name'=>$full_name])</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">@lang('adminpanel::adminpanel.close')</button>
        {!! Form::submit(trans('adminpanel::adminpanel.yes'),['class'=>'btn btn-danger']) !!}
      </div>
      {!! Form::close() !!}
    </div>

  </div>
</div>
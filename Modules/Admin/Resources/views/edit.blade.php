@extends('adminpanel::layouts.master')

@section('content')
    <section class="content-header">
        <h1 style="font-family: 'Cairo', sans-serif;">
            @lang('admin::admin.admins')
            <small>@lang('admin::admin.control_panel')</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('admin::admin.home')</a></li>
            <li><a href="{{route('admins.index') }}"><i class="fa fa-user-secret"></i> @lang('admin::admin.admins')</a></li>
            <li class="active">@lang('adminpanel::adminpanel.edit')</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-xs-12">

	<div class="box">
            <div class="box-header">
              <h3 style="font-family: 'Cairo', sans-serif;" class="box-title">{{ $title }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['route' => ['admins.update' , $admin->id]  , 'files' => true, 'method' => 'PUT']) !!}
              <div class="form-group">
                {!! Form::label('full_name' ,  trans('admin::admin.full_name')) !!}
                {!! Form::text('full_name' , $admin->full_name , ['class' => 'form-control'] ) !!}
              </div>

                {!! Form::hidden('id' ,  $admin->id ) !!}

              <div class="form-group">
                {!! Form::label('email' ,  trans('admin::admin.email') ) !!}
                {!! Form::email('email' , $admin->email , ['class' => 'form-control'] ) !!}
              </div>

              <div class="form-group">
                {!! Form::label('image' ,  trans('admin::admin.image') ) !!}
                {!! Form::file('image' , ['id' => 'image' , 'class' => 'form-control'] ) !!}
              </div>

              <div class="form-group">
                <img id="blah" width="100px" height="100px" class="img-thumbnail" src="{{ asset($admin->image) }}" alt="your image" />
              </div>

              <div class="form-group">
                {!! Form::label('password' ,  trans('admin::admin.password') ) !!}
                {!! Form::password('password' , ['class' => 'form-control'] ) !!}
              </div>

                <!-- Start Permission -->
                <label for="exampleInputEmail1">@lang('admin::admin.permission')</label>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs ac">
                        @php
                            $models = ['read','add','edit','delete'];
                            $cats = ['admins','configs'];
                        @endphp
                        @foreach($cats as $cat)
                            <li><a href="#{{$cat}}" data-toggle="tab"> @lang('admin::admin.'.$cat)</a></li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($cats as $cat)
                            <div class="tab-pane" id="{{$cat}}">
                                @foreach($models as $model)
                                    <input type="checkbox" {{ $admin->can($model."_".$cat) ? 'checked' : '' }} name="permissions[]" value="{{$model}}_{{$cat}}">
                                    <label>@lang('admin::admin.'.$model)</label>
                                @endforeach
                            </div>
                    @endforeach
                    <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">

                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- end permission -->
                <button class="btn btn-primary"><i class="fa fa-edit"></i> @lang('adminpanel::adminpanel.edit')</button>
              {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
    </div>
            </div>
        </div>
    </section>
@stop
@push('js')
    <script>
        $('#admins').addClass('active');
        $('.ac li').first().addClass('active');
        $("input[type='image']").click(function() {
            $("#my_file").click();
            return false;
        });
    </script>
@endpush
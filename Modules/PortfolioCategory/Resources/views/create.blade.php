@extends('adminpanel::layouts.master')

@section('content')
    <section class="content-header">
        <h1 style="font-family: 'Cairo', sans-serif;">
            @lang('admin::admin.category')
            <small>@lang('admin::admin.control_panel')</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('admin::admin.home')</a></li>
            <li><a href="{{route('categories.index') }}"><i class="fa fa-user-secret"></i> @lang('admin::admin.category')</a></li>
            <li class="active">@lang('adminpanel::adminpanel.add')</li>
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
              {!! Form::open(['route' => 'categories.store']) !!}
              <div class="form-group">
                {!! Form::label('title' ,  trans('admin::admin.title')) !!}
                {!! Form::text('title' , old('title') , ['class' => 'form-control'] ) !!}
              </div>

              <div class="form-group">
                {!! Form::label('description' ,  trans('admin::admin.description') ) !!}
                {!! Form::textarea('description' , old('description') , ['class' => 'form-control'] ) !!}
              </div>

                
              <button class="btn btn-primary"><i class="fa fa-plus"></i> @lang('adminpanel::adminpanel.add')</button>
              {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
          </div>
            </div>
        </div>
    </section>
@endsection

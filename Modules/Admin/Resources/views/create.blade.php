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
              {!! Form::open(['route' => 'admins.store' , 'files' => true]) !!}
              <div class="form-group">
                {!! Form::label('full_name' ,  trans('admin::admin.full_name')) !!}
                {!! Form::text('full_name' , old('full_name') , ['class' => 'form-control'] ) !!}
              </div>

              <div class="form-group">
                {!! Form::label('email' ,  trans('admin::admin.email') ) !!}
                {!! Form::email('email' , old('email') , ['class' => 'form-control'] ) !!}
              </div>

              <div class="form-group">
                {!! Form::label('password' ,  trans('admin::admin.password') ) !!}
                {!! Form::password('password' , ['class' => 'form-control'] ) !!}
              </div>

              <div class="form-group">
                {!! Form::label('image' ,  trans('admin::admin.image') ) !!}
                {!! Form::file('image' , ['id' => 'image' , 'class' => 'form-control'] ) !!}
              </div>

              <div class="form-group">
                <img id="blah" width="100px" height="100px" class="img-thumbnail" src="{{ url('upload/admins/default.png') }}" alt="your image" />
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
                                    <input type="checkbox" name="permissions[]" value="{{$model}}_{{$cat}}">
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
              <button class="btn btn-primary"><i class="fa fa-plus"></i> @lang('adminpanel::adminpanel.add')</button>
              {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
          </div>
            </div>
        </div>
    </section>
@endsection
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
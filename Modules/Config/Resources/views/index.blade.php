@extends('adminpanel::layouts.master')

@push('css')
  <link rel="stylesheet" href="{{ admin_design('/jstree/themes/default/style.css') }}">

  <link rel="stylesheet" href="{{ admin_design('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

@endpush

@push('js')
<script src="{{ admin_design('bower_components/fastclick/lib/fastclick.js')}}"></script>

<script src="{{ admin_design('bower_components/ckeditor/ckeditor.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ admin_design('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

<script>
  $(function () {
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      CKEDITOR.replace('{{ $localeCode .'[desc]' }}')
      CKEDITOR.replace('{{ $localeCode .'[commission]' }}')
      CKEDITOR.replace('{{ $localeCode .'[install_advertising]' }}')
      CKEDITOR.replace('{{ $localeCode .'[laws]' }}')
      CKEDITOR.replace('{{ $localeCode .'[why_banned]' }}')
      CKEDITOR.replace('{{ $localeCode .'[what_i_do]' }}')
      $('.textarea').wysihtml5();

    @endforeach
    CKEDITOR.config.language = "{{ app()->getLocale() }}";

 })
</script>

@endpush



@section('content')

    <section class="content-header">
        <h1 style="font-family: 'Cairo', sans-serif;">
            @lang('config::config.configs')
            <small>@lang('adminpanel::adminpanel.control_panel')</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> @lang('adminpanel::adminpanel.home')</a></li>
            <li class="active">@lang('config::config.configs')</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-xs-12">
    <div class="side-body padding-top">

    <div class="page-content settings container-fluid">
        <form action="{{ route('configs.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="panel">

                <div class="page-content settings container-fluid">

                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#site">@lang('config::config.about')</a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#admin">@lang('config::config.other')</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="site" class="tab-pane fade in  active ">



                            <ul class="nav nav-tabs">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li class="{{ $loop->first ? 'active' : '' }}">
                                      <a  class="btn btn-danger" href="#tab_{{ $localeCode }}" data-toggle="tab">
                                        {{ $properties['native'] }}
                                      </a>
                                    </li>
                                @endforeach
                            </ul>


                            <div class="tab-content">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)


                                    <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="tab_{{ $localeCode }}">


                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <code>
                                                    @lang('config::config.title')
                                                    ( {{ $properties['native'] }} )
                                                </code>
                                            </h3>
                                        </div>

                                        <div class="panel-body no-padding-left-right">
                                            <div class="col-md-10 no-padding-left-right">

                                                <input type="text" value="{{ $config ? $config->translate($localeCode)->title : old($localeCode.'[title]') }}" class="form-control" placeholder="@lang('config::config.title')" name="{{ $localeCode }}[title]">
                                            </div>

                                        </div>
                                        <hr>

                                        <div class="panel-heading">

                                            <h3 class="panel-title">
                                                <code>
                                                    @lang('config::config.desc')
                                                    ( {{ $properties['native'] }} )
                                                </code>
                                            </h3>
                                        </div>

                                        <div class="panel-body no-padding-left-right">
                                            <div class="col-md-10 no-padding-left-right">

                                                <textarea class="form-control" name="{{ $localeCode }}[desc]" placeholder="@lang('config::config.desc')">
                                                     {{ $config ? $config->translate($localeCode)->desc : old($localeCode."[desc]") }}
                                                </textarea>
                                            </div>
                                        </div>


                                        <hr>

                                        <div class="panel-heading">

                                            <h3 class="panel-title">
                                                <code>
                                                    @lang('config::config.commission')
                                                    ( {{ $properties['native'] }} )
                                                </code>
                                            </h3>
                                        </div>


                                        <div class="panel-body no-padding-left-right">
                                            <div class="col-md-10 no-padding-left-right">
                                                <textarea class="form-control" name="{{ $localeCode }}[commission]" placeholder="@lang('config::config.commission')">
                                                     {{ $config ? $config->translate($localeCode)->commission : old($localeCode."[commission]") }}
                                                </textarea>
                                            </div>
                                        </div>


                                        <hr>

                                        <div class="panel-heading">

                                            <h3 class="panel-title">
                                                <code>
                                                    @lang('config::config.install_advertising')
                                                    ( {{ $properties['native'] }} )
                                                </code>
                                            </h3>
                                        </div>


                                        <div class="panel-body no-padding-left-right">
                                            <div class="col-md-10 no-padding-left-right">
                                                <textarea class="form-control" name="{{ $localeCode }}[install_advertising]" placeholder="@lang('config::config.install_advertising')">
                                                     {{ $config ? $config->translate($localeCode)->install_advertising : old($localeCode."[install_advertising]") }}
                                                </textarea>
                                            </div>
                                        </div>

                                        <hr/>


                                        <div class="panel-heading">

                                            <h3 class="panel-title">
                                                <code>
                                                    @lang('config::config.laws')
                                                    ( {{ $properties['native'] }} )
                                                </code>
                                            </h3>
                                        </div>


                                        <div class="panel-body no-padding-left-right">
                                            <div class="col-md-10 no-padding-left-right">
                                                <textarea class="form-control" name="{{ $localeCode }}[laws]" placeholder="@lang('config::config.laws')">
                                                     {{ $config ? $config->translate($localeCode)->laws : old($localeCode."[laws]") }}
                                                </textarea>
                                            </div>
                                        </div>

                                        <hr/>

                                        <div class="panel-heading">

                                            <h3 class="panel-title">
                                                <code>
                                                    @lang('config::config.why_banned')
                                                    ( {{ $properties['native'] }} )
                                                </code>
                                            </h3>
                                        </div>


                                        <div class="panel-body no-padding-left-right">
                                            <div class="col-md-10 no-padding-left-right">
                                                <textarea class="form-control" name="{{ $localeCode }}[why_banned]" placeholder="@lang('config::config.why_banned')">
                                                     {{ $config ? $config->translate($localeCode)->why_banned : old($localeCode."[why_banned]") }}
                                                </textarea>
                                            </div>
                                        </div>

                                        <hr/>

                                        <div class="panel-heading">

                                            <h3 class="panel-title">
                                                <code>
                                                    @lang('config::config.what_i_do')
                                                    ( {{ $properties['native'] }} )
                                                </code>
                                            </h3>
                                        </div>


                                        <div class="panel-body no-padding-left-right">
                                            <div class="col-md-10 no-padding-left-right">
                                                <textarea class="form-control" name="{{ $localeCode }}[what_i_do]" placeholder="@lang('config::config.what_i_do')">
                                                     {{ $config ? $config->translate($localeCode)->what_i_do : old($localeCode."[what_i_do]") }}
                                                </textarea>
                                            </div>
                                        </div>


                                        <hr>

                                        <div class="panel-heading">

                                            <h3 class="panel-title">
                                                <code>
                                                    @lang('config::config.address')
                                                    ( {{ $properties['native'] }} )
                                                </code>
                                            </h3>
                                        </div>

                                        <div class="panel-body no-padding-left-right">
                                            <div class="col-md-10 no-padding-left-right">

                                                <input type="text" class="form-control" name="{{ $localeCode }}[address]"  value="{{ $config ? $config->translate($localeCode)->address :  old( $localeCode.'[address]') }}"  placeholder="@lang('config::config.address')">
                                            </div>

                                        </div>

                                        <hr>


                                    </div>

                                @endforeach


                            </div>




                        </div>

                        <div id="admin" class="tab-pane fade in ">

                            <div class="panel-heading">

                                <h3 class="panel-title">
                                    <code>
                                        @lang('config::config.phone')
                                        ( {{ $properties['native'] }} )
                                    </code>
                                </h3>
                            </div>

                            <div class="panel-body no-padding-left-right">
                                <div class="col-md-10 no-padding-left-right">

                                    <input type="text"   value="{{ $config->phone ?? old('phone') }}" class="form-control" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="phone" placeholder="@lang('config::config.phone')">
                                </div>

                            </div>


                            <hr/>

                          <div class="panel-heading">
                                <h3 class="panel-title">
                                    <code>@lang('config::config.logo')</code>
                                </h3>

                            </div>

                            <div class="panel-body no-padding-left-right">
                                <div class="col-md-10 no-padding-left-right">
                                    <input id="image" type="file" name="logo">
                                </div>
                            </div>


                            @if($config and $config->logo)
                                <div class="form-group">
                                    <img width="100px" height="100px" class="img-thumbnail" src="{{ asset($config->logo) }}" alt="your image" />
                                </div>
                            @endif

                            <hr>

                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <code>@lang('config::config.background')</code>
                                </h3>

                            </div>

                            <div class="panel-body no-padding-left-right">
                                <div class="col-md-10 no-padding-left-right">
                                    <input type="file" name="background">
                                </div>
                            </div>

                            @if($config and $config->background)
                                <div class="form-group">
                                    <img width="100px" height="100px" class="img-thumbnail" src="{{ asset($config->background) }}" alt="your image" />
                                </div>
                            @endif


                            <div class="col-md-10 no-padding-left-right">
                                <label>@lang('config::config.email')</label>
                                <input type="email"   value="{{ $config->email ?? old('email') }}" class="form-control" name="email" placeholder="@lang('config::config.email')">
                            </div>

                            <div class="col-md-10 no-padding-left-right">
                                <label>@lang('front::front.bank1')</label>
                                <input type="text"   value="{{ $config->bank1 ?? old('bank1') }}" class="form-control" name="bank1" placeholder="@lang('front::front.bank1')">
                            </div>

                            <hr/>


                            <div class="col-md-10 no-padding-left-right">
                                <label>@lang('front::front.bank2')</label>
                                <input type="text"   value="{{ $config->bank2 ?? old('bank2') }}" class="form-control" name="bank2" placeholder="@lang('front::front.bank2')">
                            </div>


                            <div class="col-md-10 no-padding-left-right">
                                <label>@lang('front::front.bank3')</label>
                                <input type="text"   value="{{ $config->bank3 ?? old('bank3') }}" class="form-control" name="bank3" placeholder="@lang('front::front.bank3')">
                            </div>


                            <div class="form-group">


                                <button type="submit" class="btn btn-primary pull-right">@lang('adminpanel::adminpanel.save')</button>

                            </div>

                            <hr>



                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
        </form>



            </div>



            </div>
        </div>
    </section>
@stop

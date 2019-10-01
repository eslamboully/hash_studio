@extends('adminpanel::layouts.master')

@section('content')


 @push('js')



  <script src="{{ url('/')}}/dist/jquery-confirm/jquery-confirm.min.js"></script>

  <script src="{{ url('/')}}/dist/socket.io-client/socket.io.js"></script>
  <script type="text/javascript" src="{{ url('/dist/locationpicker/locationpicker.jquery.min.js') }}"></script>

  <script src="{{ url('/')}}/js/socket.io.js"></script>

  <script type="text/javascript">

    var admin_id = '{{ admin()->id }}';
    var name = '{{ admin()->name }}';
    var user_image="";

    var my_friends = [];

    var active_suppliers = [];
    var active_contractors = [];
    var currentSupCode = '';
    var currentConCode = '';

    var socket = io.connect('http://localhost:3000' , {

      query: 'admin_id=' + admin_id + '&name=' + name + '&user_image=' + user_image +'&my_friends=' + my_friends+'&role=' + 'admin'

     });

     function ifOnline(uid , type) {
      socket.emit('check_if_online' , {user_id: 'user_' + uid , type:type});
    }
  </script>






    <script src="{{ url('/') }}admin_design/plugins/vector/jquery-jvectormap--2.0.3.min.js"></script>

    <script src="{{ url('/') }}/admin_design/plugins/vector/jquery-jvectormap-world-mill.js"></script>


    <script type="text/javascript">


        jQuery(document).ready(function() {

            $('.emailBtn').on('click', function(e) {


              var subject = $('#email_subject').val();
              var message = $('#email_message').val();



                $.ajax({
                    url: '{{ route('admin_quick_email') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        subject: subject,
                        message: message,
                    },
                }).done(function() {

                    new Noty({
                        theme: 'sunset',
                        type: 'success',
                        layout: 'topRight',
                        text: "Data Send Successfully",
                        timeout: 2000,
                        killer: true
                    }).show();

                    $('#email_subject').val('');
                    $('#email_message').val('');

                }).fail(function() {

                    new Noty({
                        theme: 'sunset',
                        type: 'error',
                        layout: 'topRight',
                        text: "UnExpected Error!",
                        timeout: 2000,
                        killer: true
                    }).show();

                });


            });


        });


    </script>


  @endpush







    <section class="content-header">
        <h1>
            @lang('adminpanel::adminpanel.dashboard')
            <small>@lang('adminpanel::adminpanel.control_panel')</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> @lang('adminpanel::adminpanel.dashboard')</a></li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
      
        <!-- /.row -->
        <!-- Main row -->
{{--        <div class="row">--}}
{{--            <!-- Left col -->--}}
{{--            <section class="col-lg-7 connectedSortable">--}}
{{--                <!-- Custom tabs (Charts with tabs)-->--}}
{{--                <div class="nav-tabs-custom">--}}
{{--                    <!-- Tabs within a box -->--}}
{{--                    <ul class="nav nav-tabs pull-right">--}}
{{--                        <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>--}}
{{--                        <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>--}}
{{--                        <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>--}}
{{--                    </ul>--}}
{{--                    <div class="tab-content no-padding">--}}
{{--                        <!-- Morris chart - Sales -->--}}
{{--                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>--}}
{{--                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /.nav-tabs-custom -->--}}


{{--                <!-- quick email widget -->--}}
{{--                <div class="box box-info">--}}
{{--                    <div class="box-header">--}}
{{--                        <i class="fa fa-envelope"></i>--}}

{{--                        <h3 class="box-title">Quick Email</h3>--}}
{{--                        <!-- tools box -->--}}
{{--                        <div class="pull-right box-tools">--}}
{{--                            <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"--}}
{{--                                    title="Remove">--}}
{{--                                <i class="fa fa-times"></i></button>--}}
{{--                        </div>--}}
{{--                        <!-- /. tools -->--}}
{{--                    </div>--}}
{{--                    <div class="box-body">--}}
{{--                        <form action="#" method="post">--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="email" class="form-control" name="emailto" placeholder="Email to:">--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="text" class="form-control" name="subject" placeholder="Subject">--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                  <textarea class="textarea" placeholder="Message"--}}
{{--                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                    <div class="box-footer clearfix">--}}
{{--                        <button type="button" class="pull-right btn btn-default" id="sendEmail">Send--}}
{{--                            <i class="fa fa-arrow-circle-right"></i></button>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </section>--}}
{{--            <!-- /.Left col -->--}}
{{--            <!-- right col (We are only adding the ID to make the widgets sortable)-->--}}
{{--            <section class="col-lg-5 connectedSortable">--}}

{{--                <!-- Map box -->--}}
{{--                <div class="box box-solid bg-light-blue-gradient">--}}
{{--                    <div class="box-header">--}}
{{--                        <!-- tools box -->--}}
{{--                        <div class="pull-right box-tools">--}}
{{--                            <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip"--}}
{{--                                    title="Date range">--}}
{{--                                <i class="fa fa-calendar"></i></button>--}}
{{--                            <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse"--}}
{{--                                    data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">--}}
{{--                                <i class="fa fa-minus"></i></button>--}}
{{--                        </div>--}}
{{--                        <!-- /. tools -->--}}

{{--                        <i class="fa fa-map-marker"></i>--}}

{{--                        <h3 class="box-title">--}}
{{--                            Visitors--}}
{{--                        </h3>--}}
{{--                    </div>--}}
{{--                    <div class="box-body">--}}
{{--                        <div id="world-map" style="height: 250px; width: 100%;"></div>--}}
{{--                    </div>--}}
{{--                    <!-- /.box-body-->--}}
{{--                    <div class="box-footer no-border">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">--}}
{{--                                <div id="sparkline-1"></div>--}}
{{--                                <div class="knob-label">Visitors</div>--}}
{{--                            </div>--}}
{{--                            <!-- ./col -->--}}
{{--                            <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">--}}
{{--                                <div id="sparkline-2"></div>--}}
{{--                                <div class="knob-label">Online</div>--}}
{{--                            </div>--}}
{{--                            <!-- ./col -->--}}
{{--                            <div class="col-xs-4 text-center">--}}
{{--                                <div id="sparkline-3"></div>--}}
{{--                                <div class="knob-label">Exists</div>--}}
{{--                            </div>--}}
{{--                            <!-- ./col -->--}}
{{--                        </div>--}}
{{--                        <!-- /.row -->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /.box -->--}}

{{--                <!-- solid sales graph -->--}}
{{--                <div class="box box-solid bg-teal-gradient">--}}
{{--                    <div class="box-header">--}}
{{--                        <i class="fa fa-th"></i>--}}

{{--                        <h3 class="box-title">Sales Graph</h3>--}}

{{--                        <div class="box-tools pull-right">--}}
{{--                            <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>--}}
{{--                            </button>--}}
{{--                            <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="box-body border-radius-none">--}}
{{--                        <div class="chart" id="line-chart" style="height: 250px;"></div>--}}
{{--                    </div>--}}
{{--                    <!-- /.box-body -->--}}
{{--                    <div class="box-footer no-border">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">--}}
{{--                                <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"--}}
{{--                                       data-fgColor="#39CCCC">--}}

{{--                                <div class="knob-label">Mail-Orders</div>--}}
{{--                            </div>--}}
{{--                            <!-- ./col -->--}}
{{--                            <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">--}}
{{--                                <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"--}}
{{--                                       data-fgColor="#39CCCC">--}}

{{--                                <div class="knob-label">Online</div>--}}
{{--                            </div>--}}
{{--                            <!-- ./col -->--}}
{{--                            <div class="col-xs-4 text-center">--}}
{{--                                <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"--}}
{{--                                       data-fgColor="#39CCCC">--}}

{{--                                <div class="knob-label">In-Store</div>--}}
{{--                            </div>--}}
{{--                            <!-- ./col -->--}}
{{--                        </div>--}}
{{--                        <!-- /.row -->--}}
{{--                    </div>--}}
{{--                    <!-- /.box-footer -->--}}
{{--                </div>--}}
{{--                <!-- /.box -->--}}


{{--            </section>--}}
{{--            <!-- right col -->--}}
{{--        </div>--}}
        <!-- /.row (main row) -->

    </section>

    <section class="col-lg-12 connectedSortable">

           <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="#" method="post">

                <div class="form-group">
                  <input type="text" class="form-control" id="email_subject" placeholder="Subject">
                </div>
                <div>
                  <textarea class="textarea" id="email_message" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </form>
            </div>
            <div class="box-footer clearfix">
              <button type="button" class="pull-right btn btn-default emailBtn" id="sendEmail">Send
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>

    </section>







@stop

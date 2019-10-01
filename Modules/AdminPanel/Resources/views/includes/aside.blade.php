<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset(admin()->image)}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{admin()->full_name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> @lang('adminpanel::adminpanel.online')</a>
            </div>
        </div>

        <!-- start search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="@lang('adminpanel::adminpanel.search')">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- end search form -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">@lang('adminpanel::adminpanel.main_navigation')</li>

            <li class=" {{ active('/') }} treeview">
                <a href="{{ url('/admin') }}">
                    <i class="fa fa-dashboard"></i> <span>@lang('adminpanel::adminpanel.dashboard')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> <span>@lang('adminpanel::adminpanel.dashboard')</span></a></li>
                </ul>
            </li>

            @if ( auth()->guard('admin')->user()->can('read_admins'))
                <li class=" {{ active('admins') }} treeview">
                <a href="#">
                    <i class="fa fa-user-secret"></i> <span>@lang('admin::admin.admins')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('admins.index') }}"><i class="fa fa-user-secret"></i> @lang('admin::admin.admins')</a></li>
                    @if ( auth()->guard('admin')->user()->can('add_admins'))
                        <li><a href="{{ route('admins.create') }}"><i class="fa fa-plus"></i> @lang('adminpanel::adminpanel.add')</a></li>
                    @endif
                </ul>
            </li>
            @endif

            @if ( auth()->guard('admin')->user()->can('read_portfolio_category'))
                <li class=" {{ active('portfolio_category') }} treeview">
                <a href="#">
                    <i class="fa fa-gallery"></i> <span>@lang('admin::admin.portfolio_category')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('categories.index') }}"><i class="fa fa-gallery"></i> @lang('admin::admin.admins')</a></li>
                    @if ( auth()->guard('admin')->user()->can('add_admins'))
                        <li><a href="{{ route('categories.create') }}"><i class="fa fa-plus"></i> @lang('adminpanel::adminpanel.add')</a></li>
                    @endif
                </ul>
            </li>
            @endif



            @if(auth()->guard('admin')->user()->can('read_configs') )
            <li class=" {{ active('configs') }} treeview">
                <a href="#">
                    <i class="fa fa-cog"></i> <span>@lang('config::config.configs')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="active">
                        <a href="{{ route('configs.index') }}"><i class="fa fa-cog"></i>
                            @lang('config::config.configs')
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

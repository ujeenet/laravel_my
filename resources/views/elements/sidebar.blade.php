<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>
                    {{--@if(Auth::user())--}}

                        {{--{{(Auth::user()->profile->name) }}{{(Auth::user()->profile->lastname)}}--}}

                    {{--@endif--}}
                </p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
                <a href="#"><i class="fa fa-list"></i><span>Projects</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    <ul class="treeview-menu">
{{-- I send status by numbers because VUE JS does not wat to accept strings.--}}
                        <li><a href="/project/index/0">All</a></li>
                        <li><a href="/project/index/1">In-process</a></li>
                        <li><a href="/project/index/2">On-hold</a></li>
                        <li><a href="/project/index/3">Finished</a></li>
                    </ul>
            <li><a href="/resource/index"><i class="fa fa-user"></i> <span>Resources</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-list"></i> <span>Repports</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#">Month</a></li>
                    <li><a href="#">Year</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
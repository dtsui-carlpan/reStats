@if (Auth::guest())
    @yield('content')
@else
    <div class="container-fluid">
        <div class="row">
            <!-- Dashboard sidebar -->
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li><a href="#">Overview</a></li>
                    <li><a href="#">Analytics</a></li>
                </ul>
            </div>

            <!-- Dashboard main -->
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Monday</h1>

                <!-- main content in the dashboard -->
                @yield('dashboard-main')

            </div>
        </div>
    </div>
@endif

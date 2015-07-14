<!-- Navigation top bar after Login -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('home') }}">Amigo!</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i>
                {{ Auth::user()->name }}<b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i>Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ url('/auth/logout') }}"><i class="fa fa-fw fa-power-off"></i>Log Out</a>
                </li>
            </ul>
        </li>
    </ul>

    <!-- Dashboard sidebar -->
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <!--<div class="col-sm-3 col-md-2">-->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{{ url('home/') }}">
                    <i class="fa fa-fw fa-dashboard"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo1">
                    <i class="fa fa-fw fa-bar-chart-o"></i>
                    Analytics
                    <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="demo1" class="collapse">
                    <li><a href="{{ url('home/departments') }}">Department</a></li>
                    <li><a href="#">Invoice</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo2">
                    <i class="fa fa-fw fa-arrows-v"></i>
                    Dropdown
                    <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="demo2" class="collapse">
                    <li><a href="#">Dropdown Item</a></li>
                    <li><a href="#">Dropdown Item</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

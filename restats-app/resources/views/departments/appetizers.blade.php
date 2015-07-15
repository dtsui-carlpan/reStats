@extends('app')

@section('dashboard-main')
    <!-- Top Panel -->
    <div class="row" id="bod-1">
        <div class="col-md-3">
            <div class="panel panel-default top-panel">
                <div class="panel-heading main-header">营业额</div>
                <div class="panel-body text-center" id="p1">
                    <h1>¥78090.90</h1>
                </div>
                <div class="panel-footer">今天</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default top-panel">
                <div class="panel-heading main-header">毛利</div>
                <div class="panel-body text-center" id="p2">
                    45.7%
                </div>
                <div class="panel-footer">今天</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default top-panel">
                <div class="panel-heading main-header">开房率</div>
                <div class="panel-body text-center" id="p3">
                    66.7%
                </div>
                <div class="panel-footer">今天</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default top-panel">
                <div class="panel-heading main-header">采购使用率</div>
                <div class="panel-body text-center" id="p4">
                    83.3%
                </div>
                <div class="panel-footer">今天</div>
            </div>
        </div>
    </div>

    <!-- Main Panel -->
    <!-- Appetizer Sales by Month -->
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i>
                Appetizers
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            Options<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-11">
                    <canvas id="appetizer-reports"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Panel continued -->
    <div class="row">
        <!-- ############################################# -->
        <!-- # Left col/panel for Top items              # -->
        <!-- # Showing pie graph comparisons and table   # -->
        <!-- ############################################# -->
        <div class="col-md-6">
            <div class="panel panel-default left-panel">
                <div class="panel-heading left-panel-header">
                    本月销售排名
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                Options<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="panel-body">

                    <!-- nested pie graph panel -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-11">
                                <canvas id="top-appetizers"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- nested table summary panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Top Sales by Revenue
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                        @foreach ($topItems as $name => $rev)
                                            <tr>
                                                <td>{{ $name }}</td>
                                                <td>¥ {{ $rev[0] }}</td>
                                                <td>¥ {{ $rev[1] }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ############################################# -->
        <!-- # Right col/panel for Top items             # -->
        <!-- # Showing pie graph comparisons and table   # -->
        <!-- ############################################# -->
        <div class="col-md-6">
            <div class="panel panel-default left-panel">
                <div class="panel-heading left-panel-header">
                    本月销售排名
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                Options<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="panel-body">

                    <!-- nested pie graph panel -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-11">
                                <canvas id="least-appetizers"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- nested table summary panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Top Sales by Revenue
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                        @foreach ($leastItems as $name => $rev)
                                            <tr>
                                                <td>{{ $name }}</td>
                                                <td>¥ {{ $rev[0] }}</td>
                                                <td>¥ {{ $rev[1] }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script>
        (function() {
            // appetizer by month
            var ctx_app = document.getElementById('appetizer-reports').getContext('2d');
            var appetizers = {
                labels: ['一月', '二月', '三月', '四月', '五月', '六月', '七月'],
                datasets: [{
                    data: <?php echo $appetizers; ?>,
                    fillColor: "#46BFBD",
                    strokeColor: "#46BFBD",
                    pointColor: "#46BFBD"
                }]
            };
            new Chart(ctx_app).Bar(appetizers,
                    {responsive: true, barValueSpacing: 10});

        })();

    </script>

@endsection
@extends('app')

@section('dashboard-main')
    <!-- Top Panel -->
    <div class="row" id="bod-1">
        <div class="col-md-3">
            <div class="panel panel-default top-panel">
                <div class="panel-heading main-header">营业额</div>
                <div class="panel-body text-center" id="p1">
                    ¥78090.90
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

    <!-- main panel -->
    <div class="col-lg-6">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i>
                    Bars
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
                        <canvas id="bar-reports"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        (function() {
            // bar by months
            var ctx_bar = document.getElementById('bar-reports').getContext('2d');
            var bars = {
                labels: <?php echo $monthNames; ?>,
                datasets: [{
                    data: <?php echo $bars; ?>,
                    fillColor: "#46BFBD",
                    strokeColor: "#46BFBD",
                    pointColor: "#46BFBD"
                }]
            };
            new Chart(ctx_bar).Bar(bars, {responsive: true});
        })();

    </script>

@endsection
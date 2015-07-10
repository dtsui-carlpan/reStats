@extends('app')

@section('dashboard-main')
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i>Appetizers
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
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Pie Chart Table
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
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="col-md-12">
                                <canvas id="test"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                        <tr>
                                            <td>Appetizers</td>
                                            <td>$12,034</td>
                                            <td>40%</td>
                                        </tr>
                                        <tr>
                                            <td>Bars</td>
                                            <td>$1,334</td>
                                            <td>20%</td>
                                        </tr>
                                        <tr>
                                            <td>Seafood</td>
                                            <td>$345.10</td>
                                            <td>10%</td>
                                        </tr>
                                        <tr>
                                            <td>Entry General</td>
                                            <td>$5,400</td>
                                            <td>34%</td>
                                        </tr>
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
            // revenue by months
            /*
            var ctx_month = document.getElementById('month-reports').getContext('2d');
            var chart = {
                labels: ]
                datasets: [{
                    data: ,
                    fillColor: "#5B90BF",
                    strokeColor: "#5B90B",
                    pointColor: "#5B90B"
                }]
            };
            new Chart(ctx_month).Bar(chart, {responsive: true});*/

            // revenue by departments
            /*
            var ctx_depart = document.getElementById('department-reports').getContext('2d');
            var departments = {
                labels:
                datasets: [{
                    data:
                    fillColor: "#F7464A",
                    strokeColor: "#F7464A",
                    pointColor: "#F7464A"
                }]
            };
            new Chart(ctx_depart).Bar(departments, {responsive: true});*/

            // appetizer by month
            var ctx_app = document.getElementById('appetizer-reports').getContext('2d');
            var appetizers = {
                labels: <?php echo $monthNames; ?>,
                datasets: [{
                    data: <?php echo $appetizers; ?>,
                    fillColor: "#46BFBD",
                    strokeColor: "#46BFBD",
                    pointColor: "#46BFBD"
                }]
            };
            new Chart(ctx_app).Bar(appetizers, {responsive: true});


            var testData = [
                {
                    value: 300,
                    color:"#F7464A",
                    highlight: "#FF5A5E",
                    label: "Red"
                },
                {
                    value: 50,
                    color: "#46BFBD",
                    highlight: "#5AD3D1",
                    label: "Green"
                },
                {
                    value: 100,
                    color: "#FDB45C",
                    highlight: "#FFC870",
                    label: "Yellow"
                }
            ];

            $(document).ready(
                    function () {
                        var ctx = document.getElementById("test").getContext("2d");
                        var myNewChart = new Chart(ctx).Pie(testData);

                        $("#test").click(
                                function(evt){
                                    var activePoints = myNewChart.getSegmentsAtEvent(evt);
                                    //var url = "http://example.com/?label=" + activePoints[0].label + "&value=" + activePoints[0].value;
                                    window.location.href = "<?php echo URL::to('items/details'); ?>";
                                }
                        );
                    }
            );


            // bar by month
            /*
            var ctx_bar = document.getElementById('bar-reports').getContext('2d');
            var bars = {
                labels:
                datasets: [{
                    data:
                    fillColor: "#46BFBD",
                    strokeColor: "#46BFBD",
                    pointColor: "#46BFBD"
                }]
            };
            new Chart(ctx_bar).Bar(bars, {responsive: true});*/
        })();


    </script>
@endsection

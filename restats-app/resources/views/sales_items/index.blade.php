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
                <div class="panel-heading main-header">开房率</div>
                <div class="panel-body text-center" id="p3">
                    66.7%
                </div>
                <div class="panel-footer">今天</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default top-panel">
                <div class="panel-heading main-header">服务员对客人比例</div>
                <div class="panel-body text-center" id="p2">
                    1:7
                </div>
                <div class="panel-footer">今天</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default top-panel">
                <div class="panel-heading main-header">人员流失率</div>
                <div class="panel-body text-center" id="p4">
                    8.7%
                </div>
                <div class="panel-footer">今天</div>
            </div>
        </div>
    </div>


    <!-- Main Panel -->
    <div class="row">
        <!-- ############################################# -->
        <!-- # Left col/panel for Year                   # -->
        <!-- # Showing bar graph comparisons and table   # -->
        <!-- ############################################# -->
        <div class="col-md-6" id="left">
            <div class="panel panel-default left-panel">
                <div class="panel-heading left-panel-header">
                    个月营业额（当年）
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

                    <!-- nested bar graph panel -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-11">
                                <canvas id="month-reports"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- nested pie chart panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            各类消费统计
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <canvas id="type-reports"></canvas>
                            </div>
                        </div>
                    </div>
                </div> <!-- end outer left panel body -->
            </div> <!-- outer left panel -->
        </div> <!-- end left col -->

        <!-- ############################################# -->
        <!-- # Right col/panel for Department            # -->
        <!-- # Showing bar graph comparisons and table   # -->
        <!-- ############################################# -->
        <div class="col-md-6" id="right">
            <div class="panel panel-default right-panel">
                <div class="panel-heading right-panel-header">
                    各部门营业额（当月）
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

                    <!-- nested bar graph panel -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-11">
                                <canvas id="department-reports"></canvas>
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
                                        @foreach ($topCurrentItems as $name => $rev)
                                            <tr>
                                                <td>{{ $name }}</td>
                                                <td>¥ {{ $rev }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end outer right panel body -->
            </div> <!-- outer right panel -->
        </div> <!-- end right col -->
    </div>
@endsection

@section('footer')
    <script>
        (function() {
            /*********************
             * revenue by months *
             *********************/
            var chart = {
                labels: <?php echo $monthNames; ?>,
                datasets: [{
                    data: <?php echo $monthTotals; ?>,
                    fillColor: "#5B90BF",
                    strokeColor: "#5B90B",
                    pointColor: "#5B90B"
                }]
            };

            /**************************
             * revenue by departments *
             **************************/
            var departments = {
                labels: <?php echo $departNames; ?>,
                datasets: [{
                    data: <?php echo $departTotals; ?>,
                    fillColor: "#F7464A",
                    strokeColor: "#F7464A",
                    pointColor: "#F7464A"
                }]
            };


            // adding DOM events and plotting
            $(document).ready(
                function() {
                    // month
                    var ctx_month = document.getElementById('month-reports').getContext('2d');
                    var monthChart = new Chart(ctx_month).Bar(chart, {responsive: true});
                    // department
                    var ctx_depart = document.getElementById('department-reports').getContext('2d');
                    var departChart = new Chart(ctx_depart).Bar(departments, {responsive: true});

                    // month event
                    $("#month-reports").click(
                            function(evt) {
                                var activeBars = monthChart.getBarsAtEvent(evt);
                                window.location.href = '{{ URL::to('home/details') }}';
                            }
                    );

                    // department event
                    $("#department-reports").click(
                        function(evt) {
                            var departName;
                            var activeDepartPoints = departChart.getBarsAtEvent(evt);
                            var departValue = activeDepartPoints[0].value;
                            var departBars = departChart.datasets[0].bars;

                            for (var index = 0; index < departBars.length; index++) {
                                // retrieve label based on index matching
                                if (departBars[index].value == departValue) {
                                    // use departNames array passed from index method
                                    departName = departNames[index];
                                    var departUrl = '{{ URL::to('home/:id') }}';
                                    departUrl = departUrl.replace(':id', departName.toLowerCase());
                                    window.location.href = departUrl;
                                    //console.log(departName.toLowerCase());
                                    //console.log(departValue);
                                }
                            }
                        }
                    );

                    // temporary
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
                                var ctx = document.getElementById("type-reports").getContext("2d");
                                var myNewChart = new Chart(ctx).Pie(testData);

                                $("#type-reports").click(
                                        function(evt){
                                            var activePoints = myNewChart.getSegmentsAtEvent(evt);
                                            window.location.href = "<?php echo URL::to('home/details'); ?>";
                                        }
                                );
                            }
                    );
                }
            );



        })();


    </script>
@endsection

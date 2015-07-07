@extends('app')

@section('content')

    <!--suppress BadExpressionStatementJS -->
    <div class="container plot-page">
        <!-- revenue by month -->
        <div class="row">
            <div class="col-md-10">
                <div class="col-md-12">
                    <canvas id="month-reports"></canvas>
                </div>
            </div>

            <div class="col-md-2">
                <div class="col-md-12">
                    <div class="list-group">
                        <a href="#" class="list-group-item">Year</a>
                        <a href="#" class="list-group-item active">Month</a>
                        <a href="#" class="list-group-item">Day</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- revenue by department -->
        <div class="row voffset">
            <div class="col-md-10">
                <div class="col-md-12">
                    <canvas id="department-reports"></canvas>
                </div>
            </div>

            <div class="col-md-2">
                <div class="col-md-12">
                    <div class="list-group">
                        <a href="#" class="list-group-item">Year</a>
                        <a href="#" class="list-group-item active">Month</a>
                        <a href="#" class="list-group-item">Day</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- department by months -->
        <div class="row voffset">
            <h2>Appetizers</h2>
            <div class=col-md-12">
                <canvas id="appetizer-reports"></canvas>
            </div>
        </div>

        <div class="row voffset">
            <h2>Bar</h2>
            <div class=col-md-12">
                <canvas id="bar-reports"></canvas>
            </div>
        </div>
    </div>



@endsection

@section('footer')
    <script src="js/vendor/Chart.min.js"></script>

    <script>
        (function() {
            // revenue by months
            var ctx_month = document.getElementById('month-reports').getContext('2d');
            var chart = {
                labels: <?php echo $monthNames ?>,
                datasets: [{
                    data: <?php echo $monthTotals ?>,
                    fillColor: "#5B90BF",
                    strokeColor: "#5B90B",
                    pointColor: "#5B90B"
                }]
            };
            new Chart(ctx_month).Bar(chart, {responsive: true});

            // revenue by departments
            var ctx_depart = document.getElementById('department-reports').getContext('2d');
            var departments = {
                labels: <?php echo $departNames ?>,
                datasets: [{
                    data: <?php echo $departTotals ?>,
                    fillColor: "#F7464A",
                    strokeColor: "#F7464A",
                    pointColor: "#F7464A"
                }]
            };
            new Chart(ctx_depart).Bar(departments, {responsive: true});

            // appetizer by month
            var ctx_app = document.getElementById('appetizer-reports').getContext('2d');
            var appetizers = {
                labels: <?php echo $monthNames ?>,
                datasets: [{
                    data: <?php echo $appetizers ?>,
                    fillColor: "#46BFBD",
                    strokeColor: "#46BFBD",
                    pointColor: "#46BFBD"
                }]
            };
            new Chart(ctx_app).Bar(appetizers, {responsive: true});

            // bar by month
            var ctx_bar = document.getElementById('bar-reports').getContext('2d');
            var bars = {
                labels: <?php echo $monthNames ?>,
                datasets: [{
                    data: <?php echo $bars ?>,
                    fillColor: "#46BFBD",
                    strokeColor: "#46BFBD",
                    pointColor: "#46BFBD"
                }]
            };
            new Chart(ctx_bar).Bar(bars, {responsive: true});
        })();


    </script>
@endsection

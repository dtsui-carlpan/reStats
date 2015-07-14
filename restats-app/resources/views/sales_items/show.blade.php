@extends('app')

@section('dashboard-main')
    <div class="row">
        <!-- appetizers -->
        <div class="col-lg-6">
            <div class="col-md-12">
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
        </div>
        <!-- bar -->
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
    </div>


    <div class="row">
        <!-- dim sum -->
        <div class="col-lg-6">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i>
                        Dim Sum
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
                            <canvas id="dimsum-reports"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- product -->
        <div class="col-lg-6">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i>
                        Product
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
                            <canvas id="product-reports"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <!-- entree general -->
        <div class="col-lg-6">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i>
                        Entree General
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
                            <canvas id="general-reports"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Entree expensive -->
        <div class="col-lg-6">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i>
                        Entree Expensive
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
                            <canvas id="expensive-reports"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <!-- luxury -->
        <div class="col-lg-6">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i>
                        Luxury
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
                            <canvas id="luxury-reports"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- seafood -->
        <div class="col-lg-6">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i>
                        Seafood
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
                            <canvas id="seafood-reports"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- soup -->
        <div class="col-lg-6">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i>
                        Soup
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
                            <canvas id="soup-reports"></canvas>
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
                labels: <?php echo $monthNames; ?>,
                datasets: [{
                    data: <?php echo $appetizers; ?>,
                    fillColor: "#46BFBD",
                    strokeColor: "#46BFBD",
                    pointColor: "#46BFBD"
                }]
            };
            new Chart(ctx_app).Bar(appetizers, {responsive: true});

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

            // dimsum by months
            var ctx_dimsum = document.getElementById('dimsum-reports').getContext('2d');
            var dimsum = {
                labels: <?php echo $monthNames; ?>,
                datasets: [{
                    data: <?php echo $dimsum; ?>,
                    fillColor: "#46BFBD",
                    strokeColor: "#46BFBD",
                    pointColor: "#46BFBD"
                }]
            };
            new Chart(ctx_dimsum).Bar(dimsum, {responsive: true});

            // product by month
            var ctx_product = document.getElementById('product-reports').getContext('2d');
            var product = {
                labels: <?php echo $monthNames; ?>,
                datasets: [{
                    data: <?php echo $product; ?>,
                    fillColor: "#46BFBD",
                    strokeColor: "#46BFBD",
                    pointColor: "#46BFBD"
                }]
            };
            new Chart(ctx_product).Bar(product, {responsive: true});

            // entree general by month
            var ctx_general = document.getElementById('general-reports').getContext('2d');
            var general = {
                labels: <?php echo $monthNames; ?>,
                datasets: [{
                    data: <?php echo $general; ?>,
                    fillColor: "#46BFBD",
                    strokeColor: "#46BFBD",
                    pointColor: "#46BFBD"
                }]
            };
            new Chart(ctx_general).Bar(general, {responsive: true});

            // entree expensive by month
            var ctx_expensive = document.getElementById('expensive-reports').getContext('2d');
            var expensive = {
                labels: <?php echo $monthNames; ?>,
                datasets: [{
                    data: <?php echo $expensive; ?>,
                    fillColor: "#46BFBD",
                    strokeColor: "#46BFBD",
                    pointColor: "#46BFBD"
                }]
            };
            new Chart(ctx_expensive).Bar(expensive, {responsive: true});


            // luxury
            var ctx_luxury = document.getElementById('luxury-reports').getContext('2d');
            var luxury = {
                labels: <?php echo $monthNames; ?>,
                datasets: [{
                    data: <?php echo $luxury; ?>,
                    fillColor: "#46BFBD",
                    strokeColor: "#46BFBD",
                    pointColor: "#46BFBD"
                }]
            };
            new Chart(ctx_luxury).Bar(luxury, {responsive: true});

            // seafood
            var ctx_seafood = document.getElementById('seafood-reports').getContext('2d');
            var seafood = {
                labels: <?php echo $monthNames; ?>,
                datasets: [{
                    data: <?php echo $seafood; ?>,
                    fillColor: "#46BFBD",
                    strokeColor: "#46BFBD",
                    pointColor: "#46BFBD"
                }]
            };
            new Chart(ctx_seafood).Bar(seafood, {responsive: true});

            // soup
            var ctx_soup = document.getElementById('soup-reports').getContext('2d');
            var soup = {
                labels: <?php echo $monthNames; ?>,
                datasets: [{
                    data: <?php echo $soup; ?>,
                    fillColor: "#46BFBD",
                    strokeColor: "#46BFBD",
                    pointColor: "#46BFBD"
                }]
            };
            new Chart(ctx_soup).Bar(soup, {responsive: true});


        })();

    </script>

@endsection
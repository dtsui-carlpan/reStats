@extends('app')

@section('content')

    <!--suppress BadExpressionStatementJS -->
    <canvas id="sale-reports" width="1000" height="500"></canvas>

    <div class="container">
        <div class="total-rev">
            <h1>Sales Items</h1>
            @foreach($items as $item)
                <article>
                    <h2>{{ $item->name }}</h2>
                    <h2>{{ $item->revenue }}</h2>
                </article>
            @endforeach
        </div>
    </div>



@endsection

@section('footer')
    <script src="js/vendor/Chart.min.js"></script>

    <script>
        (function() {
            var ctx = document.getElementById('sale-reports').getContext('2d');
            var chart = {
                labels: <?php echo $names ?>,
                datasets: [{
                    data: <?php echo $totals ?>,
                    fillColor: "#f8b1aa",
                    strokeColor: "#bb574e",
                    pointColor: "#bb574e"
                }]
            };

            new Chart(ctx).Bar(chart);

        })();

    </script>
@endsection
@endsection
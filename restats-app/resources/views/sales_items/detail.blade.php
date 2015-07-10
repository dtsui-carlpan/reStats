@extends('app')

@section('dashboard-main')
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
                                <canvas id="bar"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                        @foreach ($pairs as $name => $rev)
                                            <tr>
                                                <td>{{ $name }}</td>
                                                <td>{{ $rev }}</td>
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
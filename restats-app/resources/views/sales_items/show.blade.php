@extends('app')

@section('dashboard-main')


    <div class="row" id="extend-up">
        <div class="col-md-4">
            <div class="panel panel-default top-panel">
                <div class="panel-heading main-header">今天</div>
                <div class="panel-body text-center" id="appetizer-panel">
                    <h1>Appetizer</h1>
                </div>
                <a href="{{ url('home/appetizers') }}">
                    <div class="panel-footer">
                        <span class="pull-left">浏览详情</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default top-panel">
                <div class="panel-heading main-header">今天</div>
                <div class="panel-body text-center" id="bar-panel">
                    <h1>Bar</h1>
                </div>
                <a href="{{ url('home/bar') }}">
                    <div class="panel-footer">
                        <span class="pull-left">浏览详情</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default top-panel">
                <div class="panel-heading main-header">今天</div>
                <div class="panel-body text-center" id="dimsum-panel">
                    <h1>Dimsum</h1>
                </div>
                <a href="{{ url('home/dimsum') }}">
                    <div class="panel-footer">
                        <span class="pull-left">浏览详情</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default top-panel">
                <div class="panel-heading main-header">今天</div>
                <div class="panel-body text-center" id="expensive-panel">
                    <h1>Entree Expensive</h1>
                </div>
                <a href="{{ url('home/entree_expensive') }}">
                    <div class="panel-footer">
                        <span class="pull-left">浏览详情</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default top-panel">
                <div class="panel-heading main-header">今天</div>
                <div class="panel-body text-center" id="general-panel">
                    <h1>Entree General</h1>
                </div>
                <a href="{{ url('home/entree_general') }}">
                    <div class="panel-footer">
                        <span class="pull-left">浏览详情</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default top-panel">
                <div class="panel-heading main-header">今天</div>
                <div class="panel-body text-center" id="luxury-panel">
                    <h1>Luxury</h1>
                </div>
                <a href="{{ url('home/luxury') }}">
                    <div class="panel-footer">
                        <span class="pull-left">浏览详情</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row" id="extend-down">
        <div class="col-md-4">
            <div class="panel panel-default top-panel">
                <div class="panel-heading main-header">今天</div>
                <div class="panel-body text-center" id="product-panel">
                    <h1>Product</h1>
                </div>
                <a href="{{ url('home/product') }}">
                    <div class="panel-footer">
                        <span class="pull-left">浏览详情</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default top-panel">
                <div class="panel-heading main-header">今天</div>
                <div class="panel-body text-center" id="seafood-panel">
                    <h1>Seafood</h1>
                </div>
                <a href="{{ url('home/seafood') }}">
                    <div class="panel-footer">
                        <span class="pull-left">浏览详情</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default top-panel">
                <div class="panel-heading main-header">今天</div>
                <div class="panel-body text-center" id="soup-panel">
                    <h1>Soup</h1>
                </div>
                <a href="{{ url('home/soup') }}">
                    <div class="panel-footer">
                        <span class="pull-left">浏览详情</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection

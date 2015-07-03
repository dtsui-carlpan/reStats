@extends('app')

@section('content')

    <div class="container">
        <div class="total-rev">
            <h1>Sales Items</h1>

            <article>
                <h2>{{ $item->name }}</h2>
                <h2>{{ $item->revenue }}</h2>
            </article>
        </div>
    </div>

@endsection
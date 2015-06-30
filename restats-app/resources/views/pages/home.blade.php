@extends('app')

@section('content')
    <div class="container intro-page">
        <div class="content">
            <div class="title">Amigo!</div>
            <div class="quote">{{ Inspiring::quote() }}</div>
        </div>
    </div>
@endsection
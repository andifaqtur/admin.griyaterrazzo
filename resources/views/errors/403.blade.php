@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="content">
            <h1>403</h1>
            <h4>{{ $exception->getMessage() }}</h4>
        </div>
    </div>
@endsection

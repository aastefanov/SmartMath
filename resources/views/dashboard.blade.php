@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1>Welcome to SmartMath</h1>
                    <p>To start, choose a category below</p>
                </div>
            </div>
        </div>

        <div class="row text-center">
            @foreach($categories as $category)
                <div class="btn-circle">
                    <a href="{{ url('/category/' . $category->id) }}">{{ $category->name }}</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

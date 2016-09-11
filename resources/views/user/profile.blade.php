@extends('layouts.app')

@section('content')
    Name: {{ $user->name }}
    Email: {{ $user->email }}
@endsection
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Categories</div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="col-md-8">Category</th>
                                    <th class="col-md-2">Problems</th>
                                    <th class="col-md-1">Edit</th>
                                    <th class="col-md-1">Delete</th>
                                </tr>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->problems()->get()->count() }}</td>
                                        <td><a class="btn btn-primary"
                                               href="{{ url('/admin/categories/edit/' . $category->id ) }}">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger"
                                               href="{{ url('/admin/categories/delete/' . $category->id ) }}">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

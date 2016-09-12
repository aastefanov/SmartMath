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
                                    <th class="col-md-9">Category</th>
                                    <th class="col-md-1">Problems</th>
                                    <th class="col-md-1">Edit</th>
                                    <th class="col-md-1">Delete</th>
                                </tr>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->problems()->get()->count() }}</td>
                                        <td><a class="btn btn-primary"
                                               href="{{ url('/admin/categories/' . $category->id . "/edit") }}">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger"
                                               onclick="checkDelete( {{ $category->id }} )">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-md-4 col-md-push-8">
                            <a class="btn btn-block btn-success" href="{{ url('/admin/categories/create') }}">
                                <span class="glyphicon glyphicon-plus"></span> Create new category</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_footer')
    <script>
        function checkDelete(id) {
            if (confirm('Are you sure you want to delete the category?')) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('/admin/categories') }}" + "/" + id,
                    data: {_token: "{{csrf_token()}}"},
                    success: function () {
                        window.location.reload();
                    }
                });
            }
        }
    </script>
@endsection
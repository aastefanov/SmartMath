@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit category</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/admin/categories/' . $category->id) }}" id="category_form">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ $category->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea id="description"
                                              name="description">{!! $category->description !!}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Edit Category
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="panel panel-default">
                            <div class="panel-heading">Problems</div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="col-md-9">Problem</th>
                                            <th class="col-md-1">Difficulty</th>
                                            <th class="col-md-1">Edit</th>
                                            <th class="col-md-1">Delete</th>
                                        </tr>
                                        @foreach($category->problems()->get() as $problem)
                                            <tr>
                                                <td>{!! $problem->description !!}</td>
                                                <td>{{ $problem->difficulty }}</td>
                                                <td><a class="btn btn-primary"
                                                       href="{{ url('/admin/problems/' . $problem->id . "/edit") }}">
                                                        <span class="glyphicon glyphicon-edit"></span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger"
                                                       onclick="checkDelete( {{ $problem->id }} )">
                                                        <span class="glyphicon glyphicon-trash"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                                <div class="col-md-4 col-md-push-8">
                                    <a class="btn btn-block btn-success" href="{{ url('/admin/problems/create/' . $category->id) }}">
                                        <span class="glyphicon glyphicon-plus"></span> Create new problem</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_footer')
    <script src="/js/summernote.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#description').summernote({
                minHeight: 200,
                focus: false
            });
        });
    </script>
@endsection

@section('js_footer')
    <script>
        function checkDelete(id) {
            if (confirm('Are you sure you want to delete the user?')) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('/admin/problems') }}" + "/" + id,
                    data: {_token: "{{csrf_token()}}"},
                    success: function () {
                        window.location.reload();
                    }
                });
            }
        }
    </script>
@endsection

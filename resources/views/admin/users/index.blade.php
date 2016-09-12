@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @if (session('status'))
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
            <br/>
        @endif

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="col-md-5">Email</th>
                                    <th class="col-md-4">Name</th>
                                    <th class="col-md-1">Admin</th>
                                    <th class="col-md-1">Edit</th>
                                    <th class="col-md-1">Delete</th>
                                </tr>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            <span class="glyphicon glyphicon-{{ $user->isAdmin()?"ok":"remove" }}"></span>
                                        </td>
                                        <td><a class="btn btn-primary"
                                               href="{{ url('/admin/users/' . $user->id . "/edit") }}">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger"
                                               onclick="checkDelete( {{ $user->id }} )">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-md-4 col-md-push-8">
                            <a class="btn btn-block btn-success" href="{{ url('/admin/users/create') }}">
                                <span class="glyphicon glyphicon-plus"></span> Create new user</a>
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
            if (confirm('Are you sure you want to delete the user?')) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('/admin/users') }}" + "/" + id,
                    data: {_token: "{{csrf_token()}}"},
                    success: function () {
                        window.location.reload();
                    }
                });
            }
        }
    </script>
@endsection
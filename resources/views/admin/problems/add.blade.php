@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit problem</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/admin/problems') }}" id="problem_form">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea id="description"
                                              name="description">{!! old('description') !!}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                                <label for="answer" class="col-md-4 control-label">Answer</label>

                                <div class="col-md-6">
                                    <textarea id="answer"
                                              name="answer">{!! old('answer') !!}</textarea>
                                    @if ($errors->has('answer'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('answer') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('difficulty') ? ' has-error' : '' }}">
                                <label for="difficulty" class="col-md-4 control-label">Difficulty</label>

                                <div class="col-md-6">
                                    <input id="difficulty" type="number" class="form-control" min="1" max="10"
                                           name="difficulty" required value="{{ old('difficulty') }}">
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('difficulty') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" id="category_id" name="category_id" value="{{ $category->id }}" required>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create Problem
                                    </button>
                                </div>
                            </div>
                        </form>
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
	    
	    $('#answer').summernote({
                minHeight: 100,
                focus: false
            });
        });
    </script>
@endsection

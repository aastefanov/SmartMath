@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-push-3">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">
						Problem
					</div>
					<div class="panel-body">
						{!! $problem->description !!}
						<br/>
	
						<div id="solve-buttons">
							<h3 class="text-center">Can you solve the problem?</h3>
							<div class="row">
								<div class="col-sm-6">
									<a class="btn btn-primary btn-block" id="solve-yes" onclick="solve()">
										Yes
									</a>
								</div>
								<div class="col-sm-6">
									<a class="btn btn-default btn-block" id="solve-no" onclick="skip()">
										No	
									</a>
								</div>
							</div>

						</div>
						<div id="answer-section" style="display: none;">
							<h2>The answer is: {!! $problem->answer !!}</h3>
						<div id="answer-confirm" style="display: none;">
							<h3 class="text-center">Is this your answer?</h2>
							<div class="row">
								<div class="col-sm-6">
									<a class="btn btn-primary btn-block" id="solve-correct" onclick="correct()">
										Yes
									</a>
								</div>
								<div class="col-sm-6">
									<a class="btn btn-default btn-block" id="solve-incorrect" onclick="incorrect()">
										No	
									</a>
								</div>
							</div>
						</div>

							<div id="next-step" style="display: none;">
							<h3 class="text-center">Would you like to get another question?</h2>
							<div class="row">
								<div class="col-sm-6">
									<a class="btn btn-primary btn-block" id="another-yes" onclick="nextQuestion()">
										Yes
									</a>
								</div>
								<div class="col-sm-6">
									<a class="btn btn-default btn-block" id="another-no" onclick="dashboard()">
										No	
									</a>
								</div>
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
<script>

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

function solve() {
	$('#answer-section').show();	
	$('#solve-buttons').hide();
	$('#answer-confirm').show();
}

function skip() {
	$('#answer-section').show();
	$('#solve-buttons').hide();
	$('#next-step').show();

	    $.ajax({
	               type: "POST",
		       url: '{{ url('/problems/solve/' . $problem->id) }}',
		       data: '{{csrf_token()}}", "correct": "false", "problem": "{{ $problem->id }}"}', // serializes the form's elements.
		       success: function(data)
		       {
			       console.log("solve successful");
			},

		       error: function(XMLHttpRequest, textStatus, errorThrown) { 
       				 console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
   			 }    
	});
}

function correct() {
	//$('#correct-only').show();
	$('#next-step').show();
		    $.ajax({
	               type: "POST",
		       url: '{{ url('/problems/solve/' . $problem->id) }}',
		       data: '{"_token": "{{csrf_token()}}", "correct": "true", "problem": "{{$problem->id}}" }', // serializes the form's elements.
		       success: function(data)
		       {
			       console.log("solve successful");
			},

		       error: function(XMLHttpRequest, textStatus, errorThrown) { 
       				 console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
   			 }    
	});
}

function incorrect() {
	//$('#incorrect-only').show();
	$('#next-step').show();
		    $.ajax({
	               type: "POST",
		       url: '{{ url('/problems/solve/' . $problem->id) }}',
		       data: '{"_token": "{{csrf_token()}}", "correct": "true", "problem": "{{$problem->id}}"}', // serializes the form's elements.
		       success: function(data)
		       {
			       console.log("solve successful");
			},

		       error: function(XMLHttpRequest, textStatus, errorThrown) { 
       				 console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
   			 }    
	});
}

function nextQuestion() {
	window.location.reload();
}

function dashboard() {
	window.location = "{{ url('/') }}";
}
</script>
@endsection

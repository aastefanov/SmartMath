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
						<div id="correct-only" style="display: none;">
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
							<h3 class="text-center">Would you like to get another problem?</h2>
							<div class="row">
								<div class="col-sm-6">
									<a class="btn btn-primary btn-block" id="solve-correct" onclick="nextQuestion()">
										Yes
									</a>
								</div>
								<div class="col-sm-6">
									<a class="btn btn-default btn-block" id="solve-incorrect" onclick="dashboard()">
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
function solve() {
	$('#answer-section').show();	
	$('#solve-buttons').hide();
}

function skip() {
	$('#answer-section').show();
	$('#solve-buttons').hide();
}

function correct() {
	$('#correct-only').show();
}

function incorrect() {
	$('#incorrect-only').show();
}
</script>
@endsection

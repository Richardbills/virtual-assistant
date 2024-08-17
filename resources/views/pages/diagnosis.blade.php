@extends('layouts.fe-layout')
@section('body')
		<!-- Assistant Page -->
		<section class="error-page section" style="padding: 50px 0px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3 col-12">
						
                        <!-- Assistant Inner -->
						<div class="error-inner">
							

							<div id="app">
								<ExampleComponent></ExampleComponent>
							</div>
                            <img id="assistant" src="{{asset('img/eb-assistant.png')}}" alt="EB Assistant">
                            <br><br><hr><br>
                            <h1><span>Let's get started</span></h1>
							<p>Feel free to summarize how you feel and let's help you identify what the issue might be</p>
							<form class="search-form">
								<input placeholder="Search : I feel fed up with life" type="text">
								<button class="btn" type="submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
						<!--/ End Assistant Inner -->

					</div>
				</div>
			</div>
		</section>	
		<!--/ End Assistant Page -->
@endsection
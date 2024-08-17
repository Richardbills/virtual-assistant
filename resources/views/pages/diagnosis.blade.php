@extends('layouts.fe-layout')
@section('body')
		<!-- Assistant Page -->
		<section class="error-page section" style="padding: 20px 0px;">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3 col-12">

                        <!-- Assistant Inner -->
						<div class="error-inner">

							<div id="app">
								<assistant-component></assistant-component>

                                {{-- <router-view></router-view>
                                <nav>
                                    <router-link to="/">Home</router-link>
                                    <router-link to="/about">About</router-link>
                                </nav>
                                <router-view></router-view> --}}


							</div>

						</div>
						<!--/ End Assistant Inner -->

					</div>
				</div>
			</div>
		</section>
		<!--/ End Assistant Page -->
@endsection

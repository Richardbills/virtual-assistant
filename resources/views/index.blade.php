@extends('layouts.fe-layout')
@section('body')
		<!-- Slider Area -->
		<section class="slider">
			<div class="hero-slider">
				<!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url('img/slider2.jpg')">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1>We Provide <span>Depression</span> Care That You Can <span>Trust!</span></h1>
									<p>Expert diagnosis and personalized treatment plans to help you manage and overcome depression.</p>
									<div class="button">
										<a href="{{route('diagnosis')}}" class="btn">Get a Diagnosis</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single Slider -->
				<!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url('img/slider.jpg')">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1>Your Path to <span>Depression</span> Recovery Starts <span>Here!</span></h1>
									<p>Our team is dedicated to accurate diagnosis and effective treatments to support your mental health journey.</p>

									<div class="button">
										<a href="{{route('diagnosis')}}" class="btn">Get a Diagnosis</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Start End Slider -->
				<!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url('img/slider3.jpg')">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1>Comprehensive <span>Depression</span> Treatment You Can <span>Rely On!</span></h1>
									<p>We offer evidence-based therapies and compassionate care tailored to your specific needs.</p>

									<div class="button">
										<a href="{{route('diagnosis')}}" class="btn">Get a Diagnosis</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single Slider -->
			</div>
		</section>
		<!--/ End Slider Area -->
		
		<!-- Start Schedule Area -->
		<section class="schedule">
			<div class="container">
				<div class="schedule-inner">
					<div class="row">
						<div class="col-lg-4 col-md-6 col-12 ">
							<!-- single-schedule -->
							<div class="single-schedule first">
								<div class="inner">
									<div class="icon">
										<i class="fa fa-ambulance"></i>
									</div>
									<div class="single-content">
										<span>In times of emotional distress</span>
										<h4>Care is Crucial</h4>
										<p>Our dedicated team is here to provide timely support and effective treatment to help you navigate through challenging moments.</p>
										<a href="#">LEARN MORE<i class="fa fa-long-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-12">
							<!-- single-schedule -->
							<div class="single-schedule middle">
								<div class="inner">
									<div class="icon">
										<i class="icofont-prescription"></i>
									</div>
									<div class="single-content">
										<span>Accessible Depression Care</span>
										<h4>Expert Appointment Scheduling</h4>
										<p>Finding the right time to seek help is essential for managing depression effectively.</p>
										<a href="#">LEARN MORE<i class="fa fa-long-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-12 col-12">
							<!-- single-schedule -->
							<div class="single-schedule last">
								<div class="inner">
									<div class="icon">
										<i class="icofont-ui-clock"></i>
									</div>
									<div class="single-content">
										<span>Care Centers</span>
										<h4>Opening Hours</h4>
										<ul class="time-sidual">
											<li class="day">Monday - Friday <span>8.00 AM - 8.00 PM</span></li>
											<li class="day">Saturday <span>8.00 AM - 8.00 PM</span></li>
											<li class="day">Sunday - Our chatbot is on call, because even on weekends, it's not taking a nap!</li>
										</ul>
										<a href="#">LEARN MORE<i class="fa fa-long-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/End Start schedule Area -->
		
		<!-- Start Feedback Area -->
		<section class="newsletter section">
			<div class="container">
				<div class="row ">
					<div class="col-lg-6  col-12">
						<!-- Start Feedback Form -->
						<div class="subscribe-text ">
							<h6>Feedback</h6>
							<p class="">You can kindly provide us your anonymous,<br> Feedback and suggestions.</p>
						</div>
						<!-- End Feedback Form -->
					</div>
					<div class="col-lg-6  col-12">
						<!-- Start Feedback Form -->
						<div class="subscribe-form ">
							<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
								<input name="feedback" placeholder="How did we make you feel" class="common-input" onfocus="this.placeholder = ''"
									onblur="this.placeholder = 'How did we make you feel'" required="" type="text">
								<button class="btn">Submit Feedback</button>
							</form>
						</div>
						<!-- End Feedback Form -->
					</div>
				</div>
			</div>
		</section>
		<!-- /End Feedback Area -->
@endsection
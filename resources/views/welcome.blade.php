@extends('layouts.app')
@section('content')
@include('inc.header')

<!--Banner Section-->
<section class="banner-section">
		<div class="patern-layer-one" style="background-image: url({{ asset('assets/landing/images/background/1.png')}})"></div>
		<div class="patern-layer-two" style="background-image: url({{ asset('assets/landing/images/background/pattern-1.png')}})"></div>
		<!-- <div class="patern-layer-three" style="background-image: url({{ asset('assets/landing/images/background/pattern-2.png')}})"></div>
		<div class="patern-layer-four" style="background-image: url({{ asset('assets/landing/images/background/pattern-3.png')}})"></div> -->
		<div class="patern-layer-five" style="background-image: url({{ asset('assets/landing/images/background/pattern-4.png')}})"></div>
		<div class="patern-layer-six" style="background-image: url({{ asset('assets/landing/images/background/pattern-5.png')}})"></div>
		<div class="patern-layer-seven" style="background-image: url({{ asset('assets/landing/images/background/pattern-6.png')}})"></div>
		<div class="patern-layer-eight" style="background-image: url({{ asset('assets/landing/images/background/pattern-7.png')}})"></div>
		<div class="patern-layer-nine" style="background-image: url({{ asset('assets/landing/images/background/pattern-8.png')}})"></div>
		
		<div class="main-slider-carousel owl-carousel owl-theme">
            
            <div class="slide">
		
				<div class="auto-container">
					<div class="row clearfix">
								
						<!-- Content Column -->
						<div class="content-column col-lg-6 col-md-12 col-sm-12">
							<div class="inner-column">
								<h1 class="text-white">Buy and Sell <br> Products Online<br></h1>
								<div class="text">Buy product of various categories<br> on Peddle app. Create and upload products for sale</div>
								<div class="btns-box">
									<a href="about.html" class="theme-btn btn-style-one"><span class="txt">Download Now</span></a>
								</div>
							</div>
						</div>
						
						<!-- Image Column -->
						<div class="image-column col-lg-6 col-md-12 col-sm-12">
							<div class="inner-column parallax-scene-1">
								<div class="image" data-depth="0.10">
									<img src="{{ asset('assets/landing/images/resource/aaxa.png')}}" alt="" />
								</div>
								<div class="image-two" data-depth="0.10">
									<!-- <img src="{{ asset('assets/landing/images/resource/mobile-2.png')}}" alt="" /> -->
								</div>
							</div>
						</div>
						
					</div>
				</div>
				
			</div>
			
			 <div class="slide">
		
				<div class="auto-container">
					<div class="row clearfix">
								
						<!-- Content Column -->
						<div class="content-column col-lg-6 col-md-12 col-sm-12">
							<div class="inner-column">
								<h1>Resell Other Products <br> & Get Paid <br></h1>
								<div class="text">Don't have a product to sell? <br> No problem. You can resell other vendor's products and make money off them</div>
								<div class="btns-box">
									<a href="about.html" class="theme-btn btn-style-one"><span class="txt">Discover Now!</span></a>
								</div>
							</div>
						</div>
						
						<!-- Image Column -->
						<div class="image-column col-lg-6 col-md-12 col-sm-12">
							<div class="inner-column parallax-scene-2">
								<div class="image" data-depth="0.30">
									<img src="{{ asset('assets/landing/images/resource/aaxa.png')}}" alt="" />
								</div>
								<div class="image-two" data-depth="0.30">
									<!-- <img src="{{ asset('assets/landing/images/resource/mobile-2.png')}}" alt="" /> -->
								</div>
							</div>
						</div>
						
					</div>
				</div>
				
			</div>
			
			 <div class="slide">
		
				<div class="auto-container">
					<div class="row clearfix">
								
						<!-- Content Column -->
						<div class="content-column col-lg-6 col-md-12 col-sm-12">
							<div class="inner-column">
								<h1>Secure Escrow Payments <br> </h1>
								<div class="text">Worried about releasing funds for a damaged or fake product? <br> With our secure escrow service, we've got you covered</div>
								<div class="btns-box">
									<a href="about.html" class="theme-btn btn-style-one"><span class="txt">Discover Now!</span></a>
								</div>
							</div>
						</div>
						
						<!-- Image Column -->
						<div class="image-column col-lg-6 col-md-12 col-sm-12">
							<div class="inner-column parallax-scene-3">
								<div class="image" data-depth="0.30">
									<img src="{{ asset('assets/landing/images/resource/aaxa.png')}}" alt="" />
								</div>
								<div class="image-two" data-depth="0.30">
									<!-- <img src="{{ asset('assets/landing/images/resource/mobile-2.png')}}" alt="" /> -->
								</div>
							</div>
						</div>
						
					</div>
				</div>
				
			</div>
			
		</div>
	</section>
	<!--End Banner Section-->
	
	<!-- Featured Section -->
    <section class="featured-section" id="services">
		<div class="icon-one" style="background-image: url({{ asset('assets/landing/images/icons/icon-1.png')}})"></div>
		<div class="icon-two" style="background-image: url({{ asset('assets/landing/images/icons/icon-2.png')}})"></div>
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title centered">
				<div class="title">Our Services</div>
				<h2>See Our Major Features <br> Below</h2>
			</div>
			<div class="row clearfix">
				
				<!-- Featured Block -->
				<div class="feature-block col-lg-4 col-md-4 col-dm-12">
					<div class="inner-box wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
						<a href="business.html" class="overlay-link"></a>
						<div class="icon-box">
							<span class="icon flaticon-smartphone"></span>
						</div>
						<h5>Buy and Sell Goods</h5>
					</div>
				</div>
				
				
				<!-- Featured Block -->
				<div class="feature-block col-lg-4 col-md-4 col-dm-12">
					<div class="inner-box wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
						<a href="business.html" class="overlay-link"></a>
						<div class="icon-box">
							<span class="icon flaticon-data"></span>
						</div>
						<h5>Secure Escrow Payment</h5>
					</div>
				</div>
				
				<!-- Featured Block -->
				<div class="feature-block col-lg-4 col-md-4 col-dm-12">
					<div class="inner-box wow fadeInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
						<a href="business.html" class="overlay-link"></a>
						<div class="icon-box">
							<span class="icon flaticon-technical-support"></span>
						</div>
						<h5>Direct Dropshipping</h5>
					</div>
				</div>
				
				<!-- Featured Block -->
				<!-- <div class="feature-block col-lg-3 col-md-4 col-dm-12">
					<div class="inner-box wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1500ms">
						<a href="business.html" class="overlay-link"></a>
						<div class="icon-box">
							<span class="icon flaticon-customer-service"></span>
						</div>
						<h5>24h Support</h5>
					</div>
				</div> -->
				
				<!-- Featured Block -->
				<!-- <div class="feature-block col-lg-3 col-md-4 col-dm-12">
					<div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
						<a href="business.html" class="overlay-link"></a>
						<div class="icon-box">
							<span class="icon flaticon-smartphone-1"></span>
						</div>
						<h5>Quick Access</h5>
					</div>
				</div>
				
		
				<div class="feature-block col-lg-3 col-md-4 col-dm-12">
					<div class="inner-box wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1500ms">
						<a href="business.html" class="overlay-link"></a>
						<div class="icon-box">
							<span class="icon flaticon-location-1"></span>
						</div>
						<h5>Track Anywhere</h5>
					</div>
				</div>
				
		
				<div class="feature-block col-lg-3 col-md-4 col-dm-12">
					<div class="inner-box wow fadeInRight" data-wow-delay="200ms" data-wow-duration="1500ms">
						<a href="business.html" class="overlay-link"></a>
						<div class="icon-box">
							<span class="icon flaticon-man"></span>
						</div>
						<h5>Manage User</h5>
					</div>
				</div>
				
			
				<div class="feature-block col-lg-3 col-md-4 col-dm-12">
					<div class="inner-box wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
						<a href="business.html" class="overlay-link"></a>
						<div class="icon-box">
							<span class="icon flaticon-database"></span>
						</div>
						<h5>Daily Update</h5>
					</div>
				</div> -->
				
			</div>
		</div>
	</section>
	<!-- End Featured Section -->
	
	<!-- Email Section -->
    <section class="email-section">
		<div class="icon-layer-one" style="background-image: url({{ asset('assets/landing/images/background/pattern-4.png')}})"></div>
		<div class="icon-layer-two" style="background-image: url({{ asset('assets/landing/images/icons/icon-3.png')}})"></div>
		<div class="auto-container">
			<div class="row clearfix">
				
				<!-- Content Column -->
				<div class="content-column col-lg-5 col-md-12 col-sm-12">
					<div class="inner-column">
						<h2>All all your products <br> to your E-store</h2>
						<div class="text">Upload and edit products to be sold under different categories</div>
						<!-- <ul class="email-list">
							<li><span class="icon flaticon-organization"></span>Connect with new people</li>
							<li><span class="icon flaticon-increase-1"></span>Increase chance to engage</li>
							<li><span class="icon flaticon-server"></span>Unlimited storage <i>PRO</i></li>
						</ul> -->
					</div>
				</div>
				
				<!-- Images Column -->
				<div class="images-column col-lg-7 col-md-12 col-sm-12">
					<div class="inner-column">
						<div class="small-image">
							<img src="{{ asset('assets/landing/images/resource/email-1.png')}}" alt="" />
						</div>
						<div class="image titlt" data-tilt data-tilt-max="8">
							<img src="{{ asset('assets/landing/images/resource/email.png')}}" alt="" />
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<!-- Email Email Section -->
	
	<!-- App Section -->
    <section class="app-section">
		<div class="icon-layer-one" style="background-image: url({{ asset('assets/landing/images/icons/icon-4.png')}})"></div>
		<div class="icon-layer-two" style="background-image: url({{ asset('assets/landing/images/icons/icon-5.png')}})"></div>
		<div class="icon-layer-three" style="background-image: url({{ asset('assets/landing/images/background/pattern-10.png')}})"></div>
		<div class="auto-container">
			<div class="row clearfix">
				
				<!-- Images Column -->
				<div class="images-column col-lg-7 col-md-12 col-sm-12">
					<div class="inner-column">
						<div class="image titlt" data-tilt data-tilt-max="8">
							<img src="{{ asset('assets/landing/images/resource/app-1.png')}}" alt="" />
						</div>
						<div class="small-image titlt" data-tilt data-tilt-max="8">
							<img src="{{ asset('assets/landing/images/resource/app-2.png')}}" alt="" />
						</div>
					</div>
				</div>
				
				<!-- Content Column -->
				<div class="content-column col-lg-5 col-md-12 col-sm-12">
					<div class="inner-column">
						<h2>Get value for your money</h2>
						<div class="text">Your payment is sent to Peddle and only disbursed to the seller when you've confirmed the product is intact</div>
						<div class="btns-box">
							<a class="theme-btn" href="#"><img src="{{ asset('assets/landing/images/icons/app.png')}}" alt="" /></a>
							<a class="theme-btn" href="#"><img src="{{ asset('assets/landing/images/icons/google.png')}}" alt="" /></a>
						</div>
						
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<!-- Email Email Section -->
	
	<!-- Video Section -->
	<section class="video-section" style="background-image: url({{ asset('assets/landing/images/background/2.jpg')}})">
		<div class="auto-container">
			<a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="lightbox-image video-box"><span class="fa fa-play"><i class="ripple"></i></span></a>
			<h4>Watch video overview</h4>
		</div>
	</section>
	<!-- End Video Section -->
	
	<!-- Screenshots Section -->
    <!-- <section class="screenshots-section">
		<div class="auto-container">
			<div class="sec-title centered">
				<div class="title">all screens</div>
				<h2>Our Awesome App <br> <span>Screenshots</span></h2>
			</div>
		</div>
		
		<div class="carousel-container">
            <div class="carousel-outer">
          
                <div class="screenshots-carousel owl-carousel owl-theme">
                    
                    <div class="slide"><figure class="image"><img src="images/resource/app-screen-one.jpg" alt=""></figure></div>
                    
                    <div class="slide"><figure class="image"><img src="images/resource/app-screen-two.jpg" alt=""></figure></div>
                    
                    <div class="slide"><figure class="image"><img src="images/resource/app-screen-three.jpg" alt=""></figure></div>
                    
                    <div class="slide"><figure class="image"><img src="images/resource/app-screen-four.jpg" alt=""></figure></div>
				
                    <div class="slide"><figure class="image"><img src="images/resource/app-screen-five.jpg" alt=""></figure></div>
                </div>
                
             
                <div class="mockup-layer"></div>
            </div>
        </div>
		
	</section> -->
	<!-- End Screenshots Section -->
	
	<!-- Pricing Section -->
    <!-- <section class="pricing-section">
		<div class="auto-container">
			<div class="sec-title centered">
				<div class="title">all pricing</div>
				<h2>Our Pricing Creative <br> Section</h2>
			</div>
			
			<div class="row clearfix">
				
			
				<div class="price-block col-lg-4 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
						<h4>Small Plan</h4>
						<ul class="price-list">
							<li>10 pages</li>
							<li>500 gb storage</li>
							<li>10 sdd Database</li>
							<li>Free coustom domain</li>
							<li>24/7 free support</li>
						</ul>
						<div class="price"><sup>$</sup>25<sub>/mo</sub></div>
						<a href="#" class="theme-btn btn-style-two"><span class="txt">Select the plan</span></a>
					</div>
				</div>
				
			
				<div class="price-block active col-lg-4 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
						<div class="discount">12% Discount</div>
						<h4>Startup Plan</h4>
						<ul class="price-list">
							<li>10 pages</li>
							<li>500 gb storage</li>
							<li>10 sdd Database</li>
							<li>Free coustom domain</li>
							<li>24/7 free support</li>
						</ul>
						<div class="price"><sup>$</sup>35<sub>/mo</sub></div>
						<a href="#" class="theme-btn btn-style-two"><span class="txt">Select the plan</span></a>
					</div>
				</div>
				
			
				<div class="price-block col-lg-4 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
						<h4>Business Plan</h4>
						<ul class="price-list">
							<li>10 pages</li>
							<li>500 gb storage</li>
							<li>10 sdd Database</li>
							<li>Free coustom domain</li>
							<li>24/7 free support</li>
						</ul>
						<div class="price"><sup>$</sup>45<sub>/mo</sub></div>
						<a href="#" class="theme-btn btn-style-two"><span class="txt">Select the plan</span></a>
					</div>
				</div>
				
			</div>
			
		</div>
	</section> -->
	<!-- End Pricing Section -->
	
	<!-- Testimonial Section -->
    <section class="testimonial-section">
		<div class="icon-one" style="background-image: url({{ asset('assets/landing/images/icons/icon-6.png')}})"></div>
		<div class="icon-two" style="background-image: url({{ asset('assets/landing/icons/icon-3.png')}})"></div>
		<div class="icon-three" style="background-image: url({{ asset('assets/landing/icons/icon-1.png')}})"></div>
		<div class="auto-container">
			<div class="sec-title centered">
				<div class="title">TESTIMONIALS</div>
				<h2>Feedback from Our Users</h2>
			</div>
			
			<div class="three-item-carousel owl-carousel owl-theme">
				
				<!-- Testimonial Block -->
				<div class="testimonial-block">
					<div class="inner-box">
						<div class="upper-content">
							<h5>Lorem Ipsum!</h5>
							<div class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry has been since the 1500s</div>
						</div>
						<div class="lower-content">
							<div class="author-image">
								<img src="{{ asset('assets/landing/images/resource/author-1.jpg')}}" alt="" />
							</div>
							<div class="author-name">Mark Smith</div>
							<div class="designation">Envato Inc.</div>
						</div>
					</div>
				</div>
				
				<!-- Testimonial Block -->
				<div class="testimonial-block">
					<div class="inner-box">
						<div class="upper-content">
							<h5>Lorem Ipsum!</h5>
							<div class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry has been since the 1500s</div>
						</div>
						<div class="lower-content">
							<div class="author-image">
								<img src="{{ asset('assets/landing/images/resource/author-2.jpg')}}" alt="" />
							</div>
							<div class="author-name">Vera Duncan</div>
							<div class="designation">PayPal Inc.</div>
						</div>
					</div>
				</div>
				
				<!-- Testimonial Block -->
				<div class="testimonial-block">
					<div class="inner-box">
						<div class="upper-content">
							<h5>Lorem Ipsum!</h5>
							<div class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry has been since the 1500s</div>
						</div>
						<div class="lower-content">
							<div class="author-image">
								<img src="{{ asset('assets/landing/images/resource/author-3.jpg')}}" alt="" />
							</div>
							<div class="author-name">Bryce Vaughn</div>
							<div class="designation">Unbounce Inc.</div>
						</div>
					</div>
				</div>
				
				<!-- Testimonial Block -->
				<div class="testimonial-block">
					<div class="inner-box">
						<div class="upper-content">
							<h5>Lorem Ipsum!</h5>
							<div class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry has been since the 1500s</div>
						</div>
						<div class="lower-content">
							<div class="author-image">
								<img src="{{ asset('assets/landing/images/resource/author-1.jpg')}}" alt="" />
							</div>
							<div class="author-name">Mark Smith</div>
							<div class="designation">Envato Inc.</div>
						</div>
					</div>
				</div>
				
				<!-- Testimonial Block -->
				<div class="testimonial-block">
					<div class="inner-box">
						<div class="upper-content">
							<h5>Lorem Ipsum!</h5>
							<div class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry has been since the 1500s</div>
						</div>
						<div class="lower-content">
							<div class="author-image">
								<img src="{{ asset('assets/landing/images/resource/author-2.jpg')}}" alt="" />
							</div>
							<div class="author-name">Vera Duncan</div>
							<div class="designation">PayPal Inc.</div>
						</div>
					</div>
				</div>
				
				<!-- Testimonial Block -->
				<div class="testimonial-block">
					<div class="inner-box">
						<div class="upper-content">
							<h5>Lorem Ipsum!</h5>
							<div class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry has been since the 1500s</div>
						</div>
						<div class="lower-content">
							<div class="author-image">
								<img src="{{ asset('assets/landing/images/resource/author-3.jpg')}}" alt="" />
							</div>
							<div class="author-name">Bryce Vaughn</div>
							<div class="designation">Unbounce Inc.</div>
						</div>
					</div>
				</div>
				
			</div>
			
		</div>
	</section>
	<!-- End Testimonial Section -->

@include('inc.footer')
@endsection


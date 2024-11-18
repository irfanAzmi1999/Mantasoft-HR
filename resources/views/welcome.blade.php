<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Home | MANTASOFT Leave by VN Human Resource</title>
		<link href="{{ asset('img/LogoVNatas.png') }}" rel="shortcut icon"/>
		<link rel="stylesheet" href="{{ asset('css/css-main-page/bootstrap.min.css') }}"/>
		<link rel="stylesheet" href="{{ asset('css/css-main-page/font-awesome.min.css') }}"/>
		<link rel="stylesheet" href="{{ asset('css/css-main-page/owl.carousel.css') }}"/>
		<link rel="stylesheet" href="{{ asset('css/css-main-page/style.css') }}"/>
		<link rel="stylesheet" href="{{ asset('css/css-main-page/animate.css') }}"/>
		<link rel="stylesheet" href="{{ asset('css/css-main-page/jquery.classycountdown.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/css-main-page/countdown_styles.css') }}"/>
		<link rel="stylesheet" href="{{ asset('css/css-main-page/countdown_responsive.css') }}"/>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark header-section">
			<div class="container-fluid">
				<a class="navbar-brand" href="#"><img src="{{ asset('img/LogoVN.png') }}"></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse justify-content-center space-x-px" id="navbarScroll">
					<ul class="navbar-nav" style="--bs-scroll-height: 100px;">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="{{ Request::root()}}">HOME</a>
						</li>

						<li class="nav-item hidden-md">
							<a class="nav-link " aria-current="page" href="{{ route('login') }}">LOGIN</a>
						</li>
					</ul>
				</div>
				<div class="hidden-bd">
					<a href="{{ route('login') }}" ><button class="btn user-panel hidden-bd" type="submit">LOGIN</button></a>
				</div>
			</div>
		</nav>
		<div class="latest-news-section">
			<div class="ln-title">On Leave Today</div>
			<div class="news-ticker">
				<div class="news-ticker-contant">
					@foreach ($userLeaveToday as $u)
						<div class="nt-item">
							<span class="medical">{{ $u->getLeaveType->name }}</span>
							{{ $u->getStaff->getUser->name }}
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<section class="hero-section">
			<div class="hero-slider owl-carousel">
				<div class="hs-item set-bg" data-setbg="img/bg.jfif">
					<div class="hs-text">
						<div class="container">
							<h2>MANTASOFT<span>&nbsp;LEAVE</span>&nbsp;</h2>
							<p>IN LEAVE AND CLAIM MANAGEMENT.</p>
							<a href="{{ route('login') }}" class="site-btn">LOGIN</a>
						</div>
					</div>
				</div>
				<div class="hs-item set-bg" data-setbg="img/bg_1.jfif">
					<div class="hs-text">
						<div class="container">
							<h2>MANTASOFT<span>&nbsp;LEAVE</span>&nbsp;</h2>
							<p>DELIVERS SIMPLICITY AND AUTOMATION TO STREAMLINE HUMAN RESOURCE.</p>
							<a href="#" class="site-btn">READ SITE DOCUMENTATION</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="counter-section cuba_timer">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="counter-text">
							<span>Next Public Holiday</span>
							<h3>{{ $name ?? null }}</h3>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="display-table center-text">
							<div class="display-table-cell">
								<div id="normal-countdown" data-date={{ $start_date ?? null }}></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="breadcrumb-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumb-text">
							<h2>Executive Summary</h2>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="about-section spad">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<img src="img/abt_us.png">
					</div>
					<div class="col-lg-8">
						<div class="text-justify">
							<p>Venture Nucleus (M) Sdn Bhd or VNSB is an established Bumiputera company since 2004.
								Combining years of experiences with technical expertise, VNSB was able to carry out
								trading and provide various technical and management services in ICT and telecommunication
								industry in Malaysia. We also take into consideration of the government initiatives when
								faced with the technology rapacity. VNSB will be focusing on the Communications Content
								and Infrastructure (CCI) sector which is spans a wide ecosystem covering content, network
								applications, services and devices.
							</p>
							<p> Aware of this opportunity, we will strive to engage more actively approaching our target
								and take chances. With high quality of human capital and consistent financial stability,
								VNSB has been spreading its wings in equipment supply, software development and technical
								services that relates to telecommunication and ICT ground works as well as project management.
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="team-member-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<h2>On Leave Today,&nbsp;{{ date('D, d M Y') }}</h2>
						</div>
					</div>
				</div>
			</div>
		</section>
		<div class="container">
			<section class="schedule-table-section spad">
				<div class="row">
					<div class="col-lg-12">
						<div class="schedule-table-tab">
							<div class="tab-content">
								<div class="tab-pane active" id="tabs-1" role="tabpanel">
									<div class="schedule-table-content">
										<table>
											<thead>
												<tr>
													<th>
														<strong>Name</strong>
													</th>
													<th>
														<strong>Type</strong>
													</th>
													<th>
														<strong>Start Date</strong>
													</th>
													<th>
														<strong>End Date</strong>
													</th>
												</tr>
											</thead>
											<tbody>
											@foreach ($userLeaveToday as $u)
												<tr class='number'>
													<td class='break hover-bg'>{{ $u->getStaff->getUser->name }}</td>
													<td class='break hover-bg'>{{ $u->getLeaveType->name }}</td>
													<td class='break hover-bg'>{{ date('D, d M Y', strtotime($u->start_date)) }}</td>
													<td class='break hover-bg'>{{ date('D, d M Y', strtotime ($u->end_date)) }}</td>
												</tr>
											@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="contact-section spad">
				<div class="row">
					<div class="col-lg-6">
						<div class="section-title">
							<h2>Our Office</h2>
						</div>
						<div class="cs-text">
							<div class="ct-address">
								<span>Address:</span>
								<p>27-2, Jalan Wangsa Delima 13, Wangsa Maju, 53300 Kuala Lumpur</p>
							</div>
							<div class="ct-address mt-2">
								<span>Phone:</span>
								<p>+60341441220</p>
							</div>
							<div class="ct-address mt-2">
								<span>Email:</span>
								<p><a href="mailto:vncareline@vn.net.my" target="_blank" rel="noopener noreferrer">vncareline@vn.net.my</a></p>
							</div>
							<div class="ct-address mt-2">
								<span>Website:</span>
								<p><a href="https://www.vn.net.my" target="_blank" rel="noopener noreferrer">vn.net.my</a></p>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="cs-map">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.608220938937!2d101.73997351454227!3d3.197177097672155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc382f7240fe39%3A0x96aaf4d5d1f4cb68!2sVenture%20Nucleus%20M%20Sdn%20Bhd!5e0!3m2!1sen!2smy!4v1667361879814!5m2!1sen!2smy" width="500" height="400" style="border:0;" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
						</div>
					</div>
				</div>
			</section>
		</div>
		<footer class="footer-section">
			<div class="container">
				<p class="copyright">
					<b>Copyright</b> VN Human Resource&nbsp;&copy;&nbsp;<script>document.write({{ date('Y') }});</script><span class="d-none d-sm-inline-block">, All Rights Reserved</span>
				</p>
			</div>
		</footer>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/c765aea185.js" crossorigin="anonymous"></script>
		<script src="js/landing_page/jquery-3.3.1.min.js"></script>
		<script src="js/landing_page/bootstrap.min.js"></script>
		<script src="js/landing_page/owl.carousel.min.js"></script>
		<script src="js/landing_page/jquery.marquee.min.js"></script>
		<script src="js/landing_page/main.js"></script>
		<script src="js/landing_page/jquery.countdown.min.js"></script>
		<script src="js/landing_page/countdown_scripts.js"></script>
	</body>
</html>

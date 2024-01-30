
<!DOCTYPE html>
<!--
Template Name: NobleUI - Admin & Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_admin
License: You must have a valid license purchased only from above link or https://themeforest.net/user/nobleui/portfolio/ in order to legally use the theme for your project.
-->
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Lion NobleUI Responsive Bootstrap 4 Dashboard Template</title>
	<!-- core:css -->
	<link rel="stylesheet" href="{{asset('backend')}}/assets/vendors/core/core.css">
	<!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{asset('backend')}}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
	<!-- end plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="{{asset('backend')}}/assets/fonts/feather-font/css/iconfont.css">
	<link rel="stylesheet" href="{{asset('backend')}}/assets/vendors/flag-icon-css/css/flag-icon.min.css">
	<!-- endinject -->
  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{asset('backend')}}/assets/css/demo_1/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{asset('backend')}}/assets/images/favicon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
  integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"/>
  {{-- summernote css --}}
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  @yield('css_cdn')
  <style>
    .upload__box {
    padding: 40px;
    }
    .upload__inputfile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
    }
    .upload__btn {
    display: block;
    font-weight: 600;
    color: #fff;
    text-align: center;
    min-width: 116px;
    padding: 5px;
    transition: all 0.3s ease;
    cursor: pointer;
    border: 2px solid;
    background-color: #555ae0;
    border-color: #4045ba;
    border-radius: 10px;
    line-height: 26px;
    font-size: 14px;
    }
    .upload__btn:hover {
    background-color: unset;
    color: #4045ba;
    transition: all 0.3s ease;
    }
    .upload__btn-box {
    margin-bottom: 10px;
    }
    .upload__img-wrap {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -10px;
    }
    .upload__img-box {
    width: 200px;
    padding: 0 10px;
    margin-bottom: 12px;
    }
    .upload__img-close {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background-color: rgba(0, 0, 0, 0.5);
    position: absolute;
    top: 10px;
    right: 10px;
    text-align: center;
    line-height: 24px;
    z-index: 1;
    cursor: pointer;
    }
    .upload__img-close:after {
    content: "✖";
    font-size: 14px;
    color: white;
    }

    .img-bg {
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    position: relative;
    padding-bottom: 100%;
    }

  /* add product design */
  .btn_design:hover {
    background-color: #2126c3;
    color: white;
    transition: all 0.3s ease;
  }

  /* toggle */
  .toggle{
    background-color: #e2e2eb;
    color: white;
    border-radius: 5px;
    width: 90%;
  }

   /* order */
    .status_c {
        color: white;
        border: none;
        border-radius: 5px;
        margin-top: 5px;
    }
    .abc{
        padding: 5px;
        border-radius: 3px;
    }

    .swal2-popup.swal2-toast.swal2-show {
      background-color: rgb(25, 143, 14);
      color: white;
    }

    
      /* frontend button design color */
      .yellloww {
          background: linear-gradient(180deg, #FED700 0%, #F78914 100%);
          color: white;
      }
      .greeenn {
          background: linear-gradient(180deg, #95CD2F 0%, #63911F 100%);
          color: white;
      }
      .reedd {
          background: linear-gradient(180deg, #b1452af0 0%, rgb(250, 4, 4) 100%);
          color: white;
      }
      .skybluee {
          
          background: linear-gradient(180deg, #5df3f3 0%, #047281 100%);
          color: white;
      }
      .bluuee {
          
          background: linear-gradient(180deg, #729bd8 0%, #3307ad 100%);
          color: white;
      }
      .secondary {
          background: linear-gradient(180deg, #96969c 0%, #53535b 100%);
          color: white;
      }
</style>
</head>
<body>
	<div class="main-wrapper">

		<!-- partial:partials/_sidebar.html -->
		<nav class="sidebar">
      <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
          Noble<span>UI</span>
        </a>
        <div class="sidebar-toggler not-active">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="sidebar-body">
        <ul class="nav">
          <li class="nav-item nav-category">Main</li>
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('role.manager')}}">
              <i class="link-icon" data-feather="feather"></i>
              <span class="link-title">Role Manager</span>
              <i class="link-arrow"></i>
            </a>
          </li>
          <li class="nav-item nav-category">web apps</li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
              <i class="link-icon" data-feather="mail"></i>
              <span class="link-title">User</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="emails">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('user.list')}}" class="nav-link">User List</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item nav-category">Components</li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#logo">
              <i class="link-icon" data-feather="feather"></i>
              <span class="link-title">Logo</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="logo">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('logo')}}" class="nav-link">Logo</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Banner">
              <i class="link-icon" data-feather="feather"></i>
              <span class="link-title">Banner</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="Banner">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('banner')}}" class="nav-link">Banner</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('offer')}}">
              <i class="link-icon" data-feather="feather"></i>
              <span class="link-title">Exciting Offer</span>
              <i class="link-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('festival.offer')}}">
              <i class="link-icon" data-feather="feather"></i>
              <span class="link-title">Festival Offer</span>
              <i class="link-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('special.offer')}}">
              <i class="link-icon" data-feather="feather"></i>
              <span class="link-title">Special Offer</span>
              <i class="link-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('subscriber')}}">
              <i class="link-icon" data-feather="feather"></i>
              <span class="link-title">Subscribers</span>
              <i class="link-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
              <i class="link-icon" data-feather="feather"></i>
              <span class="link-title">Category</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="uiComponents">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('category')}}" class="nav-link">Add Category</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('category.trash')}}" class="nav-link">Trash Category</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('subcategory')}}" class="nav-link">Sub Category</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
              <i class="link-icon" data-feather="anchor"></i>
              <span class="link-title">Products</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="advancedUI">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('add.product')}}" class="nav-link">Add Product</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('brand')}}" class="nav-link">Brand</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('product.list')}}" class="nav-link">Product List</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('variation')}}" class="nav-link">Variation</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('coupon')}}">
              <i class="link-icon" data-feather="feather"></i>
              <span class="link-title">Coupon</span>
              <i class="link-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('orders')}}">
              <i class="link-icon" data-feather="feather"></i>
              <span class="link-title">Orders</span>
              <i class="link-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('order.cancel.list')}}">
              <i class="link-icon" data-feather="feather"></i>
              <span class="link-title">Order Cancel List</span>
              <i class="link-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('order.returns.list')}}">
              <i class="link-icon" data-feather="feather"></i>
              <span class="link-title">Order Return List</span>
              <i class="link-arrow"></i>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <nav class="settings-sidebar">
      <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
          <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted">Sidebar:</h6>
        <div class="form-group border-bottom">
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
              Light
            </label>
          </div>
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
              Dark
            </label>
          </div>
        </div>
        <div class="theme-wrapper">
          <h6 class="text-muted mb-2">Light Theme:</h6>
          <a class="theme-item active" href="../demo_1/dashboard-one.html">
            <img src="../assets/images/screenshots/light.jpg" alt="light theme">
          </a>
          <h6 class="text-muted mb-2">Dark Theme:</h6>
          <a class="theme-item" href="../demo_2/dashboard-one.html">
            <img src="../assets/images/screenshots/dark.jpg" alt="light theme">
          </a>
        </div>
      </div>
    </nav>
		<!-- partial -->
	
		
	
		<div class="page-wrapper">
					
			<!-- partial:partials/_navbar.html -->
			<nav class="navbar">
				<a href="#" class="sidebar-toggler">
					<i data-feather="menu"></i>
				</a>
				<div class="navbar-content">
					<form class="search-form">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<i data-feather="search"></i>
								</div>
							</div>
							<input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
						</div>
					</form>
					<ul class="navbar-nav">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="flag-icon flag-icon-us mt-1" title="us"></i> <span class="font-weight-medium ml-1 mr-1 d-none d-md-inline-block">English</span>
							</a>
							<div class="dropdown-menu" aria-labelledby="languageDropdown">
                <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us" id="us"></i> <span class="ml-1"> English </span></a>
                <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-fr" title="fr" id="fr"></i> <span class="ml-1"> French </span></a>
                <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-de" title="de" id="de"></i> <span class="ml-1"> German </span></a>
                <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-pt" title="pt" id="pt"></i> <span class="ml-1"> Portuguese </span></a>
                <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-es" title="es" id="es"></i> <span class="ml-1"> Spanish </span></a>
							</div>
            </li>
						<li class="nav-item dropdown nav-apps">
							<a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i data-feather="grid"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="appsDropdown">
								<div class="dropdown-header d-flex align-items-center justify-content-between">
									<p class="mb-0 font-weight-medium">Web Apps</p>
									<a href="javascript:;" class="text-muted">Edit</a>
								</div>
								<div class="dropdown-body">
									<div class="d-flex align-items-center apps">
										<a href="pages/apps/chat.html"><i data-feather="message-square" class="icon-lg"></i><p>Chat</p></a>
										<a href="pages/apps/calendar.html"><i data-feather="calendar" class="icon-lg"></i><p>Calendar</p></a>
										<a href="pages/email/inbox.html"><i data-feather="mail" class="icon-lg"></i><p>Email</p></a>
										<a href="pages/general/profile.html"><i data-feather="instagram" class="icon-lg"></i><p>Profile</p></a>
									</div>
								</div>
								<div class="dropdown-footer d-flex align-items-center justify-content-center">
									<a href="javascript:;">View all</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown nav-messages">
							<a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i data-feather="mail"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="messageDropdown">
								<div class="dropdown-header d-flex align-items-center justify-content-between">
									<p class="mb-0 font-weight-medium">9 New Messages</p>
									<a href="javascript:;" class="text-muted">Clear all</a>
								</div>
								<div class="dropdown-body">
									<a href="javascript:;" class="dropdown-item">
										<div class="figure">
											<img src="https://via.placeholder.com/30x30" alt="userr">
										</div>
										<div class="content">
											<div class="d-flex justify-content-between align-items-center">
												<p>Leonardo Payne</p>
												<p class="sub-text text-muted">2 min ago</p>
											</div>	
											<p class="sub-text text-muted">Project status</p>
										</div>
									</a>
									<a href="javascript:;" class="dropdown-item">
										<div class="figure">
											<img src="https://via.placeholder.com/30x30" alt="userr">
										</div>
										<div class="content">
											<div class="d-flex justify-content-between align-items-center">
												<p>Carl Henson</p>
												<p class="sub-text text-muted">30 min ago</p>
											</div>	
											<p class="sub-text text-muted">Client meeting</p>
										</div>
									</a>
									<a href="javascript:;" class="dropdown-item">
										<div class="figure">
											<img src="https://via.placeholder.com/30x30" alt="userr">
										</div>
										<div class="content">
											<div class="d-flex justify-content-between align-items-center">
												<p>Jensen Combs</p>												
												<p class="sub-text text-muted">1 hrs ago</p>
											</div>	
											<p class="sub-text text-muted">Project updates</p>
										</div>
									</a>
									<a href="javascript:;" class="dropdown-item">
										<div class="figure">
											<img src="https://via.placeholder.com/30x30" alt="userr">
										</div>
										<div class="content">
											<div class="d-flex justify-content-between align-items-center">
												<p>Amiah Burton</p>
												<p class="sub-text text-muted">2 hrs ago</p>
											</div>
											<p class="sub-text text-muted">Project deadline</p>
										</div>
									</a>
									<a href="javascript:;" class="dropdown-item">
										<div class="figure">
											<img src="https://via.placeholder.com/30x30" alt="userr">
										</div>
										<div class="content">
											<div class="d-flex justify-content-between align-items-center">
												<p>Yaretzi Mayo</p>
												<p class="sub-text text-muted">5 hr ago</p>
											</div>
											<p class="sub-text text-muted">New record</p>
										</div>
									</a>
								</div>
								<div class="dropdown-footer d-flex align-items-center justify-content-center">
									<a href="javascript:;">View all</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown nav-notifications">
							<a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i data-feather="bell"></i>
								<div class="indicator">
									<div class="circle"></div>
								</div>
							</a>
							<div class="dropdown-menu" aria-labelledby="notificationDropdown">
								<div class="dropdown-header d-flex align-items-center justify-content-between">
									<p class="mb-0 font-weight-medium">{{App\Models\OrderCancel::all()->count()}} New Notifications</p>
									<a href="javascript:;" class="text-muted">Clear all</a>
								</div>
								<div class="dropdown-body">
                  @foreach (App\Models\OrderCancel::all() as $order_cancel)
                    <a href="javascript:;" class="dropdown-item">
                      <div class="content">
                        <strong>Order Cancel Request</strong>
                        <p>Order ID: {{App\Models\Order::find($order_cancel->order_id)->order_id}}</p>
                        <p class="sub-text text-muted">{{$order_cancel->created_at->diffForHumans()}}</p>
                      </div>
                    </a>
                  @endforeach
								</div>
								<div class="dropdown-footer d-flex align-items-center justify-content-center">
									<a href="{{route('order.cancel.list')}}">View all</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown nav-profile">
							<a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if (Auth::user()->photo == null)
                <img src="{{Avatar::create(Auth::user()->name)->toBase64()}}" alt="">
                @else
                  <img src="{{asset('uploads/user/')}}/{{Auth::user()->photo}}">
                @endif
							</a>
							<div class="dropdown-menu" aria-labelledby="profileDropdown">
								<div class="dropdown-header d-flex flex-column align-items-center">
									<div class="figure mb-3">
                    @if (Auth::user()->photo == null)
										<img src="{{Avatar::create(Auth::user()->name)->toBase64()}}" alt="">
                    @else
                      <img src="{{asset('uploads/user/')}}/{{Auth::user()->photo}}">
                    @endif
									</div>
									<div class="info text-center">
										<p class="name font-weight-bold mb-0">{{Auth::user()->name}}</p>
										<p class="email text-muted mb-3">{{Auth::user()->email}}</p>
									</div>
								</div>
								<div class="dropdown-body">
									<ul class="profile-nav p-0 pt-3">
										<li class="nav-item">
											<a href="{{route('user.update')}}" class="nav-link">
												<i data-feather="user"></i>
												<span>Profile</span>
											</a>
										</li>
										<li class="nav-item">
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                        <a href="{{ route('logout') }}" class="nav-link"  onclick="event.preventDefault();
                        this.closest('form').submit();">
                          <i data-feather="log-out"></i>
                          <span>Log Out</span>
                        </a>
                      </form>
										</li>
									</ul>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			<!-- partial -->
			<div class="page-content">
        <div class="justify-content-between align-items-center flex-wrap grid-margin">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Library</a></li>
            </ol>
          </nav>
          @yield('content')
        </div>
			</div>

			<!-- partial:partials/_footer.html -->
			<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
				<p class="text-muted text-center text-md-left">Copyright © 2021 <a href="https://www.nobleui.com" target="_blank">NobleUI</a>. All rights reserved</p>
				<p class="text-muted text-center text-md-left mb-0 d-none d-md-block">Handcrafted With <i class="mb-1 text-primary ml-1 icon-small" data-feather="heart"></i></p>
			</footer>
			<!-- partial -->
		
		</div>
	</div>

	<!-- core:js -->
	<script src="{{asset('backend')}}/assets/vendors/core/core.js"></script>
	<!-- endinject -->
  <!-- plugin js for this page -->
  <script src="{{asset('backend')}}/assets/vendors/chartjs/Chart.min.js"></script>
  <script src="{{asset('backend')}}/assets/vendors/jquery.flot/jquery.flot.js"></script>
  <script src="{{asset('backend')}}/assets/vendors/jquery.flot/jquery.flot.resize.js"></script>
  <script src="{{asset('backend')}}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="{{asset('backend')}}/assets/vendors/apexcharts/apexcharts.min.js"></script>
  <script src="{{asset('backend')}}/assets/vendors/progressbar.js/progressbar.min.js"></script>
	<!-- end plugin js for this page -->
	<!-- inject:js -->
	<script src="{{asset('backend')}}/assets/vendors/feather-icons/feather.min.js"></script>
	<script src="{{asset('backend')}}/assets/js/template.js"></script>
	<!-- endinject -->
  <!-- custom js for this page -->
  <script src="{{asset('backend')}}/assets/js/dashboard.js"></script>
  <script src="{{asset('backend')}}/assets/js/datepicker.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script
  src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
  integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer">
  </script>
  {{-- summernote js --}}
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
	<!-- end custom js for this page -->
  @yield('footer_script')
</body>
</html>    
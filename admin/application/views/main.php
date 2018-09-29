<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">-->
    <title>Administrative</title>
    <link href="<?php echo base_url("public/assets/plugins/bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("public/assets/plugins/toast-master/css/jquery.toast.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("public/assets/plugins/sweetalert/sweetalert.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("public/assets/plugins/wizard/steps.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css");?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("public/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css");?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("public/assets/plugins/select2/dist/css/select2.min.css");?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("public/css/style.css"); ?>" rel="stylesheet">
	<link href="<?php echo base_url("public/css/estimate.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("public/css/colors/blue.css"); ?>" id="theme" rel="stylesheet">
    <link href="<?php echo base_url("public/assets/plugins/summernote/dist/summernote.css"); ?>" id="theme" rel="stylesheet">
	
    <script src="<?php echo base_url("public/assets/plugins/jquery/jquery.min.js");?>"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	 <script src="<?php echo base_url("public/js/jquery-calx-sample-2.2.7.min.js");?>"></script>
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
		<h6 style='text-align:center'>Please wait while we load your page...</h6>
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
	<div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <b>
                            <img src="<?php echo base_url("public/assets/images/logo.png");?>" style="width:1px;height:1px;" alt="homepage" class="dark-logo" />
                            <img src="https://via.placeholder.com/50x50/ff0000/000000/?text=%20LOGO" alt="homepage" class="light-logo" />
                        </b>
                        <span>
							<img src="<?php echo base_url("public/assets/images/logo.png");?>" style="width:150px;height:50px;" alt="homepage" class="dark-logo" />
							<img src="https://via.placeholder.com/50x50/ff0000/000000/?text=%20LOGO" class="light-logo" alt="homepage" />
						</span> 
					</a>
                </div>
				<div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
						<li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- Unused
						<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox animated slideInUp">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <a href="#">
                                                <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Launch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span> 
												</div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item dropdown">-->
					</ul>
                    <ul class="navbar-nav my-lg-0">
                       <!--<li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li>
						<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-us"></i></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up"> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> India</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> China</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a> </div>
                        </li>-->
						<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-settings"></i></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <!--<li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="https://via.placeholder.com/128x128?text=LOGO" alt="user"></div>
                                            <div class="u-text">
                                                <h4>John Salvador</h4>
												<p class="text-muted">johnjaran@gmail.com</p><a href="pages-profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
											</div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                                    <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                                    <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                                    <li role="separator" class="divider"></li>-->
                                    <li><a href="<?php echo base_url("user/manage"); ?>"><i class="ti-settings"></i> Account Setting</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url("user/logout"); ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
			</nav>
		</header>
		<aside class="left-sidebar">
            <div class="scroll-sidebar">
                <div class="user-profile">
                    <!--<div class="profile-img"> <img src="https://via.placeholder.com/50x50?text=LOGO" alt="user" />
                        <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </div>-->
					<br/>
                    <div class="profile-text">
                        <h5><?php echo $this->session->userdata('fullname'); ?></h5>
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>
                        <a href="app-email.html" class="" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                        <a href="pages-login.html" class="" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
                        <div class="dropdown-menu animated flipInY">
                            <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                            <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                            <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                            <div class="dropdown-divider"></div>
                            <a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">EMPLOYEES RECORDS</li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">EMPLOYEES <!--<span class="label label-rouded label-themecolor pull-right">4</span>--></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url("employees/dashboard"); ?>">Dashboard</a></li>
                                <li><a href="<?php echo base_url("employees/emplist"); ?>">List</a></li>
                                <li><a href="<?php echo base_url("employees/types"); ?>">Types</a></li>
                                <li><a href="<?php echo base_url("employees/designations"); ?>">Designation</a></li>
                                <li><a href="<?php echo base_url("employees/departments"); ?>">Departments</a></li>
                            </ul>
                        </li>
						<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bulletin-board"></i><span class="hide-menu">PROJECTS </span></a>
							<ul aria-expanded="false" class="collapse">
								<li><a href="<?php echo base_url("projects/projlist"); ?>">List</a></li>
								<li><a href="<?php echo base_url("projects/types"); ?>">Types</a></li>
								<li><a href="<?php echo base_url("projects/equipment"); ?>">Equipments Rate</a></li>
								<li><a href="<?php echo base_url("projects/labor"); ?>">Labor Rate</a></li>
								<li><a href="<?php echo base_url("projects/materials"); ?>">Materials</a></li>
								<li><a href="<?php echo base_url("projects/bidding"); ?>">Bidding</a></li>
							</ul>
						</li>
						<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-cash-multiple"></i><span class="hide-menu">PAYROLL</span></a>
							<ul aria-expanded="false" class="collapse">
								<li><a href="<?php echo base_url("payroll/payperiod"); ?>">Payroll Period</a></li>
								<li><a href="<?php echo base_url("payroll/leaverequest"); ?>">Leave Request</a></li>
								<li><a href="<?php echo base_url("payroll/leavetype"); ?>">Leave Type</a></li>
								<li><a href="<?php echo base_url("payroll/timesheet_type"); ?>">Timesheet Type</a></li>
								<li><a href="<?php echo base_url("payroll/deduction_type"); ?>">Deduction Type</a></li>
								<li><a href="<?php echo base_url("payroll/deduction_master"); ?>">Deduction Master</a></li>
								<li><a href="javascript:void(0);" onclick="processPayroll();"><b style='color:#ff0000'>Process Payroll</b></a></li>
							</ul>
						</li>
						<?php if($this->session->userdata('userlevel') == "ADMIN"): ?>
						<li> <a class="has-arrow waves-effect waves-dark" href="<?php echo base_url("user/list"); ?>" aria-expanded="false"><i class="mdi mdi-account-star-variant"></i><span class="hide-menu">USER ACCOUNTS</span></a></li>
						<?php endif; ?>
						<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-cash-multiple"></i><span class="hide-menu">ESTIMATION</span></a>
							<ul aria-expanded="false" class="collapse">
								<li><a href="<?php echo base_url("estimation/build"); ?>">Create Estimation</a></li>
							</ul>
							<ul aria-expanded="false" class="collapse">
								<li><a href="<?php echo base_url("estimation/preview"); ?>">Preview Estimation</a></li>
							</ul>
						</li>
						<li> <a class="has-arrow waves-effect waves-dark" href="#" onclick="gotoCRM();" aria-expanded="false"><i class="mdi mdi-apps"></i><span class="hide-menu">CRM FEATURES</span></a></li>
						<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-apps"></i><span class="hide-menu">INFOKIT</span></a>
							<ul aria-expanded="false" class="collapse">
								<li><a href="<?php echo base_url("infokit/topic"); ?>">Topics</a></li>
							</ul>
						</li>
						<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-apps"></i><span class="hide-menu">ASSET MANAGEMENT</span></a>
							<ul aria-expanded="false" class="collapse">
								<li><a href="<?php echo base_url("asset/asset_dashboard"); ?>">Assets Dashboard</a></li>
								<li><a href="<?php echo base_url("asset/asset_manager"); ?>">Assets List</a></li>
								<li><a href="<?php echo base_url("asset/asset_locator"); ?>">Asset Locator</a></li>
								<li><a href="<?php echo base_url("asset/asset_maintenance"); ?>">Maintenance and Repair</a></li>
							</ul>
						</li>
					</ul>
                </nav>
			</div>
		</aside>
		<div class="page-wrapper">
			<?php $this->load->view($module); ?>
		</div>
		
		
	</div>
    <script src="<?php echo base_url("public/assets/plugins/bootstrap/js/popper.min.js");?>"></script>
    <script src="<?php echo base_url("public/assets/plugins/bootstrap/js/bootstrap.min.js");?>"></script>
    <script src="<?php echo base_url("public/js/jquery.slimscroll.js");?>"></script>
    <script src="<?php echo base_url("public/js/waves.js");?>"></script>
    <script src="<?php echo base_url("public/js/sidebarmenu.js");?>"></script>
    <script src="<?php echo base_url("public/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js");?>"></script>
    <script src="<?php echo base_url("public/assets/plugins/sparkline/jquery.sparkline.min.js");?>"></script>
    <script src="<?php echo base_url("public/assets/plugins/toast-master/js/jquery.toast.js");?>"></script>
    <script src="<?php echo base_url("public/assets/plugins/sweetalert/sweetalert.min.js");?>"></script>
	<script src="<?php echo base_url("public/assets/plugins/wizard/jquery.steps.min.js"); ?>"></script>
    <script src="<?php echo base_url("public/assets/plugins/wizard/jquery.validate.min.js"); ?>"></script>
	<script src="<?php echo base_url("public/assets/plugins/wizard/steps.js"); ?>"></script>
	<script src="<?php echo base_url("public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
	<script src="<?php echo base_url("public/assets/plugins/moment/moment.js"); ?>"></script>
	<script src="<?php echo base_url("public/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"); ?>"></script>
	<script src="<?php echo base_url("public/assets/plugins/select2/dist/js/select2.full.js"); ?>"></script>
	<script src="<?php echo base_url("public/assets/plugins/summernote/dist/summernote.min.js"); ?>"></script>
	<script src="<?php echo base_url("public/assets/plugins/sortable-master/Sortable.min.js"); ?>"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url("public/js/custom.js");?>"></script>
	<script src="<?php echo base_url("public/js/toastr.js");?>"></script>
	<script src="<?php echo base_url("public/js/mask.js");?>"></script>
    <script src="<?php echo base_url("public/assets/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
    <script src="<?php echo base_url("public/assets/plugins/styleswitcher/jQuery.style.switcher.js");?>"></script>
	<!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
	<script>
		function processPayroll() {
			swal({   
				title: "Are you sure you want to process the payroll?",   
				text: "Process is not revertable!",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "Yes",   
				cancelButtonText: "No",   
				closeOnConfirm: false,   
				closeOnCancel: false,
				showLoaderOnConfirm: true 
			}, function(isConfirm){   
				if (isConfirm) {    
					swal("Processing...", "Redirecting to processing page!", "success"); 				
					window.location.replace("<?php echo base_url("payroll/processpayroll"); ?>");
				} else {     
					swal("Cancelled", "Processing was cancelled!", "error");   
				} 
			});
		}
		
		function gotoCRM() {
			var uname = "<?php echo md5($this->session->userdata('username')); ?>";
			window.open("https://steve-crm.appspot.com/process/apilogin?username=" + uname, '_blank');
		}
	</script>
</body>

</html>
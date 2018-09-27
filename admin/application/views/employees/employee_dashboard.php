<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h3 class="text-themecolor">Employee Dashboard</h3>
	</div>
	<div class="col-md-7 align-self-center">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
			<li class="breadcrumb-item active">Dashboard</li>
		</ol>
	</div>
	<div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs customtab" role="tablist">
					<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#leavereq" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Leave Request</span></a> </li>
					<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#otreq" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Overtime Request</span></a> </li>
					<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#emplogs" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Employee Logs</span></a> </li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content p-b-20">
					<div class="tab-pane p-l-20 p-r-20 active" id="leavereq" role="tabpanel">
						<div class="table-responsive">
							<table id="tblLeaveRequests" style="font-size:12px" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Requestor</th>
										<th>From</th>
										<th>To</th>
										<th>Type</th>
										<th>Request</th>
										<th>Status</th>
										<th>Options</th>
									</tr>
								</thead>
								<tbody id="leaveRequestData">
										
								</tbody>
							</table>
						</div>
					</div>
					<div class="tab-pane p-l-20 p-r-20" id="otreq" role="tabpanel">
						<div class="table-responsive">
							<table id="tblOtRequest" style="font-size:12px" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Requestor</th>
										<th>No. of Hours</th>
										<th>Reason</th>
										<th>Date Requested</th>
										<th>Status</th>
										<th>Options</th>
									</tr>
								</thead>
								<tbody id="OTRequestData">
											
								</tbody>
							</table>
						</div>
					</div>
					<div class="tab-pane p-l-20 p-r-20" id="emplogs" role="tabpanel">
						<div class="table-responsive">
							<table id="tblEmpLogs" style="font-size:12px" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Employee ID</th>
										<th>Employee Name</th>
										<th>Job</th>
										<th>Task</th>
										<th>Location</th>
										<th>Time Start</th>
										<th>Time End</th>
										<th>Date Inserted</th>
									</tr>
								</thead>
								<tbody id="empLogData">
											
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<footer class="footer">
			© 2018 Geo Grout Inc
		</footer>
	</div>
</div>

<!-- start create modal -->
	<div id="showLocation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Employee Location</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div class="col-12">
						<iframe id="markermap" width="100%" height="300px"
							frameborder="0" style="border:0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6318.092472145345!2d-122.41930747363149!3d37.64811701913067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xad1925a4bf0970e9!2sGeoGrout+ggms!5e0!3m2!1sen!2sph!4v1528353344175" allowfullscreen>
						</iframe>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end create modal -->

<script>
	$(document).ready(function() {
		getOTRequestList();
		getLeaveRequestList();
		getEmployeeDepartmentList();
		<?php 
			if($this->session->flashdata('global_message') != "") {
				echo $this->session->flashdata('global_message');
			}
		?>
	});
	
	function getEmployeeDepartmentList() {
		$.post("<?php echo base_url("employees/crud/retrieve/logs"); ?>",{ admin_id : "1" })
		.done(function(data) {
			$("#empLogData").html(data);
			$('#tblEmpLogs').DataTable({ lengthChange: false });
			$(".preloader").fadeOut();
		});
	}
	
	function getLeaveRequestList() {
		$.post("<?php echo base_url("employees/crud/retrieve/leavelogs"); ?>",{ admin_id : "1" })
		.done(function(data) {
			$("#leaveRequestData").html(data);
			$('#tblLeaveRequests').DataTable({ lengthChange: false });
		});
	}
	
	function getOTRequestList() {
		$.post("<?php echo base_url("employees/crud/retrieve/otlogs"); ?>",{ admin_id : "1" })
		.done(function(data) {
			$("#OTRequestData").html(data);
			$('#tblOtRequest').DataTable({ lengthChange: false });
		});
	}
	
	function showInMap(map) {
		var mojokey = "AIzaSyBgdwfZSVM-XkwgcnoJMr-bmWPlEhVxbpE";
		var oldkey = "AIzaSyDiiBE86xJkfFADJnCE4jZfwCu2nn30IOI";
		
		var url = "https://www.google.com/maps/embed/v1/search?key="+ mojokey +"&q=";
		url = url + map + "&zoom=18";
		$("#markermap").attr('src',url);
		$("#showLocation").modal('show');
	}
	
	function fnApproveLeave(id) {
		swal({   
            title: "Are you sure you want to approve this leave?",   
            text: "You can't revert this action!",   
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
				$.post("<?php echo base_url("employees/crud/update/leaverequest"); ?>",{ admin_id : "1", id: id, status: "Approved" })
				.done(function(data) {
					if(data == 1) { // or true
						$('#tblLeaveRequests').DataTable().destroy();
						getLeaveRequestList();
						swal("Success!", "Leave Request was successfully approved!", "success"); 
					} else {
						swal("Error!", data, "error"); 
					}
				});  
            } else {     
                swal("Cancelled", "Leave Request was not approved!", "error");   
            } 
        });
	}
	
	function fnRejectLeave(id) {
		swal({   
            title: "Are you sure you want to reject this leave?",   
            text: "You can't revert this action!",   
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
				$.post("<?php echo base_url("employees/crud/update/leaverequest"); ?>",{ admin_id : "1", id: id, status: "Rejected" })
				.done(function(data) {
					if(data == 1) { // or true
						$('#tblLeaveRequests').DataTable().destroy();
						getLeaveRequestList();
						swal("Success!", "Leave Request was successfully rejected!", "success"); 
					} else {
						swal("Error!", data, "error"); 
					}
				});  
            } else {     
                swal("Cancelled", "Leave Request was not rejected!", "error");   
            } 
        });
	}
	
	function fnApproveOT(id) {
		swal({   
            title: "Are you sure you want to approve this Overtime?",   
            text: "You can't revert this action!",   
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
				$.post("<?php echo base_url("employees/crud/update/otrequest"); ?>",{ admin_id : "1", id: id, status: "Approved" })
				.done(function(data) {
					if(data == 1) { // or true
						$('#tblOtRequest').DataTable().destroy();
						getOTRequestListList();
						swal("Success!", "Overtime Request was successfully approved!", "success"); 
					} else {
						swal("Error!", data, "error"); 
					}
				});  
            } else {     
                swal("Cancelled", "Overtime Request was not approved!", "error");   
            } 
        });
	}
	
	function fnRejectOT(id) {
		swal({   
            title: "Are you sure you want to reject this Overtime?",   
            text: "You can't revert this action!",   
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
				$.post("<?php echo base_url("employees/crud/update/otrequest"); ?>",{ admin_id : "1", id: id, status: "Rejected" })
				.done(function(data) {
					if(data == 1) { // or true
						$('#tblOtRequest').DataTable().destroy();
						getOTRequestList();
						swal("Success!", "Overtime Request was successfully rejected!", "success"); 
					} else {
						swal("Error!", data, "error"); 
					}
				});  
            } else {     
                swal("Cancelled", "Overtime Request was not rejected!", "error");   
            } 
        });
	}
	
</script>
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h3 class="text-themecolor">Payroll Records</h3>
	</div>
	<div class="col-md-7 align-self-center">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
			<li class="breadcrumb-item">Payroll</li>
			<li class="breadcrumb-item active">Timesheet Types</li>
		</ol>
	</div>
	<!--<div class="">
		<button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
	</div>-->
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-sm-10">
							<h4 class="card-title">Timesheet Types</h4>
							<h6 class="card-subtitle">List of Timesheet Types</h6>
						</div>
						<div class="col-12 col-sm-2">
							<?php if($this->session->userdata('userlevel') != "VIEWER"): ?>
							<button type='button' data-toggle="modal" data-target="#createTimesheetTypes" class='btn btn-info'><i class='fa fa-edit'></i> Create New</button>
							<?php endif; ?>
						</div>
					</div>
					<div class="table-responsive m-t-10">
						<table id="tblTimesheetTypes" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Type</th>
									<th>Created by</th>
									<th>Date Inserted</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody id="TimesheetTypesData">
										
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<footer class="footer">
			© 2018 Geo Grout Inc
		</footer>
	</div>
	<!-- start create modal -->
	<div id="createTimesheetTypes" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Create New Timesheet Type</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?php echo base_url("payroll/crud/create/timesheettype"); ?>" class="form-horizontal p-t-20">
						<div class="form-group row">
							<label for="description" class="col-sm-12 control-label">Timesheet Type*</label>
							<div class="col-sm-12">
								<div class="input-group">
									<input type="hidden" class="form-control" name="admin_id" value="1">
									<input type="text" class="form-control" name="description" id="description">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
						</div>
				</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger waves-effect waves-light">Create</button>
					</div>
					</form>
			</div>
		</div>
	</div>
	<!-- end create modal -->
	<style>
		#previewTimesheetTypes .values { border-bottom:#6BB9F0 solid 2px;padding:5px }
	</style>
	<!-- start create modal -->
	<div id="previewTimesheetTypes" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Timesheet Type</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
						<div class="form-group row">
							<label for="description" class="col-sm-12 control-label">Timesheet Type</label>
							<div class="col-sm-12">
								<div class='values' id="description"></div>
							</div>
						</div>
				</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
						<button onclick="$('#editTimesheetTypes').modal('show');$('#previewTimesheetTypes').modal('hide');" class="btn btn-danger waves-effect waves-light">Edit</button>
					</div>
			</div>
		</div>
	</div>
	<!-- end create modal -->
	
	<!-- start create modal -->
	<div id="editTimesheetTypes" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Update Timesheet Type</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form id="updateTimesheetType" method="post" action="<?php echo base_url("payroll/crud/update/timesheettype"); ?>" class="form-horizontal p-t-20">
						<div class="form-group row">
							<label for="description" class="col-sm-12 control-label">Timesheet Type*</label>
							<div class="col-sm-12">
								<div class="input-group">
									<input type="hidden" class="form-control" name="rowid" id="rowid">
									<input type="hidden" class="form-control" name="admin_id" id="admin_id" value="1">
									<input type="text" class="form-control" name="description" id="description">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
						</div>
				</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger waves-effect waves-light">Update</button>
					</div>
					</form>
			</div>
		</div>
	</div>
	<!-- end create modal -->
</div>

<script>
	$(document).ready(function() {
		getTimesheetTypesList();
		<?php 
			if($this->session->flashdata('global_message') != "") {
				echo $this->session->flashdata('global_message');
			}
		?>
	});
	
	function getTimesheetTypesList() {
		$.post("<?php echo base_url("payroll/crud/retrieve/timesheettype"); ?>",{ admin_id : "1" })
		.done(function(data) {
			$("#TimesheetTypesData").html(data);
			$('#tblTimesheetTypes').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			});
			$(".preloader").fadeOut();
		});
	}
	
	function fneditTimesheetType(id) {
		$.post("<?php echo base_url("payroll/prepupdate/timesheettype"); ?>",{ admin_id : "1", id: id })
		.done(function(json) {
			if(json == "Unable to proceed insufficient account level!") {
				swal("Error!", json, "error"); 
				return false;
			}
			var obj = JSON.parse(json);
			$('#editTimesheetTypes input#rowid').val(obj[0].id);
			$('#editTimesheetTypes input#description').val(obj[0].description);
			$('#previewTimesheetTypes div#description').text(obj[0].description);
			$("#previewTimesheetTypes").modal('show');
		});
		
	}
	
	function fndeleteTimesheetType(id) {
		swal({   
            title: "Are you sure you want to delete this record?",   
            text: "You will not be able to recover this record!",   
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
				$.post("<?php echo base_url("payroll/crud/delete/timesheettype"); ?>",{ admin_id : "1", id: id })
				.done(function(data) {
					if(data == 1) { // or true
						$('#tblTimesheetTypes').DataTable().destroy();
						getTimesheetTypesList();
						swal("Deleted!", "Record was successfully deleted!", "success"); 
					} else {
						swal("Error!", data, "error"); 
					}
				});  
            } else {     
                swal("Cancelled", "Record is not deleted!", "error");   
            } 
        });
	}
</script>

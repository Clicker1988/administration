<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h3 class="text-themecolor">Payroll Records</h3>
	</div>
	<div class="col-md-7 align-self-center">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
			<li class="breadcrumb-item">Payroll Transactions</li>
			<li class="breadcrumb-item active">Payroll Period</li>
		</ol>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-sm-10">
							<h4 class="card-title">Payroll Period</h4>
							<h6 class="card-subtitle">List of Payroll Period</h6>
						</div>
						<div class="col-12 col-sm-2">
							<?php if($this->session->userdata('userlevel') != "VIEWER"): ?>
							<button type='button' data-toggle="modal" data-target="#createPayperiod" class='btn btn-info'><i class='fa fa-edit'></i> Create New</button>
							<?php endif; ?>
						</div>
					</div>
					<div class="table-responsive m-t-10">
						<table id="tblPayperiod" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Description</th>
									<th>Date From</th>
									<th>Date To</th>
									<th>Active</th>
									<th>Date Inserted</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody id="payperiodData">
										
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
	<div id="createPayperiod" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Create New Pay Period</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?php echo base_url("payroll/crud/create/payperiod"); ?>" class="form-horizontal p-t-20">
						<div class="form-group row">
							<label for="description" class="col-sm-12 control-label">Description</label>
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
						<div class="form-group row">
							<label for="date_from" class="col-sm-12 control-label">Date From*</label>
							<div class="col-sm-12">
								<div class="input-group">
									<input type="text" class="form-control" name="date_from" id="date_from">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="date_to" class="col-sm-12 control-label">Date To*</label>
							<div class="col-sm-12">
								<div class="input-group">
									<input type="text" class="form-control" name="date_to" id="date_to">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="status" class="col-sm-12 control-label">Active</label>
							<div class="col-sm-12">
								<div class="input-group">
									<select class="form-control" name="status" id="status">
										<option value="Y">Yes</option>
										<option value="N">No</option>
									</select>
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
		#previewPayperiod .values { border-bottom:#6BB9F0 solid 2px;padding:5px }
	</style>
	<!-- start create modal -->
	<div id="previewPayperiod" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Payroll Period</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
						<div class="form-group row">
							<label for="description" class="col-sm-12 control-label">Description</label>
							<div class="col-sm-12">
								<div class='values' id="description"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="date_from" class="col-sm-12 control-label">Date From</label>
							<div class="col-sm-12">
								<div class='values' id="date_from"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="date_to" class="col-sm-12 control-label">Date To</label>
							<div class="col-sm-12">
								<div class='values' id="date_to"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="status" class="col-sm-12 control-label">Active</label>
							<div class="col-sm-12">
								<div class='values' id="status"></div>
							</div>
						</div>
				</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
						<button onclick="$('#editPayperiod').modal('show');$('#previewPayperiod').modal('hide');" class="btn btn-danger waves-effect waves-light">Edit</button>
					</div>
			</div>
		</div>
	</div>
	<!-- end create modal -->
	
	<!-- start create modal -->
	<div id="editPayperiod" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Update Payroll Period</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form id="updatePayperiod" method="post" action="<?php echo base_url("payroll/crud/update/payperiod"); ?>" class="form-horizontal p-t-20">
						<div class="form-group row">
							<label for="description" class="col-sm-12 control-label">Description*</label>
							<div class="col-sm-12">
								<div class="input-group">
									<input type="hidden" class="form-control" name="rowid" id="rowid">
									<input type="hidden" class="form-control" name="admin_id" value="1">
									<input type="text" class="form-control" name="description" id="description">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="date_from" class="col-sm-12 control-label">Date From*</label>
							<div class="col-sm-12">
								<div class="input-group">
									<input type="text" class="form-control" name="date_from" id="date_from">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="date_to" class="col-sm-12 control-label">Date To*</label>
							<div class="col-sm-12">
								<div class="input-group">
									<input type="text" class="form-control" name="date_to" id="date_to">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="status" class="col-sm-12 control-label">Active*</label>
							<div class="col-sm-12">
								<div class="input-group">
									<select class="form-control" name="status" id="status">
										<option value="Y">Yes</option>
										<option value="N">No</option>
									</select>
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
		$('#createPayperiod #date_from').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD HH:mm:00' });
		$('#createPayperiod #date_to').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD HH:mm:00' });
		$('#editPayperiod #date_from').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD HH:mm:00' });
		$('#editPayperiod #date_to').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD HH:mm:00' });
		getPayperiodList();
		<?php 
			if($this->session->flashdata('global_message') != "") {
				echo $this->session->flashdata('global_message');
			}
		?>
	});
	
	function getPayperiodList() {
		$.post("<?php echo base_url("payroll/crud/retrieve/payperiod"); ?>",{ admin_id : "1" })
		.done(function(data) {
			$("#payperiodData").html(data);
			$('#tblPayperiod').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			});
		});
		
		$(".preloader").fadeOut();
	}
	
	function fneditPayperiod(id) {
		$.post("<?php echo base_url("payroll/prepupdate/payperiod"); ?>",{ admin_id : "1", id: id })
		.done(function(json) {
			if(json == "Unable to proceed insufficient account level!") {
				swal("Error!", json, "error"); 
				return false;
			}
			var obj = JSON.parse(json);
			$('#editPayperiod input#rowid').val(obj[0].id);
			$('#editPayperiod input#description').val(obj[0].description);
			$('#editPayperiod input#date_from').val(obj[0].date_from);
			$('#editPayperiod input#date_to').val(obj[0].date_to);
			$('#editPayperiod select#status').val(obj[0].status);
			$('#previewPayperiod div#description').text(obj[0].description);
			$('#previewPayperiod div#date_from').text(obj[0].date_from);
			$('#previewPayperiod div#date_to').text(obj[0].date_to);
			var status = "";
			if(obj[0].status == "Y") { status = "Yes"; } else { status = "No"; }
			$('#previewPayperiod div#status').text(status);
			$("#previewPayperiod").modal('show');
		});
	}
	
	function fndeletePayperiod(id) {
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
				$.post("<?php echo base_url("payroll/crud/delete/payperiod"); ?>",{ admin_id : "1", id: id })
				.done(function(data) {
					if(data == 1) { // or true
						$('#tblPayperiod').DataTable().destroy();
						getPayperiodList();
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

<style>
	.form-group { margin-bottom:5px; }
	.form-group .input-group > .form-control { min-height:35px !important;font-size:12px !important; }
	.holderx { font-size:11px; }
	.modal-lg { max-width: 80%; }
</style>
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h3 class="text-themecolor">Asset Management</h3>
	</div>
	<div class="col-md-7 align-self-center">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="breadcrumb-item">Asset</li>
			<li class="breadcrumb-item active">Repair and Maintenance</li>
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
				<div id="mainAssetDiv" class="card-body">
					<div class="row">
						<div class="col-12 col-sm-10">
							<h4 class="card-title">List of Assets Under Repair</h4>
							<h6 class="card-subtitle">Documented Assets that are Either on Repair on Maintenance</h6>
						</div>
						<div class="col-12 col-sm-2">
							<?php if($this->session->userdata('userlevel') != "VIEWER"): ?>
							<button type='button' onclick="showRepair();" class='btn btn-info'><i class='fa fa-edit'></i> Create New</button>
							<?php endif; ?>
						</div>
					</div>
					<div class="table-responsive m-t-10">
						<table id="tblAssetList" class="display wrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr style="border: 1px solid #e2e2e2; background-color: #0059b3; color: #fff;">
									<th>Name</th>
									<th>Model No.</th>
									<th>Stock Type</th>
									<th>Ownership</th>
									<th>Repair Reason</th>
									<th>Manufacturer</th>
									<th id="optdiv">Options</th>
								</tr>
							</thead>
							<tbody id="assetListData" >
										
							</tbody>
						</table>
					</div>
				</div>
				
				<div id="repairAssetDiv" class="card-body">
					<div class="form-group row">
						<div class="col-sm-4">
								<div class="input-group">
									<label for="assetid" class="p-0 col-sm-12 control-label">Asset Name</label>
									<input type='hidden' name='assetid' id='assetid'>
									<div class="input-group">
										<select class="select2 form-control custom-select" id="option_assetid" style="width: 100%; height:36px;">
											<option value="" disabled>-- Select --</option>
										</select>
									</div>
								</div>
						</div>
						<div class="col-sm-4">
								<label for="repair_reason" class="p-0 col-sm-12 control-label">Reason For Repair</label>
								<div class="input-group">
									<input type="text" class="form-control" name="repair_reason" id="repair_reason">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
						</div>
						<div class="col-sm-4">
								<div class="input-group">
									<label for="asset" class="p-0 col-sm-12 control-label">Repair Status</label>
									<input type='hidden' name='status' id='status'>
									<div class="input-group">
										<select class="select2 form-control custom-select" id="option_status" style="width: 100%; height:36px;">
											<option value="" disabled>-- Select --</option>
										</select>
									</div>
								</div>
							</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">
								<div class="input-group">
									<label for="comment" class="p-0 col-sm-12 control-label">Detailed Information</label>
									<textarea class="form-control" name="repair_details" id="repair_details" rows=4></textarea>
								</div>
							</div>
						</div>
						<div class="form-group row" style="margin-top:10px;">
							<div class="col-sm-10">
								<div class="input-group">
									<button type='button' id="btnRepair" onclick="createRepairList($(this));" class='btn btn-warning'><i class='fa fa-edit'></i>&nbsp;Create Repair Item</button>&nbsp;
									<button type='button' id="btnCancel" onclick="cancel();" class='btn btn-danger'><i class='fa fa-close'></i>&nbsp;Cancel</button>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="input-group">
									<button type='button' id="btnEdit" onclick="updateRepairDetail();" class='btn btn-primary pull-right'><i class='fa fa-edit'></i>&nbsp;Update Details</button>
								</div>
							</div>
						</div>
						<div class="table-responsive m-t-10">
							<table id="tblAssetRepairList" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr style="border: 1px solid #e2e2e2; background-color: #0059b3; color: #fff;">
										<th>Item For Repair</th>
										<th>Description</th>
										<th>Assigned Team</th>
										<th>Status of Repair</th>
										<th>Cost</th>
										<th>Action Taken</th>
										<th id="optdiv">Options</th>
									</tr>
								</thead>
								<tbody id="repairItemData" >
									
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
	

</div>


<div id="repairDetailDiv" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add Repair Item</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form id="assetLog" method="post" action="#" class="form-horizontal p-t-20">
					<div class="form-group row">
							<div class="col-sm-3">
								<label for="repair_item" class="p-0 col-sm-12 control-label">Item for Repair</label>
								<div class="input-group">
									<input type='hidden' name='repair_detail_id' id='repair_detail_id'>
									<input type='hidden' name='repair_asset_id' id='repair_asset_id'>
									<input type='hidden' name='repair_asset_name' id='repair_asset_name'>
									<input type='hidden' name='repair_asset_reason' id='repair_asset_reason'>
									<input type='hidden' name='repair_asset_status' id='repair_asset_status'>
									<input type='hidden' name='repair_asset_details' id='repair_asset_details'>
									
									<input type="text" class="form-control" name="repair_item" id="repair_item">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<label for="assigned_team" class="p-0 col-sm-12 control-label">Assigned Team</label>
								<div class="input-group">
									<input type="text" class="form-control" name="assigned_team" id="assigned_team">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="input-group">
									<label for="asset" class="p-0 col-sm-12 control-label">Repair Status</label>
									<input type='hidden' name='repair_status' id='repair_status'>
									<div class="input-group">
										<select class="select2 form-control custom-select" id="option_repair_status" style="width: 100%; height:36px;">
											<option value="" disabled>-- Select --</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="input-group">
									<label for="assigned_team" class="p-0 col-sm-12 control-label">Repair Cost</label>
									<div class="input-group">
										<input type="number" class="form-control" name="repair_cost" id="repair_cost">
										<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
										</div>
									</div>
								</div>
							</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">
								<label for="repair_description" class="p-0 col-sm-12 control-label">Repair Information</label>
								<div class="input-group">
									<textarea class="form-control" name="repair_description" id="repair_description" rows=4></textarea>
								</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">
								<label for="action_taken" class="p-0 col-sm-12 control-label">Action Taken</label>
								<div class="input-group">
									<textarea class="form-control" name="action_taken" id="action_taken" rows=4></textarea>
								</div>
						</div>
					</div>
				</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
						<button type="button" onclick="createRepairLog();" class="btn btn-danger waves-effect waves-light">Create</button>
					</div>
					</form>
			</div>
		</div>
	</div>
	<!-- end create modal -->
	
	<style>
		#prevDetailDiv .values { border-bottom:#6BB9F0 solid 2px;padding:5px }
	</style>
	
	<div id="prevDetailDiv" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Preview Repair Item</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div class="form-group row">
							<div class="col-sm-3">
								<div class="input-group">
									<label for="ownership" class="p-0 col-sm-12 control-label">Item for Repair</label>
									<div class="col-sm-12">
										<div class='values' id="prev_repair_item"></div>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="input-group">
									<label for="ownership" class="p-0 col-sm-12 control-label">Assigned Team</label>
									<div class="col-sm-12">
										<div class='values' id="prev_assigned_team"></div>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="input-group">
									<label for="ownership" class="p-0 col-sm-12 control-label">Repair Status</label>
									<div class="col-sm-12">
										<div class='values' id="prev_repair_status"></div>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="input-group">
									<label for="prev_" class="p-0 col-sm-12 control-label">Repair Cost</label>
									<div class="col-sm-12">
										<div class='values' id="prev_repair_cost"></div>
									</div>
								</div>
							</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">
							<div class="input-group">
									<label for="prev_" class="p-0 col-sm-12 control-label">Repair Information</label>
									<div class="col-sm-12">
										<div class='values' id="prev_repair_description"></div>
									</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">
							<div class="input-group">
									<label for="prev_action_taken" class="p-0 col-sm-12 control-label">Action Taken</label>
									<div class="col-sm-12">
										<div class='values' id="prev_action_taken"></div>
									</div>
							</div>
						</div>
					</div>
				</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
						<button type="button" onclick="showEditLog();" class="btn btn-info waves-effect waves-light">Edit</button>
					</div>
			</div>
		</div>
	</div>
	<!-- end preview modal -->


<div id="editDetailDiv" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Update Repair Item</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form id="editassetLog" method="post" action="#" class="form-horizontal p-t-20">
					<div class="form-group row">
							<div class="col-sm-3">
								<label for="repair_item" class="p-0 col-sm-12 control-label">Item for Repair</label>
								<div class="input-group">
									<input type='hidden' name='repair_detail_id' id='repair_detail_id'>
									<input type='hidden' name='edit_log_id' id='edit_log_id'>
									<input type='hidden' name='edit_asset_id' id='edit_asset_id'>
									<input type='hidden' name='edit_asset_name' id='edit_asset_name'>
									<input type='hidden' name='edit_asset_reason' id='edit_asset_reason'>
									<input type='hidden' name='edit_asset_status' id='edit_asset_status'>
									<input type='hidden' name='edit_asset_details' id='edit_asset_details'>
									
									<input type="text" class="form-control" name="edit_repair_item" id="edit_repair_item">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<label for="assigned_team" class="p-0 col-sm-12 control-label">Assigned Team</label>
								<div class="input-group">
									<input type="text" class="form-control" name="edit_assigned_team" id="edit_assigned_team">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="input-group">
									<label for="asset" class="p-0 col-sm-12 control-label">Repair Status</label>
									<input type='hidden' name='edit_repair_status' id='edit_repair_status'>
									<div class="input-group">
										<select class="select2 form-control custom-select" id="edit_option_repair_status" style="width: 100%; height:36px;">
											<option value="" disabled>-- Select --</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="input-group">
									<label for="assigned_team" class="p-0 col-sm-12 control-label">Repair Cost</label>
									<div class="input-group">
										<input type="number" class="form-control" name="edit_repair_cost" id="edit_repair_cost">
										<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
										</div>
									</div>
								</div>
							</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">
								<label for="repair_description" class="p-0 col-sm-12 control-label">Repair Information</label>
								<div class="input-group">
									<textarea class="form-control" name="edit_repair_description" id="edit_repair_description" rows=4></textarea>
								</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">
								<label for="action_taken" class="p-0 col-sm-12 control-label">Action Taken</label>
								<div class="input-group">
									<textarea class="form-control" name="edit_action_taken" id="edit_action_taken" rows=4></textarea>
								</div>
						</div>
					</div>
				</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
						<button type="button" onclick="editRepairLog();" class="btn btn-primary waves-effect waves-light">Update</button>
					</div>
					</form>
			</div>
		</div>
	</div>
	<!-- end create modal -->
	
	
<script>
	$(document).ready(function() {
		$('#createAssetList #procurement_date').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD HH:mm:00' });
		<?php 
			if($this->session->flashdata('global_message') != "") {
				echo $this->session->flashdata('global_message');
			}
		?>
		getList();
		
		$('#repairAssetDiv #option_assetid').select2({
			dropdownParent: $("#repairAssetDiv"),
			ajax: {
				url: "<?php echo base_url("asset/crud/retrieve/repair_asset_list"); ?>",
				type: "POST",
				dataType: 'json',
				delay: 100,
				data: function (params) {
					var query = { admin_id: "1",searchTerm: params.description }
					return query;
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
		
		$('#repairAssetDiv #option_status').select2({
			dropdownParent: $("#repairAssetDiv"),
			ajax: {
				url: "<?php echo base_url("asset/crud/retrieve/repair_stat"); ?>",
				type: "POST",
				dataType: 'json',
				delay: 100,
				data: function (params) {
					var query = { admin_id: "1",searchTerm: params.description }
					return query;
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
		
		$('#repairDetailDiv #option_repair_status').select2({
			dropdownParent: $("#repairAssetDiv"),
			ajax: {
				url: "<?php echo base_url("asset/crud/retrieve/repair_stat"); ?>",
				type: "POST",
				dataType: 'json',
				delay: 100,
				data: function (params) {
					var query = { admin_id: "1",searchTerm: params.description }
					return query;
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
		
		$('#editDetailDiv #edit_option_repair_status').select2({
			dropdownParent: $("#editDetailDiv"),
			ajax: {
				url: "<?php echo base_url("asset/crud/retrieve/repair_stat"); ?>",
				type: "POST",
				dataType: 'json',
				delay: 100,
				data: function (params) {
					var query = { admin_id: "1",searchTerm: params.description }
					return query;
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
		
		$("#repairAssetDiv #option_assetid").change(function() {
			$('#assetid').val($("#repairAssetDiv #option_assetid option:selected").val());
			auditRepairLogs();
		});
		$("#repairAssetDiv #option_status").change(function() {
			$('#status').val($("#repairAssetDiv #option_status option:selected").text());
		});
		$("#repairDetailDiv #option_repair_status").change(function() {
			$('#repair_status').val($("#repairDetailDiv #option_repair_status option:selected").text());
		});
		
		$("#editDetailDiv #edit_option_repair_status").change(function() {
			$('#edit_repair_status').val($("#editDetailDiv #edit_option_repair_status option:selected").text());
		});
		
		$('#repairAssetDiv').hide();
	});
	
	function showRepair(){
		$('#repairAssetDiv').show();
		$('#mainAssetDiv').hide();
		$('#btnEdit').hide();
		
	}
	
	function createRepairLog(){
		$.post('<?php echo base_url("asset/crud/create/assetRepairlist"); ?>', $('#assetLog').serialize())
		.done(function(data){
			if(data == "success"){
				swal("Register!", "Record was successfully deleted!", "success"); 
			}else if(data == "error"){
				swal("Register!", "Error Creating Record!, Kindly Retry Again!", "info"); 
			}else if(data == "parameter"){
				swal("Register!", "Invalid Parameters, Kindly validate your data!", "info"); 
			}
		});
		auditRepairLogs();
		$('#repairDetailDiv').modal('hide');
		$("#assetLog :input").each(function(){
			$(this).val(''); 
		});
	}
	
	function editRepairLog(){
		$.post('<?php echo base_url("asset/crud/update/assetRepairLoglist"); ?>',$('#editassetLog').serialize() )
		.done(function(data){
			auditRepairLogs();
			if(data == "success"){
				swal("Update!", "Record was successfully updated!", "success"); 
			}else if(data == "error"){
				swal("Update!", "Error Creating Record!, Kindly Retry Again!", "info"); 
			}else if(data == "parameter"){
				swal("Update!", "Invalid Parameters, Kindly validate your data!", "info"); 
			}
		});
		
		$('#editDetailDiv').modal('hide');
		$("#editassetLog :input").each(function(){
			$(this).val(''); 
		});
	}
	
	function createRepairList(itm){
		if($('#status').val() == null || $('#assetid').val() == null || $('#repair_reason').val() == "" || $('#repair_details').val() == ""){
			swal("Error!", "All Fields Required", "error"); 
			return false
		}else{
			$('#repair_asset_id').val($('#option_assetid').val());
			$('#repair_asset_name').val($('#option_assetid option:selected').text());
			$('#repair_asset_reason').val($('#repair_reason').val());
			$('#repair_asset_status').val($('#option_status option:selected').text());
			$('#repair_asset_details').val($('#repair_details').val());
			$('#repairDetailDiv').modal();
		}
	}
	
	function showEditLog(){
		$('#prevDetailDiv').modal('hide');
		$('#editDetailDiv').modal();
		$('#btnEdit').show();
	}
	
	function auditRepairLogs(){
		
		var id = $('#assetid').val();
		console.log(id);
		if(id == null){
			return false;
		}
		$("#repairItemData").html('');
		$.post("<?php echo base_url("asset/crud/retrieve/repair_audit_logs"); ?>",{ admin_id : "1" , searchTerm: id, })
		.done(function(data) {
			$('#tblAssetRepairList').DataTable().destroy();
			$("#repairItemData").html(data);
			$('#tblAssetRepairList').DataTable({
				dom: 'frtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			});
		});
	}
	
	function getList(){
		$.post("<?php echo base_url("asset/crud/retrieve/assetOnRepairList"); ?>",{ admin_id : "1" })
		.done(function(data) {
			$("#assetListData").html(data);
			$('#tblAssetList').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			});
		});
	}
	
	function fnPrevRepair(xid){
		
		$.post("<?php echo base_url("asset/prepupdate/repairitem"); ?>",{ admin_id : "1", id: xid })
		.done(function(json) {
			if(json == "Unable to proceed insufficient account level!") {
				swal("Error!", json, "error"); 
				return false;
			}
			var obj = JSON.parse(json);
			
			$('#edit_repair_detail_id').val($('#repair_detail_id').val());
			$('#edit_log_id').val(xid);
			$('#edit_asset_id').val(obj[0].asset_id);
			$('#edit_asset_name').val($('#option_assetid option:selected').text());
			$('#edit_asset_reason').val($('#repair_reason').val());
			$('#edit_asset_status').val($('#option_status option:selected').text());
			$('#edit_asset_details').val($('#repair_details').val());
			
			
			$('#edit_repair_item').val(obj[0].repair_item);
			$('#edit_assigned_team').val(obj[0].assigned_team);
			$('#edit_repair_status').val(obj[0].repair_status);
			$('#select2-edit_option_repair_status-container').text(obj[0].repair_status);
			$('#edit_repair_cost').val(obj[0].repair_cost);
			$('#edit_repair_description').val(obj[0].repair_description);
			$('#edit_action_taken').val(obj[0].action_taken);

			
			$('#prev_repair_item').text(obj[0].repair_item);
			$('#prev_assigned_team').text(obj[0].assigned_team);
			$('#prev_repair_status').text(obj[0].repair_status);
			$('#prev_repair_cost').text(obj[0].repair_cost);
			$('#prev_repair_description').text(obj[0].repair_description);
			$('#prev_action_taken').text(obj[0].action_taken);
			
			$('#prevDetailDiv').modal();
			
			
		});
	}
	
	function fnDelRepair(id){
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
				$.post("<?php echo base_url("asset/crud/delete/asset_repair_log"); ?>",{ admin_id : "1", id: id })
				.done(function(data) {
					if(data == "success") { 
						auditRepairLogs();
						swal("Deleted!", "Record was successfully deleted!", "success"); 
					} else {
						swal("Error!", data, "info"); 
					}
				});  
            } else {     
                swal("Cancelled", "Record is not deleted!", "error");   
            } 
        });
	}
	
	function viewRepair(xid, logid){
		
		$.post("<?php echo base_url("asset/prepupdate/repairlog"); ?>",{ admin_id : "1", id: xid })
		.done(function(json) {
			if(json == "Unable to proceed insufficient account level!") {
				swal("Error!", json, "error"); 
				return false;
			}
			var obj = JSON.parse(json);
			
			$('#repair_detail_id').val(logid);
			$('#assetid').val(obj[0].asset_id);
			$('#repair_reason').val(obj[0].repair_reason);
			$('#status').val(obj[0].status).trigger('change');;
			$('#select2-option_status-container').text(obj[0].status);
			$('#repair_details').val(obj[0].repair_details);
			$('#select2-option_assetid-container').text(obj[0].name);
			
			$('#repairAssetDiv').show();
			$('#mainAssetDiv').hide();
			$('#option_assetid').attr('disabled','disabled');
			auditRepairLogs();

		});
	}
	
	function cancel(){
		location.reload();
	}
	
	
	function updateRepairDetail(){
		if(id = $('#repair_detail_id').val() == "" || $('#status').val() == null || $('#assetid').val() == null || $('#repair_reason').val() == "" || $('#repair_details').val() == ""){
			swal("Error!", "All Fields Required", "error"); 
			return false
		}else{
			var id = $('#repair_detail_id').val();
			var assetid = $('#assetid').val();
			var stat = $('#status').val();
			var reason = $('#repair_reason').val();
			var details = $('#repair_details').val();
			
			swal({   
            title: "Are you sure you want to edit this record?",   
            text: "You are about to modify this record!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#4D8FAC",   
            confirmButtonText: "Yes",   
            cancelButtonText: "No",   
            closeOnConfirm: false,   
            closeOnCancel: false,
			showLoaderOnConfirm: true 
        }, function(isConfirm){   
            if (isConfirm) {     
				$.post("<?php echo base_url("asset/crud/update/asset_repair_update"); ?>",
				{ admin_id : "1", id: id, asset_id: assetid, asset_stat: stat, asset_reason: reason, asset_details: details, })
				.done(function(data) {
					if(data == "success") { 
						auditRepairLogs();
						swal("Updated!", "Record was successfully updated!", "success"); 
					} else {
						swal("Error!", data, "info"); 
					}
				});  
            } else {     
                swal("Cancelled", "Record is not Updated!", "error");   
            } 
        });
			
		}
	}
</script>
 <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgdwfZSVM-XkwgcnoJMr-bmWPlEhVxbpE"></script>
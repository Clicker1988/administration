<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h3 class="text-themecolor">Project Records</h3>
	</div>
	<div class="col-md-7 align-self-center">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="breadcrumb-item">Projects</li>
			<li class="breadcrumb-item active">Equipment Rate</li>
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
							<h4 class="card-title">Equipment Rate</h4>
							<h6 class="card-subtitle">List of Rates</h6>
						</div>
						<div class="col-12 col-sm-2">
							<?php if($this->session->userdata('userlevel') != "VIEWER"): ?>
							<button type='button' data-toggle="modal" data-target="#createEquipList" class='btn btn-info'><i class='fa fa-edit'></i> Create New</button>
							<?php endif; ?>
						</div>
					</div>
					<div class="table-responsive m-t-10">
						<table id="tblEquipList" class="display wrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Code</th>
									<th>Description</th>
									<th>Equip No.</th>
									<th>Class</th>
									<th>FA Rate</th>
									<th>Geo Rate</th>
									<th>Make</th>
									<th>Model</th>
									<th>OT Factor</th>
									<th>Row Delay</th>
									<th>Date Inserted</th>
									<th id="optdiv">Options</th>
								</tr>
							</thead>
							<tbody id="equipListData">
										
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
	<div id="createEquipList" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Create New Equipment Rate</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?php echo base_url("projects/crud/create/equiprate"); ?>" class="form-horizontal p-t-20">
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="code" class="p-0 col-sm-12 control-label">Code*</label>
								<div class="input-group">
									<input type="hidden" class="form-control" name="admin_id" value="1">
									<input type="text" class="form-control" name="code" id="code">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="description" class="p-0 col-sm-12 control-label">Description*</label>
								<div class="input-group">
									<input type="text" class="form-control" name="description" id="description">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="equip_no" class="p-0 col-sm-12 control-label">Equipment Number*</label>
								<div class="input-group">
									<input type="number" class="form-control" name="equip_no" id="equip_no">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="class" class="p-0 col-sm-12 control-label">Location*</label>
								<div class="input-group">
									<input type="text" class="form-control" name="class" id="class">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-location-pin"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="fa_rate" class="p-0 col-sm-12 control-label">FA Rate*</label>
								<div class="input-group">
									<input type="number" class="form-control" name="fa_rate" id="fa_rate">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-list"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="geo_rate" class="p-0 col-sm-12 control-label">Geo Rate*</label>
								<div class="input-group">
									<input type="number" class="form-control" name="geo_rate" id="geo_rate">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-list"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="make" class="p-0 col-sm-12 control-label">Make*</label>
								<div class="input-group">
									<input type="text" class="form-control" name="make" id="make">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-list"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="model" class="p-0 col-sm-12 control-label">Model*</label>
								<div class="input-group">
									<input type="text" class="form-control" name="model" id="model">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-list"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="ot_factor" class="p-0 col-sm-12 control-label">OT Factor*</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ot_factor" id="ot_factor">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-list"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="row_delay" class="p-0 col-sm-12 control-label">Row Delay*</label>
								<div class="input-group">
									<input type="number" class="form-control" name="row_delay" id="row_delay">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-list"></i></span>
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
		#previewEquipList label { font-size:14px; }
		#previewEquipList .values { border-bottom:#6BB9F0 solid 2px;padding:5px }
	</style>
	<!-- start create modal -->
	<div id="previewEquipList" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Equipment Rate</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="code" class="p-0 ol-sm-12 control-label">Code</label>
								<div class="values" id="code"></div>
							</div>
							<div class="col-sm-6">
								<label for="description" class="p-0 col-sm-12 control-label">Description</label>
								<div class="values" id="description"></div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="equip_no" class="p-0 col-sm-12 control-label">Equipment Number</label>
								<div class="values" id="equip_no"></div>
							</div>
							<div class="col-sm-6">
								<label for="class" class="p-0 col-sm-12 control-label">Location</label>
								<div class="values" id="class"></div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="fa_rate" class="p-0 col-sm-12 control-label">FA Rate</label>
								<div class="values" id="fa_rate"></div>
							</div>
							<div class="col-sm-6">
								<label for="geo_rate" class="p-0 col-sm-12 control-label">Geo Rate</label>
								<div class="values" id="geo_rate"></div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="make" class="p-0 col-sm-12 control-label">Make</label>	
								<div class="values" id="make"></div>
							</div>
							<div class="col-sm-6">
								<label for="model" class="p-0 col-sm-12 control-label">Model</label>
								<div class="values" id="model"></div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="ot_factor" class="p-0 col-sm-12 control-label">OT Factor</label>
								<div class="values" id="ot_factor"></div>
							</div>
							<div class="col-sm-6">
								<label for="row_delay" class="p-0 col-sm-12 control-label">Row Delay</label>
								<div class="values" id="row_delay"></div>
							</div>
						</div>
				</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
						<button onclick="$('#editEquipList').modal('show');$('#previewEquipList').modal('hide');" class="btn btn-danger waves-effect waves-light">Edit</button>
					</div>
					</form>
			</div>
		</div>
	</div>
	<!-- end create modal -->
	
	<!-- start create modal -->
	<div id="editEquipList" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Update Equipment Rate</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?php echo base_url("projects/crud/update/equiprate"); ?>" class="form-horizontal p-t-20">
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="code" class="p-0 ol-sm-12 control-label">Code*</label>
								<div class="input-group">
									<input type="hidden" class="form-control" name="rowid" id="rowid">
									<input type="hidden" class="form-control" name="admin_id" value="1">
									<input type="text" class="form-control" name="code" id="code">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="description" class="p-0 col-sm-12 control-label">Description*</label>
								<div class="input-group">
									<input type="text" class="form-control" name="description" id="description">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="equip_no" class="p-0 col-sm-12 control-label">Equipment Number*</label>
								<div class="input-group">
									<input type="number" placeholder="" class="form-control" name="equip_no" id="equip_no">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="class" class="p-0 col-sm-12 control-label">Location*</label>
								<div class="input-group">
									<input type="text" class="form-control" name="class" id="class">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-location-pin"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="fa_rate" class="p-0 col-sm-12 control-label">FA Rate*</label>
								<div class="input-group">
									<input type="number" class="form-control" name="fa_rate" id="fa_rate">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-list"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="geo_rate" class="p-0 col-sm-12 control-label">Geo Rate*</label>
								<div class="input-group">
									<input type="number" class="form-control" name="geo_rate" id="geo_rate">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-list"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="make" class="p-0 col-sm-12 control-label">Make*</label>	
								<div class="input-group">
									<input type="text" class="form-control" name="make" id="make">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-list"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="model" class="p-0 col-sm-12 control-label">Model*</label>
								<div class="input-group">
									<input type="text" class="form-control" name="model" id="model">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-list"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="ot_factor" class="p-0 col-sm-12 control-label">OT Factor*</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ot_factor" id="ot_factor">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-list"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="row_delay" class="p-0 col-sm-12 control-label">Row Delay*</label>
								<div class="input-group">
									<input type="number" class="form-control" name="row_delay" id="row_delay">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-list"></i></span>
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
		getEquipRate();
		<?php 
			if($this->session->flashdata('global_message') != "") {
				echo $this->session->flashdata('global_message');
			}
		?>
	});
	
	function getEquipRate() {
		$.post("<?php echo base_url("projects/crud/retrieve/equiprate"); ?>",{ admin_id : "1" })
		.done(function(data) {
			$("#equipListData").html(data);
			$('#tblEquipList').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			});
			$(".preloader").fadeOut();
			//getEquipTypes();
		});
	}
	
	function getProjectList2() {
		$.post("<?php echo base_url("projects/crud/retrieve/projlist"); ?>",{ admin_id : "1" })
		.done(function(data) {
			$("#projListData").html(data);
			$('#tblProjList').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			});
		});
	}
	
	function getEquipTypes() {
		$.post("<?php echo base_url("projects/crud/retrieve/cbotypes"); ?>",{ admin_id : "1" })
		.done(function(data) {
			$("#createProjList #project_type").html(data);
			$("#editProjectType #project_type").html(data);
			
		});
	}
	
	function fndeleteEquipRate(id) {
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
				$.post("<?php echo base_url("projects/crud/delete/equiprate"); ?>",{ admin_id : "1", id: id })
				.done(function(data) {
					if(data == 1) { // or true
						$('#tblEquipList').DataTable().destroy();
						getEquipRate();
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
	
	function fneditEquipRate(id) {
		$.post("<?php echo base_url("projects/prepupdate/equiprate"); ?>",{ admin_id : "1", id: id })
		.done(function(json) {
			if(json == "Unable to proceed insufficient account level!") {
				swal("Error!", json, "error"); 
				return false;
			}
			var obj = JSON.parse(json);
			$('#editEquipList input#rowid').val(obj[0].id);
			$('#editEquipList input#code').val(obj[0].code);
			$('#editEquipList input#description').val(obj[0].description);
			$('#editEquipList input#equip_no').val(obj[0].equip_no);
			$('#editEquipList input#class').val(obj[0].class);
			$('#editEquipList input#fa_rate').val(obj[0].fa_rate);
			$('#editEquipList input#geo_rate').val(obj[0].geo_rate);
			$('#editEquipList input#make').val(obj[0].make);
			$('#editEquipList input#model').val(obj[0].model);
			$('#editEquipList input#ot_factor').val(obj[0].ot_factor);
			$('#editEquipList input#row_delay').val(obj[0].row_delay);
			$('#previewEquipList div#code').text(obj[0].code);
			$('#previewEquipList div#description').text(obj[0].description);
			$('#previewEquipList div#equip_no').text(obj[0].equip_no);
			$('#previewEquipList div#class').text(obj[0].class);
			$('#previewEquipList div#fa_rate').text(obj[0].fa_rate);
			$('#previewEquipList div#geo_rate').text(obj[0].geo_rate);
			$('#previewEquipList div#make').text(obj[0].make);
			$('#previewEquipList div#model').text(obj[0].model);
			$('#previewEquipList div#ot_factor').text(obj[0].ot_factor);
			$('#previewEquipList div#row_delay').text(obj[0].row_delay);
			$("#previewEquipList").modal('show');
		});
	}
</script>

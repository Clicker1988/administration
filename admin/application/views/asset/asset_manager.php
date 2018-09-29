<style>
	.form-group { margin-bottom:5px; }
	.form-group .input-group > .form-control { min-height:35px !important;font-size:11px !important; }
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
			<li class="breadcrumb-item active">Management</li>
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
							<h4 class="card-title">List of Assets</h4>
							<h6 class="card-subtitle">Documented Assets and other Properties</h6>
						</div>
						<div class="col-12 col-sm-2">
							<?php if($this->session->userdata('userlevel') != "VIEWER"): ?>
							<button type='button' data-toggle="modal" data-target="#createAssetList" class='btn btn-info'><i class='fa fa-edit'></i> Create New</button>
							<?php endif; ?>
						</div>
					</div>
					<div class="table-responsive m-t-10">
						<table id="tblAssetList" class="display wrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Name</th>
									<th>Serial No</th>
									<th>Model No.</th>
									<th>Stock Type</th>
									<th>Description</th>
									<th>Cost</th>
									<th>Manufacturer</th>
									<th>Procuerement Date</th>
									<th>Warranty Expiration</th>
									<th id="optdiv">Options</th>
								</tr>
							</thead>
							<tbody id="assetListData" >
										
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
	<div id="createAssetList" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Create New Asset List</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?php echo base_url("asset/crud/create/assetlist"); ?>" class="form-horizontal p-t-20">
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="name" class="p-0 col-sm-12 control-label">Name*</label>
								<div class="input-group">
									<input type="hidden" class="form-control" name="admin_id" value="1">
									<input type="text" class="form-control" name="name" id="name">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="option_stock_type" class="col-sm-12 control-label">Stock Type*</label>
								<input type='hidden' name='stock_type' id='stock_type'>
								<div class="input-group">
									<select class="select2 form-control custom-select" id="option_stock_type" style="width: 100%; height:36px;">
											<option value="" disabled>-- Select --</option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="serialno" class="p-0 col-sm-12 control-label">Serial No*</label>
								<div class="input-group">
									<input type="text" class="form-control" name="serialno" id="serialno">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
									<label for="modelno" class="p-0 col-sm-12 control-label">Model No*</label>
									<input type="text" class="form-control" name="modelno" id="modelno">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="description" class="p-0 col-sm-12 control-label">Description*</label>
								<div class="input-group">
									<input type="text" class="form-control" name="description" id="description">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
									<label for="cost" class="p-0 col-sm-12 control-label">Cost*</label>
									<input type="number" class="form-control" name="cost" id="cost">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="manufacturer" class="p-0 col-sm-12 control-label">Manufacturer*</label>
								<div class="input-group">
									<input type="text" class="form-control" name="manufacturer" id="manufacturer">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="option_condition" class="col-sm-12 control-label">Condition*</label>
								<input type='hidden' name='condition' id='condition'>
								<div class="input-group">
									<select class="select2 form-control custom-select" id="option_condition" style="width: 100%; height:36px;">
										<option value="" disabled>-- Select --</option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6">
								<div class="input-group">
									<label for="procurement_date" class="p-0 col-sm-12 control-label">Procuerement Date</label>
									<input type="text" class="form-control" name="procurement_date" id="procurement_date">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
									<label for="warranty_exp_date" class="p-0 col-sm-12 control-label">Warranty Expiration</label>
									<input type="text" class="form-control" name="warranty_exp_date" id="warranty_exp_date">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6">
								<div class="input-group">
									<label for="ownership" class="p-0 col-sm-12 control-label">Ownership Status</label>
									<input type='hidden' name='ownership' id='ownership'>
									<div class="input-group">
										<select class="select2 form-control custom-select" id="option_ownership" style="width: 100%; height:36px;">
											<option value="" disabled>-- Select --</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
									<label for="gps_id" class="p-0 col-sm-12 control-label">GPS ID*</label>
									<div class="input-group">
										<input type="text" class="form-control" name="gps_id" id="gps_id">
										<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-12">
								<div class="input-group">
									<label for="comment" class="p-0 col-sm-12 control-label">Additional Information</label>
									<textarea class="form-control" name="comment" id="comment"></textarea>
									
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
		#previewAssetList .values { border-bottom:#6BB9F0 solid 2px;padding:5px }
	</style>
	<!-- start create modal -->
	<div id="previewAssetList" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"> Asset List</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form method="post" action="#" class="form-horizontal p-t-20">
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="name" class="p-0 col-sm-12 control-label">Name*</label>
								<div class="col-sm-12">
									<div class='values' id="prName"></div>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="option_stock_type" class="col-sm-12 control-label">Stock Type*</label>
								<div class="col-sm-12">
									<div class='values' id="prstock_type"></div>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="serialno" class="p-0 col-sm-12 control-label">Serial No*</label>
								<div class="col-sm-12">
									<div class='values' id="prserialno"></div>
									
								</div>
							</div>
							<div class="col-sm-6">
								<div class="col-sm-12">
									<label for="modelno" class="p-0 col-sm-12 control-label">Model No*</label>
									<div class='values' id="prmodelno"></div>
									
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="description" class="p-0 col-sm-12 control-label">Description*</label>
								<div class="col-sm-12">
									<div class='values' id="prdescription"></div>
									
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
									<label for="cost" class="p-0 col-sm-12 control-label">Cost*</label>
									<div class="col-sm-12">
										<div class='values' id="prcost"></div>
										
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="manufacturer" class="p-0 col-sm-12 control-label">Manufacturer*</label>
								<div class="col-sm-12">
									<div class='values' id="prmanufacturer"></div>
									
								</div>
							</div>
							<div class="col-sm-6">
								<label for="option_condition" class="col-sm-12 control-label">Condition*</label>
								<div class="col-sm-12">
									<div class='values' id="prcondition"></div>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6">
								<div class="input-group">
									<label for="procurement_date" class="p-0 col-sm-12 control-label">Procuerement Date</label>
									<div class="col-sm-12">
										<div class='values' id="prprocurement_date"></div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
									<label for="warranty_exp_date" class="p-0 col-sm-12 control-label">Warranty Expiration</label>
									<div class="col-sm-12">
										<div class='values' id="prwarranty_exp_date"></div>
									</div>	
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6">
								<div class="input-group">
									<label for="ownership" class="p-0 col-sm-12 control-label">Ownership Status</label>
									<div class="col-sm-12">
										<div class='values' id="prownership"></div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
									<label for="prgps_id" class="p-0 col-sm-12 control-label">GPS ID*</label>
									<div class="col-sm-12">
										<div class='values' id="prgps_id"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-12">
								<div class="input-group">
									<label for="comment" class="p-0 col-sm-12 control-label">Additional Information</label>
									<div class="col-sm-12">
										<div class='values' id="prcomment"></div>
									</div>	
								</div>
							</div>
						</div>
				</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary waves-effect waves-light" onclick="updateAsset();">Edit</button>
					</div>
					</form>
			</div>
		</div>
	</div>
	<!-- end create modal -->

	<!-- start create modal -->
	<div id="editAssetList" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Update Asset Item</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form method="post" action="<?php echo base_url("asset/crud/update/assetlist"); ?>" class="form-horizontal p-t-20">
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="name" class="p-0 col-sm-12 control-label">Name*</label>
								<div class="input-group">
									<input type="hidden" class="form-control" name="edit_id" id="edit_id" >
									<input type="text" class="form-control" name="edit_Name" id="edit_Name">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="option_stock_type" class="col-sm-12 control-label">Stock Type*</label>
								<input type='hidden' name='edit_stock_type' id='edit_stock_type'>
								<div class="input-group">
									<select class="select2 form-control custom-select" id="edit_option_stock_type" style="width: 100%; height:36px;">
											<option value="" disabled>-- Select --</option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="edit_serialno" class="p-0 col-sm-12 control-label">Serial No*</label>
								<div class="input-group">
									<input type="text" class="form-control" name="edit_serialno" id="edit_serialno">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
									<label for="edit_modelno" class="p-0 col-sm-12 control-label">Model No*</label>
									<input type="text" class="form-control" name="edit_modelno" id="edit_modelno">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="edit_description" class="p-0 col-sm-12 control-label">Description*</label>
								<div class="input-group">
									<input type="text" class="form-control" name="edit_description" id="edit_description">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
									<label for="edit_cost" class="p-0 col-sm-12 control-label">Cost*</label>
									<input type="number" class="form-control" name="edit_cost" id="edit_cost">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6">
								<label for="edit_manufacturer" class="p-0 col-sm-12 control-label">Manufacturer*</label>
								<div class="input-group">
									<input type="text" class="form-control" name="edit_manufacturer" id="edit_manufacturer">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="option_condition" class="col-sm-12 control-label">Condition*</label>
								<input type='hidden' name='edit_condition' id='edit_condition'>
								<div class="input-group">
									<select class="select2 form-control custom-select" id="edit_option_condition" style="width: 100%; height:36px;">
										<option value="" disabled>-- Select --</option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6">
								<div class="input-group">
									<label for="procurement_date" class="p-0 col-sm-12 control-label">Procuerement Date</label>
									<input type="text" class="form-control" name="edit_procurement_date" id="edit_procurement_date">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
									<label for="warranty_exp_date" class="p-0 col-sm-12 control-label">Warranty Expiration</label>
									<input type="text" class="form-control" name="edit_warranty_exp_date" id="edit_warranty_exp_date">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-6">
								<div class="input-group">
									<label for="ownership" class="p-0 col-sm-12 control-label">Ownership Status</label>
									<input type='hidden' name='edit_ownership' id='edit_ownership'>
									<div class="input-group">
										<select class="select2 form-control custom-select" id="edit_option_ownership" style="width: 100%; height:36px;">
											<option value="" disabled>-- Select --</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
									<label for="edit_gps_id" class="p-0 col-sm-12 control-label">GPS ID</label>
									<div class="input-group">
										<input type="text" class="form-control" name="edit_gps_id" id="edit_gps_id">
										<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2"><i class="ti-ruler-pencil"></i></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-12">
								<div class="input-group">
									<label for="edit_comment" class="p-0 col-sm-12 control-label">Additional Information</label>
									<textarea class="form-control" name="edit_comment" id="edit_comment"></textarea>
									
								</div>
							</div>
						</div>
				</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
					</div>
					</form>
			</div>
		</div>
	</div>
	<!-- end create modal -->
	
	<!-- start create modal -->
	<div id="showMap" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Location Viewer</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div id="map" style="height:500px;"></div>
				</div>
				<div class="modal-footer">
					<small>Data are base from from Last Recorded Entry from the Database</small>
				</div>
			</div>
		</div>
	</div>
	<!-- end create modal -->
	
</div>

<script>
	$(document).ready(function() {
		$('#createAssetList #procurement_date').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD HH:mm:00' });
		$('#createAssetList #warranty_exp_date').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD HH:mm:00' });
		<?php 
			if($this->session->flashdata('global_message') != "") {
				echo $this->session->flashdata('global_message');
			}
		?>
		
		getList();
		
		$('#createAssetList #option_stock_type').select2({
			dropdownParent: $("#createAssetList"),
			ajax: {
				url: "<?php echo base_url("asset/crud/retrieve/stocktype"); ?>",
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
		
		$('#createAssetList #option_condition').select2({
			dropdownParent: $("#createAssetList"),
			ajax: {
				url: "<?php echo base_url("asset/crud/retrieve/condition"); ?>",
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
		
		$('#createAssetList #option_ownership').select2({
			dropdownParent: $("#createAssetList"),
			ajax: {
				url: "<?php echo base_url("asset/crud/retrieve/ownership"); ?>",
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
		
		$("#createAssetList #option_stock_type").change(function() {
			$('#stock_type').val($("#createAssetList #option_stock_type option:selected").text());
		});
		
		$("#createAssetList #option_condition").change(function() {
			$('#condition').val($("#createAssetList #option_condition option:selected").text());
		});
		
		$("#createAssetList #option_ownership").change(function() {
			$('#ownership').val($("#createAssetList #option_ownership option:selected").text());
		});
		
		$('#editAssetList #edit_option_stock_type').select2({
			dropdownParent: $("#editAssetList"),
			ajax: {
				url: "<?php echo base_url("asset/crud/retrieve/stocktype"); ?>",
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
		
		$('#editAssetList #edit_option_condition').select2({
			dropdownParent: $("#editAssetList"),
			ajax: {
				url: "<?php echo base_url("asset/crud/retrieve/condition"); ?>",
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
		
		$('#editAssetList #edit_option_ownership').select2({
			dropdownParent: $("#editAssetList"),
			ajax: {
				url: "<?php echo base_url("asset/crud/retrieve/ownership"); ?>",
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
		
		$("#editAssetList #edit_option_stock_type").change(function() {
			$('#edit_stock_type').val($("#editAssetList #edit_option_stock_type option:selected").text());
		});
		
		$("#editAssetList #edit_option_condition").change(function() {
			$('#edit_condition').val($("#editAssetList #edit_option_condition option:selected").text());
		});
		
		$("#editAssetList #edit_option_ownership").change(function() {
			$('#edit_ownership').val($("#editAssetList #edit_option_ownership option:selected").text());
		});

		
		});
	
	function getList(){
		$.post("<?php echo base_url("asset/crud/retrieve/assetlist"); ?>",{ admin_id : "1" })
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
	
	function fneditAssetData(id){
		
		$.post("<?php echo base_url("asset/prepupdate/assetInfo"); ?>",{ admin_id : "1", id: id })
		.done(function(json) {
			if(json == "Unable to proceed insufficient account level!") {
				swal("Error!", json, "error"); 
				return false;
			}
			var obj = JSON.parse(json);
			
			$('#edit_id').val(id);
			$('#edit_Name').val(obj[0].name);
			$('#edit_serialno').val(obj[0].serialno);
			$('#edit_modelno').val(obj[0].modelno);
			$('#edit_stock_type').val(obj[0].stock_type);
			$('#select2-edit_option_stock_type-container').text(obj[0].stock_type);
			$('#edit_description').val(obj[0].description);
			$('#edit_procurement_date').val(obj[0].procurement_date);
			$('#edit_warranty_exp_date').val(obj[0].warranty_exp_date);
			$('#edit_cost').val(parseInt(obj[0].cost));
			$('#edit_manufacturer').val(obj[0].manufacturer);
			$('#edit_condition').val(obj[0].condition);
			$('#select2-edit_option_condition-container').text(obj[0].condition);
			$('#edit_ownership').val(obj[0].ownership);
			$('#select2-edit_option_ownership-container').text(obj[0].ownership);
			$('#edit_comment').val(obj[0].comment);
			$('#gps_id').val(obj[0].gps_id);
			
			
			$('#prName').text(obj[0].name);
			$('#prserialno').text(obj[0].serialno);
			$('#prmodelno').text(obj[0].modelno);
			$('#prstock_type').text(obj[0].stock_type);
			$('#prdescription').text(obj[0].description);
			$('#prprocurement_date').text(obj[0].procurement_date);
			$('#prwarranty_exp_date').text(obj[0].warranty_exp_date);
			$('#prcost').text(obj[0].cost);
			$('#prmanufacturer').text(obj[0].manufacturer);
			$('#prcondition').text(obj[0].condition);
			$('#prownership').text(obj[0].ownership);
			$('#prcomment').text(obj[0].comment);
			$('#prgps_id').text(obj[0].gps_id);
			
			
			$("#previewAssetList").modal();
			
		});
	}
	
	function fndeleteAssetData(id){
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
				$.post("<?php echo base_url("asset/crud/delete/assetlist"); ?>",{ admin_id : "1", id: id })
				.done(function(data) {
					if(data == 1) { // or true
						$('#tblAssetList').DataTable().destroy();
						getList();
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
	
	function updateAsset(){
		$("#previewAssetList").modal('hide');
		$("#editAssetList").modal();
	}
	
	function fnfindme(gps){	
		var map;
		var iconBase = 'http://maps.google.com/mapfiles/kml/pal4/';
			var icons = {
			  parking: {
				icon: iconBase + 'icon7.png'
			  },
			  library: {
				icon: iconBase + 'icon29.png'
			  },
			  info: {
				icon: iconBase + 'icon41.png'
			  }
			};
			
		$.post("<?php echo base_url("asset/crud/retrieve/lastlocation"); ?>",{ admin_id : "1", gpsid: gps })
			.done(function(json) {
			if(json == "no records found") {
					swal("Opps!", json, "info"); 
					return false;
			}
			
			var obj = JSON.parse(json);
			var features = [
				{
				position: new google.maps.LatLng(obj.latitude, obj.longitude),
				type: 'info',
				content: obj.msg,
				}];
			
			map = new google.maps.Map(document.getElementById('map'), {
			  zoom: 16,
			  center: new google.maps.LatLng(obj.latitude, obj.longitude),
			  mapTypeId: 'roadmap',
			  zoomControl: true,
			  mapTypeControl: true,
			  scaleControl: true,
			  streetViewControl: true,
			  rotateControl: true,
			  fullscreenControl: true
			});
			
			features.forEach(function(feature) {
			  var infowindow = new google.maps.InfoWindow({
				content: feature.content
			  });
			  var marker = new google.maps.Marker({
				position: feature.position,
				icon: icons[feature.type].icon,
				map: map
			  }); 
			  marker.addListener('click', function() {
				infowindow.open(map, marker);
			  });
			});
			$('#showMap').modal();
		});
			
			
	}
</script>
 <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgdwfZSVM-XkwgcnoJMr-bmWPlEhVxbpE"></script>
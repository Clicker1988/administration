<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h3 class="text-themecolor">Administration</h3>
	</div>
	<div class="col-md-7 align-self-center">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
			<li class="breadcrumb-item">Administration</li>
			<li class="breadcrumb-item active">Admin Accounts</li>
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
							<h4 class="card-title">Admin Accounts</h4>
							<h6 class="card-subtitle">List of Accounts</h6>
						</div>
						<div class="col-12 col-sm-2">
							<?php if($this->session->userdata('userlevel') == "ADMIN"): ?>
							<button type='button' data-toggle="modal" data-target="#createAdminList" class='btn btn-info'><i class='fa fa-edit'></i> Create New</button>
							<?php endif; ?>
						</div>
					</div>
					<div class="table-responsive m-t-10">
						<table id="tblAdminList" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Fullname</th>
									<th>Username</th>
									<th>User Level</th>
									<th>Date Created</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody id="AdminListData">
										
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
	<div id="createAdminList" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Create New Admin Data</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form autocomplete="off" method="post" action="<?php echo base_url("user/crud/create/list"); ?>" class="form-horizontal p-t-20">
						<div class="form-group row">
							<label for="username" class="col-sm-12 control-label">Username*</label>
							<div class="col-sm-12">
								<div class="input-group">
									<input type="hidden" class="form-control" name="admin_id" value="1">
									<input type="text" class="form-control" name="username" id="username">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="password" class="col-sm-12 control-label">Password*</label>
							<div class="col-sm-12">
								<div class="input-group">
									<input type="text" class="form-control" name="password" id="password">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="fullname" class="col-sm-12 control-label">Full Name*</label>
							<div class="col-sm-12">
								<div class="input-group">
									<input type="text" class="form-control" name="fullname" id="fullname">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="level" class="col-sm-12 control-label">Level*</label>
							<div class="col-sm-12">
								<div class="input-group">
									<select class="form-control" id="level" name="level">
										<option value="ADMIN">ADMIN</option>
										<option value="EDITOR">EDITOR</option>
										<option value="VIEWER">VIEWER</option>
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
		#previewAdminList .values { border-bottom:#6BB9F0 solid 2px;padding:5px }
	</style>
	<!-- start create modal -->
	<div id="previewAdminList" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Update Admin Data</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
						<div class="form-group row">
							<label for="xusername" class="col-sm-12 control-label">Username*</label>
							<div class="col-sm-12">
								<div class="values" id="username"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="xfullname" class="col-sm-12 control-label">Full Name*</label>
							<div class="col-sm-12">
								<div class="values" id="fullname"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="level" class="col-sm-12 control-label">Level*</label>
							<div class="col-sm-12">
								<div class="values" id="level"></div>
							</div>
						</div>
				</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
						<button onclick="$('#editAdminList').modal('show');$('#previewAdminList').modal('hide');" class="btn btn-danger waves-effect waves-light">Edit</button>
					</div>
			</div>
		</div>
	</div>
	<!-- end create modal -->
	
	<!-- start create modal -->
	<div id="editAdminList" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Update Admin Data</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form autocomplete="off" id="updateAdminList" method="post" action="<?php echo base_url("user/crud/update/list"); ?>" class="form-horizontal p-t-20">
						<div class="form-group row">
							<label for="xusername" class="col-sm-12 control-label">Username*</label>
							<div class="col-sm-12">
								<div class="input-group">
									<input type="hidden" class="form-control" name="row_id" id="row_id" value="">
									<input type="text" class="form-control" name="username" id="username">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="xpassword" class="col-sm-12 control-label">Password*</label>
							<div class="col-sm-12">
								<div class="input-group">
									<input type="text" class="form-control" name="password" id="password">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="xfullname" class="col-sm-12 control-label">Full Name*</label>
							<div class="col-sm-12">
								<div class="input-group">
									<input type="text" class="form-control" name="fullname" id="fullname">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="ti-user"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="level" class="col-sm-12 control-label">Level*</label>
							<div class="col-sm-12">
								<div class="input-group">
									<select class="form-control" id="level" name="level">
										<option value="ADMIN">ADMIN</option>
										<option value="EDITOR">EDITOR</option>
										<option value="VIEWER">VIEWER</option>
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
		getAdminList();
		<?php 
			if($this->session->flashdata('global_message') != "") {
				echo $this->session->flashdata('global_message');
			}
		?>
	});
	
	function getAdminList() {
		$.post("<?php echo base_url("user/crud/retrieve/list"); ?>",{ admin_id : "1" })
		.done(function(data) {
			$("#AdminListData").html(data);
			$('#tblAdminList').DataTable({
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
			});
			$(".preloader").fadeOut();
		});
	}
	
	function fneditAdminList(id) {
		$.post("<?php echo base_url("user/prepupdate/list"); ?>",{ admin_id : "1", id: id })
		.done(function(json) {
			if(json == "Unable to proceed insufficient account level!") {
				swal("Error!", json, "error"); 
				return false;
			}
			var obj = JSON.parse(json);
			$('#updateAdminList input#row_id').val(obj[0].id);
			$('#updateAdminList input#username').val(obj[0].username);
			$('#updateAdminList input#fullname').val(obj[0].fullname);
			$('#updateAdminList select#level').val(obj[0].level);
			
			$('#previewAdminList div#username').text(obj[0].username);
			$('#previewAdminList div#fullname').text(obj[0].fullname);
			$('#previewAdminList div#level').text(obj[0].level);
			$("#previewAdminList").modal('show');
		});
		
	}
	
	function fndeleteAdminList(id) {
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
				$.post("<?php echo base_url("user/crud/delete/list"); ?>",{ admin_id : "1", id: id })
				.done(function(data) {
					if(data == 1) { // or true
						$('#tblAdminList').DataTable().destroy();
						getAdminList();
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

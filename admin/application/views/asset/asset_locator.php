<style>
	.form-group { margin-bottom:5px; }
	.form-group .input-group > .form-control { min-height:35px !important;font-size:11px !important; }
	.holderx { font-size:11px; }
	.modal-lg { max-width: 80%; }
</style>
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h3 class="text-themecolor">Asset Locator</h3>
	</div>
	<div class="col-md-7 align-self-center">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="breadcrumb-item">Asset</li>
			<li class="breadcrumb-item active">Locator</li>
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
						<div class="col-12 col-sm-12">
							<h4 class="card-title">List of Assets</h4>
							<h6 class="card-subtitle">Show the last recorded location of an Assest</h6>
						</div>
					</div>
					<br>
					<div class="row" style="min-height: 500px">
						<div class="col-3 col-sm-3">
							<div id="assetlist_holder" class="input-group">
								<label for="assetlist" class="p-0 col-sm-12 control-label">Please select one or more items below</label>
								<select class="select2 form-control custom-select" id="assetlist" style="width: 100%; height:36px;" multiple>
									<option value="" disabled>-- Select --</option>
								</select>
								<button type='button' class='btn btn-success' style="margin-top:10px;" onclick="fnfindme();">
									<i class='fa fa-map-marker'></i> Locate
								</button>
							</div>
							<br>
							<div style="min-height:370px;">
								<ul id="history" class="chatonline" style="list-style-type: none; padding: 0px;">
								
								</ul>
							</div>
						</div>
						<div class="col-9 col-sm-9">
							<div id="map" style="min-height:490px; border:1px solid #e2e2e2;"></div>
							<small>Returns the last recorded location of the selected asset(s).</small>
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

<script>
	$(document).ready(function() {
		<?php 
			if($this->session->flashdata('global_message') != "") {
				echo $this->session->flashdata('global_message');
			}
		?>
		$('#history').slimScroll({
			color: '#00f',
			size: '10px',
			height: '350px',
		});

		$('#assetlist').select2({
			dropdownParent: $("#assetlist_holder"),
			ajax: {
				url: "<?php echo base_url("asset/crud/retrieve/asset_list_names"); ?>",
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
		
	});
	
	
	function fneditAssetData(id){
		
		$.post("<?php echo base_url("asset/prepupdate/assetInfo"); ?>",{ admin_id : "1", id: id })
		.done(function(json) {
			if(json == "Unable to proceed insufficient account level!") {
				swal("Error!", json, "error"); 
				return false;
			}
			var obj = JSON.parse(json);
			
			
			$("#previewAssetList").modal();
			
		});
	}
	
	function fnfindme(){
		$('#map').html('');
		var assets = $('#assetlist').val();
		if(assets == null || assets == ""){
			swal("Error!", 'You have not selected and Item, Kindly Retry!', "info"); 
			return false;
		}
		
		var map;
		var iconBase = 'http://maps.google.com/mapfiles/kml/pal4/';
			var icons = {
			  running: {
				icon: iconBase + 'icon62.png'
			  },
			  issue: {
				icon: iconBase + 'icon15.png'
			  },
			  info: {
				icon: iconBase + 'icon41.png'
			  }
			};
			
		$.post("<?php echo base_url("asset/crud/retrieve/asset_location"); ?>",{ admin_id : "1", assetlist: assets })
			.done(function(json) {
			if(json == "no records found") {
					swal("Opps!", json, "info"); 
					return false;
			}		
			var obj = JSON.parse(json);
			
			map = new google.maps.Map(document.getElementById('map'), {
			  zoom: 12,
			  center: new google.maps.LatLng(obj[0].latitude, obj[0].longitude),
			  mapTypeId: 'roadmap',
			  zoomControl: true,
			  mapTypeControl: true,
			  scaleControl: true,
			  streetViewControl: true,
			  rotateControl: true,
			  fullscreenControl: true
			});
			
			$.each(obj, function (key, data) {
			
				var infowindow = new google.maps.InfoWindow({
					content: data.content
				  });
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng(data.latitude, data.longitude),
					icon: icons[data.type].icon,
					map: map
				  }); 
				marker.addListener('click', function() {
					infowindow.open(map, marker);
				});
			})
			
			
			
			/*
			features.forEach(function(feature) {
				console.log(feature.content);
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
			*/
		});
		
		gethistory();
	}

function gethistory(){
	$('#history').html('');
	var assets = $('#assetlist').val();
	if(assets == null || assets == ""){
		return false;
	}
	$.post("<?php echo base_url("asset/crud/retrieve/asset_history"); ?>",{ admin_id : "1", assetlist: assets })
		.done(function(response) {
		if(response != "") {
			$('#history').html(response);
		}		
	});
	
}


function historyitem(id){
	
	var map;
		var iconBase = 'http://maps.google.com/mapfiles/kml/pal4/';
			var icons = {
			  running: {
				icon: iconBase + 'icon62.png'
			  },
			  issue: {
				icon: iconBase + 'icon15.png'
			  },
			  info: {
				icon: iconBase + 'icon41.png'
			  }
			};
			
			$.post("<?php echo base_url("asset/crud/retrieve/asset_coordinates"); ?>",{ admin_id : "1", locid: id })
			.done(function(json) {
			if(json == "no records found") {
					swal("Opps!", json, "info"); 
					return false;
			}		
			var obj = JSON.parse(json);
			map = new google.maps.Map(document.getElementById('map'), {
			  zoom: 12,
			  center: new google.maps.LatLng(obj[0].latitude, obj[0].longitude),
			  mapTypeId: 'roadmap',
			  zoomControl: true,
			  mapTypeControl: true,
			  scaleControl: true,
			  streetViewControl: true,
			  rotateControl: true,
			  fullscreenControl: true
			});
			
			$.each(obj, function (key, data) {
				var infowindow = new google.maps.InfoWindow({
					content: data.content
				  });
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng(data.latitude, data.longitude),
					icon: icons[data.type].icon,
					map: map
				  }); 
				marker.addListener('click', function() {
					infowindow.open(map, marker);
				});
			});
		
		});
	
}
</script>
 <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgdwfZSVM-XkwgcnoJMr-bmWPlEhVxbpE"></script>
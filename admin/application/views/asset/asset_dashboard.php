<style>
	.form-group { margin-bottom:5px; }
	.form-group .input-group > .form-control { min-height:35px !important;font-size:11px !important; }
	.holderx { font-size:11px; }
	.modal-lg { max-width: 80%; }
</style>
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h3 class="text-themecolor">Asset Dashboard</h3>
	</div>
	<div class="col-md-7 align-self-center">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="breadcrumb-item">Asset</li>
			<li class="breadcrumb-item active">Dashboard</li>
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
							<h4 class="card-title">Chartings</h4>
							<h6 class="card-subtitle">Basic Statistical Data for all recorded Assets</h6>
						</div>
					</div>
					<br>
					<div class="row">
						<h4 class="card-title">Geo Location</h4>
						<div id="map" style="min-height: 500px" class="col-md-12">
						</div>
						<small>GeoGraphical Location of an Asset is Based on it Last Recorded Coordinates!</small>
					</div>
					<br>
					<div class="row" >
						<div class="col-6" >
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Type of Assets</h4>
									<div class="flot-chart">
										<div class="flot-chart-content" id="pieStock" style="width:450px;height:300px; margin-top:10px;"></div>
									</div>
									<br>
									<div class="text-center"><small class="text-center">Graphical Distribution / Division for Type of Asset</small>	</div>
								</div>
							</div>
						</div>
						<div class="col-6" >
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Owned and Rental Assets</h4>
									<div class="flot-chart">
										<div class="flot-chart-content" id="ownership" style="width:450px;height:300px;  margin-top:10px;"></div>
									</div>
									<br>
									<div class="text-center"><small >Graphical Distribution / Division for Asset Ownership</small> </div>	
								</div>
							</div>
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
	genPie();
	getAssetCoordinates();
});
	
function genPie(){
	
	$.post("<?php echo base_url("asset/crud/retrieve/piechart"); ?>",{ admin_id : "1", chartitem: 'stock_type' })
	.done(function(response) {
	var data = eval(response);

	/*
	 var data = [{	
        label: "Series 0"
        , data: 10
        , color: "#4f5467"
    , }, {
        label: "Series 1"
        , data: 1
        , color: "#26c6da"
    , }, {
        label: "Series 2"
        , data: 3
        , color: "#009efb"
    , }, {
        label: "Series 3"
        , data: 1
        , color: "#7460ee"
    , }];
	*/
	console.log(data);
		var plotObj = $.plot($("#pieStock"), data, {
			series: {
				pie: {
					innerRadius: 0.5
					, show: true
				},			
			}
			, grid: {
				hoverable: true
			}
			, color: null
			, tooltip: true
			, tooltipOpts: {
				content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
				shifts: {
					x: 20
					, y: 0
				}
				, defaultTheme: false
			}
		});
	});
	
	$.post("<?php echo base_url("asset/crud/retrieve/piechart"); ?>",{ admin_id : "1", chartitem: 'ownership' })
	.done(function(response) {
	var data = eval(response);
	console.log(data);
		var plotObj = $.plot($("#ownership"), data, {
			series: {
				pie: {
					innerRadius: 0.5
					, show: true
				},			
			}
			, grid: {
				hoverable: true
			}
			, color: null
			, tooltip: true
			, tooltipOpts: {
				content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
				shifts: {
					x: 20
					, y: 0
				}
				, defaultTheme: false
			}
		});
	});
}
	
function getAssetCoordinates(){
	
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
			
			$.post("<?php echo base_url("asset/crud/retrieve/asset_coordinates"); ?>",{ admin_id : "1", locid: 'ALL' })
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
  <!-- Flot Charts JavaScript -->
<script src="<?php echo base_url(); ?>public/assets/plugins/flot/excanvas.js"></script>
<script src="<?php echo base_url(); ?>public/assets/plugins/flot/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>public/assets/plugins/flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url(); ?>public/assets/plugins/flot/jquery.flot.time.js"></script>
<script src="<?php echo base_url(); ?>public/assets/plugins/flot/jquery.flot.stack.js"></script>
<script src="<?php echo base_url(); ?>public/assets/plugins/flot/jquery.flot.crosshair.js"></script>
<script src="<?php echo base_url(); ?>public/assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<!--
<script src="js/flot-data.js"></script>
-->

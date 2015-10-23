<?
	$config = Configure::read("TaxiCel"); // loading config	
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places" type="text/javascript"></script>
<script type="text/javascript">
	var baseurl = "<?=$config['BaseUrl']?>admin/HeatZones/";
	var map;
	var infoWindow;
	var triangleCoords = [];
	var bermudaTriangle;
	var poly;
	var heatzonelat = '22.56';
	var heatzonelon = '88.145';
	google.maps.event.addDomListener( window, 'load', initialize );
	$(document).ready( function() {
		//alert(baseurl);
		$("#btnAddZone").bind("click", addZoneHandler );
		/*$("#country").bind('change',getcities);
		$("#closmap").bind('click',closemapview);
		$("#mapdone").bind('click',donefrommap);
		$("#city").bind('change',getcitydetails);
		// bind the two button
		$("#htmpmap").bind('click',usingmapcreateheatmap);
		$("#htmpmanual").bind('click',manualycreateheatmap);
		$("#addlocaton").bind('click',addmanuallocations);
		$("#map-canvas").css({ height: $(window).height(), width: $(window).width() });*/
		//get old results
		var url=baseurl+'getallzones';
		 PlayAjax.call( url,zoneResultHandler,zoneFaultHandler);
	});
	function initialize() {
		var mapOptions = {
			zoom: 11,
			center: new google.maps.LatLng( heatzonelat, heatzonelon ),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			mapTypeControl: false,
		};
		map = new google.maps.Map( document.getElementById('map-canvas'), mapOptions );
		google.maps.event.addListener(map, 'click', mapClickHandler );
		infoWindow = new google.maps.InfoWindow();
	}
	function mapClickHandler(e) {
		var lat = e.latLng.lat();
		var lng = e.latLng.lng();
		PlayAjax.call( 'http://maps.googleapis.com/maps/api/geocode/json?latlng='+lat+','+lng+'&sensor=true', addrResultHandler, addrFaultHandler );
	}
 
	function addrResultHandler(response){
		console.log(response);
		var addr = null;
		if( response.length > 3 ) {
		addr = response.results[3];
		} else {
		addr = response.results[0];
		}
		triangleCoords.push( {  lat : addr.geometry.location.lat, 
			lon : addr.geometry.location.lng,
			location : addr.formatted_address } );
		createpolygons();
	}
 
	function addrFaultHandler( response ) {
		//console.log( "could not get the address" );
	}

	function createpolygons() {
		//console.log(bermudaTriangle);
		if( bermudaTriangle ) {
			bermudaTriangle.setMap(null);
		}
		// Convert each co-ordinate to latlong object
		var latlngs = [];
		for( var i=0; i<triangleCoords.length; i++ ) {
			var aLatLng = new google.maps.LatLng( triangleCoords[i].lat, triangleCoords[i].lon );
			latlngs.push( aLatLng );
		}
		var poly = new google.maps.Polyline({
			strokeColor: '#FF0000',
			path:latlngs
		});
		poly.setMap(map);
	}
	function addZoneHandler(e) {
		// validate the heat map zone name mendatory
		if ($("#city").val()=='' || $("#city").val()==0) {
		alert("No city available for hit map");
		return false;
		}
		if ($("#newzone").val()=='') {
		alert("Please provid heat map zone name.");
		return false;
		}
		// Validating whether at least 3 co-ordinate selected
		if( triangleCoords.length < 3 ) {
		alert("Please draw an area to mark a heat map zone.");
		return false;
		}

		// Preparing Latlong Set
		var acord;
		var verifirdLatLng = [];
		for( var i=0; i<triangleCoords.length; i++ ) {
		acord  = triangleCoords[i];
		$anHidInput = '<input type="hidden" name="heatZoneCords['+i+'][lat]" value="'+acord.lat+'" />\
		<input type="hidden" name="heatZoneCords['+i+'][lon]" value="'+acord.lon+'" />\
		<input type="hidden" name="heatZoneCords['+i+'][location]" value="'+acord.location+'" />';
		$("#heatZoneCordsHolder").append( $anHidInput );
		}
		return true;
	}
	//get old data for drawing zones
	function zoneResultHandler(response){
		console.log( response );
		for( var i=0; i<response.heatzones.length; i++ ) {
			var heatzone = response.heatzones[i];
			console.log(heatzone);
			// Convert each co-ordinate to latlong object
			var latlngs = [];
			for( var j=0; j<heatzone.cords.length; j++ ) {
				var acord = heatzone.cords[j];
				console.log(acord);
				var aLatLng = new google.maps.LatLng( acord.lat, acord.lon );
				latlngs.push( aLatLng );
			}
			// Construct the polygon.
			var bermudaTriangle = new google.maps.Polygon({
				paths: latlngs,
				strokeColor: '#FF0000',
				strokeOpacity: 0.8,
				strokeWeight: 1,
				fillColor: '#FF0000',
				fillOpacity: 0.35
			});
			bermudaTriangle.setMap(map);
		}
	}

	function zoneFaultHandler( response ) {
		//console.log( "could not get the address" );
	}
</script>

<div class="creatTol">
	<div class="heatZones form">
		<form method="post" id="heatZoneCordsHolder" action="<?=$config['BaseUrl']?>admin/HeatZones/add" />
			<fieldset>
				<legend><?php echo __('Add Heat Zone'); ?>
				
				<?php echo  $this->Html->link('Back',"javascript:history.back()", array('class'=>'bottonbackclass'))?>

				</legend>
				<?php
					echo $this->Form->input('city_id');
					echo $this->Form->input('name');
				?>
				<div style="width:100%;height:300px;" id="map-canvas"></div>
			</fieldset>
			<div class="submit">
				<input type="submit" value="Add Zone" id="btnAddZone">
			</div>
		</form>
	</div>
</div>
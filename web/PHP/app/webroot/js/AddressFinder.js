/**
 * Created at IDE
 * User: amarjit jha
 * Date: 16/12/12
 * Time: 11:21 PM
 * Component to search for location and display at map
 */
(function( $ ) {

    $.fn.AddressFinder = function( data ) {
		if( $('#map').length < 1 )
			$('body').append('<div id="map"></div>');
			
		var mapOptions = {
			  center: new google.maps.LatLng(-33.8688, 151.2195),
			  zoom: 13,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map( document.getElementById('map'), mapOptions );
		  
		var input = document.getElementById( $(this).attr('id') );
		var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.bindTo('bounds', map);
		google.maps.event.addListener(autocomplete, 'place_changed', function() {

		  var place = autocomplete.getPlace();
		  var latlong = { lat:place.geometry.location.lat(), long:place.geometry.location.lng(),types:place.types };
		  data.selected( latlong );
		  
		});
		
		/*var dropoff = document.getElementById( 'dropoff' );
		var autocomplete2 = new google.maps.places.Autocomplete(dropoff);
		autocomplete2.bindTo('bounds', map);
		google.maps.event.addListener( autocomplete2, 'place_changed', function() {
		  var place = autocomplete2.getPlace();
		  alert( 'dropoff' + place.geometry.location.lng() );
		});*/
    }  

})( jQuery );
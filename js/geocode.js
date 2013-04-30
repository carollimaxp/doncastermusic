var geocoder = new google.maps.Geocoder();
  	var map;
	var bounds = {};
    function codeAddress(e) {

	  $.each(e, function(index, item) {

		var address = item.venue_postcode+", uk";

		if (geocoder) {
		  geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
			  if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {

				// map.set_center(results[0].geometry.location);
				// var marker = new google.maps.Marker({
				//     map: map,
				//     position: results[0].geometry.location
				// });
				loc = results[0].geometry.location;
				loc2 = loc.toString().split(",");
				item.venue_glat = loc2[0].substr(1);
				item.venue_glon = loc2[1].substr(0,loc2[1].length-1);
				$.ajax({
				   type: "POST",
				   url: "/map/save",
				   data: ({'venue_glat' : item.venue_glat, 'venue_glon' : item.venue_glon, 'venue_id' : item.venue_id}),
				   success: function(msg){
				   }
				 });
					for(i2=0;i2<e.length;i2++) {
						EOI.addEoi(item);
					}

        } else {
                //alert("No results found");
			    $("#errors").append(item.venue_name + " : No results found<br>");
              }
            } else {
			  if (status != "OVER_QUERY_LIMIT" ){
				$("#errors").append(item.venue_name + " Error: " + status+"<br>");
			  }
            }
          });
        }
      });
	}

//	var map = new GMap2(document.getElementById("map_canvas"));
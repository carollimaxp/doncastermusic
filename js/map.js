// eoi is a json_encode array
var EOI = {};

//draw marker
EOI.addEoi = function(e){
	var point = new GLatLng(e.venue_glat, e.venue_glon);
	var eoiIcon = new GIcon(G_DEFAULT_ICON);
	eoiIcon.shadow = "";
	//eoiIcon.image = "/images/" + e.venue_type + ".png";
	eoiIcon.image = "/images/mapmarker.png";
	eoiIcon.iconSize = new GSize(45, 41);
	eoiIcon.iconAnchor = new GPoint(22, 20);
	// Set up our GMarkerOptions object
	markerOptions = { icon:eoiIcon };

    var marker = new GMarker(point, markerOptions);


    this.marker = marker; // store this so we can close it
    this.eoi = e; // store so we can reference when checkbox clicked

	//this is where we fill the info box
    GEvent.addListener(marker, "click", function() {
        var myHtml = "<p style='width:300px;'><a href='/venues/" + e.venue_id + "/' >"+e.venue_name+"</a><br/>" +
					e.venue_address + "<br/>" + e.venue_postcode +
					"<br/><br/><strong>Tel:</strong> " + e.venue_phone +
					"<br/><br/><strong>Url:</strong> <a href='" + e.venue_website +
					"'>" + e.venue_website + "</a></p>";


        EOI.map.openInfoWindowHtml(point, myHtml);


    });


    bounds.extend(point);
    EOI.map.addOverlay(marker);
};


//get map going
$(document).ready(function() {

    if (GBrowserIsCompatible()) {
        EOI.map = new GMap2(document.getElementById("map_canvas"));
        //EOI.map.setCenter(new GLatLng(53.3830548, -1.4647953), 13);
        EOI.map.setCenter(new GLatLng(53.523345, -1.128416), 15);
        EOI.map.setUIToDefault();
        bounds = new GLatLngBounds();
    }
    if (Eois!= null && Eois.length>=1) {
		for(i=0;i<Eois.length;i++) {
			EOI.addEoi(Eois[i]);
		}
	 }
   //reset map centre and zoom to just fit what data we have
   //EOI.map.setZoom(EOI.map.getBoundsZoomLevel(bounds));
   //EOI.map.setCenter(bounds.getCenter());

});
$(function() {
	
	google.setOnLoadCallback(initialize);

      var styles = [[{
        url: '../images/people35.png',
        height: 35,
        width: 35,
        anchor: [16, 0],
        textColor: '#ff00ff',
        textSize: 10
      }, {
        url: '../images/people45.png',
        height: 45,
        width: 45,
        anchor: [24, 0],
        textColor: '#ff0000',
        textSize: 11
      }, {
        url: '../images/people55.png',
        height: 55,
        width: 55,
        anchor: [32, 0],
        textColor: '#ffffff',
        textSize: 12
      }], [{
        url: '../images/conv30.png',
        height: 27,
        width: 30,
        anchor: [3, 0],
        textColor: '#ff00ff',
        textSize: 10
      }, {
        url: '../images/conv40.png',
        height: 36,
        width: 40,
        anchor: [6, 0],
        textColor: '#ff0000',
        textSize: 11
      }, {
        url: '../images/conv50.png',
        width: 50,
        height: 45,
        anchor: [8, 0],
        textSize: 12
      }], [{
        url: '../images/heart30.png',
        height: 26,
        width: 30,
        anchor: [4, 0],
        textColor: '#ff00ff',
        textSize: 10
      }, {
        url: '../images/heart40.png',
        height: 35,
        width: 40,
        anchor: [8, 0],
        textColor: '#ff0000',
        textSize: 11
      }, {
        url: '../images/heart50.png',
        width: 50,
        height: 44,
        anchor: [12, 0],
        textSize: 12
      }]];
      var map = null  ;
      var markerClusterer = null;
      var imageUrl = 'http://chart.apis.google.com/chart?cht=mm&chs=24x32&' +
          'chco=FFFFFF,008CFF,000000&ext=.png';
	
	/**********************************************
	 * carte Google Maps
	 **********************************************/
	 



var layers = [];

// end layers to toggle 
// intialize 
var map ;
	function initialize(){
		var myLatLng = new google.maps.LatLng(36.7, 6.0);
		var mapOptions={
			 zoom: 10, // 0 à 21
		 	center: myLatLng, // centre de la carte
			mapTypeId: google.maps.MapTypeId.ROADMAP // ROADMAP, SATELLITE, HYBRID, TERRAIN
		},
		
		map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

		setMarkers(map,marker); 
 
 
 
	google.maps.event.addDomListener(document.getElementById('layer_01'), 'click', function(evt) {
    toggleLayers(1);
  });
  google.maps.event.addDomListener(document.getElementById('layer_02'), 'click', function(evt) {
    toggleLayers(2);
  });
   google.maps.event.addDomListener(document.getElementById('layer_03'), 'click', function(evt) {
    toggleLayers(3);
  });
    google.maps.event.addDomListener(document.getElementById('layer_04'), 'click', function(evt) {
    toggleLayers(4);
  });
   
  // toggle layers at the beginning

function toggleLayers(i) {
      if (layers[i].getMap() == null) {
        layers[i].setMap(map);
      } else
	  layers[i].setMap(null);
    }
   //FICHIER KML IMPORTER DANS GMAIL
         
          

  

layers[1] = new google.maps.KmlLayer("https://www.dropbox.com/s/skoud93h6zrvrbs/limite_COMMUNE1.kmz?dl=1",
  {
    preserveViewport: true
	
  });
  layers[1].setMap(null); 
// COUCHE REBOISEMENTS 2000-2010
  layers[2] = new google.maps.KmlLayer("https://www.dropbox.com/s/kkx55nvv59ki0o3/REBOISEMENT_2000_2010.kml?dl=1",
  {
    preserveViewport: true
	
  });
  layers[2].setMap(null);
// couche deds Bassins versant
  layers[3] = new google.maps.KmlLayer("https://www.dropbox.com/s/qg6gm489bdj4mh4/BASSIN%20VERSANT.kmz?dl=1",
  {
    preserveViewport: true
  
  });
  layers[3].setMap(null);
  //couche des Limite forets

//www.dropbox.com/s/w0p5h998opxsuc4/fd.kmz?dl=1

   layers[4] = new google.maps.KmlLayer("https://www.dropbox.com/s/w0p5h998opxsuc4/fd.kmz?dl=1",
  {
    preserveViewport: true
  
  });
  layers[4].setMap(null);


/*

  var z = map.data.loadGeoJson('common/js/lignes.geojson');

  var infowindow = new google.maps.InfoWindow();
 

 
  // When the user clicks, open an infowindow
 map.data.addListener('click', function(event) {
      var Localite = event.feature.getProperty("localite");

    var action = event.feature.getProperty("nomactions");
        var realisation_physique = event.feature.getProperty("realisation_physique");

  infowindow.setContent("<div style='width:300px;'>"
         +"<p class='habitants'>Localite:</br>  <strong> <font size='2' color='red' > " +Localite+ "    </font> </strong> </p>" 

    +"<p class='habitants'>Nature de l'action:</br>  <strong> <font size='2' color='red' > " +action+ "    </font> </strong> </p>" 

    +"<p class='habitants'>Réalisation physique:</br>  <strong> <font size='2' color='red'   > " +realisation_physique+ "    </font> </strong> </p>"
    
    +"</div>");

  // position the infowindow on the marker

   infowindow.setPosition(event.latLng); // ここでinfowindowの位置を指定  // anchor the infowindow on the marker
  infowindow.setOptions({pixelOffset: new google.maps.Size(0,-30)});
  infowindow.open(map);


});
*/
 map.data.loadGeoJson('common/js/ppdri_point.geojson');


 var infowindow = new google.maps.InfoWindow();

  // When the user clicks, open an infowindow
  
 map.data.addListener('clik', function(event) {
        var Localite = event.feature.getProperty("localite");
        var action = event.feature.getProperty("nomactions");
        var paiement = event.feature.getProperty("paiement");

  infowindow.setContent("<div style='width:300px;'>"
    +"<p class='habitants'>Localite:</br>  <strong> <font size='2' color='red' > " +Localite+ " </font> </strong> </p>" 

     +"<p class='habitants'>Nature de l'action:</br>  <strong> <font size='2' color='red' > " +action+ " </font> </strong> </p>" 

    +"<p class='habitants'>Paiement:</br>  <strong> <font size='2' color='red'   > " +paiement+ " </font> </strong> </p>"
    
    +"</div>");

  // position the infowindow on the marker

   infowindow.setPosition(event.latLng); // ここでinfowindowの位置を指定  // anchor the infowindow on the marker
  infowindow.setOptions({pixelOffset: new google.maps.Size(0,-20)});
  infowindow.open(map);

});

 // fin de l'initialisation


//https://maps.google.com/mapfiles/kml/shapes/parking_lot_maps.png
var icon= "common/css/pipe-line-icon.png";
map.data.setStyle(function(feature) {
    return {icon:feature.getProperty('icon')};
  });



}
  map.data.setStyle({
    fillColor: 'green',
    strokeWeight: 2,
    icon: icon
  });  
  //  infowindow.close(map);
      
//map.data.loadGeoJson('common/js/geojsonTAHER.geojson');
  // When the user clicks, open an infowindow
 
 
/*
downloadUrl("xml/point.xml", function(data) {
		      var markers = data.documentElement.getElementsByTagName("marker");
		      for (var i = 0; i < markers.length; i++) {
			var latlng = new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")),
				                    parseFloat(markers[i].getAttribute("lng")));
			marker = createMarker(markers[i].getAttribute("ville"), latlng);
		       }
		  });
*/
	
	function createMarker(Localite, latlng) {
	    var marker = new google.maps.Marker({position: latlng, map: map});
	    google.maps.event.addListener(marker, "click", function() {
	      if (infowindow) infowindow.close();
	      infowindow = new google.maps.InfoWindow({content: Localite});
	      infowindow.open(map, marker);
	    });
	    return marker;
	  }

function setMarkers(map,locations){
		for(var i=0; i<locations.length; i++){
			var station = locations[i];
			var myLatLng = new google.maps.LatLng(station[0],station[1]);
			var infoWindow = new google.maps.InfoWindow();
			var marker = new google.maps.Marker ({
				position: myLatLng,
				map: map,
				title: station[2]
			});
			
			(function(i){
				google.maps.event.addListener(marker, "click", function(){
					var station = locations[i];
					infoWindow.close();
					
          
          
          infoWindow.setContent(

						"<div  "
							+"<p class='ville'><strong> <font size='2' color='red'   >"   +station[2]+   "</font> </strong></p>"
             +"<p class='habitants'>Code du projet et taux financier:</br>  <strong> <font size='2' color='red'   > " +station[7]+ "    </font> </strong> </p>"
      +"<p class='habitants'>cadre logique:</br>  <strong> <font size='2' color='red'   > "  +station[2]+   "    </font> </strong> </p>"
							+"Coordonnees :  "
							+"<p class='indent'>Latitude : "+station[0]+"</p>"
							+"<p class='indent'>Longitude : "+station[1]+"</p>"
						+"</div>"
      
					);
         
					infoWindow.open(map, this);
				});
			})(i);
		}
	}

  
	google.maps.event.addDomListener(window, 'load', initialize);
});

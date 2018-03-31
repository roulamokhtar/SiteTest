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
var actions = [];
// end layers to toggle 
// intialize 
var map ;

var markers = [];


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
      google.maps.event.addDomListener(document.getElementById('layer_05'), 'click', function(evt) {
    toggleLayers(5);
  });
   //FICHIER KML limites_communes layers[1] IMPORTER DANS dropbox
         
  layers[1] = new google.maps.KmlLayer("https://www.dropbox.com/s/r1nfh7kegtqcqc4/limites_communes.kmz?dl=1",
  {
    preserveViewport: true
  });
  layers[1].setMap(null); 
// COUCHE REBOISEMENTS 2000-2010 layers[2] 
  layers[2] = new google.maps.KmlLayer("https://www.dropbox.com/s/kkx55nvv59ki0o3/REBOISEMENT_2000_2010.kml?dl=1",
  {
    preserveViewport: true
  });
  layers[2].setMap(null);
// couche deds Bassins versant layers[3]
  layers[3] = new google.maps.KmlLayer("https://www.dropbox.com/s/qg6gm489bdj4mh4/BASSIN%20VERSANT.kmz?dl=1",
  {
    preserveViewport: true
  });
  layers[3].setMap(null);
  //couche des Limite forets layers[4] 
  //https://www.dropbox.com/s/w0p5h998opxsuc4/fd.kmz?dl=0
   layers[4] = new google.maps.KmlLayer("https://www.dropbox.com/s/w0p5h998opxsuc4/fd.kmz?dl=1",
  {
    preserveViewport: true
  
  });
  layers[4].setMap(null);
//couche des Limite cIRCON layers[5] 
  layers[5] = new google.maps.KmlLayer("https://www.dropbox.com/s/ztcevthqkosgkxz/Circonscription5.kmz?dl=1",
  {
    preserveViewport: true
  
  });
  layers[5].setMap(null);
 // https://www.dropbox.com/s/d5nc49heab3plke/Circonscri_jijel3.kmz?dl=0
// https://www.dropbox.com/s/ztcevthqkosgkxz/Circonscription5.kmz?dl=0
//layers[5] = new google.maps.Data();
 var infowindow = new google.maps.InfoWindow();
var infoWindow = new google.maps.InfoWindow({map:map});
 if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('vous etes ici.');
            //map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow  );
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
   // When the user clicks, open an infowindow
 map.data.addListener('click', function(event) { 
    var commune = event.feature.getProperty("commune");
    var Localite = event.feature.getProperty("localite");
    var action = event.feature.getProperty("nomactions");
        var realisation_physique = event.feature.getProperty("realisation_physique");
        var quantite = event.feature.getProperty("quantite");
        var unite = event.feature.getProperty("unit");

    var paiement = event.feature.getProperty("paiement");
    
    var annee = event.feature.getProperty("annee" );
    var cloture = event.feature.getProperty("cloture" );
  
   var source_financement = event.feature.getProperty("source_financement" );
   
      var  code_ppdri = event.feature.getProperty("code_ppdri" );
    
 
  infowindow.setContent("<div >"
        +"<p class='habitants'>Code du ppdri:   <strong> <font size='2' color='blue' > " +code_ppdri+ "    </font> </strong> </p>" 

    +"<p class='habitants'>Commune:   <strong> <font size='2' color='blue' > " +commune+ "    </font> </strong> </p>" 


         +"<p class='habitants'>Localite:   <strong> <font size='2' color='blue' > " +Localite+ "    </font> </strong> </p>" 
+"<p class='habitants'>Année:   <strong> <font size='2' color='blue' > "
+     annee  +

 

" </font> </strong> </p>" 
  


    +"<p class='habitants'>Nature de l'action:   <strong> <font size='1' color='blue' > " +action+ "    </font> </strong> </p>"
         +"<p class='habitants'>Source de financement:   <strong> <font size='2' color='blue' > " +source_financement+ "    </font> </strong> </p>"
+"<p class='habitants'>Volume prévu  :   <strong> <font size='2' color='blue' > "+ new Intl.NumberFormat().format(quantite)+
   "    "+unite+"   </font> </strong> </p>"
    +"<p class='habitants'>Réalisation Physique:   <strong> <font size='2' color='blue' > "+ new Intl.NumberFormat().format(realisation_physique)+
   "    "+unite+"   </font> </strong> </p>"  
    
    +"<p class='habitants'>Paiement:   <strong> <font size='2' color='blue' > "+ new Intl.NumberFormat().format(paiement)+
   "   Da   </font> </strong> </p>"
   +"<p class='habitants'>Réception définitive:   <strong> <font size='2' color='red' > "+ cloture+"  </font> </strong> </p>"
    
    +"</div>");
  // position the infowindow on the marker
var infoWindow = new google.maps.InfoWindow({
         
          maxWidth: 100
        });
   infowindow.setPosition(event.latLng); // ここでinfowindowの位置を指定  // anchor the infowindow on the marker
  infowindow.setOptions({pixelOffset: new google.maps.Size(0,0)});
  infowindow.open(map);


});
 var icon = {
    url: "common/css/waterdrop.png", // url
    scaledSize: new google.maps.Size(50, 50), // scaled size
    origin: new google.maps.Point(0,0), // origin
    anchor: new google.maps.Point(0, 0) // anchor
};
 map.data.setStyle({
    fillColor: 'red',


    strokeWeight: 2,
    icon:icon
   });
 map.data.setStyle(function(feature) {
    var icon = null;
    if (feature.getProperty('icon')=="PLANTATION FRUITIERE") {
        icon= "common/css/trees.png";

     }
     if (feature.getProperty('icon')=="CAPTAGE ET AMENAGEMENT DE SOURCE") {
        icon= "common/css/fountain-2.png";

     }
      if (feature.getProperty('icon')=="REALISATION BASSIN") {
        icon= "common/css/waterdrop.png";

     }
    
      return /** @type {google.maps.Data.StyleOptions} */ ({
      icon: icon,
          fillColor: 'green',
              strokeWeight: 2,


    });
      
  });


 
 

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }

  
 
// map.data.loadGeoJson('common/js/lignes.geojson');

 //map.data.LoadGeoJson('common/js/total.geojson');
 // zoom to show all the features



  //Load mapdata via geoJson
// map.data.loadGeoJson('common/js/total.geojson', null, function (features) {
  // map.fitBounds(bounds); // or do other stuff what requires all features loaded
//});

 

    

     
function toggleLayers(i) {
      if (layers[i].getMap() == null) {
        layers[i].setMap(map);
      } else{
    layers[i].setMap(null);
    }
  }


function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }
 function clearMarkers() {
        setMapOnAll(null);
      }


$(function(){
  
$("#checkboxes").on('change', '[type=checkbox]', function () {

           var unchecked = $(this).is(':unchecked');
           var checked = $(this).is(':checked');

           var e = map.data.loadGeoJson('common/js/total.geojson');


           map.data.forEach(function(feature) { 
           
           if (checked){

              map.data.overrideStyle(feature, {visible: false});
              map.data.setMap(map);
              }
             if(unchecked){
 
              map.data.setMap(null);
              }

                 });
            });
 
  




$("#checkboxer").on('change', '[type=checkbox]', function () {
 
           var lol = $(this).is(':unchecked');
           var lola = $(this).is(':checked');

           if (lol){
            
      clearMarkers();
        
              }
           if (lola){
             setMarkers(map,marker);
       
             
           
              }
              
            
 
                
});



});
            // fin de l'initialisation
}

   


 





    	function addMarkerWithTimeout(position, timeout) {
  window.setTimeout(function() {
    markers.push(new google.maps.Marker({
      position: position,
      map: map,
     
      animation: google.maps.Animation.BOUNCE
    }));
  }, timeout);
}
 
function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
  map:map;
}


 

function setMarkers(map,locations){

		for(var i=0; i<locations.length; i++){

			var station = locations[i];
			var myLatLng = new google.maps.LatLng(station[0],station[1]);
			var infoWindow = new google.maps.InfoWindow();
      var image = "common/css/Marker-Ball-Pink.png";
			var marker = new google.maps.Marker ({
				position: myLatLng,
         animation: google.maps.Animation.DROP,
         map: map,
				title: station[2],
        icon: image
			});
       markers.push(marker);

			(function(i){

				google.maps.event.addListener(marker, "click", function(){

         if (this.getAnimation() != null) {
          this.setAnimation(null);
        } else {
            var t= this.setAnimation(google.maps.Animation.BOUNCE) ;

            var aaa= function stopAnimation(marker) {
                 return   setTimeout(function(i) {
          
      marker.setAnimation(null);
    }, 2000);
             
      
 
};

         
             aaa(this);
              }

           
        //setTimeout(function(i) {
  //   setAnimation(null);
   // }, 2000);
					var station = locations[i];
 
					infoWindow.close();

          infoWindow.setContent(

						"<div  "
							+"<p class='ville'><strong> <font size='2' color='red'   >"   +station[2]+   "</font> </strong></p>"
               +"<p class='habitants'>Nombre de Projet(s) Trouvé(s) :   <strong> <font size='2' color='red'   > " +station[9]+  "     </font> </strong> </p>"
 
             +"<p class='habitants'>Code du projet et taux financier par actions:  <strong> <font size='2' color='red'> " +station[4]+ " </font> </strong> </p>"
              +"<p class='habitants'>Programme:</br>  <strong> <font size='2' color='red'   > " +station[6]+ " </font> </strong> </p>"
              
              +"<p class='habitants'>Source de financement selectionnée:  <strong> <font size='2' color='red'   > " +station[10]+ "     </font> </strong> </p>"

            +"Coordonnees :  "
							+"<p class='indent'>Latitude : "+station[0]+"</p>"
							+"<p class='indent'>Longitude : "+station[1]+"</p>"
              
						+"</div>"
      
					);
          
 
  infoWindow.open(map, this);

      map.setZoom(13);
   map.setCenter(this.getPosition());
				});

			})(i);

      ////////////////////fin de la fonction i

		}

	}
    


  
	google.maps.event.addDomListener(window, 'load', initialize);



});


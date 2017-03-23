//creation d'une variable json
/*
var donnees = [
    {
        "nom": "mamadou",
        "localite": "Timbi centre",
        "lat": "11.057332",
        "lon": " -12.399675"
    },
    {
        "nom": "n/a",
        "localite": "Mamasalé",
        "lat": "9.514108 ",
        "lon": "-13.711592"
    },
    {
        "nom": "msmadou",
        "localite": "Yari",
        "lat": "11.119393 ",
        "lon": "-12.502412"
    }
];

*/

var json = $.ajax({
          url: "inc/mapsData.php",
          dataType: "json",
          async: false
          }).responseText;

var donnees = JSON.parse(json);

 function initialiser() {
	var centre_carte = new google.maps.LatLng(donnees[0].latitude,donnees[0].longitude);
    var options = {
		center: centre_carte,
		zoom: 14, 
		mapTypeId: google.maps.MapTypeId.ROADMAP
		};
	  
	 //la carte
	 var carte =  new google.maps.Map(document.getElementById("map"), options);

	 	
//creation des marqueurs
var marqueurs = [];
for(var i = 0 ; i < donnees.length; i++ ) {
	marqueur = new google.maps.Marker({
           position: new google.maps.LatLng(donnees[i].latitude,donnees[i].longitude),
           map: carte,
		   title:donnees[i].societe
		   });
	marqueurs [i] = marqueur;
}

//creation des infowindows
var infowindows = [] ;
for(var j = 0; j < marqueurs.length; j++){
	let tmp = j;
	infowindows[tmp] = new google.maps.InfoWindow({
     content: "Societe : " + donnees[tmp].societe + "<br/>Substance : " + donnees[tmp].substance + "<br/>Prefecture : " + donnees[tmp].prefecture + "<br/>Agent " +donnees[tmp].prenomNom + "<br/>Date : " + donnees[tmp].date,
     size: new google.maps.Size(100, 100)
     });
	 
   google.maps.event.addListener(marqueurs[tmp], 'click', function() {
       infowindows[tmp].open(carte,marqueurs[tmp]);
    })
  }//for
} //fct

/*

 function initialiser() {
	var centre_carte = new google.maps.LatLng(donnees[0].lat,donnees[0].lon);
    var options = {
		center: centre_carte,
		zoom: 10, 
		mapTypeId: google.maps.MapTypeId.ROADMAP
		};
	  
	 //la carte
	 var carte =  new google.maps.Map(document.getElementById("map"), options);
	 
 // CONFIGURATION DE L'ICONE PERSONALISEE
    var image = {
          url: 'image/map.png',
          // Taille de l'icône personnalisée
          size: new google.maps.Size(32, 52),
         // Origine de l'image, souvent (0, 0)
         origin: new google.maps.Point(0,0),
        // L'ancre de l'image. Correspond au point de bat de l'image
         anchor: new google.maps.Point(0, 20)
       };
	 	
//creation des marqueurs
var marqueurs = [];
for(var i = 0 ; i < donnees.length; i++ ){
	marqueur = new google.maps.Marker({ 
           position: new google.maps.LatLng(donnees[i].lat,donnees[i].lon),
           map: carte,
		   title:" CHS "+ (i+1),
		   icon: image
		   });
	marqueurs [i] = marqueur;
}

//creation des infowindows
var infowindows = [] ;
for(var j = 0; j < marqueurs.length;j++){
	let tmp = j;
	infowindows[tmp] = new google.maps.InfoWindow({
     content: donnees[tmp].nom,
     size: new google.maps.Size(100, 100)
     });
	 
   google.maps.event.addListener(marqueurs[tmp], 'click', function() {
       infowindows[tmp].open(carte,marqueurs[tmp]);
    })  
  }//for
} //fct

*/

  
/* all that google maps stuff*/

var map;
var centerLatLng;
var places = [
  ['B&B Helene', 53.63001, 8.89412,"http://aWordpressChildTheme.de/wp-site/wp-content/themes/aWordpressChildTheme/assets/images/marker.png"]
];

/**
 * The HomeControl adds a control to the map that
 * returns the user to the control's defined home.
 */

// Define a property to hold the Home state
// HomeControl.prototype.home_ = null;

// // Define setters and getters for this property
// HomeControl.prototype.getHome = function() {
//  return this.home_;
// };


// function HomeControl(map, div, home) {
//  // Get the control DIV. We'll attach our control UI to this DIV.
//  var controlDiv = div;
//  // We set up a variable for the 'this' keyword since we're adding event
//  // listeners later and 'this' will be out of scope.
//  var control = this;

//  // Set the home property upon construction
//  control.home_ = home;

//  // Set CSS styles for the DIV containing the control. Setting padding to
//  // 5 px will offset the control from the edge of the map
//  controlDiv.style.padding = '5px';

//  // Set CSS for the control border
//  var goHomeUI = document.createElement('DIV');
//  goHomeUI.title = 'Klicken Sie hier um die Karte zurückzusetzen.';
//  controlDiv.appendChild(goHomeUI);

//  // Set CSS for the control interior
//  var goHomeText = document.createElement('DIV');
//  goHomeText.innerHTML = '<img src="http://dl.dropbox.com/u/4653932/html-HP-LarsWerner/resources/images/BackButton.png">';
//  goHomeUI.appendChild(goHomeText);

//  // Setup the click event listener for Home:
//  // simply set the map to the control's current home property.
//  google.maps.event.addDomListener(goHomeUI, 'click', function() {
//    var currentHome = control.getHome();
//    map.setCenter(currentHome);
//    map.setZoom(8);
//    map.controls[google.maps.ControlPosition.TOP_RIGHT].clear();

//    });
// }

function setGoogleMarkers(places){
  for (var i = 0; i < places.length; i++) {
    var place = places[i];
    var currMarker = new google.maps.Marker({
      map: map,
      title: place[0],
      position: new google.maps.LatLng(place[1], place[2]),
      icon: new google.maps.MarkerImage(place[3]),
      animation: google.maps.Animation.DROP
    });
    google.maps.event.addDomListener(currMarker, 'click', function() {
      map.setCenter(this.getPosition());
      map.setZoom(12);

      // if(map.controls[google.maps.ControlPosition.TOP_RIGHT].length ===0){
      //  // Create the DIV to hold the control and call the HomeControl()
      //  // constructor passing in this DIV.

      //  var homeControlDiv = document.createElement('DIV');
      //  homeControlDiv.id = "backButton";
      //  var homeControl = new HomeControl(map, homeControlDiv, centerLatLng);
      //  homeControlDiv.index = 1;
      //  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
      // }
    });
  }
}

function initGoogleMap() {
  var mapDiv = document.getElementById('map_canvas');
    centerLatLng = new google.maps.LatLng(53.63001, 8.89412);
  var myOptions = {
    zoom: 9,
    center: centerLatLng,
    streetViewControl: false,
    mapTypeControl: false,
    scrollwheel: false,
    panControl: false,
    draggable: false,
    zoomControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    };
  map = new google.maps.Map(mapDiv, myOptions);
  setGoogleMarkers(places);
}
// END googlemaps Stuff


/* all that google maps stuff*/function setGoogleMarkers(e){for(var t=0;t<e.length;t++){var n=e[t],r=new google.maps.Marker({map:map,title:n[0],position:new google.maps.LatLng(n[1],n[2]),icon:new google.maps.MarkerImage(n[3]),animation:google.maps.Animation.DROP});google.maps.event.addDomListener(r,"click",function(){map.setCenter(this.getPosition());map.setZoom(12)})}}function initGoogleMap(){var e=document.getElementById("map_canvas");centerLatLng=new google.maps.LatLng(53.63001,8.89412);var t={zoom:9,center:centerLatLng,streetViewControl:!1,mapTypeControl:!1,scrollwheel:!1,panControl:!1,draggable:!1,zoomControl:!0,mapTypeId:google.maps.MapTypeId.ROADMAP};map=new google.maps.Map(e,t);setGoogleMarkers(places)}var map,centerLatLng,places=[["B&B Helene",53.63001,8.89412,"http://aWordpressChildTheme.de/wp-site/wp-content/themes/aWordpressChildTheme/assets/images/marker.png"]];
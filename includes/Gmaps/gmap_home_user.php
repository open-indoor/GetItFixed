

     
    <script type="text/javascript">

    
    var map;
          
    var mymarkerarray=[];
    var markersArray = [];
    var iterator;

    var infowindow = new google.maps.InfoWindow({
      maxWidth: 550
    });


    var greenicon = new google.maps.MarkerImage("img/green_marker.png", null, null, null, new google.maps.Size(40, 40));
    var blueicon = new google.maps.MarkerImage("img/blue_marker.png", null, null, null, new google.maps.Size(40, 40));
    var redicon = new google.maps.MarkerImage("img/pink_marker.png", null, null, null, new google.maps.Size(40, 40));


    var customIcons = {
      fixed: {
        icon: greenicon
      },
      deleted: {
        icon: redicon
      },
      none: {
        icon: blueicon
      }
    };


    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, this);
      });
    }
    
    
    
    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {

          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function drop() {
      for (var i = 0; i < mymarkerarray.length; i++) {
        if(i==0)
        {
          addFirstMarker();
        } else {

          setTimeout(function() {
            addMarkers();
          }, i * 150);
        }
      }
    }

    function addMarkers() {
      var icon = customIcons[mymarkerarray[iterator][4]] || {};
      
      var marker = new google.maps.Marker({
        position: mymarkerarray[iterator][6],
        map: map,
        icon: icon.icon,
        animation: google.maps.Animation.DROP
      });

      markersArray.push(marker);

      marker.html=mymarkerarray[iterator][7];

      google.maps.event.addListener(marker, 'click', function(){
        // Set the content of the InfoBubble or InfoWindow
        // They both have a function called setContent 
        infowindow.setContent(this.html);
        infowindow.open(map, this);
       });

      iterator++;
    }

    function addFirstMarker() {
      var icon = customIcons[mymarkerarray[iterator][4]] || {};
      
      var marker = new google.maps.Marker({
        position: mymarkerarray[iterator][6],
        map: map,
        icon: icon.icon,
        animation: google.maps.Animation.BOUNCE
      });

      markersArray.push(marker);

      marker.html=mymarkerarray[iterator][7];

      google.maps.event.addListener(marker, 'click', function(){
        // Set the content of the InfoBubble or InfoWindow
        // They both have a function called setContent 
        infowindow.setContent(this.html);
        infowindow.open(map, this);
       });

      iterator++;
    }


  function clearMarkers() {
    for (var i = 0; i < markersArray.length; i++ ) {
      markersArray[i].setMap(null);
    }
    markersArray.length = 0;
  }



    //START OF INITIALIZE    
    function initialize() {

      var mapOptions = {
        center: new google.maps.LatLng(42.0000000,2.0981837),
        zoom: 11,
        scrollwheel:true,
        draggable:true
      };
      
       map = new google.maps.Map(document.getElementById("googleMap"),mapOptions);

       getLocation();


  }// END OF INITIALIZE


  function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        alert("Geolocation is not supported by this browser.");
      }
    }

    function showPosition(position) {
      var lat = position.coords.latitude;
      var lng = position.coords.longitude;
      map.setCenter(new google.maps.LatLng(lat, lng));
    }


   function dropmarkers(){
    var markersfile = "_xml/last_20_markers.php";
    // Change this depending on the name of your PHP file
    downloadUrl(markersfile, function(data) {
      var xml = data.responseXML;
      var reports = xml.documentElement.getElementsByTagName("report");
      for (var i = 0; i < reports.length; i++) {
         mymarkerarray[i]= new Array (8);
         mymarkerarray[i][0] = reports[i].getAttribute("id");
         mymarkerarray[i][1] = reports[i].getAttribute("user");
         mymarkerarray[i][2] = reports[i].getAttribute("name");
         mymarkerarray[i][3] = reports[i].getAttribute("comment");
         mymarkerarray[i][4] = reports[i].getAttribute("status");
         mymarkerarray[i][5] = reports[i].getAttribute("adminname");
         mymarkerarray[i][6] = new google.maps.LatLng(
            parseFloat(reports[i].getAttribute("lat")),
            parseFloat(reports[i].getAttribute("lng")));
          
        mymarkerarray[i][7] = "<div id='infoWindow'> <b> Report ID : " + mymarkerarray[i][0] +"</b> <br/> <b>Made by:</b> " + mymarkerarray[i][1]+ "(user's id)<br/> <b>Description:</b><br/>" + mymarkerarray[i][2]+ " </br> <a font-color=black href='view_this_report_page.php?id=" + mymarkerarray[i][0] + "'>View report</a> </div>";
        
        if( mymarkerarray[i][4] == 'fixed' ) {
         mymarkerarray[i][7]  = "<div id='infoWindow'> <b> Report ID : " + mymarkerarray[i][0] +"</b> <br/> <b>Made by:</b> " + mymarkerarray[i][1] + "(user's id)<br/> <b>Description:</b><br/>" + mymarkerarray[i].repdescription + "<br/><b> Admin that fixed it : </b>" + mymarkerarray[i][5] + "<br/><b> Admin's comment : </b>" + mymarkerarray[i][3] + "</br> <a font-color=black href='view_this_report_page.php?id=" + mymarkerarray[i][0]+ "'>View report</a></div>";
        }
        if( mymarkerarray[i][4] == 'deleted' ) {
         mymarkerarray[i][7]  = "<div id='infoWindow'> <b> Report ID : " + mymarkerarray[i][0] +"</b> <br/> <b>Made by:</b> " + mymarkerarray[i][1] + "(user's id)<br/> <b>Description:</b><br/>" + mymarkerarray[i].repdescription + "<br/><b> Admin that deleted it : </b>" + mymarkerarray[i][5] + "<br/><b> Admin's comment : </b>" + mymarkerarray[i][3] + "</br><a font-color=black href='view_this_report_page.php?id=" + mymarkerarray[i][0]+ "'>View report</a></div>";
        }
      }
    });

    
    iterator = 0;

    drop();

  }



      

//initialize():
  google.maps.event.addDomListener(window, 'load', initialize);
    

  google.maps.event.addDomListener(map, 'idle', function(){
    dropmarkers();// do something only the first time the map is loaded
  });
  /**/

  </script>


  



    <div  id="googleMap" ></div>
 



<script type="text/javascript">
        setTimeout(function() {
          dropmarkers();
        },  300); 

$(window).on("load",dropmarkers());
window.onload = dropmarkers();


</script>
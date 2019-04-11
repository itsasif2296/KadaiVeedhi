<html lang="en">
<head>
    <title>Kadai Veethi</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <script src="bootstrap/js/jquery-3.3.1.min.js" type="text/javascript"></script>
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <link href="frontstyle.css" rel="stylesheet" type="text/css"/>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand navbar-left" href="#myPage">
          <img src="files/kvv.png" alt="logo" height="40" width="45"/>
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#search">SEARCH</a></li>
          <li><a href="#about">ABOUT</a></li>
        <li><a href="#contact">CONTACT</a></li>
      </ul>
    </div>
  </div>
</nav>
    <div id="search" class="jumbotron text-center">
    <p class="heading">Kadai Veethi</p> 
  <p>Your local shopping guide..</p> 
  <form>
    <div class="input-group">
        <input type="search" id="term" class="form-control"  size="50" placeholder="Shop name or Area" required>
        <div class="input-group-btn">
            <button type="button" class="btn btn-danger" name="submit" onclick="searchMap()">Search</button>         
      </div>
    </div>
  </form>
   </div>
  <div id="googleMap" style="height:500px;width:100%;"></div>

     <script>
    function searchMap() {
var str=document.getElementById('term').value;
if(str!=""){
                       var map = new google.maps.Map(document.getElementById('googleMap'), {
          center: new google.maps.LatLng(13.069363, 80.177963),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

          downloadUrl(str,function(data) { 
        var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('shop');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name;
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address;
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
                
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
            
          });
        }else{
            window.alert("Please enter a shop name or an area name");
          
        }
    }
              function downloadUrl(sterm,callback) {
        var request = window.XMLHttpRequest ?
            new XMLHttpRequest() :
            new ActiveXObject('Microsoft.XMLHTTP');

        request.onreadystatechange = function() {
          if (request.readyState === 4&& request.status===200) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };
        request.open("POST","connect.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
request.send("t="+sterm);
      }

      function doNothing() {}
  </script>
  <script> 
      var customLabel = {
         Restaurant: {
          label: 'R'
        },
        Grocery: {
          label: 'G'
        },
        Super: {
            label:'S'
        }
      };
      var x = document.getElementById("googleMap");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(myMap);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
    function myMap(position) {
var myCenter = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
var mapProp = {center:myCenter, zoom:16, scrollwheel:true, draggable:true, mapTypeId:google.maps.MapTypeId.ROADMAP};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>          
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzZ5T9kNQGdgZt23d5YCIIheR1LPoUzVI&callback=getLocation"></script>
    <!-- Container (About Section) -->
    <div id="about" class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <h2>About Kadai Veethi</h2><br>
      <h4>It is your little guide in locating local shops</h4><br>
      <p>This simple website was developed by a group of three final year Computer Science Engineering students of Dr.MGR Educational and Research Institute, Maduravoyal.</p>
          </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-signal logo"></span>
    </div>
  </div>
</div>

<div class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-globe logo slideanim"></span>
    </div>
    <div class="col-sm-8">
      <h2>Our Values</h2><br>
      <h4><strong>MISSION:</strong> Our mission is to provide locations of all small as well as large shops all around Chennai.</h4><br>
      <p><strong>VISION:</strong> Our vision is to be able to provide locations of all shops in Tamil Nadu and then shops in the whole of India.</p>
    </div>
  </div>
</div>

<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-grey">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us for any queries as well as for any suggestions.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Maduravoyal, Chennai</p>
      <p><span class="glyphicon glyphicon-phone"></span> +91 9791117968</p>
      <p><span class="glyphicon glyphicon-envelope"></span> kadaiveethi@gmail.com</p>
    </div>
    <div class="col-sm-7 slideanim">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Send</button>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  </footer>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
});
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../asset/css/styles.css">
</head>
<body>
    <?php 
    session_start();
    ?>
    <h1>Hello <?php echo $_SESSION['username']; ?> 
    <?php if(isset($_SESSION['avatar'])): ?>
        <img class="w-10 h-10 block bg-transparent" src="<?php echo $_SESSION['avatar']; ?>" alt="">
    <?php endif; ?>
    </h1>
    <div id="map-container" style="height: 500px; width: 100%;">
        <iframe id="map" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    var mapSrc = "https://www.google.com/maps/embed/v1/view?key=AIzaSyA07yoomSXQLLvhbr2SoHJq8bYOcmDhQN0&center=" + lat + "," + lng + "&zoom=15";
                    document.getElementById('map').src = mapSrc;
                }, function(error) {
                    console.error("Error Code = " + error.code + " - " + error.message);
                });
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }

        window.onload = getLocation;
    </script>
</body>
</html>
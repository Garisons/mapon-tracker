<?php

require '../App/bootstrap.php';

use Service\MaponAPI;

$api = new MaponAPI();
$info = $api->get(30411);

$trackingData = json_decode($info);
$units = $trackingData->data->units;
$unit = $units[0];

$firstRoute = $unit->routes[0];

$mapStartDot = [
    'lat' => $firstRoute->start->lat,
    'lng' => $firstRoute->start->lng,
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mapon task</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/style.css"/>
    <script src="/index.js"></script>

</head>
<body>

<h3>Tracking</h3>

<div class="container">
    <form method="post" action="/login" id="login-form">
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" name="login" class="form-control" id="login" placeholder="Enter login">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<script>
    var initCoord = <?= json_encode($mapStartDot) ?>;
</script>

<div id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" async></script>

</body>
</html>

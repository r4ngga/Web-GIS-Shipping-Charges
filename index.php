<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/dist/css/bootstrap.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <link rel="stylesheet" href="assets/leaflet-routing-machine-3.2.12/dist/leaflet-routing-machine.css">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="assets/leaflet-routing-machine-3.2.12/dist/leaflet-routing-machine.js"></script>
    <script src="assets/dist/js/jquery-3.6.0.min.js"></script>
    <title>GIS || Calculate Cost</title>
    <link rel="icon" href="assets/images/logogis_finaly_16x16.jpg" type="jpg/jpeg" />
</head>

<body>
    <!-- <h1>Hello, world!</h1> -->
    <div class="container">
        <div class="row mb-2">
            <div class="col">
                <div id="mapid" style="width: 100%; height: 500px;"></div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col">
                <a href="https://leafletjs.com/">Documentation Leaflet</a>
                <!-- <label for="">Biaya kirim ?</label>
                <input id="cost_estimation" type="text" class="form-control" style="border-style: hidden; background-color: white; "> -->
            </div>
            <div class="col">
                <a href="https://www.liedman.net/leaflet-routing-machine/">Documentation Routing Machine</a>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <a href="https://www.mapbox.com/">Documentation MapBox</a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="information">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var map = L.map('mapid').setView([-7.746970, 110.355514], 13);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'your.mapbox.access.token'
        }).addTo(map);
        var marker = L.marker([-7.746970, 110.355514]).addTo(map);
        marker.bindPopup("<b>Posisi anda!</b><br>berada disini.").openPopup();

        var routeControl = L.Routing.control({
            waypoints: [
                L.latLng(-7.746970, 110.355514),
                L.latLng(-7.734241, 110.395448)
            ]
        }).addTo(map);
        routeControl.on('routesfound', function(e) {
            var routes = e.routes;
            var summary = routes[0].summary;
            var totaljarak = summary.totalDistance / 1000;
            var cost = (summary.totalDistance / 1000) * 500;
            // alert time and distance in km and minutes
            // alert('Total jarak ' + summary.totalDistance / 1000 + ' km, dan waktu tempuh ' + Math.round(summary.totalTime % 3600 / 60) + ' menit');
            // document.getElementById("cost_estimation").value = "Rp " + cost;
            var info = 'Total jarak ' + totaljarak.toFixed(2) + ' km, dan waktu tempuh ' + Math.round(summary.totalTime % 3600 / 60) + ' menit <br> Ongkos Kirim Rp ' + cost.toFixed(0);
            $("#exampleModal").modal("show");
            document.getElementById("information").innerHTML = info;
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="assets/dist/js/bootstrap.js"></script>

</body>

</html>
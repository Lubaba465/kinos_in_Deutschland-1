<?php
include "phpLogic/addOrEditCinemaPageLogic.php";
include "helper/messageHelper.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de-de">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="content-script-type" content="text/javascript"/>
    <meta http-equiv="content-style-type" content="text/css"/>
    <meta http-equiv="content-language" content="de"/>
    <meta name="author" content="Thomas Heiles"/>
    <link rel="stylesheet" type="text/css" href="css/mapCinemass.css">
    <!--[if IE]>
    <link rel="stylesheet" type="text/css" href="ie_map.css">
    <![endif]-->
    <script type="text/javascript" src="https://openlayers.org/api/OpenLayers.js"></script>
    <script type="text/javascript" src="https://openstreetmap.org/openlayers/OpenStreetMap.js"></script>
    <script type="text/javascript" src="js/tom.js"></script>
    <link rel="stylesheet" href="css/forms.css">

    <script type="text/javascript">
        //<![CDATA[

        var map;
        var layer_mapnik;
        var layer_tah;
        var layer_markers;

        function drawmap() {
            // Popup und Popuptext mit evtl. Grafik
            var popuptext = "<font color=\"black\"><b>Thomas Heiles<br>Stra&szlig;e 123<br>54290 Trier</b><p><img src=\"test.jpg\" width=\"180\" height=\"113\"></p></font>";

            OpenLayers.Lang.setCode('de');

            // Position und Zoomstufe der Karte
            var lon = 6.641389;
            var lat = 49.756667;
            var zoom = 7;

            map = new OpenLayers.Map('map', {
                projection: new OpenLayers.Projection("EPSG:900913"),
                displayProjection: new OpenLayers.Projection("EPSG:4326"),
                controls: [
                    new OpenLayers.Control.Navigation(),
                    new OpenLayers.Control.LayerSwitcher(),
                    new OpenLayers.Control.PanZoomBar()],
                maxExtent:
                    new OpenLayers.Bounds(-20037508.34, -20037508.34,
                        20037508.34, 20037508.34),
                numZoomLevels: 18,
                maxResolution: 156543,
                units: 'meters'
            });

            layer_mapnik = new OpenLayers.Layer.OSM.Mapnik("Mapnik");
            layer_markers = new OpenLayers.Layer.Markers("Address", {
                projection: new OpenLayers.Projection("EPSG:4326"),
                visibility: true, displayInLayerSwitcher: false
            });

            map.addLayers([layer_mapnik, layer_markers]);
            jumpTo(lon, lat, zoom);
            map.events.register('click', map, handleMapClick);
        }

        function handleMapClick(evt) {
            var lonlat = map.getLonLatFromViewPortPx(evt.xy);
            var newlonLat = new OpenLayers.LonLat(lonlat.lon, lonlat.lat).transform(map.getProjectionObject(), new OpenLayers.Projection("EPSG:4326"));
            $("#lon").val(newlonLat.lon);
            $("#lat").val(newlonLat.lat);
            layer_markers.clearMarkers();
            addMarker(layer_markers, newlonLat.lon, newlonLat.lat, "Auswahl");
        }

    </script>


</head>


<body onload="drawmap();">

<?php include "php/head.php" ?>
<?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == 1){ ?>
<?php include "php/navigation.php" ?>

<?php

if (isset($_GET["delete"])) {
    $cinemadao->deleteCinema($cinemaId); ?>

    <div class="myForm">
        <h1>Der Eintrag wurde gelöscht!</h1>
    </div>

<?php } else { ?>

    <div class="myForm">
        <?php if (isset($usermsg) && isset($msgTitle) && !empty($usermsg) && !empty($msgTitle)) {
            MessageHelper::messageHandler($msgTitle, $usermsg);
        } ?>

        <form method="post" enctype="multipart/form-data">
            <h1>Neues Kino hinzufügen oder bearbeiten</h1>
            <div class="form">

                <?php
                $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : 'anonym';
                ?>
                <input type="hidden" name="userid" value="<?php echo $userId; ?>">
                <label for="name"><b>Name des Kinos</b></label>
                <input type="text" placeholder="Name eintragen" name="cinemaName" required
                       value="<?php echo $cinemaName; ?>">
                <br>
                <label for="str"><b>Straße</b></label>
                <input type="text" placeholder="Straße eintragen" name="cinemaStreetName" required
                       value="<?php echo $cinemaStreetName; ?>">
                <br><br>
                <label for="nr"><b>Straßennummer</b></label>
                <input type="number" placeholder="Nr. eintragen" name="cinemaStreetNumber" required
                       value="<?php echo $cinemaStreetNumber; ?>">

                <label for="plz"><b>Postleitzahl</b></label>
                <input type="number" placeholder="Postleitzahl eintragen" required name="cinemaZipCode"
                       value="<?php echo $cinemaZipCode; ?>"><br><br>

                <label for="st"><b>Stadt</b></label>
                <input type="text" placeholder="Stadt eintragen" required name="cityName"
                       value="<?php echo $cityName; ?>">

                <label for="bul"><b>Bundesland</b></label>
                <input type="text" placeholder="Bundesland eintragen" name="state" required
                       value="<?php echo $state; ?>">


                <div class="mapCinema">
                    <div id="map">

                    </div>
                    <div>
                        <label for="longitude">Längengrad:</label><br>
                        <input type="text" name="longitude" maxlength="50" id="lon" value="<?php echo $longitude; ?>"><br>
                        <label for="latitude">Breitengrad:</label><br>
                        <input type="text" name="latitude" maxlength="50" id="lat" value="<?php echo $latitude; ?>"><br>
                    </div>
                </div>
                <br><br><br><br><br><br>
                <label for="beschr"><b>Beschreibung</b></label><br>
                <textarea name="description" required placeholder="Beschreibung eintragen"> <?php echo $description; ?></textarea><br><br>

                <label class="content-grid"><b>Media</b></label><br>
                <input type="file" value="" name="image" required/>
                <br><br>
                <input class="addbutton" id="<?php echo $cTransName; ?>" name="<?php echo $cTransName; ?>" type="submit"
                       value="<?php echo $cTransType; ?>">
            </div>
        </form>
    </div>
<?php } ?>

<?php include "php/footer.php" ?>
</body>

</html>


<?php } else {
    header("Location:error.php");
} ?>

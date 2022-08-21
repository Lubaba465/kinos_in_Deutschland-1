<?php
include "DAO/interfaces/iCinemaDAO.php";
include "helper/sessionsHelper/sessionsHelper.php";

$cinemaId = (isset($_GET["id"]) && is_string($_GET["id"])) ? $_GET["id"] : "0";
$cinemas = $cinemadao->getCinema($cinemaId);

$usermsg = "";
$msgTitle = "";

$cinemaName = null;
$cinemaStreetName = null;
$cinemaZipCode = null;
$cityName = null;
$state = null;
$description = null;
$cinemaStreetNumber = null;
$cTransType = null;
$longitude = null;
$latitude =null;
$imagefile=null;
if ($cinemaId == 0) {
    $cTransType = "Hinzufügen";
    $cTransName = "newCinema";
} else {
    $cinemaId = $cinemas['cinemaId'];
    $cTransType = "Bearbeiten";
    $cTransName = "updCinema";
    $cinemaName = $cinemas['cinemaName'];
    $cinemaStreetName = $cinemas['cinemaStreetName'];
    $cinemaStreetNumber = $cinemas['cinemaStreetNumber'];
    $cinemaZipCode = $cinemas['cinemaZipCode'];
    $cityName = $cinemas['cityName'];
    $state = $cinemas['state'];
    $imagefile=$cinemas['cinemaImage'];
    $description = $cinemas['description'];
    $longitude = $cinemas['long'];
    $latitude = $cinemas['lati'];
}


if (isset($_POST["newCinema"])) {

    $cinemaNam =isset( $_POST['cinemaName']) ? $_POST['cinemaName']:null;
    $cinemaStreetNam = isset($_POST['cinemaStreetName'])?$_POST['cinemaStreetName']:null;
    $cinemaStreetNumbe = isset($_POST['cinemaStreetNumber'])?$_POST['cinemaStreetNumber']:null;
    $cinemaZipCod = isset($_POST['cinemaZipCode'])?$_POST['cinemaZipCode']:null;
    $cityNam = isset($_POST['cityName'])?$_POST['cityName']:null;
    $stat = isset($_POST['state'])?$_POST['state']:null;
    $descriptio = isset($_POST['description'])?$_POST['description']:null;
    $userid = isset($_POST['userid'])?$_POST['userid']:null;
    $longitud= isset($_POST["longitude"])?$_POST["longitude"]:null;
    $latitud = isset($_POST["latitude"])?$_POST["latitude"]:null;
     $fileName = basename($_FILES['image']['name']);
    $statusMsg = '';


    if (move_uploaded_file($_FILES["image"]["tmp_name"], "../website/ressources/images/" . $_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $insert = $cinemadao->addCinema(array(":cinemaName" => $cinemaNam, ":description" => $descriptio, ":cinemaImage" => "./ressources/images/" . $_FILES['image']['name'], ":cinemaStreetName" => $cinemaStreetNam, ":cinemaStreetNumber" => $cinemaStreetNumbe, ":cinemaZipCode" => $cinemaZipCod, ":cityName" => $cityNam, ":state" => $stat, ":long" => $longitud,  ":lati" => $latitud , ":userId" => $userid));

        if ($insert) {
            $usermsg = "Das Kino wurde erfolgreich hinzugefügt!";
            $msgTitle = "Erfolg";
            $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
        } else {
            $usermsg = "Das Kino konnte nicht hinzugefügt werden!";
            $msgTitle = "Warnung";
            $statusMsg = "File upload failed, please try again.";
        }
    } else {
        $statusMsg = "Sorry, there was an error uploading your file.";
        $usermsg = "Das Kino konnte nicht hinzugefügt werden!";
        $msgTitle = "Warnung";
    }
}

if (isset($_POST["updCinema"])) {
    $cinemaId = (isset($_GET["id"]) && is_string($_GET["id"])) ? $_GET["id"] : "0";
    $cinemaNam =isset( $_POST['cinemaName']) ? $_POST['cinemaName']:null;
    $cinemaStreetNam = isset($_POST['cinemaStreetName'])?$_POST['cinemaStreetName']:null;
    $cinemaStreetNumbe = isset($_POST['cinemaStreetNumber'])?$_POST['cinemaStreetNumber']:null;
    $cinemaZipCod = isset($_POST['cinemaZipCode'])?$_POST['cinemaZipCode']:null;
    $cityNam = isset($_POST['cityName'])?$_POST['cityName']:null;
    $stat = isset($_POST['state'])?$_POST['state']:null;
    $descriptio = isset($_POST['description'])?$_POST['description']:null;
    $userid = isset($_POST['userid'])?$_POST['userid']:null;
    $longitud= isset($_POST["longitude"])?$_POST["longitude"]:null;
    $latitud = isset($_POST["latitude"])?$_POST["latitude"]:null;
     $fileName = basename($_FILES['image']['name']);
    $statusMsg = '';
    if (move_uploaded_file($_FILES["image"]["tmp_name"], "../website/ressources/images/" . $_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $insert = $cinemadao->editCinema($cinemaId, array(":cinemaName" => $cinemaNam, ":description" => $descriptio, ":cinemaImage" => "./ressources/images/" . $_FILES['image']['name'], ":cinemaStreetName" => $cinemaStreetNam, ":cinemaStreetNumber" => $cinemaStreetNumbe, ":cinemaZipCode" => $cinemaZipCod, ":cityName" => $cityNam, ":state" => $stat, ":long" => $longitud,  ":lati" => $latitud ));

        if ($insert) {
            $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
            $usermsg = "Das Kino wurde erfolgreich bearbeitet!";
            $msgTitle = "Erfolg";
        } else {
            $statusMsg = "File upload failed, please try again.";
            $usermsg = "Das Kino konnte nicht bearbeitet werden!";
            $msgTitle = "Warnung";
        }
    } else {
        $statusMsg = "Sorry, there was an error uploading your file.";
        $usermsg = "Das Kino konnte nicht bearbeitet werden!";
        $msgTitle = "Warnung";
    }
}

?>
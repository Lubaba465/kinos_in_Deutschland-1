<?php

require_once ("DAO/interfaces/iMovieDAO.php" );
include "helper/sessionsHelper/sessionsHelper.php";

$movieId = (isset($_GET["movieId"])&& is_string($_GET["movieId"])) ? $_GET["movieId"]: "0";
$movies=$moviedao->getMovie($movieId);
$movieName = null;
$price = null;
$releaseDate = null;
$language= null;
$description = null;
$movieImage=null;
$cinemaid = null;

$usermsg = "";
$msgTitle = "";

if ($movieId == 0)
{
    $cTransType = "Hinzufügen";
    $cTransName = "newMovie";
}
else
{
    $movieId = $movies["movieId"];
    $cTransType = "Bearbeiten";
    $cTransName = "updMovie";
    $movieName = $movies["movieName"];
    $price=$movies["price"];
    $releaseDate= $movies["releaseDate"] ;
    $language = $movies["language"];
    $description =$movies["description"] ;
}

if (isset($_POST["newMovie"]))
{
    $movieNam = isset($_POST["movieName"])?$_POST["movieName"]:null;
    $pric=isset($_POST["price"])?$_POST["price"]:null;
    $releaseDat=isset($_POST["releaseDate"])?$_POST["releaseDate"]:null ;
    $languag = isset($_POST["language"])?$_POST["language"]:null;
    $descriptio=isset($_POST["description"])?$_POST["description"]:null;
    $cinemaid= $_SESSION['cinemaId'];
    $fileName = basename($_FILES['image']['name']);
    $statusMsg = '';

    if (move_uploaded_file($_FILES["image"]["tmp_name"], "../website/ressources/images/" . $_FILES['image']['name']))
    {
        $image = $_FILES['image']['name'];
        $insert= $moviedao->addMovie(array(":movieName"=>$movieNam,":description" =>$descriptio, ":movieImage"=>"./ressources/images/".$_FILES['image']['name'],":price"=> $pric,":releaseDate"=> $_POST["releaseDate"],":language"=>  $_POST["language"], ":cinemaId"=>$cinemaid));

        if ($insert)
        {
            $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
            $usermsg = "Der Film wurde erfolgreich hinzugefügt";
            $msgTitle = "Erfolg";
        }
        else
        {
            $statusMsg = "File upload failed, please try again.";
            $usermsg = "Der Film konnte nicht hinzugefügt werden!";
            $msgTitle = "Warnung";
        }
    }
    else
    {
        $statusMsg = "Sorry, there was an error uploading your file.";
        $usermsg = "Das Bild konnte nicht hochgeladen werden, wählen Sie bitte ein anders Bild!";
        $msgTitle = "Warnung";
    }
}

if(isset($_POST["updMovie"]))
{
    $movieId = (isset($_GET["movieId"])&& is_string($_GET["movieId"])) ? $_GET["movieId"]: "0";

    $movieNam = isset($_POST["movieName"])?$_POST["movieName"]:null;
    $pric=isset($_POST["price"])?$_POST["price"]:null;
    $releaseDat=isset($_POST["releaseDate"])?$_POST["releaseDate"]:null ;
    $languag = isset($_POST["language"])?$_POST["language"]:null;
    $descriptio=isset($_POST["description"])?$_POST["description"]:null ;
    $fileName = basename($_FILES['image']['name']);
    $statusMsg = '';
    if (move_uploaded_file($_FILES["image"]["tmp_name"],"../website/ressources/images/" . $_FILES['image']['name']))
    {
        //TODO EDIT IMAGE
        $image = $_FILES['image']['name'];
        $insert= $moviedao->editMovie($movieId,array(":movieName"=>$movieNam,":description" =>$descriptio, ":movieImage"=>"./ressources/images/".$_FILES['image']['name'],":price"=> $pric,":releaseDate"=> $_POST["releaseDate"],":language"=>  $_POST["language"]));

        if ($insert)
        {
            $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
            $usermsg = "Der Film wurde erfolgreich bearbeitet!";
            $msgTitle = "Erfolg";
        }
        else
        {
            $statusMsg = "File upload failed, please try again.";
            $usermsg = "Der Film konnte nicht bearbeitet werden!";
            $msgTitle = "Warnung";
        }
    }
    else
    {
        $statusMsg = "Sorry, there was an error uploading your file.";
        $usermsg = "Das Bild konnte nicht hochgeladen werden, wählen Sie bitte ein anders Bild!";
        $msgTitle = "Warnung";
    }

}
?>

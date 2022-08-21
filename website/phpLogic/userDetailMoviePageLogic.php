<?php
require_once ("DAO/interfaces/iMovieDAO.php" );
include "helper/sessionsHelper/sessionsHelper.php";

$cinemaid = isset($_GET["id"])?$_GET["id"]:null;
$_SESSION['cinemaId']=$cinemaid;
$movies=$moviedao->getMovies($cinemaid);

?>
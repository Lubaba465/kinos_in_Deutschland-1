<?php

require_once ("DAO/interfaces/iCinemaDAO.php" );
require_once ("DAO/interfaces/iMovieDAO.php" );
require_once ("DAO/interfaces/iUserDAO.php" );
include "helper/sessionsHelper/sessionsHelper.php";

$cinemaid = isset($_GET["id"])?$_GET["id"]:null;

$cinemas=$cinemadao->getCinema($cinemaid);
$movies=$moviedao->getMovies($cinemaid);
$cinemaComments=$cinemadao->getComments($cinemaid);
$userid = isset($_SESSION['userId']) ? $_SESSION['userId'] : 'anonym';
$user=$userdao->getUser($userid);

?>
<?php /*include "helper/dummyDataHelper/cinemaDummyData.php";*/?><!--
--><?php /*include "helper/dummyDataHelper/movieDummyData.php";*/?>

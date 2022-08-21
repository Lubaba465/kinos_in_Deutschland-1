<?php

/*include "helper/dummyDataHelper/cinemaDummyData.php";*/
/*include "helper/dummyDataHelper/movieDummyData.php";*/
/*include "helper/dummyDataHelper/movieCommentsDummyData.php";*/
/*include "helper/dummyDataHelper/userDummyData.php";*/

require_once ("DAO/interfaces/iMovieDAO.php" );
require_once ("DAO/interfaces/iUserDAO.php" );
include "helper/sessionsHelper/sessionsHelper.php";

$movieid = isset($_GET["movieid"])?$_GET["movieid"]:null;
$movies=$moviedao->getMovie($movieid);
$movieComments=$moviedao->getComments($movieid);
$userid = isset($_SESSION['userId']) ? $_SESSION['userId'] : 'anonym';

?>
<?php
require_once("DAO/interfaces/iCinemaDAO.php");
require_once ("DAO/interfaces/iMovieDAO.php" );


if (isset($_POST["newComment"])) {
    $cinemaid = isset($_POST['cinemaid'])?  $_POST['cinemaid']:null;;
    $comment = isset($_POST['comment'])?$_POST['comment']:null;
    $userid = isset($_POST['userid'])?$_POST['userid']:null;


    $cinemadao->addCinemaComment($comment, $userid, $cinemaid);

    header("Location:cinemaOverviewPage.php?id=$cinemaid");
}
/*if (isset($_POST["newCommentMovie"])) {
    $comment = $_POST['comment'];
    $userid = $_POST['userid'];

    $movieid=$_POST['movieid'];
    $moviedao->AddMovieComment($comment, $userid, $movieid);

    header("Location:movieOverviewPage.php?movieid=$movieid");
}*/

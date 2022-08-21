<?php
require_once ("DAO/interfaces/iCinemaDAO.php" );


if(isset($_POST['userid'])){
$cinemadao->addCinemaLike($_POST['userid'], $_POST['cinemaId']);}

?>
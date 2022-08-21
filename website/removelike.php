<?php
require_once ("DAO/interfaces/iCinemaDAO.php" );

if(isset($_POST['userid'])){
    $cinemadao->removeCinemaLike($_POST['userid'], $_POST['cinemaId']);}

?>


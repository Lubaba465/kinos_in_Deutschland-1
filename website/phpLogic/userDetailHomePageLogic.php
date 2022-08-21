<?php
require_once ("DAO/interfaces/iCinemaDAO.php" );
include "helper/sessionsHelper/sessionsHelper.php";

$userid = isset($_SESSION['userId']) ? $_SESSION['userId'] : 'anonym';
$cinemas=$cinemadao->getCinemasByUser($userid);
?>

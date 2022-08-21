<?php


require_once ("DAO/interfaces/iCinemaDAO.php" );
include "helper/sessionsHelper/sessionsHelper.php";

$cinema=$cinemadao->getTheLastCinema();
$imgList = $cinemadao->getCinemas();

?>
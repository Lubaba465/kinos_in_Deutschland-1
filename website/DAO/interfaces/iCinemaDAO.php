<?php

interface iCinemaDAO
{
    function addCinema($cinema);
    function editCinema($cinemaId,$cinema);
    function deleteCinema($cinemaId);
    function addCinemaLike($userId,$cinemaId);
    function addCinemaComment($comment , $userId, $cinemaId);
    function getCinema($cinemaId);
    function getCinemas();
    function getCinemasByUser($userId);
    function getCinemasByStateName($stateName);
    function getTheLastCinema();
    function getComments($cinemaId);
    function searchcinemas($searchWord);
    function getCinemaLikesCount($cinemaId);
    function getCinemaLike($userId,$cinemaId);
    function removeCinemaLike($userId,$cinemaId);
}

include("DAO/cinemaDAO.php");

$cinemadao = new cinemaDAO;

?>
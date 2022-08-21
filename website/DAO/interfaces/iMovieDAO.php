<?php

interface iMovieDAO
{
    function addMovie($movie);
    function editMovie($movieId, $data);
    function deleteMovie($movieId);
    function addMovieLike($movieId,$userId);
    function AddMovieComment($comment,$movieId,$userId);
    function getMovie($movieId);
    function getMovies($cinemaId);
    function getComments($movieId);

}

include("DAO/movieDAO.php");

$moviedao = new movieDAO;

?>

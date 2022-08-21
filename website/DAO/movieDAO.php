<?php

class movieDAO implements iMovieDAO
{
    private $db = null;
    private $statementGetMovieById = null;
    private $statementGetMoviesByCinemaId = null;
    private $statementAddMovieLike = null;
    private $statementAddMovieComment = null;
    private $statementCheckMovieLike = null;
    private $statementDeleteMovie = null;
    private $statementDeleteMovieLikes = null;
    private $statementDeleteMovieComments = null;
    private $statementAddMovie = null;
    private $statementEditMovie = null;
    private $statementMovieByName = null;
    private $statementMovie = null;

    function getComments($movieId)
    {


    }

    private function startConnection()
    {
        $user = "root";
        $pw = null;
        $dsn = "sqlite:../database/database.db";
        $this->db = new PDO($dsn, $user, $pw);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->SetStatements();
    }

    private function SetStatements()
    {
        $this->statementGetMovieById = $this->db->prepare("SELECT * FROM movies WHERE movieId = :movieId;");
        $this->statementGetMoviesByCinemaId = $this->db->prepare("SELECT * FROM movies WHERE cinemaId = :cinemaId;");
        $this->statementDeleteMovie = $this->db->prepare("DELETE FROM movies WHERE movieId = :movieId; DELETE FROM cinemas WHERE movieId = :movieId;");
        $this->statementAddMovie = $this->db->prepare("INSERT INTO movies (movieName,description,movieImage,price,releaseDate,language,cinemaId) VALUES (:movieName,:description,:movieImage,:price,:releaseDate,:language,:cinemaId);");
        $this->statementEditMovie = $this->db->prepare("UPDATE movies SET movieName = (:movieName), description = (:description), movieImage = (:movieImage), price = (:price), releaseDate = (:releaseDate), language = (:language) WHERE movieId = (:movieId);");
        $this->statementMovieByName = $this->db->prepare("SELECT * FROM movies WHERE movieName = :movieName");
        $this->statementMovie = $this->db->prepare("SELECT * FROM movies WHERE movieId = :movieId");

    }

    function addMovie($movie)
    {
        if (is_array($movie)) {
            $this->startConnection();
            try {
                $this->db->beginTransaction();
                $this->statementAddMovie->execute($movie);
                $this->db->commit();
                return true;
            } catch (PDOException $e) {
                $this->db->rollBack();
                header("Location: ./error.php");
                return false;
            } finally {
                $this->db = null;
            }
        } else {
            //kein array
            header("Location: ./error.php");
        }
    }


    function editMovie($movieId, $data)
    {
        if (is_array($data)) {
            $this->startConnection();
            try {
                $this->db->beginTransaction();
                $this->statementMovie->bindValue(":movieId", $movieId);
                $this->statementMovie->execute();
                $movie = $this->statementMovie->fetch(PDO::FETCH_ASSOC);
                if ($movie === false) {
                    $this->db->rollBack();
                    header("Location: ./error.php");
                    return false;
                }
                $this->statementEditMovie->execute(array_merge($data, array("movieId" => $movieId)));
                $this->db->commit();
                return true;
            } catch (PDOException $e) {
                $this->db->rollBack();
                return false;
                header("Location: ./error.php");
            } finally {
                $this->db = null;
            }
        } else {
            return false;
            header("Location: ./error.php");
        }
    }

    function deleteMovie($movieId)
    {
        $this->startConnection();
        try {
            $this->db->beginTransaction();
            $this->statementGetMovieById->bindValue(":movieId", $movieId);
            $this->statementGetMovieById->execute();
            $movie = $this->statementGetMovieById->fetch(PDO::FETCH_ASSOC);
            if ($movie == null) {
                $this->db->rollBack();
                header("Location: ./error.php");
                return;
            }

            $this->statementDeleteMovie->bindValue(":movieId", $movieId);
            $this->statementDeleteMovie->execute();
            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
            header("Location: ./error.php");
        } finally {
            $this->db = null;
        }
    }

    function addMovieLike($movieId, $userId)
    {
        $this->startConnection();
        try {
            $this->statementCheckMovieLike->bindValue(":userId", $userId);
            $this->statementCheckMovieLike->bindValue(":movieId", $movieId);
            $this->statementCheckMovieLike->execute();

            $checkIfLikeExist = $this->statementCheckMovieLike->fetch(PDO::FETCH_ASSOC);

            if ($checkIfLikeExist == null) {
                $this->db->beginTransaction();
                $this->statementAddMovieLike->bindValue(":userId", $userId);
                $this->statementAddMovieLike->bindValue(":movieId", $movieId);
                $this->statementAddMovieLike->execute();

                $fetch_like = $this->statementAddMovieLike->fetch(PDO::FETCH_ASSOC);
                if ($fetch_like !== false) {
                    $this->db->rollBack();
                    header("Location: ./error.php");
                    return;
                }

                $this->db->commit();
            } else {
                header("Location: ./error.php");
                return;
            }

        } catch (PDOException $e) {
            $this->db->rollBack();
            header("Location: ./error.php");
        } finally {
            $this->db = null;
        }
    }

    function AddMovieComment($comment, $movieId, $userId)
    {
        $this->startConnection();
        try {
            $this->db->beginTransaction();

            $this->statementAddMovieComment->bindValue(":comment", $comment);
            $this->statementAddMovieComment->bindValue(":userId", $userId);
            $this->statementAddMovieComment->bindValue(":movieId", $movieId);
            $this->statementAddMovieComment->execute();

            $fetch_comment = $this->statementAddMovieComment->fetch(PDO::FETCH_ASSOC);
            if ($fetch_comment !== false) {
                $this->db->rollBack();
                header("Location: ./error.php");
                return;
            }

            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
            header("Location: ./error.php");
        } finally {
            $this->db = null;
        }
    }

    function getMovie($movieId)
    {
        $this->startConnection();
        try {
            $this->statementGetMovieById->bindValue(":movieId", $movieId);


            $this->statementGetMovieById->execute();
            if ($movie = $this->statementGetMovieById->fetch(PDO::FETCH_ASSOC)) {
                return $movie;
            } else {
                return "not found";
            }
        } catch (PDOException $e) {
            header("Location: ./error.php");
        } finally {
            $this->db = null;
        }
    }

    function getMovies($cinemaId)
    {
        $this->startConnection();
        try {
            $this->statementGetMoviesByCinemaId->bindValue(":cinemaId", $cinemaId);
            $this->statementGetMoviesByCinemaId->execute();
            $movies = array();
            while ($movie = $this->statementGetMoviesByCinemaId->fetch(PDO::FETCH_ASSOC)) {
                global $movies;
                $movies[] = $movie;
            }
            return $movies;
        } catch (PDOException $e) {
            header("Location: ./error.php");
        } finally {
            $this->db = null;
        }
    }
}

?>
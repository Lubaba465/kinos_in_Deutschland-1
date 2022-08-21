<?php

class cinemaDAO implements iCinemaDAO
{
    private $db = null;
    private $statementCinema = null;
    private $statementUpdateCinema = null;
    private $statementCinemas = null;
    private $statementCinemasByUser = null;
    private $statementCinemaByStateName = null;
    private $statementAddCinemaComment = null;
    private $statementAddCinemaLike = null;
    private $statementCheckCinemaLike = null;
    private $statementDeleteCinemaById = null;
    private $statementDeleteCinemaMovies = null;
    private $statementDeleteCinemaLikes = null;
    private $statementDeleteCinemaComments = null;
    private $statementAddCinema = null;
    private $statementGetTheLastCinema = null;
    private $statementGetCinemaComments = null;
    private $statementCinemaByName= null;
    private $statementSearchCinemas = null;
    private $statementgetCinemaLikesCount = null;
    private $statementRemoveCinemaLike = null;
    private $statementgetCinemaLike=null;

    private function SetStatements()
    {
        $this->statementCinema = $this->db->prepare("SELECT * FROM cinemas WHERE cinemaId = :cinemaId;");
        $this->statementUpdateCinema = $this->db->prepare("UPDATE cinemas SET cinemaName = (:cinemaName), description = (:description), cinemaImage = (:cinemaImage), cinemaStreetName = (:cinemaStreetName), cinemaStreetNumber = (:cinemaStreetNumber), cinemaZipCode = (:cinemaZipCode), cityName = (:cityName), state = (:state),  long=(:long) , lati=(:lati)  WHERE cinemaId = (:cinemaId);");
        $this->statementCinemas = $this->db->prepare("SELECT * FROM cinemas;");
        $this->statementCinemasByUser = $this->db->prepare("SELECT * FROM cinemas WHERE userId =(:userId)");
        $this->statementCinemaByStateName = $this->db->prepare("SELECT * FROM cinemas WHERE state =(:state)");
        $this->statementAddCinemaComment = $this->db->prepare("INSERT INTO cinemaComments (comment, userId,cinemaId) VALUES (:comment, :userId, :cinemaId);");
        $this->statementAddCinemaLike = $this->db->prepare("INSERT INTO cinemaLikes (userId,cinemaId) VALUES (:userId, :cinemaId);");
        $this->statementCheckCinemaLike = $this->db->prepare("SELECT * FROM cinemaLikes WHERE userId =(:userId) AND cinemaId =(:cinemaId)");
        $this->statementDeleteCinemaById = $this->db->prepare("DELETE FROM cinemas WHERE cinemaId = :cinemaId; DELETE FROM cinemaLikes WHERE cinemaId = :cinemaId; DELETE FROM cinemaComments WHERE cinemaId = :cinemaId; DELETE FROM movies WHERE cinemaId = :cinemaId;");
        $this->statementCinemaByName = $this->db->prepare("SELECT * FROM cinemas WHERE cinemaName = :cinemaName");
        $this->statementCinema = $this->db->prepare("SELECT * FROM cinemas WHERE cinemaId = :cinemaId");

        $this->statementDeleteCinemaMovies = $this->db->prepare("DELETE FROM movies WHERE cinemaId = :cinemaId;");
        $this->statementDeleteCinemaLikes = $this->db->prepare("DELETE FROM cinemaLikes WHERE cinemaId = :cinemaId;");
        $this->statementDeleteCinemaComments = $this->db->prepare("DELETE FROM cinemaComments WHERE cinemaId = :cinemaId;");

        $this->statementAddCinema = $this->db->prepare("INSERT INTO cinemas (cinemaName, description, cinemaImage, cinemaStreetName, cinemaStreetNumber, cinemaZipCode, cityName, state,long, lati,userId) VALUES (:cinemaName, :description, :cinemaImage, :cinemaStreetName, :cinemaStreetNumber, :cinemaZipCode, :cityName, :state,  :long,  :lati, :userId);");
        $this->statementGetCinemaComments = $this->db->prepare("SELECT * FROM  cinemaComments WHERE cinemaId = :cinemaId;");
        $this->statementGetTheLastCinema = $this->db->prepare("SELECT * FROM cinemas WHERE cinemaId = (SELECT MAX(cinemaId)  FROM cinemas);");
        $this->statementCinema = $this->db->prepare("SELECT * FROM cinemas WHERE cinemaId = :cinemaId;");

        $this->statementSearchCinemas = $this->db->prepare("SELECT * FROM cinemas WHERE cinemaName like (:searchContent) OR state like (:searchContent);");

        $this->statementgetCinemaLikesCount = $this->db->prepare("SELECT * FROM cinemaLikes WHERE cinemaId = :cinemaId;");

        $this->statementRemoveCinemaLike = $this->db->prepare("DELETE FROM cinemaLikes WHERE userId = :userId AND cinemaId = :cinemaId;");

        $this->statementgetCinemaLike = $this->db->prepare("SELECT * FROM cinemaLikes WHERE userId = :userId AND cinemaId = :cinemaId;");

    }

    function getCinemaLike($userId,$cinemaId){

        $this->startConnection();
        try {
            $this->statementgetCinemaLike->bindValue(":cinemaId", $cinemaId);
            $this->statementgetCinemaLike->bindValue(":userId", $userId);
            $this->statementgetCinemaLike->execute();
            if($cinemaLike= $this->statementgetCinemaLike->fetch(PDO::FETCH_ASSOC))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch(PDOException $e)
        {
            header("Location: ./error.php");
        }
        finally
        {
            $this->db = null;
        }
    }

    private function startConnection() {
        $user = "root";
        $pw = null;
        $dsn= "sqlite:../database/database.db";
        $this->db = new PDO($dsn, $user, $pw);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->SetStatements();
    }

    function getComments($cinemaId){

            $this->startConnection();
            try {
                $this->statementGetCinemaComments->bindValue(":cinemaId", $cinemaId);
                $this->statementGetCinemaComments->execute();

                $cinemaComments = array();
                while($cinemaComment = $this->statementGetCinemaComments->fetch(PDO::FETCH_ASSOC))
                {
                    global $cinemaComments;
                    $cinemaComments[] = $cinemaComment;
                }
                return $cinemaComments;
            }
            catch(PDOException $e)
            {
                header("Location: ./error.php");
            }
            finally
            {
                $this->db = null;
            }

    }

    function addCinema($cinema)
    {
        if(is_array($cinema)) {
            $this->startConnection();
            try {
                $this->db->beginTransaction();
                $this->statementAddCinema->execute($cinema);
                $this->db->commit();
                return true;
            } catch(PDOException $e) {
                $this->db->rollBack();
                return false;
            } finally {
                $this->db = null;
            }
        } else {
            //kein array
            return false;
            header("Location: ./error.php");
        }


    }
    
    function editCinema($cinemaId,$data)
    {

        if(is_array($data)) {
            $this->startConnection();
            try {
                $this->db->beginTransaction();
                $this->statementCinema->bindValue(":cinemaId", $cinemaId);
                $this->statementCinema->execute();
                $cinema = $this->statementCinema->fetch(PDO::FETCH_ASSOC);
                if($cinema === false) {
                    $this->db->rollBack();
                    header("Location: ./error.php");
                    return false;
                }
                $this->statementUpdateCinema->execute(array_merge($data, array("cinemaId" => $cinemaId)));
                $this->db->commit();
                return true;
            } catch(PDOException $e) {
                $this->db->rollBack();
                return false;
                header("Location: ./error.php");
            } finally {
                $this->db = null;
            }
        } else {
            //$data kein array
            return false;
            header("Location: ./error.php");
        }


    }

    function deleteCinema($cinemaId)
    {
        $this->startConnection();
        try
        {
            $this->db->beginTransaction();
            $this->statementCinema->bindValue(":cinemaId", $cinemaId);
            $this->statementCinema->execute();
            $cinema = $this->statementCinema->fetch(PDO::FETCH_ASSOC);
            if($cinema === false)
            {
                $this->db->rollBack();
                header("Location: ./error.php");
                return;
            }

            $this->statementDeleteCinemaById->bindValue(":cinemaId", $cinemaId);
            $this->statementDeleteCinemaById->execute();

            $this->statementDeleteCinemaMovies->bindValue(":cinemaId", $cinemaId);
            $this->statementDeleteCinemaMovies->execute();

            $this->statementDeleteCinemaLikes->bindValue(":cinemaId", $cinemaId);
            $this->statementDeleteCinemaLikes->execute();

            $this->statementDeleteCinemaComments->bindValue(":cinemaId", $cinemaId);
            $this->statementDeleteCinemaComments->execute();

            $this->db->commit();
        }
        catch(PDOException $e)
        {
            $this->db->rollBack();
            header("Location: ./error.php");
        }
        finally
        {
            $this->db = null;
        }
    }

    function addCinemaLike($userId,$cinemaId)
    {
        $this->startConnection();
        try
        {
            $this->statementCheckCinemaLike->bindValue(":userId", $userId);
            $this->statementCheckCinemaLike->bindValue(":cinemaId", $cinemaId);
            $this->statementCheckCinemaLike->execute();

            $checkIfLikeExist = $this->statementCheckCinemaLike->fetch(PDO::FETCH_ASSOC);

            if($checkIfLikeExist == null)
            {
                $this->db->beginTransaction();
                $this->statementAddCinemaLike->bindValue(":userId", $userId);
                $this->statementAddCinemaLike->bindValue(":cinemaId", $cinemaId);
                $this->statementAddCinemaLike->execute();

                $fetch_like = $this->statementAddCinemaLike->fetch(PDO::FETCH_ASSOC);
                if($fetch_like !== false)
                {
                    $this->db->rollBack();
                    header("Location: ./error.php");
                    return;
                }

                $this->db->commit();
            }
        }

        catch(PDOException $e)
        {
            $this->db->rollBack();
            header("Location: ./error.php");
        }

        finally
        {
            $this->db = null;
        }
    }

    function addCinemaComment($comment , $userId, $cinemaId)
    {
        $this->startConnection();
        try
        {
            $this->db->beginTransaction();

            $this->statementAddCinemaComment->bindValue(":comment", $comment);
            $this->statementAddCinemaComment->bindValue(":userId", $userId);
            $this->statementAddCinemaComment->bindValue(":cinemaId", $cinemaId);
            $this->statementAddCinemaComment->execute();

            $fetch_comment = $this->statementAddCinemaComment->fetch(PDO::FETCH_ASSOC);
            if($fetch_comment !== false)
            {
                $this->db->rollBack();
                header("Location: ./error.php");
                return;
            }

            $this->db->commit();
        }

        catch(PDOException $e)
        {
            $this->db->rollBack();
            header("Location: ./error.php");
        }

        finally
        {
            $this->db = null;
        }
    }

    function getCinema($cinemaId)
    {
        $this->startConnection();
        try {
            $this->statementCinema->bindValue(":cinemaId", $cinemaId);
            $this->statementCinema->execute();
            if($cinema = $this->statementCinema->fetch(PDO::FETCH_ASSOC))
            {
                return $cinema;
            }
            else
            {
                return "not found";
            }
        }
        catch(PDOException $e)
        {
            header("Location: ./error.php");
        }
        finally
        {
            $this->db = null;
        }
    }

    function getCinemas()
    {
        $this->startConnection();
        try 
        {
            $this->statementCinemas->execute();
            $cinemas = array();
            while($cinema = $this->statementCinemas->fetch(PDO::FETCH_ASSOC))
            {
                global $cinemas;
                $cinemas[] = $cinema;
            }
            return $cinemas;
        }
        catch(PDOException $e)
        {
            header("Location: ./error.php");
        }
        finally
        {
            $this->db = null;
        }
    }

    function getCinemasByUser($userId)
    {
        $this->startConnection();
        try
        {
            $this->statementCinemasByUser->bindValue(":userId", $userId);
            $this->statementCinemasByUser->execute();
            $cinemas = array();
            while($cinema = $this->statementCinemasByUser->fetch(PDO::FETCH_ASSOC))
            {
                global $cinemas;
                $cinemas[] = $cinema;
            }
            return $cinemas;
        }
        catch(PDOException $e)
        {
            header("Location: ./error.php");
        }
        finally
        {
            $this->db = null;
        }
    }

    function getCinemasByStateName($state)
    {
        $this->startConnection();
        try
        {
            $this->statementCinemaByStateName->bindValue(":state", $state);
            $this->statementCinemaByStateName->execute();
            $cinemas = array();
            while($cinema = $this->statementCinemaByStateName->fetch(PDO::FETCH_ASSOC))
            {
                global $cinemas;
                $cinemas[] = $cinema;
            }
            return $cinemas;
        }
        catch(PDOException $e)
        {
            header("Location: ./error.php");
        }
        finally
        {
            $this->db = null;
        }
    }

    function getTheLastCinema()
    {
        $this->startConnection();
        try
        {
            $this->statementGetTheLastCinema->execute();
            if($cinema = $this->statementGetTheLastCinema->fetch(PDO::FETCH_ASSOC))
            {
                return $cinema;
            }
            else
            {
                return "not found";
            }
        }
        catch(PDOException $e)
        {
            header("Location: ./error.php");
        }
        finally
        {
            $this->db = null;
        }
    }

    function searchcinemas($searchWord)
    {
        $this->startConnection();
        try {
            $this->statementSearchCinemas->bindValue(":searchContent", $searchWord);
            $this->statementSearchCinemas->execute();
            $cinemas = array();
            while($cinema = $this->statementSearchCinemas->fetch(PDO::FETCH_ASSOC))
            {
                global $cinemas;
                $cinemas[] = $cinema;
            }
            return $cinemas;
        }
        catch(PDOException $e)
        {
            header("Location: ./error.php");
        }
        finally
        {
            $this->db = null;
        }
    }

    function getCinemaLikesCount($cinemaId)
    {
        $this->startConnection();
        try
        {
            $this->statementgetCinemaLikesCount->bindValue(":cinemaId", $cinemaId);
            $this->statementgetCinemaLikesCount->execute();

            $likes = array();

            while($like = $this->statementgetCinemaLikesCount->fetch(PDO::FETCH_ASSOC))
            {
                global $likes;
                $likes[] = $like;
            }
            return sizeof($likes);
        }
        catch(PDOException $e)
        {
            header("Location: ./error.php");
        }
        finally
        {
            $this->db = null;
        }
    }

    function removeCinemaLike($userId,$cinemaId)
    {



        $this->startConnection();
        try
        {
            $this->db->beginTransaction();

            $this->statementRemoveCinemaLike->bindValue(":userId", $userId);
            $this->statementRemoveCinemaLike->execute();

            $this->statementRemoveCinemaLike->bindValue(":cinemaId", $cinemaId);

            $this->statementRemoveCinemaLike->execute();

            $this->db->commit();
        }
        catch(PDOException $e)
        {
            $this->db->rollBack();
            header("Location: ./error.php");
        }
        finally
        {
            $this->db = null;
        }
    }
}
?>
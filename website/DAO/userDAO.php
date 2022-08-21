<?php

class userDAO implements iUserDAO
{
    private $db = null;
    private $statementUserRegister = null;
    private $statementCheckIfUserMailExist = null;
    private $statementUpdateUserName = null;
    private $statementGetUser = null;
    private $statementUpdatePassword = null;
    private $statementGetHashedPassword = null;
    private $statementUser = null;

    private $statementDeleteUser = null;
    private $statementDeleteUserCinemas = null;
    private $statementDeleteUserMovies = null;
    private $statementDeleteUserLikes = null;
    private $statementDeleteUserComments = null;
    private $statementDeleteCinemaLikes = null;
    private $statementDeleteCinemaComments = null;
    private $statementGetUserCinemas = null;

    private function SetStatements()
    {
        $this->statementGetUser = $this->db->prepare("SELECT * FROM users WHERE userId = :userId;");
        $this->statementUpdateUserName = $this->db->prepare("UPDATE users SET name = (:name) WHERE userId = (:userId);");
        $this->statementUpdatePassword = $this->db->prepare("UPDATE users SET password = (:password) WHERE userId = (:userId);");

        $this->statementCheckIfUserMailExist = $this->db->prepare("SELECT * FROM users WHERE email = :userMail;");
        $this->statementUser = $this->db->prepare("SELECT userId FROM users WHERE email = :userMail;");


        $this->statementUserRegister = $this->db->prepare("INSERT INTO users (name,email,password) VALUES (:name, :email,:password);");

        $this->statementGetHashedPassword = $this->db->prepare("SELECT password FROM users WHERE email = :userMail;");

        $this->statementDeleteUser = $this->db->prepare("DELETE FROM users WHERE userId = :userId;");
        $this->statementDeleteUserCinemas = $this->db->prepare("DELETE FROM cinemas WHERE userId = :userId;");
        $this->statementDeleteUserLikes = $this->db->prepare("DELETE FROM cinemaLikes WHERE userId = :userId;");
        $this->statementDeleteUserComments = $this->db->prepare("DELETE FROM cinemaComments WHERE userId = :userId;");
        $this->statementGetUserCinemas = $this->db->prepare("SELECT * FROM cinemas WHERE userId = :userId;");

        $this->statementDeleteUserMovies = $this->db->prepare("DELETE FROM movies WHERE cinemaId = :cinemaId;");
        $this->statementDeleteCinemaLikes = $this->db->prepare("DELETE FROM cinemaLikes WHERE cinemaId = :cinemaId;");
        $this->statementDeleteCinemaComments = $this->db->prepare("DELETE FROM cinemaComments WHERE cinemaId = :cinemaId;");

        $this->statementNames=$this->db->prepare("SELECT name FROM users;");

    }

    private function startConnection()
    {
        $user = "root";
        $pw = null;
        $dsn= "sqlite:../database/database.db";
        $this->db = new PDO($dsn, $user, $pw);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->SetStatements();
    }

    function getnames()
    {
        $this->startConnection();
        try {
            $this->statementNames->execute();
            $allnames = array();
            while($user = $this->statementNames->fetch(PDO::FETCH_ASSOC)) {
                global $allnames;
                $allnames[] = $user;
            }
            global $allnames;
            return $allnames;
        } catch(PDOException $e) {
            header("Location: ./error.php");
        } finally {
            $this->db = null;
        }
    }

    function IsUserRegisted($email)
    {
        $this->startConnection();
        try
        {
            $this->db->beginTransaction();
            $email =  strtolower($email);
            $this->statementCheckIfUserMailExist->bindValue(":userMail", $email);
            $this->statementCheckIfUserMailExist->execute();

            if($this->statementCheckIfUserMailExist->fetch(PDO::FETCH_ASSOC) != null)
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

    function userRegister($name,$email,$password)
    {
        $this->startConnection();
        try
        {
            $this->db->beginTransaction();
            $email = strtolower($email);
            $this->statementCheckIfUserMailExist->bindValue(":userMail", $email);
            $this->statementCheckIfUserMailExist->execute();

            if($this->statementCheckIfUserMailExist->fetch(PDO::FETCH_ASSOC) != null)
            {
                return false;
            }

            else
            {
                $hashedPassword = strval(password_hash($password, PASSWORD_DEFAULT));
                $this->statementUserRegister->bindValue(":name", $name);
                $this->statementUserRegister->bindValue(":email", $email);
                $this->statementUserRegister->bindValue(":password", $hashedPassword);

                $this->statementUserRegister->execute();
                $this->db->commit();
                return true;
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

    function deleteUser($userId)
    {
        $this->startConnection();
        try
        {
            $this->db->beginTransaction();

            $this->statementDeleteUser->bindValue(":userId", $userId);
            $this->statementDeleteUser->execute();
            $this->statementDeleteUserCinemas->bindValue(":userId", $userId);
            $this->statementDeleteUserCinemas->execute();
            $this->statementDeleteUserLikes->bindValue(":userId", $userId);
            $this->statementDeleteUserLikes->execute();
            $this->statementDeleteUserComments->bindValue(":userId", $userId);
            $this->statementDeleteUserComments->execute();

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

    function logIn($userMail,$userPassword)
    {

        $this->startConnection();
        try
        {
            $this->db->beginTransaction();
            $userMail =  strtolower($userMail);

            $this->statementCheckIfUserMailExist->bindValue(":userMail", $userMail);
            $this->statementCheckIfUserMailExist->execute();

            if($this->statementCheckIfUserMailExist->fetch(PDO::FETCH_ASSOC) != null)
            {
                $this->statementGetHashedPassword->bindValue(":userMail", $userMail);
                $this->statementGetHashedPassword->execute();

                $existingHashFromDb = $this->statementGetHashedPassword->fetch(PDO::FETCH_ASSOC);

                $isPasswordCorrect = password_verify($userPassword, strval($existingHashFromDb['password']));

                if($isPasswordCorrect)
                {
                    $_SESSION['isLoggedIn'] = true;
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
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

    function updateUserName($userId,$name)
    {
        $this->startConnection();
        try
        {
            $this->db->beginTransaction();
            $this->statementUpdateUserName->bindValue(":userId", $userId);
            $this->statementUpdateUserName->bindValue(":name", $name);

            $this->statementUpdateUserName->execute();
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

    function updatePassword($userId,$newPassword)
    {
        $this->startConnection();
        try
        {
            $newHashedPassword = strval(password_hash($newPassword, PASSWORD_DEFAULT));

            $this->db->beginTransaction();
            $this->statementUpdatePassword->bindValue(":userId", $userId);
            $this->statementUpdatePassword->bindValue(":password", $newHashedPassword);

            $this->statementUpdatePassword->execute();
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

    function getUser($userId)
    {
        $this->startConnection();
        try {
            $this->statementGetUser->bindValue(":userId", $userId);
            $this->statementGetUser->execute();
            if($user = $this->statementGetUser->fetch(PDO::FETCH_ASSOC))
            {
                return $user;
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

    //Maybe we don´t need this function
    function getUserIdByEmail($userEmail)
    {
        $this->startConnection();
        try {
            $userEmail = strtolower($userEmail);
            $this->statementUser->bindValue(":userMail", $userEmail);
            $this->statementUser->execute();
            if($user = $this->statementUser->fetch(PDO::FETCH_ASSOC))
            {
                return $user['userId'];
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

}
?>
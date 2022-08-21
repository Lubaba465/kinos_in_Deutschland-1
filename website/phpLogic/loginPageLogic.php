<?php
require_once ("DAO/interfaces/iUserDAO.php" );
include "helper/sessionsHelper/sessionsHelper.php";

$usermsg = "";
$msgTitle = "";

if (isset($_POST["loginButton"])) {

    if (isset($_POST["email"]) && isset($_POST["userPassword"])) {

        $isLoggedIn = $userdao->logIn($_POST["email"], $_POST["userPassword"]);

        if ($isLoggedIn) {
            $_SESSION['userId'] = $userdao->getUserIdByEmail($_POST["email"]);
            header("Location:index.php");
        }
        else
        {
            $usermsg = "Bitte überprüfen Sie Ihre Angaben";
            $msgTitle = "FEHLER";
        }
    }
}
?>
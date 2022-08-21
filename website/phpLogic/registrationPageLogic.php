<?php

require_once ("DAO/interfaces/iUserDAO.php" );
include "helper/sessionsHelper/sessionsHelper.php";
$usermsg = "";
$msgTitle = "";
if(isset($_POST["signup"]))
{
    if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirmedPassword"]) && !empty($_POST["name"])&&!empty($_POST["confirmedPassword"]) && !empty($_POST["password"]) && !empty($_POST["email"]))
    {
        if($_POST["password"] == $_POST["confirmedPassword"])
        {
            $isUserRegisted=$userdao->IsUserRegisted($_POST["email"]);
            $usermsg = "Es wurde eine E-Mail an die angegebene Adresse verschickt mit weiteren Infos.";
            $msgTitle = "Hinweis";

            $_SESSION["isUserRegisted"] =$isUserRegisted;
            $_SESSION["registerUserName"] = $_POST["name"];
            $_SESSION["registerUserEmail"] = $_POST["email"];
            $_SESSION["registerUserPassword"] = $_POST["password"];

            echo '<script type="text/javascript">
                window.open("confirmRegistrationPage.php");
            </script>';
        }
        else
        {
            $usermsg = "Die Passwörter sind nicht gleich!";
            $msgTitle = "Fehler";
        }
    }
    else{
        $usermsg = "Bitte füllen Sie alles aus";
        $msgTitle = "Fehler";
    }
}
?>

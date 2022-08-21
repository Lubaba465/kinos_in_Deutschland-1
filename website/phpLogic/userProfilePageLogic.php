<?php
require_once ("DAO/interfaces/iuserDAO.php" );
include "helper/sessionsHelper/sessionsHelper.php";

$usermsg = "";
$msgTitle = "";

$loggedInUser = null;

if(isset($_SESSION['userId']))
{
    $loggedInUser = $userdao->getUser($_SESSION['userId']);

    if(isset($_POST["deleteUserCheckBox"]))
    {
        //den Nutzer fragen, ob er sich sicher ist, sein Konto und alles von ihm erstellte Kinos und Filme zu löschen
        $userdao->deleteUser($loggedInUser['userId']);
        require_once ("logoutPage.php" );
    }
    else
    {
        if(isset($_POST["submitBtn"]))
        {
            if(isset($_POST["name"]) && !empty($_POST["name"]) && isset($_POST["psw"]) && isset($_POST["pswb"]))
            {
                if(($_POST["psw"] == $_POST["pswb"]))
                {
                    $userdao->updateUserName($loggedInUser['userId'],$_POST["name"]);

                    if($_POST["psw"] != "••••••••" && !empty($_POST["psw"]))
                    {
                        $userdao->updatePassword($loggedInUser['userId'],$_POST['psw']);
                    }
                    header("Location:index.php");
                }
                else
                {
                    // den Nutzer sagen, dass die Passwörter nicht gleich sind oder.
                    $usermsg = "Die Passwörter stimmen nicht miteinander";
                    $msgTitle = "Warnung";
                }
            }
            else
            {
                // den Nutzer sagen, dass er alle Felder ausfühlen muss
                $usermsg = "Sie müssen alle Felder ausfüllen!";
                $msgTitle = "Warnung";
            }
        }
    }

}
else
{
    include ("error.php" );
}

?>

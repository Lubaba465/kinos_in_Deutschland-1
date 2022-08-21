<?php
include "DAO/interfaces/iUserDAO.php";
include "helper/sessionsHelper/sessionsHelper.php";

if(isset($_SESSION["registerUserName"]) && isset($_SESSION["registerUserEmail"]) && isset($_SESSION["registerUserPassword"]))
{
    if(!empty($_SESSION["registerUserName"]) && !empty($_SESSION["registerUserEmail"]) && !empty($_SESSION["registerUserPassword"]) )
    {
        $isUserRegisted = $userdao->userRegister($_SESSION["registerUserName"],$_SESSION["registerUserEmail"],$_SESSION["registerUserPassword"]);

        if($isUserRegisted)
        {
            ?>

            <article>
                <h1>Glückwunsch</h1>
                <p>Sie wurden erfolgreich regristriert! Sie können Sich jetzt anmelden</p>
            </article>
<?php
        }
        else
        {
            ?>


            <article>
                <h1>Fehler</h1>
                <p>Bitte versuchen Sie es nochmal</p>
            </article>
            <?php
        }
    }
}
?>

<?php

$userMSG = "";
if(isset($_SESSION["isUserRegisted"]) && $_SESSION["isUserRegisted"] == false )
{
    $userMSG = "Bitte ignoriere die 
                    E-Mail, wenn du es nicht warst, der sich versucht hat zu registrieren. Ansonsten 
                    klicke auf folgenden Link, um die Registrierung abzuschließen:";
}
else
{
    $userMSG = "Bitte ignoriere die E-Mail, 
            wenn du es nicht warst, der sich versucht hat zu registrieren. Du bist aber bereits 
            registriert. Solltest du dein Password vergessen habe, klicke bitte hier";

}
?>

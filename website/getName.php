<?php
$name = $_REQUEST["name"];
require_once("DAO/interfaces/iUserDAO.php");
$allnames = $userdao->getnames();
$Message = "";

foreach($allnames as $user) {
    if (strcasecmp($name, $user["name"]) == 0) {
        $Message = "Name bereits vergeben";
        echo $Message;
    }
}
?>

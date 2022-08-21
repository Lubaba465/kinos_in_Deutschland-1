<?php
require_once ("DAO/interfaces/iCinemaDAO.php" );
include "helper/sessionsHelper/sessionsHelper.php";

$cinemas = null;

if(isset($_GET['searchInput']) && !empty($_GET['searchInput']))
{
    $cinemas = $cinemadao->searchcinemas($_GET['searchInput']);
}
else
{
    $cinemas=$cinemadao->getCinemas();
}

/*include "helper/dummyDataHelper/cinemaDummyData.php";*/

?>
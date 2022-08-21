<?php

require_once ("DAO/interfaces/iCinemaDAO.php" );
  $cinemas=$cinemadao->getCinemas();


$return_json = '{"cinemas":[';
foreach($cinemas as $cinema) {
    $return_json = $return_json . '{"name":"';
    $return_json = $return_json . $cinema["cinemaName"];
    $return_json = $return_json . '","id":"';
    $return_json = $return_json . $cinema["cinemaId"];
    $return_json = $return_json . '","path":"';
    $return_json = $return_json . $cinema["cinemaImage"];
    $return_json = $return_json . '","userId":"';
    $return_json = $return_json . $cinema["userId"];
    $return_json = $return_json . '","longitude":"';
    $return_json = $return_json . $cinema["long"];
    $return_json = $return_json . '","latitude":"';
    $return_json = $return_json . $cinema["lati"];
    $return_json = $return_json . '"},';
}
$return_json = substr($return_json, 0, -1);
$return_json = $return_json . ']}';
echo $return_json;
?>
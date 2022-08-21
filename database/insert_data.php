<?php
try{

$password = strval(password_hash("12345", PASSWORD_DEFAULT));

$db->exec("
    INSERT OR IGNORE INTO users (name, email, password) VALUES ('Lubaba','lmohammad@mohammad.com','$password');
    INSERT OR IGNORE INTO users (name, email, password) VALUES ('Max','max@max.com','$password');
    
    INSERT OR IGNORE  INTO cinemas (cinemaName, description, cinemaImage, cinemaStreetName, cinemaStreetNumber, cinemaZipCode, cityName, state,long, lati, userId) VALUES ('Kino 01','Euer Kino 01', './ressources/images/cinema01.png', 'Lange straße',100,24902,'Oldenburg','Niedersachsen', 8.214552099999999, 53.1434501, 1);
    INSERT OR IGNORE  INTO cinemas (cinemaName, description, cinemaImage, cinemaStreetName, cinemaStreetNumber, cinemaZipCode, cityName, state, long, lati, userId) VALUES ('Kino 02','Euer Kino 02', './ressources/images/cinema_2.png', 'große straße',111,24902,'Bremen','Bremen', 8.8016937, 53.07929619999999, 1);
    INSERT OR IGNORE  INTO cinemas (cinemaName, description, cinemaImage, cinemaStreetName, cinemaStreetNumber, cinemaZipCode, cityName, state, long, lati, userId) VALUES ('Kino 03','Euer Kino 03', './ressources/images/cinema01.png', 'Lange straße',10,24902,'Delmenhorst','Niedersachsen',8.635593199999999, 53.0521886, 2);
    INSERT OR IGNORE  INTO cinemas (cinemaName, description, cinemaImage, cinemaStreetName, cinemaStreetNumber, cinemaZipCode, cityName, state, long, lati, userId) VALUES ('Kino 04','Euer Kino 04', './ressources/images/cinema_2.png', 'große straße',12,24902,'Bremerhaven','Bremen',8.5809424, 53.5395845, 2);
    
    INSERT OR IGNORE  INTO movies (movieName,description,movieImage,price,releaseDate,language,cinemaId) VALUES ('Film 01','Euer Film 01','./ressources/images/batman.png',12,'22.05.2022 21:17:57', 'Deutsch', 1);
    INSERT OR IGNORE  INTO movies (movieName,description,movieImage,price,releaseDate,language,cinemaId) VALUES ('Film 02','Euer Film 02','./ressources/images/interstellar.png',1,'22.05.2022 21:17:57', 'Spanisch', 2);
    INSERT OR IGNORE  INTO movies (movieName,description,movieImage,price,releaseDate,language,cinemaId) VALUES ('Film 03','Euer Film 03','./ressources/images/movieImage.png',15,'22.05.2022 21:17:57', 'Englisch', 3);
    INSERT OR IGNORE INTO movies (movieName,description,movieImage,price,releaseDate,language,cinemaId) VALUES ('Film 04','Euer Film 04','./ressources/images/batman.png',19,'22.05.2022 21:17:57', 'Deutsch', 4);
    
    INSERT OR IGNORE INTO cinemaComments (comment,userId,cinemaId) VALUES ('Kommentar von Mohammad user 01',1,1);
    INSERT OR IGNORE  INTO cinemaComments (comment,userId,cinemaId) VALUES ('Kommentar von Mohammad user 01',1,2);
    INSERT OR IGNORE INTO cinemaComments (comment,userId,cinemaId) VALUES ('Kommentar von Mohammad user 01',1,3);
    INSERT OR IGNORE  INTO cinemaComments (comment,userId,cinemaId) VALUES ('Kommentar von Nina user 02',2,1);
    INSERT OR IGNORE  INTO cinemaComments (comment,userId,cinemaId) VALUES ('Kommentar von Nina user 02',2,2);
    INSERT OR IGNORE INTO cinemaComments (comment,userId,cinemaId) VALUES ('Kommentar von Nina user 02',2,3);
    
    
    INSERT OR IGNORE  INTO cinemaLikes (userId,cinemaId) VALUES (1,1);
    INSERT OR IGNORE  INTO cinemaLikes (userId,cinemaId) VALUES (1,2);
    INSERT OR IGNORE  INTO cinemaLikes (userId,cinemaId) VALUES (1,3);
    INSERT OR IGNORE  INTO cinemaLikes (userId,cinemaId) VALUES (2,1);
    INSERT OR IGNORE INTO cinemaLikes (userId,cinemaId) VALUES (2,3);
    ");

$err = $db->errorInfo();
/*echo strval($err[0]);*/
$db = null;
}catch(PDOException $e) {
    echo $e->getMessage();
} finally {
    
}

?>
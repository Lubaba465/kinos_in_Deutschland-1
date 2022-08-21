<?php

try {
    $user = "root";
    $pw = null;
    define('DB_DRIVER', 'sqlite');
    define('DB_DATABASE',"../database/database.db");

    $dsn = DB_DRIVER . ':' . DB_DATABASE;

    $db = new PDO($dsn, $user, $pw);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $mydatabase = "
    
    CREATE TABLE  IF NOT EXISTS  users (
        userId INTEGER PRIMARY KEY AUTOINCREMENT,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(250) NOT NuLL,
        password VARCHAR NOT NULL
    );
        
    CREATE TABLE  IF NOT EXISTS  cinemas (
        cinemaId INTEGER PRIMARY KEY AUTOINCREMENT,
        cinemaName VARCHAR(50) NOT NULL,
        description TEXT NOT NULL,
        cinemaImage VARCHAR(50) NOT NULL,
        cinemaStreetName VARCHAR(50) NOT NULL,
        cinemaStreetNumber INTEGER NOT NULL,
        cinemaZipCode INTEGER NOT NULL,
        cityName VARCHAR(50) NOT NULL,
        state VARCHAR(50) NOT NULL,
        userId INTEGER NOT NULL,
        long REAL,
        lati REAL,
        
        FOREIGN KEY(userId) REFERENCES users(userId)
    );
    
    CREATE TABLE  IF NOT EXISTS movies (
        movieId INTEGER PRIMARY KEY AUTOINCREMENT,
        movieName VARCHAR(50) NOT NULL,
        description TEXT NOT NULL,
        movieImage VARCHAR(50) NOT NULL,
        price REAL NOT NULL,
        releaseDate DATE NOT NULL,
        language VARCHAR(50) NOT NULL,
        cinemaId INTEGER NOT NULL,

        FOREIGN KEY(cinemaId) REFERENCES cinemas(cinemaId)
    );
    
    CREATE TABLE  IF NOT EXISTS cinemaComments (
        cinemaCommentId INTEGER PRIMARY KEY AUTOINCREMENT,
        comment TEXT NOT NULL,
        userId INTEGER NOT NULL,
        cinemaId INTEGER NOT NULL,

        FOREIGN KEY(userId) REFERENCES users(userId),
        FOREIGN KEY(cinemaId) REFERENCES cinemas(cinemaId)
    );


    CREATE TABLE  IF NOT EXISTS  cinemaLikes (
        cinemaLikeId INTEGER PRIMARY KEY AUTOINCREMENT,
        userId INTEGER,
        cinemaId INTEGER,

        FOREIGN KEY(userId) REFERENCES users(userId),
        FOREIGN KEY(cinemaId) REFERENCES cinemas(cinemaId)
    );

";

    $db->exec($mydatabase);
    $err = $db->errorInfo();


    $sql = "SELECT  cinemaId FROM  cinemas limit 1";

    $result=$db->prepare($sql);
    $result->execute();
    $rs=$result->fetch();
    if(empty($rs['cinemaId'])){
        include("insert_data.php");
    }

} catch (PDOException $e) {echo $e->getMessage();}
$db = null;
?>
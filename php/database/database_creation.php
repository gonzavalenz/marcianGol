<?php

include ('connection.php');

/* ------------------------ DATABASE CREATION ------------------------ */

$databaseName = "MarcianGol";

$createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS $databaseName";

if (mysqli_query($conn, $createDatabaseQuery)) {
    echo "<br> Database created successfully";
} else {
    die("<br> Database creation has failed: " . mysqli_error($conn));
}

/* ------------------------ TABLES CREATION ------------------------ */

mysqli_select_db($conn, $databaseName);

$createTableTeam = "CREATE TABLE IF NOT EXISTS team (
    id_team INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    photo VARCHAR(50) NOT NULL
);";

$createTableUser = "CREATE TABLE IF NOT EXISTS user (
    id_user INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(150) NOT NULL,
    admin BOOLEAN NOT NULL DEFAULT FALSE,
    active BOOLEAN NOT NULL DEFAULT TRUE,
    id_team INT(6) UNSIGNED NOT NULL,

    FOREIGN KEY (id_team) REFERENCES team(id_team) ON DELETE CASCADE ON UPDATE CASCADE
    
)";

$createTableLeague = "CREATE TABLE IF NOT EXISTS league (
    id_league INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(50) NOT NULL
);";

$createTableForo = "CREATE TABLE IF NOT EXISTS foro (
    id_foro INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    photo VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(50) NOT NULL,
    date_creation DATE NOT NULL,
    id_league INT(6) UNSIGNED NOT NULL,
    id_user INT(6) UNSIGNED NOT NULL,
    active BOOLEAN NOT NULL DEFAULT TRUE,

    FOREIGN KEY (id_league) REFERENCES league(id_league) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE
    
)";

$createTableComment = "CREATE TABLE IF NOT EXISTS comment (
    id_comment INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(50) NOT NULL,
    date_comment DATE NOT NULL,
    likes INT(6) NOT NULL DEFAULT 0,
    dislikes INT(6) NOT NULL DEFAULT 0,
    id_foro INT(6) UNSIGNED NOT NULL,
    id_user INT(6) UNSIGNED NOT NULL,

    FOREIGN KEY (id_foro) REFERENCES foro(id_foro) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE
    
)";

if (mysqli_query($conn, $createTableTeam)) {
    echo "<br> Table Team created successfully";
} else {
    echo "<br> Error while creating table Team: " . mysqli_error($conn);
}
if (mysqli_query($conn, $createTableUser)) {
    echo "<br> Table User created successfully";
} else {
    echo "<br> Error while creating table User: " . mysqli_error($conn);
}
if (mysqli_query($conn, $createTableLeague)) {
    echo "<br> Table League created successfully";
} else {
    echo "<br> Error while creating table League: " . mysqli_error($conn);
}
if (mysqli_query($conn, $createTableForo)) {
    echo "<br> Table Foro created successfully";
} else {
    echo "<br> Error while creating table Foro: " . mysqli_error($conn);
}
if (mysqli_query($conn, $createTableComment)) {
    echo "<br> Table Comment created successfully";
} else {
    echo "<br> Error while creating table Comment: " . mysqli_error($conn);
}

include ("inserts.php");

// Cerrar la conexión
$conn->close();

?>
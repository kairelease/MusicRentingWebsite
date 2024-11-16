<?php

#server name
$serverName = "localhost";

# user name
$userName = "root";

# password
$password = "";

# database name
$db_name = "music-rent-store-db";

//creating database connection using The PHP Data Object
try {
    $conn = new PDO("mysql:host=$serverName;dbname=$db_name", $userName, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection failed : " . $e->getMessage();
}
<?php
////////// PCR ///////////////
$servername = "127.0.0.1";
$username = "root";
$password = "root123456";
$dbname = "pcrdb"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


/////////// DBMC /////////////
$servername_data = "127.0.0.1";
$username_data = "root";
$password_data = "root123456";
$dbname_data = "dbmc";

$condbmc = new mysqli($servername_data, $username_data, $password_data, $dbname_data);

if ($condbmc->connect_error) {
    die("Connection failed: " . $condbmc->connect_error);
}
?>

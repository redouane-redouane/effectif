<?php
// id15600269_electag	
// id15600269_root	
// 210(IOw<~pBnqWSN
//Connect to data base stored in the server
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "urdseDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

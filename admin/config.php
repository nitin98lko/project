<?php
 $dbhost="localhost";
 $dbuser="root";
 $dbpass="mysql";
 $dbname="project";

 // Create connection
 global $conn;
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully with mysql";
session_start();

$_SESSION['cart'][0] = array(
  'prodname' => "name",
  'price' => 99,
  'quantity' => 1,
  'product_id'=>9999,
  'image'=>"image.jpg"
);

?>
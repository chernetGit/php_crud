<?php
if (isset($_GET["id"])) {
   $id = $_GET["id"];

$servername = 'localhost';
$username = 'root';
$password = "";
$database = 'myshop';
// create connection
$connection = new mysqli($servername, $username, $password, $database);

$sql = "DELETE FROM clients WHERE id = $id";
  mysqli_query($connection, $sql);
}

header("location: /myshop_php_app/index.php");
exit;
?>
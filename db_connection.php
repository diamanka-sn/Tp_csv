
<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "bdsuperette";
$conn = mysqli_connect($server, $username, $password, $db);


$mysqli = new mysqli($server, $username, $password, $db);
// TEST DE CONNEXION 1
if ($mysqli->connect_errno > 0) {
  die('IMPOSSIBLE DE SE CONNECTER AU SERVEUR' . $mysqli->connect_error);
}
?>
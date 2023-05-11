<?php 

require '../protected/connection.php';
require '../protected/functions.php';

error_reporting(0);
header('Content-Type: application/json');

$conn = get_connection();

if (!$_GET['action']) {
    $array = array();

    $array['success'] = "Welcome to our api!";

    echo json_encode($array);
} 

if ($_GET['action'] == "geninvite") {
if ($_GET['key'] == "QuantumISHOT23!") {
    $array = array();
    $inv = genstring(14);

    $conn->query("INSERT INTO `invites` (`invite`, `owner`, `isUsed`) VALUES ('$inv', 'API', 0);");

    $array['invite'] = $inv;

    echo json_encode($array);
    } else {
    $array = array();

    $array['error'] = "Unauthorized";

    echo json_encode($array);
  }
}



?>
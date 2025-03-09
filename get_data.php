<?php
$host = "localhost";
$user = "root"; 
$pass = ""; 
$db = "db_realtime";

$conn = new mysqli($host, $user, $pass, $db);

$sql = "SELECT * FROM data_realtime";
$result = $conn->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>

<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "robot_control";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

$sql = "SELECT * FROM robot_pose";
$result = $conn->query($sql);

$poses = array();
while($row = $result->fetch_assoc()) {
    $poses[] = $row;
}

echo json_encode($poses);

$conn->close();
?>
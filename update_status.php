<?php
header('Content-Type: application/json; charset=utf-8');

$host = "localhost";
$username = "root";
$password = "";
$database = "robot_control";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
  echo json_encode(["status"=>"error","message"=>$conn->connect_error]); exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $m1 = intval($_POST['motor1'] ?? 0);
  $m2 = intval($_POST['motor2'] ?? 0);
  $m3 = intval($_POST['motor3'] ?? 0);
  $m4 = intval($_POST['motor4'] ?? 0);

  $sql = "INSERT INTO robot_pose (motor1, motor2, motor3, motor4) VALUES ($m1, $m2, $m3, $m4)";
  if ($conn->query($sql) === TRUE) {
    echo json_encode(["status"=>"success","id"=>$conn->insert_id]);
  } else {
    echo json_encode(["status"=>"error","message"=>$conn->error]);
  }
} else {
  echo json_encode(["status"=>"error","message"=>"Invalid request"]);
}
$conn->close();
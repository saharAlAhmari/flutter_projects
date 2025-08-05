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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
  $id = intval($_POST['id']);
  $sql = "DELETE FROM robot_pose WHERE id = $id";
  if ($conn->query($sql) === TRUE) {
    echo json_encode(["status"=>"deleted"]);
  } else {
    echo json_encode(["status"=>"error","message"=>$conn->error]);
  }
} else {
  echo json_encode(["status"=>"error","message"=>"Invalid request"]);
}
$conn->close();
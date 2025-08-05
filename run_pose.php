<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "robot_control";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'] ?? '';

if ($id === '') {
    echo json_encode(['status' => 'error', 'message' => 'No ID provided']);
    exit;
}

$sql = "SELECT motor1, motor2, motor3, motor4 FROM robot_pose WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode([
        'status' => 'success',
        'motor1' => $row['motor1'],
        'motor2' => $row['motor2'],
        'motor3' => $row['motor3'],
        'motor4' => $row['motor4'],
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Pose not found']);
}

$conn->close();
?>
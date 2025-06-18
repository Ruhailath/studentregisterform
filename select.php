<?php
header('Content-Type: application/json');
include 'dbconnection.php';
$id = $_POST['id'];
$sql ="select * from student_register where student_id=$id";
 
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
}
$conn->close();
?>
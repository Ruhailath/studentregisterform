<?php
include 'dbconnection.php';
$id = $_REQUEST['selected'];
$u="select * from student where id=$id";
 
$r = mysqli_query($conn, $u);
if ($r->num_rows > 0) {
    $row = $r->fetch_assoc();
    echo json_encode($row);
}
?>
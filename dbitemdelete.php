<?php
  include 'dbconnection.php';
 // Check if the ID is set in the URL
 if (isset($_POST['id'])) 
 {
    $id = $_POST['id'];
    $sql = "DELETE FROM student_register WHERE student_id=$id";

     if ($conn->query($sql) ===TRUE)
        {
            echo "Record deleted successfully";
        }
        else{
            echo "Error deleting record: " . $conn->error;
         }
 }   
$conn->close();

?>
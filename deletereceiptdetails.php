<?php
  include 'dbconnection.php';
 // Check if the ID is set in the URL
 if (isset($_POST['id'])) 
 {
    $id = $_POST['id'];
    $sql = "DELETE receipt_header,receipt_details from receipt_header inner join receipt_details ON receipt_header.header_id=receipt_details.header_id  WHERE receipt_header.header_id=$id";
    

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
<html>
 <link rel="stylesheet" href="style.css" />
<?php
include 'dbconnection.php';
$sql = "select receipt_header.header_id, receipt_header.student_id,receipt_header.receipt_no,receipt_header.total,receipt_header.receipt_date,student_register.student_firstname,student_register.email,student_register.phone,student_register.course FROM
receipt_header INNER JOIN student_register ON receipt_header.student_id=student_register.student_id;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<h2>Fee Details Of Students</h2>";
    echo ' <table id="feedetailsbody">';
    echo "<thead>";
    echo  "<tr>";
    echo  "<th>Student_id</th>";
    echo  "<th>student_firstname</th>";
    echo  "<th>Email</th>";
    echo  "<th>Phone</th>";
    echo  "<th>Course</th>";
    echo  "<th>Receipt_number</th>";
    echo  "<th>Total amount</th>";
    echo  "<th>Receipt Date</th>";
    echo  "<th>Delete</th>";
    echo  "<th>Update</th>";
    echo  "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr id='tr'>";
        echo "<td>" . $row["student_id"] . "</td>";
        echo "<td>" . $row["student_firstname"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "<td>" . $row["course"] . "</td>";
        echo "<td>" . $row["receipt_no"] . "</td>";
        echo "<td>" . $row["total"] . "</td>";
        echo "<td>" . $row["receipt_date"] . "</td>";
        echo "<td><button class='delete-button' onclick='deletefeeRow({$row["header_id"]})' name='buttonfeedel' id='buttonfeedel'>Delete</button></td>";
        echo "<td><button class='update-button' onclick='updatefeeRow({$row["header_id"]})' name='buttonfeeupdate' id='buttonfeeupadate' >Update</button></td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
</html>
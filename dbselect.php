 <html>
 <link rel="stylesheet" href="style.css" />
<?php
include 'dbconnection.php';
$sql = "SELECT * FROM student_register";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<h2>Registered Students</h2>";
    echo '<table id="studentTable">';
    echo "<thead>";
    echo  "<tr>";
    echo  "<th>ID</th>";
    echo  "<th>First Name</th>";
    echo  "<th>Last Name</th>";
    echo  "<th>Date of Birth</th>";
    echo  "<th>Email</th>";
    echo  "<th>Phone</th>";
    echo  "<th>Gender</th>";
    echo  "<th>Address</th>";
    echo  "<th>City</th>";
    echo  "<th>Pincode</th>";
    echo  "<th>State</th>";
    echo  "<th>Country</th>";
    echo  "<th>University</th>";
    echo  "<th>Course</th>";
    echo  "<th>Password</th>";
    echo  "<th>Confirm Password</th>";
    echo  "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr id='tr'>";
        echo "<td>" . $row["student_id"] . "</td>";
        echo "<td>" . $row["student_firstname"] . "</td>";
        echo "<td>" . $row["student_lastname"] . "</td>";
        echo "<td>" . $row["dob"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "<td>" . $row["gender"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["city"] . "</td>";
        echo "<td>" . $row["pin"] . "</td>";
        echo "<td>" . $row["state"] . "</td>";
        echo "<td>" . $row["country"] . "</td>";
        echo "<td>" . $row["university"] . "</td>";
        echo "<td>" . $row["course"] . "</td>";
        echo "<td>" . $row["pass_wrd"] . "</td>";
        echo "<td>" . $row["confirm_pass"] . "</td>";
        echo "<td><button class='delete-button' onclick='deleteRow({$row["student_id"]})' name='buttondel' id='buttondel'>Delete</button></td>";
        echo "<td><button class='update-button' onclick='updateRow({$row["student_id"]})'>Update</button></td>";
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
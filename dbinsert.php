<?php
   include 'dbconnection.php';
   
    // Collect and sanitize form data
    //if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $firstname = $_POST["name"] ?? '';
              $lastname = $_POST["lastname"] ?? '';
              $dob = $_POST["dob"] ?? '';
              $email = $_POST["email"] ?? '';
              $phone = $_POST["phone"] ?? '';
              $gender = $_POST["gender"] ?? '';
              $address =$_POST["address"] ?? '';
              $City = $_POST["City"] ?? '';
              $state =$_POST["state"] ?? '';
              $country = $_POST["country"] ?? '';
              $pincode = $_POST["pincode"] ?? '';
              $university =$_POST["university"] ?? '';
              $course = $_POST["course"] ?? '';
              $password =$_POST["password"] ?? '';
              $confirmpassword = $_POST["confirmpassword"] ?? '';
    // Prepare and execute the SQL statement
$sql = "INSERT INTO student_register (student_firstname,student_lastname, dob, email, phone, gender,address,city,state, country, pin, university, course, pass_wrd,confirm_pass)
VALUES ('$firstname', '$lastname', '$dob', '$email', '$phone', '$gender', '$address', '$City', '$state', '$country', '$pincode', '$university', '$course', '$password','$confirmpassword')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
//}
?>


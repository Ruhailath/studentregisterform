<?php
   include 'dbconnection.php';
              $id=$_POST["id"] ?? '';
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

// Check if the ID is set in the URL
if ($id== '$row["student_id"]' ) {
               $id = $_POST['id'];

              $sql = "UPDATE Student_register SET student_firstname='$firstname',student_lastname='$lastname',dob='$dob', email='$email', phone='$phone', gender='$gender',address='$address',city='$City',state='$state', country='$country', pin='$pincode', university='$university', course='$course', pass_wrd='$password',confirm_pass='$confirmpassword' WHERE id=$id";

             if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
               } else {
                 echo "Error updating record: " . $conn->error;
               }
           }
              else{
               $sql = "INSERT INTO student_register (student_firstname,student_lastname, dob, email, phone, gender,address,city,state, country, pin, university, course, pass_wrd,confirm_pass)
                VALUES ('$firstname', '$lastname', '$dob', '$email', '$phone', '$gender', '$address', '$City', '$state', '$country', '$pincode', '$university', '$course', '$password','$confirmpassword')";

             if ($conn->query($sql) === TRUE) {
                 echo "New record created successfully";
             } else {
                 echo "Error: " . $sql . "<br>" . $conn->error;
             }
           }
$conn->close();
//}
?>


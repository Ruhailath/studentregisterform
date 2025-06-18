<?php
      // define variables and set to empty values
      $namepattern=$lastnamepattern= $emailpattern= $phonepattern= $zipcodepattern=$passwordpattern="";
      $firstname = $lastname =  $dob= $email = $phone= $gender = $address = $City =  $state = $country = $pincode = $university =  $course = $password="";
      $namepattern='/^[a-zA-Z][a-zA-Z0-9_ ]{5,19}$/';
      $lastnamepattern='/[a-zA-z]/';
      $emailpattern='/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
      $phonepattern='/^\+?1?[-.\s]?\(?([0-9]{3})\)?[-.\s]?([0-9]{3})[-.\s]?([0-9]{4})$/';
      $zipcodepattern='/^[0-9]{6}$/';
      //$zipcodepattern='/^\+?1?[-.\s]?\(?([0-9]{3})\)?[-.\s]?([0-9]{3})[-.\s]?([0-9]{4})$/';
      $passwordpattern= '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $firstname = test_input($_POST["firstname"] ?? '');
              $lastname = test_input($_POST["lastname"] ?? '');
              $dob = test_input($_POST["dob"] ?? '');
              $email = test_input($_POST["email"] ?? '');
              $phone = test_input($_POST["phone"] ?? '');
              $gender = test_input($_POST["gender"] ?? '');
              $address = test_input($_POST["address"] ?? '');
              $City = test_input($_POST["City"] ?? '');
              $state = test_input($_POST["state"] ?? '');
              $country = test_input($_POST["country"] ?? '');
              $pincode = test_input($_POST["pincode"] ?? '');
              $university = test_input($_POST["university"] ?? '');
              $course = test_input($_POST["course"] ?? '');
              $password = test_input($_POST["password"] ?? '');
              $confirmpassword = test_input($_POST["confirmpassword"] ?? '');
       //validation of form data
       if(empty($firstname)){
         echo "<script>alert('name should not be empty')</script>";
          return false;
       }
        elseif(!preg_match($namepattern,$firstname)){
        echo "<script>alert('name should be correct format')</script>";
        return false;
       }
       //lastname validation
       if(empty($lastname)){
        echo "<script>alert('last name should not be empty!')</script>";
         return false;
       }
       elseif(!preg_match($lastnamepattern,$lastname)){
        echo "<script>alert('last name should be correct format')</script>";
         return false;
       }

       //dob validation
       if(empty( $dob))
       {
        echo "<script>alert('DOB must select')</script>";
         return false;
       }

       //email validation

       if(empty($email)){
           echo "<script>alert('email should select')</script>";
            return false;
       }
       elseif(!preg_match($emailpattern,$email)){
        echo "<script>alert('email should be correct format')</script>";
         return false;
       }

       //phone validation
       if(empty($phone)){
           echo "<script>alert('phone should select')</script>";
            return false;
       }
       elseif(!preg_match($phonepattern,$phone)){
        echo "<script>alert('phone number should be correct format')</script>";
         return false;
       }

       //gender validation
       if(empty($gender)){
          echo "<script>alert('gender should select')</script>";
           return false;
       }

       //address validation
       if(empty($address)){
          echo "<script>alert('address should be filled')</script>";
           return false;
       }elseif(!strlen($address) >20){
          echo "<script>alert('address donot more than 20 words')</script>";
           return false;
       }

       //city validation
       if(empty($City)){
         echo "<script>alert('city should not be empty')</script>";
          return false;
       }

       //state
       if(empty($state)){
         echo "<script>alert('state should not be empty')</script>";
          return false;
       }
       //country
       if(empty($country)){
         echo "<script>alert('state should not be empty')</script>";
          return false;
       }
       //pincode
       if(empty($pincode)){
         echo "<script>alert('pincode should not be empty')</script>";
          return false;
       }
       elseif(!preg_match($zipcodepattern,$pincode)){
         echo "<script>alert('pincode should be correct format')</script>";
          return false;
       }
       //university
       if(empty($university)){
        echo "<script>alert('University should not be empty')</script>";
         return false;
       }
       //course
        if(empty($course)){
        echo "<script>alert('Course should not be empty')</script>";
         return false;
       }

       //password
       if(empty($password))
       {
         echo "<script>alert('password should not be empty')</script>";
         return false;
       }
       elseif(!preg_match($passwordpattern,$password)){
        echo "<script>alert('password should be correct format')</script>";
         return false;
       }

       //confirm password
       if(empty($confirmpassword))
       {
         echo "<script>alert('confrim password should not be empty')</script>";
         return false;
       }
       elseif($password!=$confirmpassword)
       {
         echo "<script>alert('password and confirm password should equal')</script>";
          return false;
       }
      

       return true;
    } 
    function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
       } 
?> 

//persitanace of date_add
<?php 
     $namepattern=$lastnamepattern= $emailpattern= $phonepattern= $zipcodepattern=$passwordpattern="";
      $firstname = $lastname =  $dob= $email = $phone= $gender = $address = $City =  $state = $country = $pincode = $university =  $course = $password="";
      $namepattern='/^[a-zA-Z][a-zA-Z0-9_ ]{5,19}$/';
      $lastnamepattern='/[a-zA-z]/';
      $emailpattern='/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
      $phonepattern='/^\+?1?[-.\s]?\(?([0-9]{3})\)?[-.\s]?([0-9]{3})[-.\s]?([0-9]{4})$/';
      $zipcodepattern='/^[0-9]{6}$/';
      //$zipcodepattern='/^\+?1?[-.\s]?\(?([0-9]{3})\)?[-.\s]?([0-9]{3})[-.\s]?([0-9]{4})$/';
      $passwordpattern= '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $firstname = test_input($_POST["firstname"] ?? '');
              $lastname = test_input($_POST["lastname"] ?? '');
              $dob = test_input($_POST["dob"] ?? '');
              $email = test_input($_POST["email"] ?? '');
              $phone = test_input($_POST["phone"] ?? '');
              $gender = test_input($_POST["gender"] ?? '');
              $address = test_input($_POST["address"] ?? '');
              $City = test_input($_POST["City"] ?? '');
              $state = test_input($_POST["state"] ?? '');
              $country = test_input($_POST["country"] ?? '');
              $pincode = test_input($_POST["pincode"] ?? '');
              $university = test_input($_POST["university"] ?? '');
              $course = test_input($_POST["course"] ?? '');
              $password = test_input($_POST["password"] ?? '');
              $confirmpassword = test_input($_POST["confirmpassword"] ?? '');
      }
    ?>
    student_register (student_firstname,student_lastname, dob, email, phone, gender,address,city,state, country, pin, university, course, pass_wrd,confirm_pass)
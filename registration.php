<script src="jquery-1.11.1.min.js"></script>

<?php
    include 'dbconnection.php';
?>
<!-- Your custom script -->
 <script>
    function formsubmission()
    {
   
      const firstname=document.getElementById("name").value;
      const lastname=document.getElementById("lastname").value;
      const dob=document.getElementById("dob").value;
      const cid=document.getElementById("courseid").value;
      const email=document.getElementById("email").value;
      const phone=document.getElementById("phone").value;
      const gender=document.querySelector('input[name="gender"]:checked');
      const address=document.getElementById("address").value;
      const city=document.getElementById("City").value;
      const pincode=document.getElementById("pincode").value;
      const state=document.getElementById("state").value;
      const country=document.getElementById("country").value;
      const university=document.getElementById("university").value;
      const course=document.getElementById("course").value;
      const password=document.getElementById("password").value;
      const confirmpassword=document.getElementById("confirmpassword").value;      
        //regular expression for name,email,password
      const namepattern=/^[a-zA-Z][a-zA-Z0-9_ ]{5,19}$/;
      const lastnamepattern=/[a-zA-z]/;
      const emailpattern=/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      const passwordpattern=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/; 
      const phonepattern=/^\+?1?[-.\s]?\(?([0-9]{3})\)?[-.\s]?([0-9]{3})[-.\s]?([0-9]{4})$/;
      const zipcodepattern=/^[0-9]{6}$/;
      if (firstname.trim() === "") {
        alert("First name should not be empty!");
        document.getElementById("name").focus();
        return false;
      }
      if(lastname.trim()===''){
        alert("lastname should not be empty!");
        document.getElementById("lastname").focus();
        return false;
      }
      if(dob.trim()=== ""){
        alert("dob should not be empty!");
        document.getElementById("dob").focus();
        return false;
      }
       if(cid.trim()===''){
        alert("course-id should not be empty!");
        document.getElementById("course").focus();
        return false;
      }
      if(email.trim()===''){
        alert("email should not be empty!");
        document.getElementById("email").focus();
        return false;
      }else if(!emailpattern.test(email.trim())){
        alert('please enter a valied email address');
         document.getElementById("email").focus();
        return false;
     }
     if(phone.trim()===''){
        alert("phone number should not be empty!");
        document.getElementById("phone").focus();
        return false;
      }
      else if(!phonepattern.test(phone.trim())){
        alert('please only 10 digit on phone number');
         document.getElementById("phone").focus();
        return false
      }
     if(!gender){
        alert("gender should  be selected!");
        document.querySelector('input[name="gender"]').focus();
        return false;
      }
      if(address.trim()===''){
        alert("address should not be empty!");
        document.getElementById("address").focus();
        return false;
      }
      if(city.trim()===''){
        alert("city should not be empty!");
        document.getElementById("City").focus();
        return false;
      }
      if(pincode.trim()===''){
        alert("pincode should not be empty!");
        document.getElementById("pincode").focus();
        return false;
      }
      if(state.trim()===''){
        alert("state should not be empty!");
        document.getElementById("state").focus();
        return false;
      }
      if(country.trim()===''){
        alert("country should not be empty!");
        document.getElementById("country").focus();
        return false;
      }
      if(university.trim()===''){
        alert("university should not be empty!");
        document.getElementById("university").focus();
        return false;
      }
      if(course.trim()===''){
        alert("course should not be empty!");
        document.getElementById("course").focus();
        return false;
      }
      if(password.trim()===''){
        alert("password should not be empty!");
        document.getElementById("password").focus();
        return false;
     }
      //else if(!passwordpattern.test(password.trim())){
        //alert('password should be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number');
         //document.getElementById("password").focus();
        //return false;
    // }
      if(confirmpassword.trim()===''){
        alert("confirm password should not be empty!");
        document.getElementById("confirmpassword").focus();
        return false;
      }
      if(password.trim()!==confirmpassword.trim()){
        alert("password and confirm password should be same!");
        document.getElementById("confirmpassword").focus();
        return false;
      }
      return true;
    }
 
       function dbinsert(){
       if(!formsubmission()){
            return ;
        } 
        //alert("inside ajax");
         $.ajax({ 
               url: 'dbinsert.php',
               type:"POST", 
               datatype: 'html',
               data:$('#studentform').serialize(),
            success: function(data) {
              //console.log(data); 
              alert("Data inserted successfully"); 
              }});

         }

         function cleardetails() {
            document.getElementById("studentform").reset();
            document.getElementById("id").value = ""; // or null
            document.getElementById("name").focus();
         }
         function Displaydetails(){
           // alert("inside display");
             $.ajax({
             url: 'dbselect.php',
             type: 'POST',
             dataType: 'html',
            success: function(data) {
            // Insert only the table rows into the tbody
            $('#studentTable').html(data);
          }
         });
         // $(document).ready(function() {
           // Displaydetails();
           // });
     }
     function deleteRow(student_id) {

         $.ajax({
            url: 'dbitemdelete.php',
            type: 'POST',
            data: { id: student_id  },
            success: function(response) {
               // Refresh the table after deletion
               alert("Data deleted successfully");
               Displaydetails(); 
            },
            error: function(xhr, status, error) {
            console.error('Error deleting row:', error);
        }
    });
   }
  function updateRow(student_id) {
        //Fetch the row data using AJAX      
           //console.log(student_id);    
    $.ajax({
    url: 'select.php',
    type: 'POST',
    dataType: 'json',
    data: { id: student_id },
    success: function(data) {
        //console.log(data);
        document.getElementById("id").value = data['student_id'];
        document.getElementById("name").value = data['student_firstname'];
        document.getElementById("lastname").value = data['student_lastname'];
        document.getElementById("dob").value = data['dob'];
        document.getElementById("courseid").value =data['course_id'];
        document.getElementById("email").value = data['email'];
        document.getElementById("phone").value = data['phone'];
        if(data['gender']) {
            document.querySelector('input[name="gender"][value="' + data['gender'] + '"]').checked = true;
        }
        document.getElementById("address").value = data['address'];
        document.getElementById("City").value = data['city'];
        document.getElementById("pincode").value = data['pin'];
        document.getElementById("state").value = data['state'];
        document.getElementById("country").value = data['country'];
        document.getElementById("university").value = data['university'];
        document.getElementById("course").value = data['course'];
        document.getElementById("password").value = data['pass_wrd'];
        document.getElementById("confirmpassword").value = data['confirm_pass'];
    }
    });
   }
  function feedetails(sid) {
    //console.log(sid); 
    $.ajax({
        url: 'displayfeedetails.php',
        type: 'POST',
        dataType: 'html',
        data: { sid: sid },
        success: function(data) {
            //console.log(data);
                $('#studentfeetable').html(data);
        }
    });
}
function calculatefee(){
    var grandTotal = 0;
    var totalBalance = 0;
    var balance=0;
    const rowcount= document.getElementById("rowcount").value;
    for(var i=0;i<rowcount;i++)
    {
        var amount = parseFloat(document.getElementById("feeamount" + i).textContent) || 0;
        var total = document.getElementById("total"+i).value;
        total = parseFloat(total) || 0; // Ensure total is a number
        balance= amount - total;
        document.getElementById("total" + i).value = total;
        document.getElementById("balance" + i).value = balance;
        grandTotal += total;
        totalBalance += balance;
    }
    document.getElementById("gtotal").value = grandTotal;
    document.getElementById("gbalance").value = totalBalance;
}
function fillfeeamount()
{
   
   //var total=0;
  var payment = document.getElementById("payment").value;
  const rowcount= document.getElementById("rowcount").value;
  //console.log("Row count: " + rowcount);
  for(var i=0;i<rowcount;i++)
  {
    var amount = parseFloat(document.getElementById("feeamount" + i).textContent) || 0;
     var total = 0;
    var balance = 0;
  if (payment > amount) {
        total = amount;
        balance = 0;
        document.getElementById("total" + i).value = total;
        document.getElementById("balance" + i).value = balance;
        payment = payment - amount;
    }
    else if (payment <= amount && payment > 0) {
        total = payment;
        balance = amount - total;
        document.getElementById("total" + i).value = total;
        document.getElementById("balance" + i).value = balance;
        payment = 0;
    } 
    else if (payment <= 0) {
        total = 0;
        balance = amount;
        document.getElementById("total" + i).value = total;
        document.getElementById("balance" + i).value = balance;
    }

      //grandTotal += total;
      //totalBalance += balance;
   }
    //document.getElementById("gtotal").value = grandTotal;
    //document.getElementById("gbalance").value = totalBalance;
}
function insertfees(student_id){
    //console.log(student_id);
    let sid = document.getElementById("sid").value;
    if (!sid) {
        sid = student_id;
    }
    const dop = document.getElementById("dop").value;
    //const sid = document.getElementById("sid").value;
    const grandtotal=document.getElementById("gtotal").value;
    const grandbalance=document.getElementById("gbalance").value;
    const rowcount= document.getElementById("rowcount").value;
    // Declare the arrays before using them!
    var feeids = [];
    var balances = [];
    var totals=[];

    
    for (var i = 0; i < rowcount; i++) {
        feeids.push(document.getElementById("feeid" + i).textContent || document.getElementById("feeid" + i).value);
        balances.push(document.getElementById("balance" + i).value);
        totals.push(document.getElementById("total" + i).value);
    }

    //console.log(amount, dop, sid, grandtotal, grandbalance);
    $.ajax({
        url: 'feeinsert.php',
        type: 'POST',
        data: { dop: dop, sid: sid , grandtotal: grandtotal,randbalance: grandbalance , rowcount: rowcount,feeid: feeids,balance: balances,total:totals},
        success: function(response) {
           //console.log('Data to be sent:', { dop: dop, sid: sid, grandtotal: grandtotal, grandbalance: grandbalance , rowcount: rowcount,feeid: feeids,
           // balance: balances, });
            alert("Fee details inserted successfully");
            //feedetails(sid);
        },
        error: function(xhr, status, error) {
            console.error('Error inserting fee details:', error);
        }
    });
}
function getreceipt() {
   $.ajax({
             url: 'receiptdisplay.php',
             type: 'POST',
             dataType: 'html',
            success: function(data) {
            // Insert only the table rows into the tbody
            $('#feedetailsbody').html(data);
          }
         });
}
function deletefeeRow(header_id) {
        //console.log(header_id);
         $.ajax({
            url: 'deletereceiptdetails.php',
            type: 'POST',
            data: { id: header_id  },
            success: function(response) {
               // Refresh the table after deletion
               alert("Data deleted successfully");
               getreceipt();
            },
            error: function(xhr, status, error) {
            console.error('Error deleting row:', error);
        }
    });
   }

function updatefeeRow(header_id) {
        //Fetch the row data using AJAX      
           //console.log(header_id);    
    $.ajax({
    url: 'selectforupdatefeedetails.php',
    type: 'POST',
    dataType: 'html',
    data: { id: header_id },
    success: function(data) {
        console.log(data);
        $('#feedtailsupdate').html(data);
    }
    });
     
   }   
</script>
      
    
    
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <title>Student Registration Form</title>
  </head>
  <body>
    <div class="container mt-5">
      <main>
        <section>
          <h1 class="text-center text-center-custom">STUDENT REGISTRATION FORM</h1>
          <form  action="" method="post"  id="studentform" class="row g-3" novalidate>
           <input type="hidden" name="id" id="id"/>
           <div class="col-md-6">
              <label for="firstname"  class="form-label">First Name:</label>
              <input
                type="text"
                class="form-control form-control-lg"
                name="name"
                placeholder="Enter first name"
                id="name"
                required
              />
            </div>

            <div class="col-md-6">
              <label for="lastname" class="form-label">Last Name:</label>
              <input
                type="text"
                class="form-control form-control-lg"
                name="lastname"
                placeholder="Enter last name"
                id="lastname"
                required
              />
            </div>
             <div class="col-6">
              <label for="dob" class="form-label">Date of Birth:</label>
              <input
                type="date"
                class="form-control form-control-lg"
                name="dob"
                id="dob"
                required
              />
            </div>
            <div class="col-md-6">
              <label for="courseid" class="form-label">Course-ID</label>
              <select class="form-select" aria-label="Default select example" name="courseid" id="courseid" required  >
                <option value="">Select course-id</option>
                <option value="1">BSC Computer science-1</option>
                <option value="2">BCA-2</option>
                <option value="3">MCA-3</option>
                <option value="4">BTEC-4</option>
                <option value="5">MTEC-5</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Email:</label>
              <input
                type="email"
                class="form-control form-control-lg"
                name="email"
                placeholder="Enter email "
                id="email"
             
              />
            </div>
           <div class="col-md-6">
              <label for="phone" class="form-label">Phone number:</label>
              <input
                type="tel"
                class="form-control form-control-lg"
                id="phone"
                name="phone"
                placeholder="phonenumber"
                required
              />
            </div>
           <div class="col-md-6">
              <label class="form-label">Gender:</label>
              <div class="form-check">
                <input
                  type="radio"
                  class="form-check-input"
                  name="gender"
                  id="female"
                  value="female"
                  required
                />
                <label for="female" class="form-check-label">Female</label>
              </div>
              <div class="form-check">
                <input
                  type="radio"
                  class="form-check-input"
                  name="gender"
                  id="male"
                  value="male"
                  required
                />
                <label for="male" class="form-check-label">Male</label>
              </div>
            </div>
           <div class="col-md-6">
              <label for="address" class="form-label">Address</label>
              <textarea
                name="address"
                class="form-control form-control-lg"
                placeholder="Enter your adress"
                id="address"
                rows="3"
                cols="2" 
                required
              ></textarea>
            </div>
             <div class="col-md-6">
              <label for="City" class="form-label">City:</label>
              <input
                type="text"
                class="form-control form-control-lg"
                name="City"
                placeholder="Enter city"
                id="City"
                required
              />
            </div>
            <div class="col-md-4">
              <label for="state" class="form-label">State:</label>
              <input
                type="text"
                class="form-control form-control-lg"
                name="state"
                placeholder="Enter state"
                id="state"
                required
              />
            </div>
             <div class="col-md-6">
              <label for="country" class="form-label">Country:</label>
              <input
                type="text"
                class="form-control form-control-lg"
                name="country"
                placeholder="Enter Country"
                id="country"
              
                required
              />
            </div>
             <div class="col-md-4">
              <label for="pincode" class="form-label">Pincode:</label>
              <input
                type="tel"
                class="form-control form-control-lg"
                id="pincode"
                name="pincode"
                placeholder="pincode" 
                
                required
              />
            </div>
            <div class="col-md-6">
              <label for="university" class="form-label">University:</label>
              <input
                type="text"
                class="form-control form-control-lg"
                name="university"
                placeholder="Enter university"
                id="university"
               
                required
              />
            </div>
          <div class="col-md-6">
              <label for="course" class="form-label">Course</label>
              <select class="form-select" aria-label="Default select example" name="course" id="course"  required>
                <option value="" selected>Select course</option>
                <option value="bsc">BSC Computer science</option>
                <option value="bca">BCA</option>
                <option value="mca">MCA</option>
                <option value="btec">BTEC</option>
                <option value="mtec">MTEC</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="password" class="form-label"
                >Enter your password:</label
              >
              <input
                type="password"
                class="form-control form-control-lg"
                name="password"
                id="password"
                required
              />
            </div>
           <div class="col-md-6">
              <label for="confirmpassword" class="form-label"
                >Confirm your password:</label
              >
              <input
                type="password"
                class="form-control form-control-lg"
                name="confirmpassword"
                id="confirmpassword"
                required
              />
            </div>
            <div class="col-12">
              <button type="button" onclick="dbinsert()" name="register" class="btn btn-primary" id="register">Register</button>
              <button type="button" onclick="cleardetails()" class="btn btn-secondary" name="clear"  id="clear" >Clear</button>
               <button type="button" class="btn btn-danger" onclick="Displaydetails()" name="display"  id="display" >DISPLAY DETAILS</button>
               <button type="button" class="btn btn-danger" onclick="getreceipt()" name="treceipt"  id="receipt" >DISPLAY FEE DETAILS</button>
             </div>
          </form>
        </section> 
        <section>
          <div>
            <h3>Course Fee Portal:</h3>
                   <div class="col-md-2">
                   <label for="confirmpassword" class="form-label">Enter student_id:</label>
                   <input
                       type="text"
                       class="form-control form-control-lg"
                       name="sid"
                       id="sid"
                       required
                    />
                    </div>
                    <div class="col-md-2">
                    <button type="button" class="btn btn-primary" onclick="feedetails(document.getElementById('sid').value)" name="getfee" id="getfee">Get Fee Details</button>
                    </div>  
                    <table id="studentTable">
                    <table id="feedetailsbody">
                    <table id="feedtailsupdate"> 
                    <table id="studentfeetable" border="none" >
                    <table border="1" id="feetable">
           </div> 
        </section> 
      </main>
    </div>
     
        
      <script src="/bootstrap.bundle.min.js"></script>
  </body>
</html>
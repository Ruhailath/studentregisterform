<html>
    <head>
    <style>
   #studentfeetable, 
   #studentfeetable th, 
   #studentfeetable td {
    border: none !important;
    box-shadow: none !important;
    background: none !important;
    background-color: transparent !important;
    text-align: left;
}
</head>
</style>
</html>
<?php
 //header('Content-Type: application/json');
 include 'dbconnection.php';
   $id = $_POST['sid'] ?? '';
    if (empty($id)) {
        echo json_encode(["error" => "ID is required"]);
        exit;
    }
 $sql ="select student_firstname,email,student_id,course_id,course from student_register where student_id=$id";  
 $result = $conn->query($sql);
if ($result->num_rows > 0) {
     $row = $result->fetch_assoc();
    echo '<table border="none" id="studentfeetable" >
    <tbody id="feedetailsbody">';
    echo  '<tr>';
    echo   '<td>Student ID:'.$row["student_id"].'</td><br/>';
    echo   '</tr>'; 
    echo  '<tr>';
    echo   '<td>Student Name:'.$row["student_firstname"].'</td><br/>';
    echo   '</tr>'; 
    echo  '<tr>';
    echo   '<td>Email:'.$row["email"].'</td><br/>';
    echo   '</tr>'; 
    echo  '<tr>';
    echo   '<td>Course-ID:'.$row["course_id"].'</td><br/>';
    echo   '</tr>'; 
    echo  '<tr>';
    echo   '<td>Course name:'.$row["course"].'</td><br/>';
    echo   '</tr>'; 
    echo  '<tr>';
    echo '<h2 class="form-label">Payment:</h2>';
    echo '<input type="text" id="payment" name="payment"  placeholder="Enter Amount" onblur="fillfeeamount()"   class="form-control form-control-lg" required/><br>';
    echo '<input type="date" id="dop" name="dop"  placeholder="Enter Amount" class="form-control form-control-lg" required/><br>';
    echo  '</tr>';
    echo '</tbody>';
    echo '</table>';
   }


    $sql2="SELECT * from fee INNER JOIN course ON fee.c_id=course.course_id INNER JOIN student_register ON student_register.course_id=course.course_id WHERE student_id=$id";
 //echo json_encode($row);
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        echo '<h3>fee stucture</h3>';
        echo '<table border="1" id="feetable"><tbody id="feedetailsbody"><tr><th>Fee Name</th><th>Amount</th><th>Total</th><th>Balance</th></tr>';
        $i=0;
    while($row1 = $result2->fetch_assoc()){
        //print_r($row1);
      
     echo  '<tr>';
     echo '<td style="display: none;" id="feeid' . $i . '">' . $row1["fee_id"] . '</td>';
     echo  '<td id="feename' . $i . '">' . $row1["fee_name"] . "</td>";
     echo  '<td id="feeamount' . $i . '">'. $row1["Amout"] . "</td>";
     echo  '<td ><input type="text" id="total' . $i . '" name="total" onfocus="calculatefee()" oninput="calculatefee()"  placeholder="0" /></td>';
     echo  '<td ><input type="text" id="balance' . $i . '" name="balance"  placeholder="0" readonly/></td>'; 
     echo  '</tr>';
        $i++;
    }
     echo '<tr>';
     echo  '<td><input type="hidden" id="rowcount"  value="' . $i . '"    name="balance"  placeholder="0" readonly/></td>';
     echo '<td>Grand total</td>';
     echo '<td><input type="text" id="gtotal" name="gtotal"  placeholder="0"/></td>';
     echo '<td><input type="text" id="gbalance" name="gbalance"  placeholder="0"  readonly/></td>'; 
     echo '</tr>';
     echo '<tr><td><button type="button" class="btn btn-primary" onclick="insertfees('.$id.')" id="Payfee" name="payfee">Pay Fee</button></td></tr>';
     echo '</table>';
    
}
$conn->close();

?>

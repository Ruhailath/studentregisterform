<html>
    <head>
    <style>
   #feedtailsupdate, 
   #feedtailsupdate th, 
   #feedtailsupdate td {
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
   $headerid = $_POST['id'] ?? '';
  
    $sql="select receipt_no,receipt_date from receipt_header where header_id=$headerid";
    $headerid_result = $conn->query($sql);
    if ($headerid_result->num_rows > 0) {
        $headerid_row = $headerid_result->fetch_assoc();
         echo '<table  id="feedtailsupdate"> 
          <tbody>';
          echo '<h2 class="form-label">Upadate Receipt:</h2>';
          echo  '<tr>';
          echo  '<td style="font-weight: bold;">';
          echo ' Receipt Number: ' . $headerid_row["receipt_no"] . '</td>';
          echo '<input type="date" id="dop" name="dop" value="'.$headerid_row["receipt_date"].'" placeholder="Enter Amount" class="form-control form-control-lg" required/><br>';
          echo  '</td>';
          echo  '</tr>';
          echo '</tbody>';
          echo '</table>';
    }
  
    $sid_result = $conn->query("SELECT student_id from receipt_header where header_id=$headerid");
    $sid_row= $sid_result->fetch_assoc();
    $sid = $sid_row['student_id'];

    $sql1 = "select total_amount from receipt_details where header_id=$headerid";
    $result1 = $conn->query($sql1);
   
  
    $sql2="SELECT * from fee INNER JOIN course ON fee.c_id=course.course_id INNER JOIN student_register ON student_register.course_id=course.course_id WHERE student_id=$sid";
 //echo json_encode($row);
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        echo '<h3>fee stucture</h3>';
        echo '<table border="1" id="feetable"><tbody id="feedetailsbody"><tr><th>Fee Name</th><th>Amount</th><th>Total</th><th>Balance</th></tr>';
        $i=0;
    while(($row2 = $result2->fetch_assoc()) && ($row1 = $result1->fetch_assoc())) {
        //print_r($row1);
      
     echo  '<tr>';
     echo '<td style="display: none;" id="feeid' . $i . '">' . $row2["fee_id"] . '</td>';
     echo  '<td id="feename' . $i . '">' . $row2["fee_name"] . "</td>";
     echo  '<td id="feeamount' . $i . '">'. $row2["Amout"] . "</td>";
     echo  '<td ><input type="text" id="total' . $i . '"  value="'.$row1['total_amount'].'"   name="total"  onfocus="calculatefee()" oninput="calculatefee()" placeholder="0" /></td>';
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
     echo '<tr><td><button type="button" class="btn btn-primary" onclick="insertfees('.$sid.')" id="Payfee" name="payfee">Pay Fee</button></td></tr>';
     echo '</table>';
    
}
$conn->close();

?>
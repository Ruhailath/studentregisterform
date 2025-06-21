<?php
   include 'dbconnection.php';
              $receiptdate= $_POST["dop"] ?? '';
              $sid = $_POST["sid"] ?? '';
              $grandtotal = $_POST["grandtotal"] ?? '';
              $grandbalance = $_POST["grandbalance"] ?? '';
              $rowcount= $_POST["rowcount"] ?? '';
              $feeids = $_POST['feeid'];      // array
              $balances = $_POST['balance'];  // array
              $totals=$_POST['total'];
             
             
              $result = $conn->query("SELECT MAX(serial_no) AS max_id FROM receipt_header"); 
              $row = $result->fetch_assoc();
              $serialno = ($row['max_id'] ?? 0) + 1;

              // Extract year from receipt date chech if receipt date is not empty
              // If receipt date is empty, set year to empty string
              $year = '';
              if (!empty($receiptdate)) {
                 $year = date('Y', strtotime($receiptdate));
              }
              // Generate receipt number
              $receiptno = 'REG' . $serialno . $year;

              $sql= "INSERT INTO receipt_header(receipt_no,total,student_id,receipt_date,serial_no) 
                      VALUES ('$receiptno', '$grandtotal', '$sid', '$receiptdate', '$serialno')";

      
                if ($conn->query($sql) === TRUE) {
                    $headerid_result = $conn->query("SELECT header_id from receipt_header where student_id=$sid");
                    $headerid_row = $headerid_result->fetch_assoc();
                     $headerid = $headerid_row['header_id'];
                     for ($i = 0; $i < count($feeids); $i++) {
                              $feeid = $feeids[$i];
                              $balance = $balances[$i];
                              $total=$totals[$i];
                              $sql_detail = "INSERT INTO receipt_details (total_amount,balance, header_id,fee_id)
                                 VALUES ('$total','$balance','$headerid', '$feeid')";
                                $conn->query($sql_detail);
                        }  
                         echo "New record created successfully";
                    }
                
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            
              
              
   $conn->close(); 
 ?>              
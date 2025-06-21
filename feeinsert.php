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
              //check student id is already exists in receipt_header
               $check_result = $conn->query("SELECT COUNT(*) as count FROM receipt_header WHERE student_id = '$sid'");
               $check_row= $check_result->fetch_assoc();
               $check_sid = $check_row['count'];
           if ($check_sid==1) {
                // If student id exists, update the existing record
                $sql = "UPDATE receipt_header SET receipt_no='$receiptno', total='$grandtotal', receipt_date='$receiptdate', serial_no='$serialno' WHERE student_id='$sid'";
                if ($conn->query($sql) === TRUE) {
                    $headerid_result = $conn->query("SELECT header_id from receipt_header where student_id=$sid");
                    $headerid_row = $headerid_result->fetch_assoc();
                    $headerid = $headerid_row['header_id'];
                    for ($i = 0; $i < count($feeids); $i++) {
                        $feeid = $feeids[$i];
                        $balance = $balances[$i];
                        $total = $totals[$i];
                        $sql_detail = "UPDATE receipt_details SET total_amount='$total', balance='$balance' WHERE header_id='$headerid' AND fee_id='$feeid'";
                        $conn->query($sql_detail);
                    }
                    echo "Record updated successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

           }
            else{  
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
            }
              
              
   $conn->close(); 
 ?>              
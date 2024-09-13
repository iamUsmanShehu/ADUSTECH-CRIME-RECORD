<?php

include "includes/connection.php";
$close_case_id = $_GET["close_id"];
$case_id = $_GET["case_id"];

if ($close_case_id ==  0) {
    $sql = "UPDATE `cases` SET `status`='1'WHERE id = $case_id";
    $stmt = mysqli_prepare($db, $sql);
  }
  if ($close_case_id ==  1) {
    $sql = "UPDATE `cases` SET `status`='0'WHERE id = $case_id";
    $stmt = mysqli_prepare($db, $sql);
}


  if ($stmt) {
      if (mysqli_stmt_execute($stmt)) {
          echo "<script> 
                  alert('Status updated successfully!')
                  window.location = 'http://localhost/Crime%20record/view.php?case_id=$case_id';
                </script>";
          
      } else {
         echo "<script> alert('Error updating status: ')</script>". mysqli_error($db);
      }

      mysqli_stmt_close($stmt);
  } else {
    echo "<script> alert('Error in preparing the statement: ')</script>" . mysqli_error($db);
  }

?>
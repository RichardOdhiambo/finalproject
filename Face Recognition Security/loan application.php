<!DOCTYPE html>
<html>



<?php include('includes/header.php') ?>

<?php 

$loantype = $_POST['loantype'];
$amount = $_POST['amount'];
$months = $_POST['months'];

include('includes/config.php');

 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 session_start();
$userid = $_SESSION['userid'];



if($loantype=="Emergency"){
$payamount=$amount*5 * $months;
}else if($loantype=="Short"){
$payamount=$amount*1.2 * $months;
}else if($loantype=="Medium"){
$payamount=$amount*1.2 * $months;
}else{
$payamount=$amount*1.2 * $months;
}

$sql1 = "INSERT INTO loan(member_id,loan_type,amount,payable_amount) VALUES('$userid','$loantype','$amount','$payamount')";

if ($link1->query($sql1) === TRUE) {


  $sql = "INSERT INTO transactions_table(member_id,type_of_transaction,transaction_description, transaction_amount) VALUES('$userid','loan','$loantype' ,'$amount')";

if ($link->query($sql) === TRUE) {
  echo "";
} else {
  echo "Error: " . $sql . "<br>" . $link->error;
}

$link->close();
} else {
  /*echo "Error: " . $sql1 . "<br>" . $link1->error;*/
  echo"Please pay your outstanding loan first";
}

$link1->close();

?>

<?php
include('includes/footer.php')
  ?>
</body>
</html>
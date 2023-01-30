<!DOCTYPE html>
<html>



<?php include('includes/header.php') ?>

<?php 

$id = $_POST['member_number'];
$pass = $_POST['Password'];
$account = $_POST['Account'];
$amount = $_POST['amount'];

include('includes/config.php');


session_start();
$userid = $_SESSION['userid'];
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$sql1 = "UPDATE accounts_table SET  amount = amount+ '$amount' WHERE account_number = '$account' and member_no= '$id' ";
if ($link1->query($sql1) === TRUE) {
  echo "<center> $amount has been succesfully added to account $account</center>";
} else {
  echo "Error: " . $sql1 . "<br>" . $link1->error;
}

$link1->close();


$sql3 = "INSERT INTO transactions_table(member_id,type_of_transaction,transaction_description, transaction_amount,staff_id) VALUES('$id','Deposit','$amount has been deposited' ,'$amount','$userid')";
if ($link3->query($sql3) === TRUE) {

} else {
  echo "Error: " . $sql3 . "<br>" . $link3->error;
}

$link3->close();



   

mysqli_close($link);
?>

<?php
include('includes/footer.php')
  ?>
</body>
</html>
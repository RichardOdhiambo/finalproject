<!DOCTYPE html>
<html>



<?php include('includes/header.php') ?>

<?php 

$id = $_POST['code'];
$pass = $_POST['phone'];
$account = $_POST['account'];

include('includes/config.php');
session_start();
$userid = $_SESSION['userid'];
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$sql = "SELECT  transaction_id, amount, phone_number, redeemed FROM mpesa_transactions WHERE transaction_id= '$id' AND phone_number='$pass'  ";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_array($result)){

            $amount= $row['amount'];
            $phone_number= $row['phone_number'];
            $redeemed= $row['redeemed'];

        }
 mysqli_free_result($result);
        if ($redeemed == "no" ) {
$sql1 = "UPDATE accounts_table SET  amount = amount+ '$amount' WHERE account_number = '$account' and member_no= '$userid' ";
if ($link1->query($sql1) === TRUE) {
  echo "<center> $amount has been succesfully added to account $account</center>";
} else {
  echo "Error: " . $sql1 . "<br>" . $link1->error;
}

$link1->close();


$sql2 = "UPDATE mpesa_transactions SET  redeemed = 'yes'   WHERE transaction_id = '$id'";
if ($link2->query($sql2) === TRUE) {

} else {
  echo "Error: " . $sql2 . "<br>" . $link2->error;
}

$link2->close();

$sql3 = "INSERT INTO transactions_table(member_id,type_of_transaction,transaction_description, transaction_amount) VALUES('$userid','Deposit','$amount has been deposited' ,'$amount')";
if ($link3->query($sql3) === TRUE) {

} else {
  echo "Error: " . $sql3 . "<br>" . $link3->error;
}

$link3->close();



    } else{
        echo "This Transaction code has been redeemed";
    }
} else{
    echo "Please check the Transaction Code or Phone number then try again";
}
}

mysqli_close($link);
?>

<?php
include('includes/footer.php')
  ?>
</body>
</html>
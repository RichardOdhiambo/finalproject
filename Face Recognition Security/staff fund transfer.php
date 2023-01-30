<!DOCTYPE html>
<html>



<?php include('includes/header.php') ?>

<?php 

$id=$_POST['id'];
$sendersaccount=$_POST['sending_account'];
$receiversaccount = $_POST['account'];
$setamount = $_POST['amount'];

include('includes/config.php');
session_start();
$userid = $_SESSION['userid'];
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$sql = "SELECT  account_number, member_no, amount FROM accounts_table WHERE member_no= '$id' AND account_number='$sendersaccount' ";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_array($result)){

            $amount= $row['amount'];

        }
 mysqli_free_result($result);
        if ($setamount <=  $amount ) {
$sql1 = "UPDATE accounts_table SET  amount = amount - '$setamount'  WHERE member_no = '$id' AND account_number='$sendersaccount' ";
if ($link1->query($sql1) === TRUE) {

} else {
  echo "Error: " . $sql1 . "<br>" . $link1->error;
}

$link1->close();


$sql2 = "UPDATE accounts_table SET  amount = amount + '$setamount'   WHERE account_number = '$receiversaccount'";
if ($link2->query($sql2) === TRUE) {
echo "$setamount has been sent to account $receiversaccount";
} else {
  echo "Error: " . $sql2 . "<br>" . $link2->error;
}

$link2->close();

$sql3 = "INSERT INTO transactions_table(member_id,type_of_transaction,transaction_description, transaction_amount,staff_id,account_no) VALUES('$id','fund transfer','$setamount sent to $receiversaccount' ,'$setamount','$userid','$sendersaccount')";
if ($link3->query($sql3) === TRUE) {

} else {
  echo "Error: " . $sql3 . "<br>" . $link3->error;
}

$link3->close();



    } else{
        echo "Please check your balance";
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
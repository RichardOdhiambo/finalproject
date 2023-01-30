<!DOCTYPE html>
<html>



<?php include('includes/registeredheader.php') ?>

<?php 

$setamount = $_POST['amount'];
$phone = $_POST['phone'];

include('includes/config.php');
session_start();
$userid = $_SESSION['userid'];
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$sql = "SELECT  account_number, member_no, amount FROM accounts_table WHERE member_no= '$userid'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_array($result)){

            $amount= $row['amount'];

        }
 mysqli_free_result($result);
        if ($setamount<= $amount  ) {
$sql1 = "UPDATE accounts_table SET  amount = amount- '$setamount' WHERE member_no= '$userid' ";
if ($link1->query($sql1) === TRUE) {
  echo "$setamount amount has been widthdrawn";
} else {
  echo "Error: " . $sql1 . "<br>" . $link1->error;
}

$link1->close();


$sql3 = "INSERT INTO transactions_table(member_id,type_of_transaction,transaction_description, transaction_amount) VALUES('$userid','Withdraw','$setamount was withdrawn' ,'$setamount')";
if ($link3->query($sql3) === TRUE) {

} else {
  echo "Error: " . $sql3 . "<br>" . $link3->error;
}

$link3->close();



    } else{
        echo "wrong password";
    }
} else{
    echo "Please check the Transaction Code or Phone number then try again";
}
}

mysqli_close($link);
?>

<?php
include('includes/footer.php');
  ?>
</body>
</html>
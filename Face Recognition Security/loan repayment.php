<!DOCTYPE html>
<html>



<?php include('includes/header.php') ?>

<?php 

$setamount = $_POST['amount'];

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
        if ($setamount <=  $amount ) {
$sql1 = "UPDATE accounts_table SET  amount = amount - '$setamount'  WHERE member_no = '$userid' ";
if ($link1->query($sql1) === TRUE) {

} else {
  echo "Error: " . $sql1 . "<br>" . $link1->error;
}

$link1->close();


$sql2 = "UPDATE loan SET  payable_amount = payable_amount-'$setamount'   WHERE member_id = '$userid'";
if ($link2->query($sql2) === TRUE) {

} else {
  echo "Error: " . $sql2 . "<br>" . $link2->error;
}

$link2->close();



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
include('includes/footer.php')
  ?>
</body>
</html>
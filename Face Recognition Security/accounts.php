<!DOCTYPE html>
<html>



<?php include('includes/header.php') ?>

<?php 

$member_number = $_POST['member_number'];
$id_number = $_POST['id_number'];
$f_name = $_POST['f_name'];
$surname = $_POST['surname'];
$l_name = $_POST['l_name'];
$phone = $_POST['phone_number'];
$address = $_POST['address'];
$resident_location = $_POST['resident_location'];
$username = $_POST['username'];
$password = $_POST['password'];
$new_account = $_POST['account'];
$amount = $_POST['amount'];

$staff = "Peter";
$staff_id = "1";


include('includes/config.php');
session_start();
$userid = $_SESSION['userid'];
 
   $hash = password_hash($password, PASSWORD_DEFAULT);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$sql = "INSERT INTO members_table(member_no,id_number,first_name, surname,last_name,phone_number,address,resident_location,username,password) VALUES('$member_number','$id_number','$f_name' ,'$surname','$l_name','$phone','$address','$resident_location','$username','$hash')";
if ($link->query($sql) === TRUE) {

} else {
  echo "Error: " . $sql . "<br>" . $link->error;
}

$link->close();

$sql1 = "INSERT INTO accounts_table(account_number,member_no,amount)VALUES('$new_account','$member_number','$amount')";
if ($link1->query($sql1) === TRUE) {
echo "You have successfuly registered the member";
} else {
  echo "Error: " . $sql1 . "<br>" . $link1->error;
}

$link1->close();

$sql2 = "INSERT INTO transactions_table(staff_id,type_of_transaction,transaction_description, transaction_amount) VALUES('$staff_id','Account','Created Account for $member_number ' ,'$amount')";
if ($link2->query($sql2) === TRUE) {

} else {
  echo "Error: " . $sql2 . "<br>" . $link2->error;
}

$link2->close();
?>

<?php
include('includes/footer.php')
  ?>
</body>
</html>
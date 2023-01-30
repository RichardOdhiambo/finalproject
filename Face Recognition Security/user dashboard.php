<?php session_start();
$userid = $_SESSION['userid']; 

include('includes/registeredheader.php')

?>


<?php 
include_once('retrieve_details.php');
$details=getdetails($userid);
$amount=getamount($userid);
$loans=getloans($userid);

include('includes/footer.php');

?>

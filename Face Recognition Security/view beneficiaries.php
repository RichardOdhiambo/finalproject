<!DOCTYPE html>
<html>

<?php 


include('includes/config.php');
session_start();
$userid = $_SESSION['userid'];
include('includes/registeredheader.php');
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$sql = "SELECT  beneficiary_no, father_id, mother_id, first_name,surname,last_name,amount FROM beneficiaries WHERE father_id= '$userid' OR mother_id= '$userid'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
echo "<table width=100% style=table-layout:fixed;>";
echo "      <tr>
        <th>
            First Name
        </th>

        <th>
           Surname
        </th>
                <th>
            Last Name
        </th>

        <th>
           Amount
        </th>
        </tr>";
        while($row = mysqli_fetch_array($result)){

            $first_name= $row['first_name'];
            $surname= $row['surname'];
            $last_name= $row['last_name'];
            $amount= $row['amount'];
echo "      <tr>
        <th>
            $first_name
        </th>

        <th>
           $surname
        </th>
                <th>
            $last_name
        </th>

        <th>
           $amount
        </th>
        </tr>";

            

        }
        echo "</table>";
 mysqli_free_result($result);

} else{
    echo "You Currently dont have any beneficiaries under your account";
}
}

mysqli_close($link);
?>

<?php
include('includes/footer.php')
  ?>
</body>
</html>
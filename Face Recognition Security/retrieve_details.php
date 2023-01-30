<?php 


include('includes/config.php');

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
 function getdetails($userid){
    include('includes/config.php');
    $sql = "SELECT  member_no,first_name, surname, last_name, phone_number,username FROM members_table WHERE member_no= '$userid'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_array($result)){

            $first_name= $row['first_name'];
            $surname= $row['surname'];
            $last_name= $row['last_name'];

echo "<center>Names:   $first_name $surname $last_name</center>";
echo "<p>";

        }
 mysqli_free_result($result);

} else{
    echo "You Currently dont have an account";
}
}

mysqli_close($link);

 }




function getamount($userid){
    include('includes/config.php');
 $sql1 = "SELECT  account_number,member_no, amount FROM accounts_table WHERE member_no= '$userid'";
if($result1 = mysqli_query($link1, $sql1)){
    if(mysqli_num_rows($result1) > 0){
echo "<table width=100% style=table-layout:fixed;>";
echo "      <tr>
        <th>
            Account Numbers
        </th>

        <th>
           Amount
        </th>
              
        </tr>";
        while($row = mysqli_fetch_array($result1)){

            $account_number= $row['account_number'];
            $amount= $row['amount'];

            echo "      <tr>
        <th>
            $account_number
        </th>

        <th>
           $amount
        </th>
        </tr>";

        }
        echo "</table>";
 mysqli_free_result($result1);

} else{
    echo "You Currently dont have any Accounts";
}
}

mysqli_close($link1);   
}



function getloans($userid){
    include('includes/config.php');
   $sql2 = "SELECT loan_id,account_number, member_id, loan_type, loan_description,payable_amount,granted FROM loan WHERE member_id= '$userid' AND granted='yes' ";
if($result2 = mysqli_query($link2, $sql2)){
    if(mysqli_num_rows($result2) > 0){
echo "<table width=100% style=table-layout:fixed;>";
echo "      <tr>
        <th>
            Account
        </th>

        <th>
           Loan Type
        </th>
                <th>
            Loan Description
        </th>

        <th>
           Payable Amount
        </th>

                <th>
           Status
        </th>
        </tr>";
        while($row = mysqli_fetch_array($result2)){

            $account_number_loan= $row['account_number'];
            $loan_type= $row['loan_type'];
            $loan_description= $row['loan_description'];
            $payable_amount= $row['payable_amount'];
            $granted= $row['granted'];

            echo "      <tr>
        <th>
            $account_number_loan
        </th>

        <th>
            $loan_type
        </th>
                <th>
           $loan_description
        </th>

        <th>
           $payable_amount
        </th>

                <th>
           $granted
        </th>
        </tr>";

        }
        echo "</table>";
 mysqli_free_result($result2);

} else{
    echo "<center> You Currently dont have pending or approved loans<center>";
}
}

mysqli_close($link2); 
}






?>


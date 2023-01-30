<!DOCTYPE html>
<html>



<?php include('includes/header.php') ?>

<?php 

$id = $_POST['id'];
$pass = $_POST['pass'];

include('includes/config.php');

 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$sql = "SELECT  member_no, password, first_name, last_name,username  FROM members_table WHERE member_no= '$id' ";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_array($result)){

            $userpassword= $row['password'];
            $fname= $row['username'];
            $sname= $row['last_name'];

        }
        echo "</table>";
 mysqli_free_result($result);
$verify = password_verify($pass, $userpassword);

        if ($verify) {
            session_start();
$_SESSION['userid'] = $_POST['id'];
$_SESSION['username'] = $fname;

echo "
            <!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body align= center>
 <form name = passvalue1 action= detection.php method = post>    
            <div class = container>      
                <div class = form_group> 
                Welcome  <p>
                   $fname
                                          
                    <p hidden > <input name = fname value = $fname> </p>   
                </div>    
                   
                <button type = 'submit' value = 'submit'>Proceed to face detection</button> 
            </div>    
        </form>    


</body>
</html>";

    } else{
        echo "wrong password";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
}

mysqli_close($link);
?>

<?php
include('includes/footer.php')
  ?>
</body>
</html>
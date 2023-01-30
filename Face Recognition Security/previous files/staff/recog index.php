<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script defer src="js/recog face-api.min.js"></script>
  <?php session_start();$username = $_SESSION['username'];?>
  <?php echo "heelo $username "; ?>
  <script id="helper" data-name="<?php echo"$username"?>" defer src="staff/js/recog script.js"></script>
  
  <title>Face Recognition</title>
  <style>

.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-right: 16px solid green;
  border-bottom: 16px solid red;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

  </style>

</head>
<body>
  <?php include('includes/header.php') ?>

  <center>
<div class="loader" id="loadingdiv"></div><p><br>
<img id="imgPreview" src=""><p><br>
<button type="button" id="verify" disabled="">Click here to verify</button><p><br>
  </center>
<script type="text/javascript">
  document.addEventListener("DOMContentLoaded",() => {
const image= localStorage.getItem("photo");
document.querySelector("#imgPreview").setAttribute("src",image)

})
</script>
<p id="demo"></p>
<?php include('includes/footer.php') ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Face Detection</title>
  <script defer src="js/face-api.min.js"></script>
  <script defer src="js/staff script.js" ></script>

  <!-- <style src="css/webcam view.css"></style> -->
</head>
<body>
  <table width="100%">
    <tr>
      <td>
        <?php include('includes/header.php') ?>
      </td>
    </tr>
  <tr>
    <td>
      <video id="video" width="100%" height="560" autoplay muted></video>
    </td>
  </tr>

  <tr>
    <td>
<?php 
$fname = $_POST['fname'];
/*echo  $fname; */
?> 
<script type="text/javascript">
        var x = "<?php echo"$fname"?>";
        /*document.write(x);*/
        localStorage.setItem("membername", x);
    </script>
    </td>
  </tr>

  <tr>
    <td>
      <p id="demo"></p>
  <?php include('includes/footer.php') ?>
    </td>
  </tr>
</table>

</body>
</html>
<?php 

if (!empty($_GET['returnMsg']))
  $ErrorMsg = $_GET['returnMsg'] ;
else
  $ErrorMsg = "" ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- fontawesome -->
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <!-- Custome CSS style -->
  <link rel="stylesheet" href="css/styles.css">
  
  

  <title>::Jan Station</title>
</head>
<body >

<div class="main">
  <div class="container">

    <center>
      <div class="errorMsg"><?php echo @$ErrorMsg; ?></div>
      <div class="middle">
        <div id="login">
          
          <form action="script/Login.php" method="POST" autocomplete="off">
            <fieldset class="clearfix">
            <p ><span class="fa fa-user"></span><input type="text" name="username" id="ID" Placeholder="ID" required maxlength="10"></p>
            <p><span class="fa fa-lock"></span><input type="password" name="password"  id="password" Placeholder="Password" required maxlength="10"></p>
            
            <div>
              <span class="pull-right" style="width:50%; text-align:right;  display: inline-block;"><input type="submit" name="submit" value="Enter"></span>
            </div>

            </fieldset>
          
            <div class="clearfix"></div>
          </form>

          <div class="clearfix"></div>

        </div> <!-- end login -->
      
        <div class="logo" style="margin-bottom: -20px;">
          <img src="images/Jan.png" style="padding-left: 10px; margin-top: -32px;">   
          <div class="clearfix"></div>
        </div>
      
      </div>
    </center>
  </div>
</div>






<!-- jQuery library -->
  <script src="js/jquery-2.1.4.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  <!-- Custome JScript File -->
  <script src="js/script.js"></script>
  <script>
    $(document).ready(function(){

    $("#ID").val("ID");
    $("#password").val("Password");

    $("#ID").click(function(){
        if ($("#ID").val() == "ID"){
          $("#ID").val("");
        }
    });

    $("#password").click(function(){
        if ($("#password").val() == "Password"){
          $("#password").val("");
        }
    });

});
  </script>
</body>
</html>
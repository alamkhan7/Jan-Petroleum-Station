<?php 

require_once dirname(__FILE__)."/script/get_customer_info.php";
require_once dirname(__FILE__)."/script/function_inc.php";

if (!loggedin()){
  header("Location: ./login_page.php");
  exit();
}

if (!empty($_GET['returnMsg']))
  $ErrorMsg = $_GET['returnMsg'] ;
else
  $ErrorMsg = "" ;

if (!empty($_GET['Label']))
  $color = $_GET['Label'];
else
  $color = "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "./header.php"; ?>
</head>

<body style="background-color:#222222">

<?php require_once "./navbar.php"; ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-offset-5 col-md-4 text-center">
      <span style="color: <?php echo $color ?>; font-weight: bold; float: left; margin-top: 30px;"><?php echo $ErrorMsg ?></span>
    </div>
    

    <div class="col-md-offset-1 col-md-5" style="margin-left: 410px; margin-top: 20px;">
      <br><br>
      <form class="form-horizontal" action="./script/meter_state.php" method="POST" autocomplete="off">
        <div class="panel panel-default">
          <div class="panel-heading">Update Meter Status <span class="pull-right">Today Date: <?php echo date("d/m/Y"); ?></span></div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-hover">
              <tbody>
                <tr>
                  <td style="border-top: 0;">1</td>
                  <td style="border-top: 0;"><b>Diesel(HSD)</b></td>
                  <td style="border-top: 0;"><input class="form-control" type="number" id="HSD" name="HSD" value="<?php echo $remainHSD ?>" placeholder="00.00" min="0" step="0.01" max="999999.99" onKeyPress="if(this.value.length==9) return false;"></td>
                  <td style="border-top: 0;"></td>
                  <td style="border-top: 0;"></td>
                </tr>
                <tr>
                  <td style="border-top: 0;">2</td>
                  <td style="border-top: 0;"><b>Petrol(PMG)</b></td>
                  <td style="border-top: 0;"><input class="form-control" type="number" id="PMG" name="PMG" value="<?php echo $remainPMG ?>" placeholder="00.00" min="0" step="0.01" max="999999.99" onKeyPress="if(this.value.length==9) return false;"></td>
                  <td style="border-top: 0;"></td>
                  <td style="border-top: 0;"></td>
                </tr>
                <tr>
                  <td style="border-top: 0;">3</td>
                  <td style="border-top: 0;"><b>Lubricant(LUB)</b></td>
                  <td style="border-top: 0;"><input class="form-control" type="number" id="LUB" name="LUB" value="<?php echo $remainLUB ?>" placeholder="00.00" min="0" step="0.01" max="999999.99" onKeyPress="if(this.value.length==9) return false;"></td>
                  <td style="border-top: 0;"></td>
                  <td style="border-top: 0;"></td>
                </tr>
              </tbody>
              </table>
            </div>

            <input class="btn btn-success btn-md pull-right" name="meter_state" id="meter_state" type="submit" value="Update"> 
          </div>
        </div>
      </form>
    </div>

  
  </div>
</div>





<!-- jQuery library -->
  <script src="js/jquery-2.1.4.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/additional-methods.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  <!-- Custome JScript File -->
  <script src="js/script.js"></script>

</body>
</html>
<?php 

require_once dirname(__FILE__)."/script/get_customer_info.php";
require_once dirname(__FILE__)."/script/function_inc.php";

if (!loggedin()){
  header("Location: ./login_page.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once "./header.php"; ?>
  <style>
  .logotext{
    text-shadow:3px 10px 10px rgba(25,17,17,1);
    font-weight:bold;
    font-variant:small-caps;
    letter-spacing:3pt;
    word-spacing:0pt;
    font-size:1.5em;
    text-align:center;
    font-family:times new roman, times, serif;
    line-height:1;
    background-color: #d9edf7;
  }
  </style>
</head>

<body style="background-color:#222222;">

<?php require_once "./navbar.php"; ?>

<div class="container-fluid">
  <div class="row">

    <div class="col-md-offset-1 col-md-10" style="margin-left: 175px;">
      
      <div class="panel panel-primary">
        <div class="panel-heading" style="font-weight: 600; font-size: 1em%">Daily/Monthly Reports <span class="pull-right">Today Date: <?php echo date("d/m/Y"); ?></span>
          <div class="panel-heading text-center" style="color: <?php echo $color ?>; font-weight: bold;" id="ErrorMsg">
            <?php echo $ErrorMsg ?>
          </div>

        </div>
        <div class="panel-body bg-info">

          <h2 class="text-center text-success marquee logotext" style="margin-top: -3px;">
          <span style="color: #051F00; text-shadow: 3px 10px 10px rgba(25,17,17,1); margin-bottom: 10px;">*~* JAN Station*~*</span>
          </h2>

        <div class="panel panel-default">
        <div class="panel-body">
          <div class="h4 "><b>Daily Report</b></div>
          <div class="col-md-4">
            <div class="h4">Today Profit: <b> <?php echo $todayProfit ?></b></div>
            <div class="h4">Today Sale: <b><?php echo $todaysale ?></b></div>
            <div class="h4">Remainig Balance: <b><?php echo $remainingBalance ?></b></div>
            <div class="h4">New Arrival: <b><?php echo $newStock ?></b></div>
            <div class="h4">Total: <b><?php echo $totalDaily ?></b></div>
            <div class="h4">Debt: <b><?php echo number_format($todayDebt,2); ?></b></div>
            <div class="h4">Return: <b><?php echo number_format($todayReturn,2); ?></b></div>
          </div>

          <div class=" col-md-4">
            <div class="h4" style="margin-top: -27px; margin-bottom: 17px; font-weight: bold;">Remainig Stock</div>
            <div class="h4">HSD: <b><?php echo $remainHSD ?></b> Liters</div>
            <div class="h4">PMG: <b><?php echo $remainPMG ?></b> Liters</div>
            <div class="h4">LUB: <b><?php echo $remainLUB ?></b> Gallon</div>
          </div>

          <div class=" col-md-4" style="margin-top: -35px">
            <form class="form-inline" action="./script/daily.php" method="POST" autocomplete="off">
            <fieldset >
              <legend style="border-bottom: 0; margin-bottom: -3px; font-weight: 600;">Today Rate</legend>
            </fieldset>
            
              <table class="table table-hover">
                <thead>
                  <th></th>
                  <th></th>
                  <th>Sale Rate</th>
                  <th>Purchase Rate</th>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><b>HSD/Liter</b></td>
                    <td><input class="form-control" type="number" id="HSD_PER_LTR" name="HSD_PER_LTR" value="<?php echo $HSD_Rate ;?>" placeholder="00.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" required></td>
                    <td><input class="form-control" type="number" id="HSD_PER_LTR" name="P_HSD_PER_LTR" value="<?php echo $HSD_Purc ;?>" placeholder="00.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" required></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><b>PMG/Liter</b></td>
                    <td><input class="form-control" type="number" id="PMG_PER_LTR" name="PMG_PER_LTR" value="<?php echo $PMG_Rate ;?>" placeholder="00.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" required></td>
                    <td><input class="form-control" type="number" id="HSD_PER_LTR" name="P_PMG_PER_LTR" value="<?php echo $PMG_Purc ;?>" placeholder="00.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" required></td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><b>LUB/Liter</b></td>
                    <td><input class="form-control" type="number" id="LUB_PER_LTR" name="LUB_PER_LTR" value="<?php echo $LUB_Rate ;?>" placeholder="00.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" required></td>
                    <td><input class="form-control" type="number" id="HSD_PER_LTR" name="P_LUB_PER_LTR" value="<?php echo $LUB_Purc ;?>" placeholder="00.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" required></td>
                  </tr>
                </tbody>
              </table>
           

            <input class="btn btn-warning btn-md pull-right" name="change_rate" id="change_rate" type="submit" value="Update">
            </form>
          </div>


        </div>
        </div>

        <div class="panel panel-default">
        <div class="panel-body">
          <div class="h4 "><b>Current Month Report</b></div>
          <div class="col-md-4">
            <div class="h4">Total Profit: <b><?php if (!empty($monthlyProfit))echo $monthlyProfit ?></b></div>
            <div class="h4">Total Sale: <b><?php if (!empty($monthlySale))echo $monthlySale ?></b></div>
            <div class="h4">Total Income/Purchase: <b><?php if (!empty($totlMonthlyIncome))echo $totlMonthlyIncome ?></b></div>
            <div class="h4">Total Returned Debt: <b><?php if (!empty($totalReturnDebt))echo $totalReturnDebt ?></b></div>
          </div>
          <div class="col-md-offset-4 col-md-4" style="margin-top: -1%;">
            <div class="h4">Total Remainig Debt: <b><?php if (!empty($totalRemainingDebt))echo $totalRemainingDebt ?></b></div>
          </div>
        </div>
        </div>

        </div>
        <div class="panel-footer text-center microsoft marquee"><span>:: JAN Station ::</span></div>
      </div>
        <br><br><br>     
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
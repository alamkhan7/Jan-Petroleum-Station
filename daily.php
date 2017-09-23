<?php 

require_once dirname(__FILE__)."/script/get_customer_info.php";
require_once dirname(__FILE__)."/script/function_inc.php";

if (!loggedin()){
  header("Location: ./login_page.php");
  exit();
}

if (!empty($_GET['returnMsg']))
  $ErrorMsg = $_GET['returnMsg'] ;

if (!empty($_GET['Label']))
  $color = $_GET['Label'];
else
  $color = $label;

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
    

    <div class="col-md-offset-1 col-md-5" style="margin-left: 150px; margin-top: 20px;">
      <br><br>
      <form class="form-horizontal" action="./script/daily.php" method="POST" autocomplete="off">
        <div class="panel panel-primary">
          <div class="panel-heading">Daily Sale</span></div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Stock</th>
                  <th>Liters</th>
                  <th>Sales Rate/LTR</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td><b>Diesel(HSD)</b></td>
                  <td><input class="form-control" type="number" id="HSD_LTR" name="HSD_LTR" value="" placeholder="00.00" min="0" step="0.01" max="9999999.00" onKeyPress="if(this.value.length==10) return false;"></td>
                  <td><input class="form-control" type="number" id="HSD_PER_LTR" name="HSD_PER_LTR" value="<?php echo $HSD_Rate ;?>" placeholder="00.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" readonly></td>
                  <td><b>Rs <span id="HSD-Total">00.00</span></b></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td><b>Petrol(PMG)</b></td>
                  <td><input class="form-control" type="number" id="PMG_LTR" name="PMG_LTR" value="" placeholder="00.00" min="0" step="0.01" max="9999999.00" onKeyPress="if(this.value.length==10) return false;"></td>
                  <td><input class="form-control" type="number" id="PMG_PER_LTR" name="PMG_PER_LTR" value="<?php echo $PMG_Rate ;?>" placeholder="00.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" readonly></td>
                  <td><b>Rs <span id="PMG-Total">00.00</span></b></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td><b>Lubricant(LUB)</b></td>
                  <td><input class="form-control" type="number" id="LUB_LTR" name="LUB_LTR" value="" placeholder="00.00" min="0" step="0.01" max="9999999.00" onKeyPress="if(this.value.length==10) return false;"></td>
                  <td><input class="form-control" type="number" id="LUB_PER_LTR" name="LUB_PER_LTR" value="<?php echo $LUB_Rate ;?>" placeholder="00.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" readonly></td>
                  <td><b>Rs <span id="LUB-Total">00.00</span></b></td>
                </tr>
                <tr>
                  <td>4</td>
                  <td><b>Daily Spent</b></td>
                  <td><input class="form-control" type="number" id="m_charges" name="m_charges" value="" placeholder="00.00" min="0" step="0.01" max="9999999.99" onKeyPress="if(this.value.length==10) return false;"></td>
                  <td></td>
                  <td><b>Rs <span id="Spent-Total">00.00</span></b></td>             
                </tr>
                 <tr>
                  <td></td>
                  <td><b>Date</b></td>
                  <td><input type='text' name="date" value="<?=date('Y-m-d')?>" class="form-control col-md-1" id='datetimepicker' readonly/></td>
                  <td></td>
                  <td></td>             
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total</b></td>
                  <td><b>Rs <span id="total_sale"> 00.00</span></b></td>
                </tr>
              </tbody>
              </table>
            </div>

            <input class="btn btn-warning btn-md pull-right" name="daily_sale" id="daily_sale" type="submit" value="Add"> 
          </div>
        </div>
      </form>
    </div>

    <div class="col-md-offset-0 col-md-5" style="margin-top: 20px">
      <br><br>
      <form class="form-horizontal" action="./script/daily.php" method="POST" autocomplete="off">
        <div class="panel panel-primary">
          <div class="panel-heading">Incoming Stock</div>
          <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Stock</th>
                <th>Liters</th>
                <th>Purchase Rate/LTR</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td><b>Diesel(HSD)</b></td>
                <td><input class="form-control" type="number" id="HSD_LTR_Income" name="HSD_LTR" value="" placeholder="00.00" min="0" step="0.01" max="9999999.00" onKeyPress="if(this.value.length==10) return false;"></td>
                <td><input class="form-control" type="number" id="HSD_PER_LTR_Income" name="HSD_PER_LTR" value="<?php echo $HSD_Purc ;?>" placeholder="00.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" readonly></td>
                <td><b>Rs <span id="HSD-Income-Total">00.00</span></b></td>
              </tr>
              <tr>
                <td>2</td>
                <td><b>Petrol(PMG)</b></td>
                <td><input class="form-control" type="number" id="PMG_LTR_Income" name="PMG_LTR" value="" placeholder="00.00" min="0" step="0.01" max="9999999.00" onKeyPress="if(this.value.length==10) return false;"></td>
                <td><input class="form-control" type="number" id="PMG_PER_LTR_Income" name="PMG_PER_LTR" value="<?php echo $PMG_Purc ;?>" placeholder="00.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" readonly></td>
                <td><b>Rs <span id="PMG-Income-Total">00.00</span></b></td>
              </tr>
              <tr>
                <td>3</td>
                <td><b>Lubricant(LUB)</b></td>
                <td><input class="form-control" type="number" id="LUB_LTR_Income" name="LUB_LTR" value="" placeholder="00.00" min="0" step="0.01" max="9999999.00" onKeyPress="if(this.value.length==10) return false;"></td>
                <td><input class="form-control" type="number" id="LUB_PER_LTR_Income" name="LUB_PER_LTR" value="<?php echo $LUB_Purc ;?>" placeholder="00.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" readonly></td>
                <td><b>Rs <span id="LUB-Income-Total">00.00</span></b></td>
              </tr>
               <tr>
                  <td></td>
                  <td><b>Date</b></td>
                  <td><input type='text' name="date" value="<?=date('Y-m-d')?>" class="form-control col-md-1" id='datetimepicker1' readonly/></td>
                  <td></td>
                  <td></td>             
                </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total</b></td>
                <td><b>Rs <span id="total_income"> 00.00</span></b></td>
              </tr>
            </tbody>
            </table>
            </div>

        <input class="btn btn-warning btn-md pull-right" name="income_stock" id="income_stock" type="submit" value="Add">
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
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/bootstrap-datetimepicker.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  <!-- Custome JScript File -->
  <script src="js/script.js"></script>
  <script>
    $(document).ready(function(){

      $(function () {
                $('#datetimepicker').datetimepicker(
                  {
                    todayHighlight: true,
                    autoclose: true,
                    format: "yyyy-mm-dd",
                    startView: 2,
                    minView: 2

                  });
      });

      $(function () {
                $('#datetimepicker1').datetimepicker(
                  {
                    todayHighlight: true,
                    autoclose: true,
                    format: "yyyy-mm-dd",
                    startView: 2,
                    minView: 2

                  });
      });
      
      var totalIncome = 0.00;

      $("#HSD_LTR, #HSD_PER_LTR, #PMG_LTR, #PMG_PER_LTR, #LUB_LTR, #LUB_PER_LTR, #m_charges").keyup(function(){
        var HSD = 0.00;
        var PMG = 0.00;
        var LUB = 0.00;
        var otherCharges = 0.00;
        var totalSale = 0.00;

        HSD = $("#HSD_LTR").val() * $("#HSD_PER_LTR").val();
        totalSale += HSD;
        document.getElementById("HSD-Total").innerHTML = HSD.toFixed(2) ;
        
        PMG = $("#PMG_LTR").val() * $("#PMG_PER_LTR").val();
        totalSale += PMG;
        document.getElementById("PMG-Total").innerHTML = PMG.toFixed(2) ;
        
        LUB = $("#LUB_LTR").val() * $("#LUB_PER_LTR").val();
        totalSale += LUB;
        document.getElementById("LUB-Total").innerHTML = LUB.toFixed(2) ;

        otherCharges = Number($("#m_charges").val()) ;
        totalSale += otherCharges;
        $("#Spent-Total").text(otherCharges.toFixed(2));

        $("#total_sale").text(totalSale.toFixed(2));
    });

      

      $("#HSD_LTR_Income, #HSD_PER_LTR_Income, #PMG_LTR_Income, #PMG_PER_LTR_Income, #LUB_LTR_Income, #LUB_PER_LTR_Income").keyup(function(){

        var HSD = 0.00;
        var PMG = 0.00;
        var LUB = 0.00;
        var totalIncome = 0.00;

        var HSD = $("#HSD_LTR_Income").val() * $("#HSD_PER_LTR_Income").val();
        totalIncome += HSD;
        document.getElementById("HSD-Income-Total").innerHTML = HSD.toFixed(2) ;

        var PMG = $("#PMG_LTR_Income").val() * $("#PMG_PER_LTR_Income").val();
        totalIncome += PMG;
        document.getElementById("PMG-Income-Total").innerHTML = PMG.toFixed(2) ;

        var LUB = $("#LUB_LTR_Income").val() * $("#LUB_PER_LTR_Income").val();
        totalIncome += LUB;
        document.getElementById("LUB-Income-Total").innerHTML = LUB.toFixed(2) ;
        $("#total_income").text(totalIncome);

        $("#total_income").text(totalIncome.toFixed(2));
    });

    

});
  </script>

</body>
</html>
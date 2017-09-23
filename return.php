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
  $ErrorMsg = $returnMsg ;

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

<div class="container" style="margin-top: 2%;">

    <div class="col-md-4 col-md-offset-4">     
      <div class="row">
        <div id="logo" class="text-center">
        </div>
      <!-- Form is handle by auto_suggestion file  -->
      <form role="form" id="form-buscar" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
        <div class="form-group">
          <div class="input-group">
              <input id="search" class="form-control" type="text" name="CNIC" placeholder="CNIC/Vehicle" required autofocus/>
              <span class="input-group-btn">
                <button name="submit" class="btn btn-success" type="submit">
                  <i class="glyphicon glyphicon-search" aria-hidden="true"></i> Search
                </button>
              </span>
          </div>
        </div>
      </form>
      </div>            
    </div>
</div>


<div class="container-fluid">
  <div class="row">
   	<div class="col-md-offset-2 col-md-8">   		
      <div class="panel-group">
        <div class="panel panel-primary">
          <div class="panel-heading text-center" style="color: <?php echo $color ?>; font-weight: bold;" id="ErrorMsg">
            <?php echo $ErrorMsg ?>
          </div>
          <div class="panel-body bg-info">         
            <h5>Type: <strong> <?php if (!empty($type)) echo $type; ?> </strong>
                <span class="pull-right"><b>Remainig Balance:</b> <?php echo number_format($Remaining_Balance,2); ?> </span>
            </h5>
            
            <h5>
              Customer Name: <strong> <?php if (!empty($Name)) echo $Name; ?> </strong>
              <span class="pull-right">Account Date: <strong> <?php if (!empty($Date)) echo $Date; ?>  </strong> </span>
            </h5>

            <table class="table table-hover" style="background-color: while;">
              <tbody>
                <tr>
                  <th>Vehicle #</th>
                  <td><?php if (!empty($Vehicle_NO)) echo $Vehicle_NO; ?></td>
                  <th>CNIC</th>
                  <td> <?php if (!empty($CNIC)) echo $CNIC; ?> </td>
                  <th>Address</th>
                  <td><?php if (!empty($Address)) echo $Address; ?></td>
                  <th>Phone</th>
                  <td> <?php if (!empty($Phone_No)) echo $Phone_No; ?> </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- End of first column -->



    <div class="col-md-offset-2 col-md-10">
      
      <div class="col-md-6" style="padding-left: 0px;">
        <form class="form-horizontal" action="./script/history.php" method="POST" autocomplete="off">
          <div class="panel panel-primary">
            <div class="panel-heading">New Legde <span class="pull-right">Today Date: <?php echo date("d/m/Y"); ?></span></div>
            <div class="panel-body">
              
              <div class="table-responsive">
                <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Stock</th>
                    <th>Liters</th>
                    <th>Price/LTR</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><b>Diesel(HSD)</b></td>
                    <td><input class="form-control" type="number" id="HSD_LTR" name="HSD_LTR" value="" placeholder="00.00" min="0" step="0.01" max="9999999.00" onKeyPress="if(this.value.length==10) return false;"></td>
                    <td><input class="form-control" type="number" id="HSD_PER_LTR" name="HSD_PER_LTR" value="<?php echo $HSD_Rate ;?>" placeholder="02.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" readonly></td>
                    <td><b>Rs. <span id="HSD-Total">00.00</span></b></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><b>Petrol(PMG)</b></td>
                    <td><input class="form-control" type="number" id="PMG_LTR" name="PMG_LTR" value="" placeholder="00.00" min="0" step="0.01" max="9999999.00" onKeyPress="if(this.value.length==10) return false;"></td>
                    <td><input class="form-control" type="number" id="PMG_PER_LTR" name="PMG_PER_LTR" value="<?php echo $PMG_Rate ;?>" placeholder="02.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" readonly></td>
                    <td><b>Rs. <span id="PMG-Total">00.00</span></b></td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><b>Lubricant(LUB)</b></td>
                    <td><input class="form-control" type="number" id="LUB_LTR" name="LUB_LTR" value="" placeholder="00.00" min="0" step="0.01" max="9999999.00" onKeyPress="if(this.value.length==10) return false;"></td>
                    <td><input class="form-control" type="number" id="LUB_PER_LTR" name="LUB_PER_LTR" value="<?php echo $LUB_Rate ;?>" placeholder="02.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" readonly></td>
                    <td><b>Rs. <span id="LUB-Total">00.00</span></b></td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><b>Others</b></td>
                    <td><input class="form-control" type="number" id="Other" name="Other" value="" placeholder="00.00" min="0" step="0.01" max="999999999.99" onKeyPress="if(this.value.length==12) return false;"></td>
                    <td></td>
                    <td><b>Rs. <span id="Other-Total">00.00</span></b></td>             
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
                    <td><b>NET:</b></td>
                    <td><b>Rs. <span id="NET">00.00</span></b></td>             
                  </tr>
                </tbody>
                </table>
              </div>

              <input class="form-control" type="hidden" name="CSID" value="<?php echo @$customer_ID; ?>" >
              <input class="btn btn-warning btn-md pull-right" name="add_amount" id="add_amount" type="submit" value="Add">
            </div>
          </div>
        </form>
      </div>
      <!-- Inner first column end -->

      <div class="col-md-4" style="padding-left: 0px;">
        <form class="form-horizontal" action="./script/history.php" method="POST" autocomplete="off">
          <div class="panel panel-primary">
            <div class="panel-heading">Return Amount </div>
            <div class="panel-body">
              
              <div class="table-responsive">
                <table class="table table-hover">
                <tbody>
                  <tr>
                    <td></td>
                    <td><b>Amount</b></td>
                    <td><input class="form-control" type="number" id="R_Amount" name="R_Amount" value="" placeholder="00.00" min="1" step="0.01" max="999999999.99" onKeyPress="if(this.value.length==12) return false;"></td>
                    <td></td>
                    <td></td>
                  </tr>
                 
                    <td></td>
                    <td><b>Date</b></td>
                    <td><input type='text' name="date" value="<?=date('Y-m-d')?>" class="form-control col-md-1" id='datetimepicker1' readonly /></td>
                    <td></td>
                    <td></td>             
                  </tr>
                  
                </tbody>
                </table>
              </div>

              <input class="form-control" type="hidden" name="CSID" value="<?php echo @$customer_ID; ?>" >
              <input class="btn btn-danger btn-md pull-right" name="return" id="return" type="submit" value="Return">
            </div>
          </div>
        </form>
      </div>

    </div>

    <!-- <div class="col-md-offset-1 col-md-4 bg-warning">
		
		  
        

        <input type="text" name="date" value="<?php echo date("Y-m-d"); ?>" hidden>
        <input class="btn btn-danger btn-md pull-right" name="return" id="return" type="submit" value="Return">
        <br><br><br>     
      </form>
    </div> -->
  
  </div>
</div>





<!-- jQuery library -->
  <script src="js/jquery-2.1.4.min.js"></script>
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

      var NET = 0;
      var HSDTotal = 0;
      var PMGTotal = 0;
      var LUBTotal = 0;
      var OtherTotal = 0;

      $("#HSD_LTR, #HSD_PER_LTR, #PMG_LTR, #PMG_PER_LTR, #LUB_LTR, #LUB_PER_LTR, #Other").keyup(function(){

      	HSDTotal = $("#HSD_LTR").val() * $("#HSD_PER_LTR").val();
        document.getElementById("HSD-Total").innerHTML = HSDTotal.toFixed(2) ;

        PMGTotal = $("#PMG_LTR").val() * $("#PMG_PER_LTR").val();
        document.getElementById("PMG-Total").innerHTML = PMGTotal.toFixed(2) ;

      	LUBTotal = $("#LUB_LTR").val() * $("#LUB_PER_LTR").val();
        document.getElementById("LUB-Total").innerHTML = LUBTotal.toFixed(2) ;

      	OtherTotal = $("#Other").val() ;
      	document.getElementById("Other-Total").innerHTML = OtherTotal ;

      	NET = Number(OtherTotal) + Number(HSDTotal) + Number(PMGTotal) + Number(LUBTotal)  ;
        document.getElementById("NET").innerHTML = NET.toFixed(2) ;
        
    });

      $('#search').keyup(function(){
        $( "#search" ).autocomplete({
          source: 'script/auto_suggestion.php',
          minLength:1,
          autoFocus:true,   
        // delay:500
      });
    });    

});
  </script>

</body>
</html>
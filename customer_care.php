<?php 

require_once dirname(__FILE__)."/script/get_customer_info.php";
require_once dirname(__FILE__)."/script/function_inc.php";

// If user is not loggedin then redirect him to login Page
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

  <style>
    #divToPrint table {  
    }
    #TableHeader th {
      text-align: left;
    }
  </style>

</head>
<body style="background-color:#222222">


<?php require_once "./navbar.php"; ?>


<div class="container" style="margin-top: 2%;">

    <div class="col-md-4 col-md-offset-4">     
      <div class="row">
        <div id="logo" class="text-center">
        </div>
      <!-- Form is handle by auto_suggestion file  -->
      <form role="form" id="form-buscar" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <div class="input-group">
              <input id="search" class="form-control" type="text" name="transaction_id" placeholder="Transaction ID" required />
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


<div class="container-fluid" style="margin-top: 10px; width: 90%">
  <div class="row">
    
    
    <div class="col-md-offset-1 col-md-10">
      <div class="panel panel-inverse">
        <div class="panel-heading text-center" style="color: <?php echo $color ?>; font-weight: bold;" id="ErrorMsg">
          <?php echo $ErrorMsg ?>
        </div>
        <div class="panel-body bg-info">

          <h2 class="text-center text-primary"><b>Customer Care</b></h2>

        <div class="panel panel-default">
        <div class="panel-body">
          <div class="col-md-offset-1 col-md-10">
            
            <form class="form-inline" action="./script/daily.php" method="POST" >
              <fieldset>
                <legend> Transaction ID: <?php if (!empty($Transaction_ID)) echo $Transaction_ID; else printf("%05d", $newTransactionID);?> <span class="pull-right">Time: <?php if (!empty($Time)) echo $Time; else echo date("h:iA, d/m/Y"); ?></span></legend>
              </fieldset>

              <div class="form-group">
                <label class="control-label" for="name">Customer Name:</label>
                  <input id="name" name="name" type="text" placeholder="Name" class="form-control " required min="0" maxlength="30" autofocus value="<?php if (!empty($Customer_Name)) echo $Customer_Name; ?>">  
              </div>

            <div class="table-responsive">
              <table class="table table-hover">
              <thead>
                <tr id="TableHeader">
                  <th>#</th>
                  <th>Stock</th>
                  <th>Liters</th>
                  <th>Sales Rate/LTR</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td><b>Diesel(HSD)</b></td>
                  <td><input class="form-control" type="number" id="HSD_LTR" name="HSD_LTR" value="<?php if (!empty($HSD)) echo $HSD ;?>" placeholder="00.00" min="0" step="0.01" max="9999999.00" onKeyPress="if(this.value.length==10) return false;"></td>
                  <td><input class="form-control" type="number" id="HSD_PER_LTR" name="HSD_PER_LTR" value="<?php if (!empty($OLD_HSD_Rate)) echo $OLD_HSD_Rate; else echo $HSD_Rate ?>" placeholder="00.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" readonly></td>
                  <td><b>Rs.<span id="HSD-Total"><?php if (!empty($OLDHSDTotal)) echo $OLDHSDTotal; else echo "00.00"; ?></span></b></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td><b>Petrol(PMG)</b></td>
                  <td><input class="form-control" type="number" id="PMG_LTR" name="PMG_LTR" value="<?php if (!empty($PMG)) echo $PMG ;?>" placeholder="00.00" min="0" step="0.01" max="9999999.00" onKeyPress="if(this.value.length==10) return false;"></td>
                  <td><input class="form-control" type="number" id="PMG_PER_LTR" name="PMG_PER_LTR" value="<?php if (!empty($OLD_PMG_Rate)) echo $OLD_PMG_Rate; else echo $PMG_Rate; ?>" placeholder="00.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" readonly></td>
                  <td><b>Rs.<span id="PMG-Total"><?php if (!empty($OLDPMGTotal)) echo $OLDPMGTotal; else echo "00.00"; ?></span></b></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td><b>Lubricant(LUB)</b></td>
                  <td><input class="form-control" type="number" id="LUB_LTR" name="LUB_LTR" value="<?php if (!empty($LUB)) echo $LUB ;?>" placeholder="00.00" min="0" step="0.01" max="9999999.00" onKeyPress="if(this.value.length==10) return false;"></td>
                  <td><input class="form-control" type="number" id="LUB_PER_LTR" name="LUB_PER_LTR" value="<?php if (!empty($OLD_LUB_Rate)) echo $OLD_LUB_Rate; else echo $LUB_Rate; ?>" placeholder="00.00" min="0" step="0.01" max="999.99" onKeyPress="if(this.value.length==6) return false;" readonly></td>
                  <td><b>Rs.<span id="LUB-Total"><?php if (!empty($OLDLUBTotal)) echo $OLDLUBTotal; else echo "00.00"; ?></span></b></td>
                </tr>
                <tr>
                  <td>4</td>
                  <td><b>Others</b></td>
                  <td><input class="form-control" type="number" id="Other" name="Other" value="<?php if (!empty($Others)) echo $Others ;?>" placeholder="00.00" min="0" step="0.01" max="999999999.99" onKeyPress="if(this.value.length==12) return false;"></td>
                  <td></td>
                  <td><b>Rs. <span id="Other-Total"><?php if (!empty($Others)) echo $Others; else echo "00.00"; ?></span></b></td>             
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><b>Total:</b></td>
                  <td><b>Rs. <span id="NET"><?php if (!empty($Total)) echo $Total; else echo "00.00"; ?></span></b></td>             
                </tr>
              </tbody>
              </table>
            </div>  

            <input type="text" name="Transaction_ID" value="<?php if (!empty($Transaction_ID)) echo $Transaction_ID; else echo $newTransactionID;?>" hidden>
            <input type="text" name="date" value="<?php echo date("Y-m-d H:i:s"); ?>" hidden>
            <button class="btn btn-warning btn-md pull-right" name="print" id="print" type="submit" value="Print" onclick="PrintDiv();"> Print &nbsp;<span class="glyphicon glyphicon-print"></span></button>

            </form>


          </div>
         

          


        </div>
        </div>

        </div>
        <div class="panel-footer text-center microsoft marquee"><span>:: JAN Station ::</span></div>
      </div>
    </div>

    <div class="col-md-6" id="divToPrint" style="display: none;">
      <br>
        <img src="images/Jan2.png" style="padding-left: 10px">

        
        <div class="h6">Transaction ID: <span class="h4"><?php if (!empty($Transaction_ID)) echo $Transaction_ID; else printf("%05d", $newTransactionID);?></span></div>
        <div class="h6">Customer Name: <span class="h4" id="Print_Name"></span></div>
        
          <table width="100%" style="margin-top: 20px;">
            <tr style="text-align: left;">
              <th>Stock</th>
              <th>Liters</th>
              <th>Sales Rate/LTR</th>
              <th>Total</th>
            </tr>
            <tr>
              <td>Diesel(HSD)</td>
              <td id="Print_HSD_LTR">10.00</td>
              <td id="Print_HSD_PER_LTR">02.00</td>
              <td>Rs.<b><span id="Print_HSD-Total">00.00</span></b></td>
            </tr>
            <tr>
              <td>Petrol(PMG)</td>
              <td id="Print_PMG_LTR">10.00</td>
              <td id="Print_PMG_PER_LTR">02.00</td>
              <td>Rs.<b><span id="Print_PMG-Total">00.00</span></b></td>
            </tr>
            <tr>
              <td>Lubricant(LUB)</b></td>
              <td id="Print_LUB_LTR">10.00</td>
              <td id="Print_LUB_PER_LTR">02.00</td>
              <td>Rs.<b><span id="Print_LUB-Total">00.00</span></b></td>
            </tr>
            <tr>
              <td>Others</td>
              <td></td>
              <td></td>
              <td>Rs.<b><span id="Print_Other-Total">00.00</span></b></td>           
            </tr>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
            <tr>
              <td><b>Total:</b></td>
              <td id="Print_Total_LTR"><b>00.00</b></td>
              <td></td>
              <td>Rs. <b><span id="Print_NET">00.00</span></b></td>             
            </tr>
          </table>
          <br>
        <span style="float: right;">Time: <?php echo date("h:iA, d/m/Y"); ?></span>
    </div>
  
  </div>
</div>





<!-- jQuery library -->
  <script src="js/jquery-2.1.4.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  <!-- Custome JScript File -->
  <script src="js/script.js"></script>
  <script>
    $(document).ready(function(){

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
          source: 'script/auto_suggestion_customer_care.php',
          minLength:1,
          autoFocus:true,   
        // delay:500
      });
    });    

});

    function PrintDiv() {

        var name = $("#name").val();

        var HSD_LTR = $("#HSD_LTR").val();
        var HSD_PER_LTR = $("#HSD_PER_LTR").val();
        var HSD_Total = $("#HSD-Total").text();

        var PMG_LTR = $("#PMG_LTR").val();
        var PMG_PER_LTR = $("#PMG_PER_LTR").val();
        var PMG_Total = $("#PMG-Total").text();

        var LUB_LTR = $("#LUB_LTR").val();
        var LUB_PER_LTR = $("#LUB_PER_LTR").val();
        var LUB_Total = $("#LUB-Total").text();

        var Other = $("#Other").val();
        var Other_Total = $("#Other-Total").text();
        var NET = $("#NET").text();

        var Total_LTR = Number(HSD_LTR) + Number(PMG_LTR) + Number(LUB_LTR) ;


        if (!isEmpty(name) && (!isEmpty(HSD_LTR) || !isEmpty(PMG_LTR) || !isEmpty(LUB_LTR) || !isEmpty(Other)) ) 
        {
          $("#Print_Name").text(name);

          $("#Print_HSD_LTR").text(HSD_LTR);
          $("#Print_HSD_PER_LTR").text(HSD_PER_LTR);
          $("#Print_HSD-Total").text(HSD_Total);

          $("#Print_PMG_LTR").text(PMG_LTR);
          $("#Print_PMG_PER_LTR").text(PMG_PER_LTR);
          $("#Print_PMG-Total").text(PMG_Total);

          $("#Print_LUB_LTR").text(LUB_LTR);
          $("#Print_LUB_PER_LTR").text(LUB_PER_LTR);
          $("#Print_LUB-Total").text(LUB_Total);

          $("#Print_Other-Total").text(Other_Total);
          $("#Print_Total_LTR").text(Total_LTR);
          $("#Print_NET").text(NET);

          var divToPrint = document.getElementById('divToPrint');
          var popupWin = window.open('', '_blank', 'width=960,height=600');
          popupWin.document.open();
          popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
          popupWin.document.close();
        }
    }

    function isEmpty(value) {
      return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
    }

  </script>

</body>
</html>
<?php 
require_once dirname(__FILE__)."/script/get_customer_info.php";
require_once dirname(__FILE__)."/script/function_inc.php";

if (!loggedin()){
  header("Location: ./login_page.php");
  exit();
}

if (!empty($_POST['date']) && !empty($_POST['date']) ){
  $date =implode("-" , array_reverse(explode("-",$_POST['date']))) . "-__";
  $showDate = $_POST['date'] ;
  $customer_ID = $_POST['CSID'] ;
}
else{
  $date = date("Y-m-__") ;
  $showDate = date("m-Y") ;
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

<div class="container" style="margin-top: 3%;">

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

<div class="container-fluid" style="margin-top: 2%; margin-left: 2%;">
  <div class="row">
   	<div class="col-md-offset-1 col-md-10">

    <div class="panel-group">
      <div class="panel panel-inverse">
        <div class="panel-heading">
        
        <span style="color: <?php echo $color ?>; font-weight: bold; float: left"><?php echo $ErrorMsg ?></span>
          
        <form class="form-inline " action="./script/debt_history_generator.php" method="POST" style="float: right;">
            <input type='hidden' name="date" value="<?php echo $showDate; ?>" class="form-control col-md-1" />
            <input class="form-control" type="hidden" name="name" value="<?php echo @$Name; ?>" >
            <input class="form-control" type="hidden" name="CNIC" value="<?php echo @$CNIC; ?>" >
            <input class="form-control" type="hidden" name="type" value="<?php echo @$type; ?>" >
            <input class="form-control" type="hidden" name="phone" value="<?php echo @$Phone_No; ?>" >
            <input class="form-control" type="hidden" name="rbalance" value="<?php echo @$Remaining_Balance; ?>" >
            <input class="form-control" type="hidden" name="CSID" value="<?php echo @$customer_ID; ?>" > &nbsp;
            <input type="submit" name="submit" class="btn btn-danger" value="Print">
        </form>

        <form class="form-inline " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" style="float: right;">
            <input type='text' name="date" value="<?php echo $showDate; ?>" class="form-control col-md-1" id='datetimepicker' />
            <input class="form-control" type="hidden" name="CNIC" value="<?php echo @$CNIC; ?>" >
            <input class="form-control" type="hidden" name="CSID" value="<?php echo @$customer_ID; ?>" > &nbsp;
            <input type="submit" name="submit" class="btn btn-warning" value="Show">
        </form>


        <div class="clearfix"></div>
    
        </div>
        <div class="panel-body bg-info">         
          <h5>Type: <strong> <?php if (!empty($type)) echo $type; ?> </strong>
              <span class="pull-right">Remainig Balance: <b><?php echo number_format($Remaining_Balance,2); ?> </b></span>
          </h5>
          
          <h5>
            Customer Name: <strong> <?php if (!empty($Name)) echo $Name; ?> </strong>
            <span class="pull-right">Account Date: <strong> <?php if (!empty($Date)) echo $Date; ?> </span> </strong>
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
            

            <span></span>

            <div class="table-responsive">
            <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Date</th>
                <th>HSD</th>
                <th>HSD/Rate</th>
                <th>PMG</th>
                <th>PMG/Rate</th>
                <th>LUB</th>
                <th>LUB/Rate</th>
                <th>Others</th>
                <th>NET</th>
                <th>Returned</th>
              </tr>
            </thead>
            <tbody class="bg-success">
            <?php
              if (!empty($customer_ID)){
                require dirname(__FILE__)."/script/connection_inc.php";
                $i=1;
                $Remainig = 0 ;
                $query = "SELECT * FROM ledge_history_view WHERE customer_ID = '$customer_ID' AND `Date` LIKE '$date' " ;
                if ($queryResult = mysqli_query($conn,$query)){
                  while ( $record = mysqli_fetch_assoc($queryResult) ) {
                    $legdeDate = $record['Date'] ;
                    $legdeDate = implode("-" , array_reverse(explode("-",$legdeDate)));
                    $HSD = $record['HSD_LTR'] ;
                    $HSDTotal += $HSD;
                    $HSD_Rate = $record['HSD_PER_LTR'] ;
                    $PMG = $record['PMG_LTR'] ;
                    $PMGTotal += $PMG;
                    $PMG_Rate = $record['PMG_PER_LTR'] ;
                    $LUB = $record['LUB_LTR'] ;
                    $LUBTotal += $LUB;
                    $LUB_Rate = $record['LUB_PER_LTR'] ;
                    $Others = $record['Others'] ;
                    $OthersTotal += $Others;       
                    $Returned = $record['Return_Amount'] ;
                    $ReturnedTotal += $Returned;
                    $NET = $record['NET'] ;
                    $NETTotal += $NET;
            ?>      
                  <tr <?php if ($Returned!=0.00) echo "class='bg-danger'"; ?> >
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $legdeDate; ?></td>
                    <td><?php echo $HSD; ?> Litres </td>
                    <td><?php echo $HSD_Rate; ?>/Litres </td>
                    <td><?php echo $PMG; ?> Litres</td>
                    <td><?php echo $PMG_Rate; ?>/Litres</td>
                    <td><?php echo $LUB; ?> Litres</td>
                    <td><?php echo $LUB_Rate; ?>/Litres</td>
                    <td>Rs. <?php echo number_format($Others,2); ?></td>
                    <td>Rs. <?php echo number_format($NET,2); ?></td>
                    <td>Rs. <?php echo number_format($Returned,2); ?></td>
                  </tr>
            <?php   }
                }
                else{
                  echo "Error: <b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn);
                }

                @mysqli_free_result($queryResult);
                @mysqli_close($conn);
              }
            ?>
            </tbody>
            <tr class="bg-warning">
              <td></td>
              <td><b>Total</b></td>
              <td><b><?php echo number_format($HSDTotal,2); ?> Litres</b></td>
              <td></td>
              <td><b><?php echo number_format($PMGTotal,2); ?> Litres</b></td>
              <td></td>
              <td><b><?php echo number_format($LUBTotal,2); ?> Litres</b></td>
              <td></b></td>
              <td><b>Rs. <?php echo number_format($OthersTotal,2); ?></b></td>
              <td><b>Rs. <?php echo number_format($NETTotal,2); ?></b></td>
              <td><b>Rs. <?php echo number_format($ReturnedTotal,2); ?></b></td>
            </tr>
            </table>
          </div> 
        </div>
        <div class="panel-footer text-center microsoft marquee"><span>:: JAN Station ::</span></div>
      </div> <!-- First panel end -->

    </div> <!-- First column end -->
  
  </div> <!-- First row end -->
</div> <!-- container end -->





<!-- jQuery library -->
  <script src="js/jquery-2.1.4.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/bootstrap-datetimepicker.min.js"></script>
  <!-- <script src="js/bootstrap-datetimepicker.uk.js"></script> -->
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
                    format: "mm-yyyy",
                    startView: 3,
                    minView: 3

                  });
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
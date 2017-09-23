<?php 

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
  $color = "rgb(255, 255, 255)";

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
    
    <div class="col-md-offset-3 col-md-6">
      <br><br>
      
      <form class="form-horizontal" action="./script/customer.php" method="POST" autocomplete="off">
      <div class="panel panel-primary">
        <div class="panel-heading text-center" style="font-weight: 600; font-size: 1em%">New Account
        <div class="panel-heading text-center" style="color: <?php echo $color ?>; font-weight: bold;" id="ErrorMsg">
          <?php echo $ErrorMsg ?>
        </div>

        </div>
        <div class="panel-body">
          
          <div class="form-group">
            <label class="col-md-3 control-label">Type:</label>&nbsp;&nbsp;
            <input type="radio" name="type" value="C" required>&nbsp;&nbsp;Customer&nbsp;&nbsp;</label>
            <input type="radio" name="type" value="V" required>&nbsp;&nbsp;Vehicle</label>
          </div>

          <div class="form-group">
          <label class="col-md-3 control-label" for="name">*Customer Name:</label>
          <div class="col-md-6">
            <input id="name" name="name" type="text" placeholder="Name" class="form-control" required minlength="3" maxlength="30" pattern="[A-Za-z ]+" size="30">
          </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label" for="v_number">Vehicle Number:</label>
            <div class="col-md-6">
              <input id="v_number" name="v_number" type="text" placeholder="PSD-1010" class="form-control" minlength="1" maxlength="15" size="10" pattern="[A-Za-z0-9-]+">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label" for="CNIC">*CNIC:</label>
            <div class="col-md-6">
              <input id="CNIC" name="CNIC" type="text" placeholder="1510112312313" class="form-control" required minlength="13" maxlength="13" size="13" pattern="[0-9]+">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label" for="Address">Address:</label>
            <div class="col-md-6">
              <input id="Address" name="Address" type="text" placeholder="Address" class="form-control" minlength="4" maxlength="50" size="50">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label" for="Phone">Phone #:</label>
            <div class="col-md-6">
              <input id="Phone" name="Phone" type="text" placeholder="+923331231231" class="form-control" minlength="5" maxlength="15" size="15" pattern="[0-9+]+">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 control-label" for="date">Date:</label>
            <div class="col-md-6">
              <input type='text' name="date" value="<?=date('Y-m-d')?>" class="form-control" id='datetimepicker' readonly/>
            </div>
          </div>
          


          
          <input class="btn btn-success btn-md pull-right" name="add_new" id="add_new" type="submit" value="Create">


        </div>
        <div class="panel-footer text-center microsoft marquee"><span>:: JAN Station ::</span></div>
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

      $("#HSD_LTR, #HSD_PER_LTR").keyup(function(){
        var Total = $("#HSD_LTR").val() * $("#HSD_PER_LTR").val();
        document.getElementById("HSD-Total").innerHTML = Total.toFixed(2) ;
    });

      $("#PMG_LTR, #PMG_PER_LTR").keyup(function(){
        var Total = $("#PMG_LTR").val() * $("#PMG_PER_LTR").val();
        document.getElementById("PMG-Total").innerHTML = Total.toFixed(2) ;
    });

      $("#LUB_LTR, #LUB_PER_LTR").keyup(function(){
        var Total = $("#LUB_LTR").val() * $("#LUB_PER_LTR").val();
        document.getElementById("LUB-Total").innerHTML = Total.toFixed(2) ;
    });

      $("#m_charges").keyup(function(){
        var Total = $(this).val() ;
        $("#Spent-Total").text(Total);
    });

      $("#HSD_LTR_Income, #HSD_PER_LTR_Income").keyup(function(){
        var Total = $("#HSD_LTR_Income").val() * $("#HSD_PER_LTR_Income").val();
        document.getElementById("HSD-Income-Total").innerHTML = Total.toFixed(2) ;
    });

      $("#PMG_LTR_Income, #PMG_PER_LTR_Income").keyup(function(){
        var Total = $("#PMG_LTR_Income").val() * $("#PMG_PER_LTR_Income").val();
        document.getElementById("PMG-Income-Total").innerHTML = Total.toFixed(2) ;
    });

      $("#LUB_LTR_Income, #LUB_PER_LTR_Income").keyup(function(){
        var Total = $("#LUB_LTR_Income").val() * $("#LUB_PER_LTR_Income").val();
        document.getElementById("LUB-Income-Total").innerHTML = Total.toFixed(2) ;
    });

});
  </script>

</body>
</html>
<?php 

require_once dirname(__FILE__)."/connection_inc.php";
require_once dirname(__FILE__)."/function_inc.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$returnMsg = "" ;
$returnLocation = "../return.php" ;
$label = "rgb(255, 255, 255)" ;

if (isset($_POST['add_amount']) && !empty($_POST['CSID']) && !empty($_POST['date']) ){
	
	if (empty($returnMsg)){
		
		$Customer_ID = $_POST['CSID'] ;
		$HSD_LTR = (float)$_POST['HSD_LTR'] ;
		$HSD_PER_LTR = (float)$_POST['HSD_PER_LTR'] ;
		$PMG_LTR = (float)$_POST['PMG_LTR'] ;
		$PMG_PER_LTR = (float)$_POST['PMG_PER_LTR'] ;
		$LUB_LTR = (float)$_POST['LUB_LTR'] ;
		$LUB_PER_LTR = (float)$_POST['LUB_PER_LTR'] ;
		$Other = (float) $_POST['Other'];
        $date = $_POST['date'] ;

        $query = "call add_customer_amount ('$Customer_ID','$date','$HSD_LTR','$HSD_PER_LTR','$PMG_LTR','$PMG_PER_LTR','$LUB_LTR','$LUB_PER_LTR','$Other')" ;

        if ($queryResult = mysqli_query($conn,$query)){
			$returnMsg = "New amount added successfully." ;
		}
		else{
			die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
		}

		@mysqli_free_result($queryResult);
		@mysqli_close($conn);
		
	}
}
else{
	$returnMsg = "Select customer/Vehicle" ;
	$label ="red";
}

if (isset($_POST['return']) && !empty($_POST['CSID']) && !empty($_POST['date']) ){
	
	if (empty($returnMsg)){
		
		$Customer_ID = $_POST['CSID'] ;
		$R_Amount = (float)$_POST['R_Amount'] ;
        $date = $_POST['date'] ;

        $query = "call return_customer_amount ('$Customer_ID','$date', '$R_Amount')" ;

        if ($queryResult = mysqli_query($conn,$query)){
			$returnMsg = "Amount successfully returned." ;
		}
		else{
			die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
		}

		@mysqli_free_result($queryResult);
		@mysqli_close($conn);
		
	}
}
else{
	$returnMsg = "Select customer/Vehicle" ;
	$label ="red";
}

@mysqli_close($conn);

header('Location: '.$returnLocation . '?returnMsg='.urlencode($returnMsg) .'&Label='.urlencode($label)  ) ;
exit();
?>
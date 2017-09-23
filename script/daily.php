<?php 
require_once dirname(__FILE__)."/connection_inc.php";
require_once dirname(__FILE__)."/function_inc.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$returnMsg = "" ;
$returnLocation = "" ;
$label = "" ;

if (isset($_POST['daily_sale'])){

	$returnLocation = "../daily.php" ;

	$returnMsg = validate_daily_sale($_POST);

	if (empty($returnMsg)){
		$HSD_LTR = (float)$_POST['HSD_LTR'] ;
		$HSD_PER_LTR = (float)$_POST['HSD_PER_LTR'] ;
		$PMG_LTR = (float)$_POST['PMG_LTR'] ;
		$PMG_PER_LTR = (float)$_POST['PMG_PER_LTR'] ;
		$LUB_LTR = (float)$_POST['LUB_LTR'] ;
		$LUB_PER_LTR = (float)$_POST['LUB_PER_LTR'] ;
        $date = $_POST['date'] ;
		$m_charges = (float)$_POST['m_charges'];

		$query = "call add_daily_sale('$date', '$HSD_LTR', '$PMG_LTR', '$LUB_LTR', '$HSD_PER_LTR', '$PMG_PER_LTR', '$LUB_PER_LTR', '$m_charges')";

		if ($queryResult = mysqli_query($conn,$query)){
			$returnMsg =  "<b>Daily sale</b> Done." ;
			$label = "white" ;
		}
		else{
			die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
		}

		@mysqli_free_result($queryResult);
	}
	else{
		$returnMsg = "Dialy Sale " . $returnMsg ;
		$label = "red" ;
	}
}

if (isset($_POST['income_stock'])){

	$returnLocation = "../daily.php" ;

	$returnMsg = validate_daily_sale($_POST);

	if (empty($returnMsg)){
		$HSD_LTR = (float)$_POST['HSD_LTR'] ;
		$HSD_PER_LTR = (float)$_POST['HSD_PER_LTR'] ;
		$PMG_LTR = (float)$_POST['PMG_LTR'] ;
		$PMG_PER_LTR = (float)$_POST['PMG_PER_LTR'] ;
		$LUB_LTR = (float)$_POST['LUB_LTR'] ;
		$LUB_PER_LTR = (float)$_POST['LUB_PER_LTR'] ;
        $date = $_POST['date'] ;

		$query = "call `add_incoming_stock`('$date', '$HSD_LTR', '$PMG_LTR', '$LUB_LTR', '$HSD_PER_LTR', '$PMG_PER_LTR', '$LUB_PER_LTR')";

		if ($queryResult = mysqli_query($conn,$query)){
			$returnMsg =  "<b>Incoming stock</b> Done" ;
			$label = "white" ;
		}
		else{
			die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
		}

		@mysqli_free_result($queryResult);
		
	}
	else{
		$returnMsg = "Incoming Stock " . $returnMsg ;
		$label = "red" ;
	}
}


/*For changing rate*/
if (isset($_POST['change_rate'])){

	$returnLocation = "../summary.php" ;

	$returnMsg = validate_today_rate($_POST);

	if (empty($returnMsg)){
		$HSD_PER_LTR = (float)$_POST['HSD_PER_LTR'] ;
		$PMG_PER_LTR = (float)$_POST['PMG_PER_LTR'] ;
		$LUB_PER_LTR = (float)$_POST['LUB_PER_LTR'] ;
		$P_HSD_PER_LTR = (float)$_POST['P_HSD_PER_LTR'] ;
		$P_PMG_PER_LTR = (float)$_POST['P_PMG_PER_LTR'] ;
		$P_LUB_PER_LTR = (float)$_POST['P_LUB_PER_LTR'] ;


		$query = "call update_oil_rate('$HSD_PER_LTR', '$PMG_PER_LTR', '$LUB_PER_LTR', '$P_HSD_PER_LTR', '$P_PMG_PER_LTR', '$P_LUB_PER_LTR')";

		if ($queryResult = mysqli_query($conn,$query)){
			$returnMsg = "Rate successfully update";
			$label = "white";
			
		}
		else{
			die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
		}

		@mysqli_free_result($queryResult);
		
	}
}

/*Store Customer Care*/
if (isset($_POST['print'])){

	$returnLocation = "../customer_care.php" ;

	if (!empty($_POST['print']) && ( !empty($_POST['HSD_LTR']) || !empty($_POST['PMG_LTR']) || !empty($_POST['LUB_LTR']) || !empty($_POST['Other']) ) ){

		$Transaction_ID = (int)$_POST['Transaction_ID'];
		$name = (string)$_POST['name'] ;
		$HSD_LTR = (float)$_POST['HSD_LTR'] ;
		$HSD_PER_LTR = (float)$_POST['HSD_PER_LTR'] ;
		$PMG_LTR = (float)$_POST['PMG_LTR'] ;
		$PMG_PER_LTR = (float)$_POST['PMG_PER_LTR'] ;
		$LUB_LTR = (float)$_POST['LUB_LTR'] ;
		$LUB_PER_LTR = (float)$_POST['LUB_PER_LTR'] ;
		$Other = (float)$_POST['Other'] ;
		$date = (string)$_POST['date'] ;
		


		$query = "call add_customer_care('$Transaction_ID', '$name', '$HSD_LTR', '$HSD_PER_LTR', '$PMG_LTR', '$PMG_PER_LTR', '$LUB_LTR', '$LUB_PER_LTR', '$Other', '$date')";

		if ($queryResult = mysqli_query($conn,$query)){
			$returnMsg = "Successful" ;
			$label = "green" ;
		}
		else{
			$returnMsg = "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn);
			$label = "red";
		}

		@mysqli_free_result($queryResult);
	}
	else{
		$returnMsg = "<b>Error: Please enter the data.</b>" ;
		$label = "red";
	}

	
}



@mysqli_close($conn);

header('Location: '.$returnLocation . '?returnMsg='.urlencode($returnMsg) .'&Label='.urlencode($label)  ) ;
exit();

?>
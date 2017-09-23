<?php 

require_once dirname(__FILE__)."/connection_inc.php";
require_once dirname(__FILE__)."/function_inc.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$returnMsg = "" ;
$returnLocation = "../meter_state_update.php" ;
$label = "" ;

/*Return Meter Status*/
if (isset($_POST['meter_state']) && !empty($_POST['meter_state']))
{
	$HSD = $_POST['HSD'];
	$PMG = $_POST['PMG'];
	$LUB = $_POST['LUB']; 

	$query = "UPDATE meter_state SET Remaining_HSD = '$HSD', Remaining_PMG = '$PMG', Remaining_LUB = '$PMG' " ;
	
	if ($queryResult = mysqli_query($conn,$query)){
		$returnMsg = "Meter status updated." ;
		$label = "#08b30d" ;
	}
	else{
		die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
	}
	@mysqli_free_result($queryResult);
}

@mysqli_close($conn);

header('Location: '.$returnLocation . '?returnMsg='.urlencode($returnMsg) .'&Label='.urlencode($label)  ) ;
exit();

?>
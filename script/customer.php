<?php 

require_once dirname(__FILE__)."/connection_inc.php";
require_once dirname(__FILE__)."/function_inc.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$returnMsg = "" ;
$returnLocation = "../new_account.php" ;
$label = "red" ;

if (isset($_POST['add_new'])){

	$returnMsg = validate_new_account($_POST) ;
	
	if (empty($returnMsg)){
		
		$type = (string)$_POST['type'] ;
		$name = (string)$_POST['name'] ;
		$v_number = (string)$_POST['v_number'] ;
		$CNIC = (string)$_POST['CNIC'] ;
		$address = (string)$_POST['Address'] ;
		$phone = (string)$_POST['Phone'] ;
        $date = (string)$_POST['date'];

        $query = "call add_customer ('$type','$name','$v_number','$phone','$address','$CNIC','$date')" ;

        if ($queryResult = mysqli_query($conn,$query)){
        	$returnMsg = "Account created successfully." ;
        	$label = "white" ;
		}
		else{
			die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
		}

		@mysqli_free_result($queryResult);
		@mysqli_close($conn);
		
	}
}

header('Location: '.$returnLocation . '?returnMsg='.urlencode($returnMsg) .'&Label='.urlencode($label)  ) ;
exit();

?>
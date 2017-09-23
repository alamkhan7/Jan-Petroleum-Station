<?php 

session_start();
function loggedin()
{
	if (isset($_SESSION['authentication']) )
		return true ;
	else
		return false ;
}

function validate_daily_sale($data)
{
	$errorMsg = "" ;

	if ( (empty($data['HSD_LTR']) && empty($data['PMG_LTR']) &&  empty($data['LUB_LTR'])) || empty($data['date']) ){
		return $errorMsg = "<b>Error:</b> Please enter the data." ;
	}
	else{
		return $errorMsg ;
	}
}

function validate_new_account($data)
{
	$errorMsg = "" ;

	if ( empty($data['type']) ){
		return $errorMsg = "<b>Error:</b> Please select customer type." ;
	}
	elseif ( $data['type'] == 'V' && empty($data['v_number']) && empty($errorMsg) ){
		return $errorMsg = "<b>Error:</b> Please enter vehicle number." ;
	}
	elseif (empty($data['name']) && empty($errorMsg) ){
		return $errorMsg = "<b>Error:</b> Please enter customer name." ;
	}
	elseif (empty($data['date']) && empty($errorMsg) ){
		return $errorMsg = "<b>Error:</b> Please enter date." ;
	}
}

function validate_today_rate($data)
{
	$errorMsg = "" ;

	if ( !is_numeric($data['HSD_PER_LTR']) ){
		return $errorMsg = "<b>Error:</b> Please enter correct value of HSD." ;
	}
	elseif ( !is_numeric($data['PMG_PER_LTR']) && empty($errorMsg) ){
		return $errorMsg = "<b>Error:</b> Please enter correct value of PMG." ;
	}
	elseif (!is_numeric($data['LUB_PER_LTR']) && empty($errorMsg) ){
		return $errorMsg = "<b>Error:</b> Please enter correct value of LUB" ;
	}
}

function return_total($query)
{
    include dirname(__FILE__).'/connection_inc.php';

    $returnData = array('totalRecord' => 0,
                        'errorMsg' => NULL
                        );
    

    if ($result = mysqli_query($conn, $query)) {

        if (mysqli_num_rows($result) > 0){
            $returnData['totalRecord'] = mysqli_num_rows($result) ;
        }
        else{
            $returnData['errorMsg'] = "Sorry! Record not found." ;
        }
    }
    else{
        $returnData['errorMsg'] = "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn)  ;
    }

    @mysqli_free_result($result);
    mysqli_close($conn);
    return $returnData ;
}

?>
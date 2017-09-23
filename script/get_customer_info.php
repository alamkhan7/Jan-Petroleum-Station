<?php 

require_once dirname(__FILE__)."/connection_inc.php";
require_once dirname(__FILE__)."/function_inc.php";

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$returnMsg = "" ;
$returnLocation = "" ;
$label = "" ;

$ErrorMsg = "" ;
$color = "rgb(255, 255, 255)";


$customer_ID = '' ;
$type = 'N/A' ;
$Name = 'N/A' ;
$Vehicle_NO = 'N/A' ;
$Phone_No = 'N/A' ;
$Address = 'N/A' ;
$CNIC = 'N/A' ;  			
$Date = 'N/A' ;

$Transaction_ID = "";
$Customer_Name = "";
$HSD = "";
$OLD_HSD_Rate = "";
$PMG = "";
$OLD_PMG_Rate = "";
$LUB = "";  
$OLD_LUB_Rate = "";
$Others = "";
$Time = "";
$OLDHSDTotal = 0;
$OLDPMGTotal = 0;
$OLDLUBTotal = 0;
$Total = 0;


$HSDTotal = 0 ;
$PMGTotal = 0 ;
$LUBTotal = 0 ;
$OthersTotal = 0 ;  			
$ReturnedTotal = 0 ;
$NETTotal = 0 ;
$Remaining_Balance = 0 ;

/* return customer information which have account in Station */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && !empty($_POST['CNIC']) ){

	$SearchCNIC = mysqli_real_escape_string($conn,$_POST['CNIC']);

  	/*First check record exist or not*/
  	$query = "SELECT * FROM customer_info_view Where CNIC='$SearchCNIC' " ;
  
  	if ($queryResult = mysqli_query($conn,$query)){

  		if (mysqli_num_rows($queryResult) > 0){

  			$row = mysqli_fetch_assoc($queryResult) ;
  			
  			$customer_ID = $row['customer_ID'];
  			$type = ($row['type']=='C') ? "Customer" : "Vehicle" ;
  			$Name = $row['Name'];
  			$Vehicle_NO = $row['Vehicle_NO'];
  			$Phone_No = $row['Phone_No'];
  			$Address = $row['Address'];
  			$CNIC = $row['CNIC'];  			
  			$Date = $row['Date'];

        /* Remaining Balance View */

        $query = "SELECT * FROM remaining_balance_view where ID='$customer_ID' " ;
  
        if ($queryResult = mysqli_query($conn,$query)){

          if (mysqli_num_rows($queryResult) > 0){
            
            $row = mysqli_fetch_assoc($queryResult) ;
            $Remaining_Balance = $row['Remaining_Balance'] ;
          }

        }
        else{
          die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
        }

        @mysqli_free_result($queryResult);

  		}
  		else{
  			$returnMsg = "<b>Record not found!<b/>";
        $label = "red" ;
  		}		
	}
	else{
		$returnMsg = "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn);
    $label = "red" ;
	}

	@mysqli_free_result($queryResult);
}

/* return customer-care information which have don't have account in Station */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && !empty($_POST['transaction_id']) ){

  $transaction_id = mysqli_real_escape_string($conn,$_POST['transaction_id']);

    /*First check record exist or not*/
    $query = "SELECT * FROM customer_care Where Transaction_ID='$transaction_id' " ;
  
    if ($queryResult = mysqli_query($conn,$query)){

      if (mysqli_num_rows($queryResult) > 0){

        $row = mysqli_fetch_assoc($queryResult) ;
        
        $Transaction_ID = $row['Transaction_ID'];
        $Customer_Name = $row['Customer_Name'];
        $HSD = $row['HSD'];
        $OLD_HSD_Rate = $row['HSD_Rate'];
        $PMG = $row['PMG'];
        $OLD_PMG_Rate = $row['PMG_Rate'];
        $LUB = $row['LUB'];       
        $OLD_LUB_Rate = $row['LUB_Rate'];
        $Others = $row['Others'];       
        $Time = $row['Time'];
        $datePart = implode('-',array_reverse(explode('-',substr($Time,0,9))));
        $timePart = date_format(date_create(substr($Time,11)), 'h:m:s A');
        $Time = $datePart . " " . $timePart ;

        $OLDHSDTotal = $HSD * $OLD_HSD_Rate;
        $OLDPMGTotal = $PMG * $OLD_PMG_Rate;
        $OLDLUBTotal = $LUB * $OLD_LUB_Rate;
        $Total = $OLDHSDTotal + $OLDPMGTotal + $OLDLUBTotal + $Others;
      }
      else{
        $returnMsg = "Record not found!" ;
        $label = "red" ;
      }
    }  
    else{
      die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
    }
  @mysqli_free_result($queryResult);
}

/*Return Meter Status*/
{
  $HSD_Rate = 0 ;
  $PMG_Rate = 0 ;
  $LUB_Rate = 0 ;
  $remainHSD = 0 ;
  $remainPMG = 0 ;
  $remainLUB = 0 ;

  $query = "SELECT * FROM `meter_state` " ;
  if ($queryResult = mysqli_query($conn,$query)){

    if (mysqli_num_rows($queryResult) > 0){
      
      $row = mysqli_fetch_assoc($queryResult) ;
      $HSD_Rate = $row['HSD_PER_LTR_SALE'];
      $PMG_Rate = $row['PMG_PER_LTR_SALE'];
      $LUB_Rate = $row['LUB_PER_LTR_SALE'];
      $HSD_Purc = $row['HSD_PER_LTR_PURC'];
      $PMG_Purc = $row['PMG_PER_LTR_PURC'];
      $LUB_Purc = $row['LUB_PER_LTR_PURC'];
      $remainHSD = $row['Remaining_HSD'] ;
      $remainPMG = $row['Remaining_PMG'] ;
      $remainLUB = $row['Remaining_LUB'] ;
    }
    else{
      $ErrorMsg = "Meter status not found" ;
      $color = "#fcff23" ;
    }
  
  }
  else{
    die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
  }
  @mysqli_free_result($queryResult);
}

/*Return Daily Report*/
{
  $todayReportID = 0;
  $todayProfit = 0 ;
  $todaysale = 0 ;
  $remainingBalance = 0 ;
  $newStock = 0 ;
  $totalDaily = 0 ;

  $todayDate = date('Y-m-d') ;

  $query = "SELECT * FROM `daily_summary_view` WHERE `Date` = '$todayDate' " ;
  if ($queryResult = mysqli_query($conn,$query)){

    if (mysqli_num_rows($queryResult) > 0){
      
      $row = mysqli_fetch_assoc($queryResult) ;
      $todayReportID = number_format($row['daily_report_ID'],2) ;
      $todayProfit = number_format($row['Today_Profit'],2) ;
      $todaysale = $row['Today_Sale'] ;
      $remainingBalance = $row['Remaining_Balance'] ;
      $newStock = $row['Incoming_Stock'] ;

      if ($todayReportID==1){
        $remainingBalance = $row['Current_Day_Remaining'] ;
        $totalDaily = $newStock;
      }
      else{
        $remainingBalance = $remainingBalance - $todaysale;
        $totalDaily = $remainingBalance + $newStock;
      }

      $todaysale = number_format($todaysale,2);
      $remainingBalance = number_format($remainingBalance,2);
      $newStock = number_format($newStock,2);
      $totalDaily = number_format($totalDaily,2);


    }

  }
  else{
    die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
  }
  @mysqli_free_result($queryResult);

  $todayDebt = 0;
  $todayReturn = 0;

  $query = "SELECT * FROM `today_debt_view` WHERE `Today` = '$todayDate' " ;
  if ($queryResult = mysqli_query($conn,$query)){
    if (mysqli_num_rows($queryResult) > 0){
      $row = mysqli_fetch_assoc($queryResult) ;
      $todayDebt = $row['Today_Debt'];
      $todayReturn = $row['Today_Return'];
    } 
  }
  else{
    die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
  }
  @mysqli_free_result($queryResult);
}

/*Return Monthly Report*/
{
  $monthlyProfit = 0 ;
  $monthlySale = 0 ;
  $totlMonthlyIncome = 0 ;
  $totalReturnDebt = 0 ;
  $totalRemainingDebt = 0 ;

  $currentMonth = date("Y-m-")."__" ;

  $query = "SELECT DISTINCT CONCAT(YEAR(`date`),'-',MONTH(`date`)) AS `Month`,
        SUM(Today_Profit) As `Total_Profit`,
        SUM(Today_Sale) As `Total_Sale`,
        SUM(Incoming_Stock) As `Total_Income`
        FROM `daily_report`
        Where `Date` LIKE '$currentMonth'" ;
  if ($queryResult = mysqli_query($conn,$query)){

    if (mysqli_num_rows($queryResult) > 0){
      
      $row = mysqli_fetch_assoc($queryResult) ;
      $monthlyProfit = number_format($row['Total_Profit'],2) ;
      $monthlySale = number_format($row['Total_Sale'],2) ;
      $totlMonthlyIncome = number_format($row['Total_Income'],2) ;
    }
  
  }
  else{
    die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
  }
  @mysqli_free_result($queryResult);

  $query = "SELECT DISTINCT
            `Date`,
            SUM(Return_Amount) As `Total_return`
            FROM `customer_history`
            WHERE `Date` LIKE '$currentMonth'" ;
  if ($queryResult = mysqli_query($conn,$query)){

    if (mysqli_num_rows($queryResult) > 0){
      
      $row = mysqli_fetch_assoc($queryResult) ;
      $totalReturnDebt = number_format($row['Total_return'],2) ;
    }
    else{
      $totalReturnDebt = number_format(00.00,2);
    }
  
  }
  else{
    die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
  }
  @mysqli_free_result($queryResult);

  $query = "SELECT Total_remaining_Debt FROM total_remaining_debt_view" ;
  if ($queryResult = mysqli_query($conn,$query)){

    if (mysqli_num_rows($queryResult) > 0){
      
      $row = mysqli_fetch_assoc($queryResult) ;
      $totalRemainingDebt = number_format($row['Total_remaining_Debt'],2) ;
    }
    else{
      $totalRemainingDebt = number_format(00.00,2) ;
    }
  
  }
  else{
    die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
  }
  @mysqli_free_result($queryResult);
}

/*Return New Transaction ID*/
{
  $newTransactionID = 1 ;

  $query = "SELECT MAX(Transaction_ID)+1 AS 'NEW_ID' FROM customer_care" ;
  if ($queryResult = mysqli_query($conn,$query)){

      $row = mysqli_fetch_assoc($queryResult) ;
      $newTransactionID = $row['NEW_ID'];
      if ($newTransactionID == 0)
        $newTransactionID = 1;
  
  }
  else{
    die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
  }
  @mysqli_free_result($queryResult);
}


@mysqli_close($conn);


?>
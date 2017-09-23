<?php 
require_once dirname(__FILE__)."/connection_inc.php";
require_once dirname(__FILE__)."/function_inc.php";
require_once dirname(__FILE__).'/vendor/autoload.php';

date_default_timezone_set('Asia/Karachi');

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$returnMsg = "Please enter Name/CNIC" ;
$returnLocation = "../debt_view.php" ;
$label = "red" ;

if( isset($_POST['date']) && !empty($_POST['CNIC']) && !empty($_POST['submit']) && !empty($_POST['CSID']) ){

	$date =implode("-" , array_reverse(explode("-",$_POST['date']))) . "-__";
	$customer_ID = $_POST['CSID'];
	$CNIC = $_POST['CNIC'] ;

	$query = "SELECT * FROM ledge_history_view WHERE customer_ID = '$customer_ID' AND `Date` LIKE '$date' " ;
	$totalRecord = return_total($query) ;

	if (empty($totalRecord['errorMsg']) ){
		
		if ($queryResult = mysqli_query($conn, $query)) {
			
			/*Genereate Template*/
			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template/DebtTemplate.docx');
			$templateProcessor->cloneRow('no', $totalRecord['totalRecord']);

			$rowNo = 1;
			$HSDTotal = 0;
			$PMGTotal = 0;
			$LUBTotal = 0;
			$OthersTotal = 0;
			$ReturnedTotal = 0;
			$NETTotal = 0;

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

	            $Others= number_format($Others,2);
	            $NET = number_format($NET,2);
	            $Returned = number_format($Returned,2);

	            // Populate Table
				{
					$templateProcessor->setValue('no#'.$rowNo, $rowNo);
					$templateProcessor->setValue('date#'.$rowNo, $legdeDate);
					$templateProcessor->setValue('hsd#'.$rowNo, $HSD);
					$templateProcessor->setValue('hsdRate#'.$rowNo, $HSD_Rate);
					$templateProcessor->setValue('pmg#'.$rowNo, $PMG);
					$templateProcessor->setValue('pmgrate#'.$rowNo, $PMG_Rate);
					$templateProcessor->setValue('lub#'.$rowNo, $LUB);
					$templateProcessor->setValue('lubrate#'.$rowNo, $LUB_Rate);
					$templateProcessor->setValue('others#'.$rowNo, $Others);
					$templateProcessor->setValue('net#'.$rowNo, $NET);
					$templateProcessor->setValue('return#'.$rowNo, $Returned);
				}

				$rowNo++ ;
			} /*End Of While Loop*/

			$templateProcessor->setValue('type',$_POST['type']);
			$templateProcessor->setValue('name',$_POST['name']);
			$templateProcessor->setValue('cnic',$CNIC);
			$templateProcessor->setValue('contact',$_POST['phone']);
			$templateProcessor->setValue('R_Balance',number_format($_POST['rbalance'],2));
			$templateProcessor->setValue('Reportdate',$_POST['date']);
			$templateProcessor->setValue('thsd',$HSDTotal);
			$templateProcessor->setValue('tpmg',$PMGTotal);
			$templateProcessor->setValue('tlub',$LUBTotal);
			$templateProcessor->setValue('to',$OthersTotal);
			$templateProcessor->setValue('tnet',$NETTotal);
			$templateProcessor->setValue('treturn',$ReturnedTotal);

			@mysqli_free_result($queryResult);
			@mysqli_close($conn);

			header('Content-Type: application/octet-stream');
			header("Content-Disposition: attachment; filename="."Testt".".docx");


			// $templateProcessor->saveAs('results/Sample_23_TemplateBlock.docx');
			$templateProcessor->saveAs('php://output');

	

		}
		else{
			die( "<b>Sorry:</b> Software problem (Contact with Teachnition) " . mysqli_error($conn) );
		}

		
	}
	else{
		$returnMsg = $totalRecord['errorMsg'] ;
		$label = "red" ;
	}

}

@mysqli_free_result($queryResult);
@mysqli_close($conn);

@header('Location: '.$returnLocation . '?returnMsg='.urlencode($returnMsg) .'&Label='.urlencode($label)  ) ;
exit();


?>
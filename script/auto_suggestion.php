<?php 

require_once dirname(__FILE__)."/connection_inc.php";
require_once dirname(__FILE__)."/function_inc.php";


if(isset($_GET['term']) && !empty($_GET['term'])){

	//get search term
    $searchTerm = mysqli_real_escape_string($conn,$_GET['term']) ;
    
    // 2-D Array
    $data = array(array());
    /*Remove empty element*/
    array_pop($data);       
    
    if ( preg_match("/\\d/",$searchTerm) ){
        /* If they searchTerm have numric value then search base is Employee_Code */
        
        $query = ("SELECT Name, CNIC FROM `customer` WHERE CNIC LIKE '%".$searchTerm."%' OR Vehicle_NO LIKE '%".$searchTerm."%' ");
        //get matched data from skills table
        if($query_result = mysqli_query($conn,$query)){
        
            while ($row = mysqli_fetch_assoc($query_result)){
                $CNIC = $row['CNIC'] ;
                $Name = $row['Name'] ;
                $new  = array('label' => $Name, 'value' => $CNIC );
                array_push($data, $new) ;
            }
        }
        else{
            $new  = array('label' => 'Software Problem!', 'value' => '' );
            array_push($data, $new) ;
        }
    }
    else{
        $query = ("SELECT Name, CNIC FROM `customer` WHERE Name LIKE '%".$searchTerm."%' ");
        //get matched data from skills table
        if($query_result = mysqli_query($conn,$query)){
        
            while ($row = mysqli_fetch_assoc($query_result)){
				$CNIC = $row['CNIC'] ;
                $Name = $row['Name'] ;
                $new  = array('label' => $Name, 'value' => $CNIC );
                array_push($data, $new) ;
            }
        }
        else{
            $new  = array('label' => 'Software Problem!', 'value' => '' );
            array_push($data, $new) ;
        }
    }
    //return json data
    echo json_encode($data);
}

?>
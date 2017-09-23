<?php
require_once dirname(__FILE__)."/connection_inc.php";
require_once dirname(__FILE__)."/function_inc.php";

ob_start();
session_start();

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$returnMsg = "" ;
$returnLocation = "../login_page.php" ;

if(isset($_POST['submit']) )
{
  if(isset($_POST['username']) || isset($_POST['password']) )
  {
    $username = $_POST['username'] ;
    $password = $_POST['password'] ;

    if(!empty($username) || !empty($password))
    {
      if($username === "alam" && $password==="1234"){
        $_SESSION['authentication'] = true ;
        session_write_close();
        $returnLocation = "../summary.php";
      }
      else
        $returnMsg = "Invalid ID/Password";
    }
    else
      $returnMsg = "Please fill ID/Password";
  }
  
 
}
@mysqli_close($conn);
header('Location: '.$returnLocation . '?returnMsg='.urlencode($returnMsg) ) ;
exit();

?>
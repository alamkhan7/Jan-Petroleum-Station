<?php

session_start();
$going_back = $_SERVER['HTTP_REFERER'] ;

if ( isset( $_COOKIE[ session_name() ] ) ) {
	setcookie( session_name(), "", time()-3600, "/" );
}
$_SESSION = array();
session_destroy();



header('Location: '.$going_back);
exit();

?>

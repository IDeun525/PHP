<?php
	session_start();
	$session_username = $_SESSION[ 'username' ];
	if ( is_null( $session_username ) ) {
		header( 'Location:member/login.php' );
	}
?>

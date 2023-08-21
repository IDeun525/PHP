<?php
	require $_SERVER['DOCUMENT_ROOT']."/require/check_session.php";
        if ( !is_null( $session_username) ) {
                header( 'Location: /member/login_ok.php' );
        }

?>

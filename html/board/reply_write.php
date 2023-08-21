<?php
        session_start();
        $session_username = $_SESSION[ 'username' ];
        if ( is_null( $session_username ) ) {
                session_destroy();
                header( 'Location: login.php' );
        }

        $num = $_GET['num'];
        $reply_content = $_POST[ 'reply_content' ];
        $reply_date = shell_exec('date +%D');

        if ( !($reply_content == '') ) {
                $conn = mysqli_connect( '192.168.10.129', 'loguser', '1', 'log' );
                $reply_write_sql = "insert into reply ( reply_num, board_num, reply_content, reply_writer, reply_date) values ('', '$num', '$reply_content', '$session_username', '$reply_date');";
                mysqli_query( $conn, $reply_write_sql );
                header( "Location:detail.php?num=".$num);
        } else {
                header( "Location:detail.php?num=".$num);
        }

?>


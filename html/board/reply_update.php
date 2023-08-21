<?php
        session_start();
        $session_username = $_SESSION[ 'username' ];
        if ( is_null( $session_username ) ) {
                session_destroy();
                header( 'Location: login.php' );
        }

        $num = $_GET['num'];
        $reply_num = $_GET['reply_num'];

        $jb_conn = mysqli_connect( '192.168.10.129', 'loguser', '1', 'log' );
        $jb_sql_writer = "select reply_writer from reply where reply_num='$reply_num';";
        $jb_result_writer = mysqli_query( $jb_conn, $jb_sql_writer );
        $jb_row_writer = mysqli_fetch_array( $jb_result_writer );
        $writer = $jb_row_writer[ 'reply_writer' ];

        if ( $writer == $session_username or "king" == $session_username ) {
                $pass1 = 1;
        } else {
                $pass1 = 2;
        }


        $password = $_POST['password'];
        if ( !is_null( $password )) {
                if ( "king" == $session_username ) {
                        $sqlkp = "select password from member where username = 'king';";
                        $resultkp = mysqli_query( $jb_conn, $sqlkp );
                        $rowkp = mysqli_fetch_array( $resultkp );
                        $kp = $rowkp[ 'password' ];
                        if ( $kp == sha1( $password ) ) {
                                $pass1 = 3;
                                $pass2 = 1;
                        } else {
                                $pass1 = 3;
                                $pass2 = 2;
                        }
                }
                if ( $writer == $session_username ) {
                        $sqlwp = "select password from member where username = '$writer';";
                        $resultwp = mysqli_query( $jb_conn, $sqlwp );
                        $rowwp = mysqli_fetch_array( $resultwp );
                        $wp = $rowwp[ 'password' ];
                        if ( $wp == sha1( $password ) ) {
                                $pass1 = 3;
                                $pass2 = 1;
                        } else {
                                $pass1 = 3;
                                $pass2 = 2;
                        }
                }
        }


        $new_reply_content = $_POST[ 'new_reply_content' ];
        $new_date = shell_exec('date +%D');

        if (!is_null( $new_reply_content )) {
                $sql_reply_update = "update reply set reply_content='$new_reply_content', reply_redate ='$new_date' where reply_num='$reply_num';";
                mysqli_query( $jb_conn, $sql_reply_update );
                header("Location:detail.php?num=".$num);
        }
?>


<!doctype html>
<html lang="ko">
        <head>
                <meta charset="utf-8">
                <title>수정</title>
                <style>
                        body {
                                font-family: Consolas, monospace;
                                font-family: 12px;
                        }
                </style>
        </head>
        <body>
                <?php
                        if( $pass2 == 1) {
                ?>
                                <div1 style="text-align:right;">
                                        <h2>Login Account : <?php echo $session_username; ?></h2>
                                </div1>
                                        <a href="logout.php" ><button style="float:right;">로그아웃</button></a>
                                <div>
                                        <h1> 댓글 수정 <hr> </h1>
                                </div1>
                                <form action="reply_update.php?num=<?php echo $num; ?>&reply_num=<?php echo $reply_num; ?>" method="POST">
                                <?php
                        		$reply_sql = "SELECT * FROM reply where board_num='$num' and reply_num='$reply_num';";
                        		$reply_result = mysqli_query( $jb_conn, $reply_sql );
                                        $reply_row = mysqli_fetch_array( $reply_result );
                                	echo '<h4> 작성자 : ' .$reply_row[ 'reply_writer' ].
                                        	'  작성일 : ' .$reply_row[ 'reply_date' ].'</h4>';
                                        echo '<h4> 내용 <textarea name="new_reply_content">' .$reply_row[ 'reply_content' ]. '</textarea></h4>';

                                ?>
                                        <button name="check"> 수정 </button>
                                </form>
                                <a href="detail.php?num=<?php echo $num; ?>"><button>돌아가기</button></a>
                <?php
                        }
                ?>

                <?php
                        if( $pass2 == 2) {
                ?>
                                <div1 style="text-align:right;">
                                        <h2>Login Account : <?php echo $session_username; ?></h2>
                                </div1>
                                        <a href="logout.php" ><button style="float:right;">로그아웃</button></a>
                                <div>
                                        <h1> 비밀번호 확인 <hr> </h1>
                                </div1>
                                <p>비밀번호가 일치하지 않습니다.</p>
                                <a href="detail.php?num=<?php echo $num; ?>"><button class="btn btn-dark">돌아가기</button></a>
                <?php
                        }
                ?>


                <?php
                        if( $pass1 == 2) {
                ?>
                                <div1 style="text-align:right;">
                                        <h2>Login Account : <?php echo $session_username; ?></h2>
                                </div1>
                                        <a href="logout.php" ><button style="float:right;">로그아웃</button></a>
                                <div>
                                        <h1> 댓글 수정 <hr> </h1>
                                </div1>
                                <p>수정 권한이 없습니다.</p>
                                <a href="detail.php?num=<?php echo $num; ?>"><button class="btn btn-dark">돌아가기</button></a>
                <?php
                        }
                ?>

                <?php
                        if( $pass1 == 1 and $pass2==0) {
                ?>
                                <div1 style="text-align:right;">
                                        <h2>Login Account : <?php echo $session_username; ?></h2>
                                </div1>
                                        <a href="logout.php" ><button style="float:right;">로그아웃</button></a>
                                <div>
                                        <h1> 비밀번호 확인 <hr> </h1>
                                </div1>

                                <form action="reply_update.php?num=<?php echo $num; ?>&reply_num=<?php echo $reply_num; ?>" method="POST">
                                        <p><input type="password" name="password" placeholder="비밀번호" required></p>
                                        <button> 입력 </button>
                                </form>
                                        <a href="detail.php?num=<?php echo $num; ?>"><button>돌아가기</button></a>
                <?php
                        }
                ?>

</body>
<html>


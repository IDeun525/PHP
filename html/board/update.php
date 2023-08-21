<?php
        session_start();
        $session_username = $_SESSION[ 'username' ];
        if ( is_null( $session_username ) ) {
                session_destroy();
                header( 'Location: login.php' );
        }

        $num = $_GET['num'];

        $jb_conn = mysqli_connect( '192.168.10.129', 'loguser', '1', 'log' );
        $jb_sql_writer = "select writer from board where num='$num';";
        $jb_result_writer = mysqli_query( $jb_conn, $jb_sql_writer );
        $jb_row_writer = mysqli_fetch_array( $jb_result_writer );
        $writer = $jb_row_writer[ 'writer' ];

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

        $new_title = $_POST[ 'new_title' ];
        $new_content = $_POST[ 'new_content' ];
        $new_date = shell_exec('date +%D');
        $new_notice = 0;
        if ( $_POST['new_notice'] == on ){
                $new_notice = 1;
        }
        if ( !is_null( $new_title ) and !is_null( $new_content )) {
                $sqlupdate = "update board set title='$new_title', content='$new_content', redate ='$new_date', notice='$new_notice' where num='$num';";
                mysqli_query( $jb_conn, $sqlupdate );
                $url = "detail.php?num=$num";
                header("Location:".$url);
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
                                        <h1> 게시글 수정 <hr> </h1>
                                </div1>
                                <form action="update.php?num=<?php echo $num; ?>" method="POST">
                                <?php
                                        $sqlsel = "SELECT * FROM board where num = '$num';";
                                        $resultsel = mysqli_query( $jb_conn, $sqlsel );
                                        $rowsel = mysqli_fetch_array( $resultsel );
                                        echo '<h4> 제목 <textarea name="new_title">' .$rowsel[ 'title' ]. '</textarea></h4>';
                                        echo '<h4> 작성자 : ' .$rowsel[ 'writer' ]. '</h4>';
                                        echo '<h4> 작성일 :' .$rowsel[ 'date' ]. '</h4>';
                                        echo '<h4> 수정일 :' .$rowsel[ 'redate' ]. '</h4>';
                                        echo '<h4> 내용 <textarea name="new_content">' .$rowsel[ 'content' ]. '</textarea></h4>';
                                        if ( $session_username == "king" ){
                                                if ( $rowsel[ 'notice' ] == 1 ) { ?>
                                                        <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="new_notice" checked >
                                                                        공지 등록
                                                                </div>
                                                <?php } else{ ?>
                                                        <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="new_notice">
                                                                공지 등록
                                                        </div>
                                                <?php
                                                }
                                        }
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
                                        <h1> 게시글 수정 <hr> </h1>
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

                                <form action="update.php?num=<?php echo $num; ?>" method="POST">
                                        <p><input type="password" name="password" placeholder="비밀번호" required></p>
                                        <button> 입력 </button>
                                </form>
                                        <a href="detail.php?num=<?php echo $num; ?>"><button>돌아가기</button></a>
                <?php
                        }
                ?>

</body>
<html>


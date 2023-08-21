<?php
        require $_SERVER['DOCUMENT_ROOT']."/require/check_session.php";
        require $_SERVER['DOCUMENT_ROOT']."/require/header.php";

        $num = $_GET['num'];

        $sql_writer = "select writer from board where num='$num';";
        $result_writer = mysqli_query( $db_conn, $sql_writer );
        $row_writer = mysqli_fetch_array( $result_writer );
        $writer = $row_writer[ 'writer' ];

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
                                $sqldel = "delete from board where num ='$num';";
                                mysqli_query( $jb_conn, $sqldel );
                                header( 'Location:board.php' );
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
                                $sqldel = "delete from board where num ='$num';";
                                mysqli_query( $jb_conn, $sqldel );
                                header( 'Location:board.php' );
                        } else {
                                $pass1 = 3;
                                $pass2 = 2;
                        }
                }
        }

?>

<!doctype html>
<html lang="ko">
        <body>
                <?php
                        if( $pass2 == 2) {
                ?>
                                <div>
                                        <h1> 비밀번호 확인 <hr> </h1>
                                </div1>
                                <p>비밀번호가 일치하지 않습니다.</p>
                                <a href="detail.php?num=<?php echo $num; ?>"><button class="btn btn-dark">돌아가기</button></a>
                <?php
                        }
                ?>

                <?php
                        if( $pass1 == 1 and $pass2==0) {
                ?>
                                <div>
                                        <h1> 비밀번호 확인 <hr> </h1>
                                </div1>
                                <form action="delete.php?num=<?php echo $num; ?>" method="POST">
                                        <p><input type="password" name="password" placeholder="비밀번호" required></p>
                                        <button> 입력 </button>
                                </form>
                <?php
                        }
                ?>

                <?php
                        if( $pass1 == 2) {
                ?>
                                <div>
                                        <h1> 게시글 삭제 <hr> </h1>
                                </div1>
                                <p>삭제 권한이 없습니다.</p>
                                <a href="detail.php?num=<?php echo $num; ?>"><button class="btn btn-dark">돌아가기</button></a>
                <?php
                        }
                ?>
        </body>
</html>


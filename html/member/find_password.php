<?php
	require $_SERVER['DOCUMENT_ROOT']."/require/db_conn.php";

	$pageset = 1;
	$username = $_POST[ 'username' ];
	$sql_user = "select * from member where username = '$username';";
	$result_user = mysqli_query( $db_conn, $sql_user );
	$row_user = mysqli_fetch_array( $result_user );
	$sel_user = $row_user[ 'username' ];
	$sel_fpq = $row_user[ 'fpq' ];
	$fpa = $_POST[ 'fpa' ];
	$password = $_POST[ 'password' ];
	$password_confirm = $_POST[ 'password_confirm' ];

	if ( !is_null( $username ) ) {
		$pageset = 2;
	}	
	if ( !is_null( $sel_user ) ) {
		$pageset = 3;
		if ( $sel_fpq == 1 ) {
			$fpq = "1번째 질문";
		}
	}
	if (!is_null( $fpa ) ) {
		$pageset = 4;
		$sql_fp = "SELECT * FROM `member` WHERE username='$username' AND fpq=$sel_fpq AND fpa='$fpa';";
		$result_fp = mysqli_query( $db_conn, $sql_fp );
		$row_fp = mysqli_fetch_array( $result_fp );
		if ( !is_null($row_fp['username']) ){
			$pageset = 5;
		}
	}

	if ( !is_null( $password ) ) {
		$pageset = 5;
		if ( $password == $password_confirm ) {
			$pageset = 6;			
			$sql_fpch = "update member set password=sha1('$password') where username='$username';";
			mysqli_query( $db_conn, $sql_fpch);
		}	
		$messageset = 1;
	}


?>

<!doctype html>
<html lang="ko">
        <head>
        <meta charset="utf-8">
                <title>비밀번호 찾기</title>
                <style>
                        body {
                                font-family: Consolas, monospace;
                                font-family: 12px;
                        }
                </style>
        </head>
        <body>
		<h1> 비밀번호 찾기 <hr> </h1>

		<?php 
			if( $pageset == 1 ) {
		?>
				<form action = "find_password.php" method="POST">
					사용자 이름 : <input type="text" name="username" required>
					<button> 조회 </button>
				</form>		
		<?php
			}
		?>

                <?php
                        if( $pageset == 2 ) {
                ?>
				<p> 조회 결과가 없습니다. <a href="find_password.php"><button>다시 조회하기</button></a></P>
                <?php
                        }
                ?>

                <?php
                        if( $pageset == 3 ) {
                ?>
                                <form action = "find_password.php" method="POST">
                                        사용자 이름 : <input type="text" value = <?php echo $username; ?> disabled>
					<input type="hidden" name ="username" value = <?php echo $username; ?>>
					<p><?php echo $fpq; ?></p>
					<input type="text" name="fpa">
                                        <button> 입력 </button>
                                </form>
                <?php
                        }
                ?>

                <?php
                        if( $pageset == 4 ) {
                ?>
				<p> 답이 일치하지 않습니다. </p>
				<a href="find_password.php"><button>다시 시도하기</button></a>
                <?php
                        }
                ?>

                <?php
                        if( $pageset == 5 ) {
                ?>
                                <form action = "find_password.php" method="POST">
                                        사용자 이름 : <input type="text" value = <?php echo $username; ?> disabled>
					<input type="hidden" name ="username" value = <?php echo $username; ?>>
		                        <p>변경 비밀번호 : <input type="password" name="password" required></p>
		                        <p>변경 비밀번호 확인 : <input type="password" name="password_confirm" required></p>
					<?php
						if ( $messageset == 1) {
					?>
							<p><span style='color:red;'>비밀번호가 일치하지 않습니다.</span></p>
					<?php
						}
					?>
					<button> 비밀번호 변경 </button>
				</form>
                <?php
                        }
                ?>

                <?php
                        if( $pageset == 6 ) {
                ?>
                                <p> 비밀번호를 변경하였습니다. </p>
                <?php
                        }
                ?>

	


		<p><hr></p>
		<p><a href="login.php"><button>돌아가기</button></a></p>
	</body>
</html>

<?php
	require $_SERVER['DOCUMENT_ROOT']."/require/check_session.php";
	require $_SERVER['DOCUMENT_ROOT']."/require/db_conn.php";
	$current_password = $_POST[ 'current_password' ];
	$new_password = $_POST[ 'new_password' ];
	$new_password_confirm = $_POST[ 'new_password_confirm' ];
	if ( !is_null( $current_password ) ) {
		$sqlpw = "SELECT password FROM member WHERE username = '$session_username';";
		$result = mysqli_query( $db_conn, $sqlpw );
		while ( $jb_row = mysqli_fetch_array( $result ) ) {
			$encrypted_password = $jb_row[ 'password' ];
		}
		if ( sha1($current_password) == $encrypted_password ) {
			if ( $new_password == $new_password_confirm ) {
				$jb_sql_change_password = "UPDATE member SET password = sha1('$new_password') WHERE username = '$session_username';";
				mysqli_query( $jb_conn, $jb_sql_change_password );
				header( 'Location:change_password_ok.php' );
			} else {
				$wp2 = 1;
			}
		} else {
			$wp1 = 1;
		}
	}
?>

<!doctype html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<title>비밀번호 변경</title>
                <style>
                        body {
                                font-family: Consolas, monospace;
                                font-family: 12px;
                        }
                </style>
	</head>
	<body>
                <div1 style="text-align:right;">
                        <h2>Login Account : <?php echo $session_username; ?></h2>
                </div1>
                        <a href="logout.php" ><button style="float:right;">로그아웃</button></a>
		<div>
			<h1> 비밀번호 변경 <hr> </h1>
                </div1>
		<form action="change_password.php" method="POST">
			<p><input type="password" name="current_password" placeholder="현재 비밀번호" required></p>
			<p><input type="password" name="new_password" placeholder="새 비밀번호" required></p>
			<p><input type="password" name="new_password_confirm" placeholder="새 비밀번호 확인" required></p>
			<p><input type="submit" value="비밀번호 변경"></p>
			<?php
				if ( $wp1 == 1 ) {
					echo "<p>현재 비밀번호가 틀렸습니다.</p>";
				}
				if ( $wp2 == 1 ) {
					echo "<p>새 비밀번호가 일치하지 않습니다.</p>";
				}
			?>
		</form>
		<div class="text-end mt-4">
			<a href="mypage.php"><button class="btn btn-dark">돌아가기</button></a>
		</div>
	</body>
</html>


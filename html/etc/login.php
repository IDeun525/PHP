<?php
	require $_SERVER['DOCUMENT_ROOT']."/require/check_session.php";
	require $_SERVER['DOCUMENT_ROOT']."/require/db_conn.php";

	$username = $_POST[ 'username' ];
	$password = $_POST[ 'password' ];

	if ( !is_null( $username ) ) {
		$sql = "SELECT password FROM member WHERE username = '$username';";
		$result = mysqli_query( $db_conn, $sql );
		while ( $row = mysqli_fetch_array( $result ) ) {
		$mysql_password = $jb_row[ 'password' ];
		}
		if ( is_null( $password ) ) {
			$wu = 1;
		} else {
			if ( sha1($password) == $mysql_password ) {
				session_start();
				$_SESSION[ 'username' ] = $username;
				header( 'Location:login_ok.php');	
			} else {
				$wp = 1;
			}
		}
	}
?>
<!doctype html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<title>로그인</title>
		<style>
			body { font-family: sans-serif; font-size: 14px; }
			input, button { font-family: inherit; font-size: inherit; }
		</style>
	</head>

	<body>
		<h1>로그인</h1>

		<form action="login.php" method="POST">
			<p><input type="text" name="username" placeholder="사용자이름" required></p>
			<p><input type="password" name="password" placeholder="비밀번호" required></p>
			<p><input type="submit" value="로그인"></p>

			<?php
				if ( $wu == 1 ) {
					echo "<p>사용자이름이 존재하지 않습니다.</p>";
				}
				if ( $wp == 1 ) {
					echo "<p>비밀번호가 틀렸습니다.</p>";
				}
			?>
		    </form>

		<div class="text-end mt-4">
			<a href="register.php"><button class="btn btn-dark">회원가입</button></a>
			<a href="find_password.php"><button class="btn btn-dark">비밀번호 찾기</button></a>
		</div>

	</body>
</html>

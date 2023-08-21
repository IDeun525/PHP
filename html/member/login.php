<?php
	require $_SERVER['DOCUMENT_ROOT']."/require/db_conn.php";

	$username = $_POST[ 'username' ];
	$password = $_POST[ 'password' ];

        if ( !is_null( $username ) ) {
                $sql = "select password from member where username = '$username';";
                $result = mysqli_query( $db_conn, $sql );

                while ( $row = mysqli_fetch_array( $result ) ) {
                	$mysql_password = $row[ 'password' ];
                }

                if ( is_null( $password ) ) {
                        $wu = 1;
                } else {
                        if ( sha1( $password ) == $mysql_password ) {
                                session_start();
                                $_SESSION[ 'username' ] = $username;
                                header( 'Location:/board/board.php');
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<style>
		#center {
			text-align:center;
		}
	</style>
</head>
<body>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

	<div class="container col-xl-10 col-xxl-8 px-4 py-5">
		<div class="col-md-10 mx-auto col-lg-5">
			<h1 align=center> LDEUN </h1>
			<br>
			<div class="p-4 p-md-5 border rounded-3 bg-light">
				<form action="login.php" method="POST">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="username" placeholder="사용자이름">
						<label for="floatingInput">사용자이름</label>
					</div>
					<div class="form-floating mb-3">
						<input type="password" class="form-control" id="floatingPassword" name="password" placeholder="비밀번호">
						<label for="floatingPassword">비밀번호</label>
					</div>
					<div class="checkbox mb-3">
						<label>
							<input type="checkbox" value="remember-me"> 사용자이름 기억 
						</label>
					</div>
					<?php
                                	if ( $wu == 1 ) {
                                        	echo "<p>사용자이름이 존재하지 않습니다.</p>";
                                	}
                                	if ( $wp == 1 ) {
                                        	echo "<p>비밀번호가 틀렸습니다.</p>";
                                	}
                        		?>
					<hr>
					<button class="w-100 btn btn-lg btn-primary" type="submit">로그인</button>
				</form>
				<br>
				<div id=center>
					<a href="register.php"><button class="btn btn-secondary">회원가입</button></a>
					<a href="find_password.php"><button class="btn btn-secondary">비밀번호 찾기</button></a>
				</div>
			</div>
		</div>
	</div>

  </body>
</html>

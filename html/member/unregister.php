<?php
	require $_SERVER['DOCUMENT_ROOT']."/require/check_session.php";
	require $_SERVER['DOCUMENT_ROOT']."/require/db_conn.php";
	
	$sqlpw = "select password from member where username='$session_username';";
	$result = mysqli_query( $db_conn, $sqlpw );
	$row = mysqli_fetch_array( $result );
	
	$pass = 1;	
	$password = $_POST[ 'password' ];
	if ( !is_null($password)){
		if ( $row[ 'password' ] == sha1($password) ){
			$pass = 3;
		} else {
			$pass = 2;
		}	
	}
	
	$check = '회원탈퇴';
	$unregister = $_POST[ 'unregister' ];
	if ( !is_null($unregister)){
		if ( $unregister == $check ){
			$pass = 4;
			$sqldel = "delete from member where username='$session_username';";
			mysqli_query( $db_conn, $sqldel );
			session_destroy();
		} else {
			$pass = 3;
			$pass2 = 1;
		}
	}
?>

<!doctype html>
<html lang="ko">
        <head>
                <meta charset="utf-8">
                <title>회원탈퇴</title>
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
                        <h1> 회원탈퇴 <hr> </h1>
		<?php
			if ( $pass == 1 ) {
				?>
				<form action="unregister.php" method="POST">
					<p><input type="password" name="password" placeholder="비밀번호" required></p>
					<button> 입력 </button>
				</form>
				<a href="mypage.php"><button>돌아가기</button></a>
				<?php
			}
		?>
		<?php
			if ( $pass == 2	){
				?>
				<p>비밀번호가 일치하지 않습니다.</p>
				<a href="mypage.php"><button>돌아가기</button></a>
				<?php
			}
		?>
                <?php
                        if ( $pass == 3 ){
                                ?>
				<p> 회원탈퇴를 하시겠습니까? </p>
				<p> 원하시면  <span style='color:red;'>회원탈퇴</span>를 입력해주세요. </p>
				<form action="unregister.php" method="POST">
					<p><input type="text" name="unregister" placeholder="회원탈퇴"><button> 입력 </button></p>
				</form>
				<?php
					if ($pass2 == 1 ) {
						?>
						<p><span style='color:red;'> 잘못입력하셨습니다. </span></p>
						<?php
						echo $unregister;
					}
				?>
                                <a href="mypage.php"><button>돌아가기</button></a>
                                <?php
                        }
                ?>

		<?php
                        if ( $pass == 4 ){
                                ?>
                                <p>회원탈퇴가 완료되었습니다.</p>
                                <a href="login.php"><button>돌아가기</button></a>
                                <?php
                        }
                ?>

	</body>
</html>

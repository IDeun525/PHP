<?php 
	require $_SERVER['DOCUMENT_ROOT']."/require/check_session.php";
	require $_SERVER['DOCUMENT_ROOT']."/require/db_conn.php";
?>

<!doctype html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<title>마이페이지</title>
	</head>
	<body>
		<?php
			include("base.php");
		?>
		<div>
			<h1> 마이페이지 <hr> </h1>
                </div1>

		<div class="text-end mt-4">
			<a href="membermodify.php"><button class="btn btn-dark">회원정보수정</button></a>
			<a href="change_password.php"><button class="btn btn-dark">비밀번호 변경</button></a>
			<a href="unregister.php"><button class="btn btn-dark">회원탈퇴</button></a>
			<a href="login_ok.php"><button class="btn btn-dark">돌아가기</button></a>
		</div>
	</body>
</html>


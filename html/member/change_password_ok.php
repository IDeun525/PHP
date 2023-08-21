<?php
	require $_SERVER['DOCUMENT_ROOT']."/require/check_session.php";
?>
<!doctype html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<title>비밀번호 변경</title>
		<style>
			body { font-family: sans-serif; font-size: 14px; }
			input, button { font-family: inherit; font-size: inherit; }
		</style>
	</head>
	<body>
		<h1><?php echo $session_username; ?>님, 비밀번호가 변경되었습니다.</h1>
		<a href="login_ok.php"><button class="btn btn-dark">돌아가기</button></a>
	</body>
</html>

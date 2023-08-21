<?php 
	require $_SERVER['DOCUMENT_ROOT']."/require/check_session.php";
	require $_SERVER['DOCUMENT_ROOT']."/require/db_conn.php";
?>

<!doctype html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<title>회원정보수정</title>
                <style>
                        body {
                                font-family: Consolas, monospace;
                                font-family: 12px;
                        }
                </style>
	</head>
	<body>
		<?php
			include("base.php");
		?>
		<div>
			<h1>회원정보수정<hr> </h1>
                </div>

		<div class="text-end mt-4">
			<a href="mypage.php"><button class="btn btn-dark">돌아가기</button></a>
		</div>
	</body>
</html>


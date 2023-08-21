<?php
	require $_SERVER['DOCUMENT_ROOT']."/require/check_session.php";
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
                <div1 style="text-align:right;">
                        <h2>Login Account : <?php echo $session_username; ?></h2>
                </div1>
                        <a href="logout.php" ><button style="float:right;">로그아웃</button></a>
                <div>
                        <h1>MAIN <hr> </h1>
                </div1>
                <a href="/board/board.php"><button class="btn btn-dark">게시판</button></a>
                <a href="/board/upload.php"><button>파일 저장소</button></a>
                <a href="mypage.php"><button>마이페이지</button></a>
	</body>
</html>

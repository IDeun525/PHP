<?php
	session_start();
	$session_username = $_SESSION[ 'username' ];
	if ( is_null( $session_username ) ) {
		session_destroy();
		header( 'Location: login.php' );
	}
	$title = $_POST[ 'title' ];
	$content = $_POST[ 'content' ];
	$date = shell_exec('date +%D');
        $notice = 0;
        if ( $_POST['notice'] == on ){
                $notice = 1;
        }
	if ( !($title == "")and !($content == "") ) {
		$jb_conn = mysqli_connect( '192.168.10.129', 'loguser', '1', 'log' );
		$jb_sql = "insert into board (title, content, writer, date, notice) values ('$title', '$content', '$session_username', '$date', '$notice');";
		mysqli_query( $jb_conn, $jb_sql );
		header( 'Location:board.php' ); 
	}

	if ($title == ""){
		$tm = 1;
	}
	if ($content == ""){
		$cm = 1;
	}
?>
<!doctype html>
<html lang="ko">
	<head>
	<meta charset="utf-8">
		<title>게시글 작성</title>
	</head>
	<body>
                <div1 style="text-align:right;">
                        <h2>Login Account : <?php echo $session_username; ?></h2>
                        <a href="logout.php" ><button style="float:right;">로그아웃</button></a>
                        <br><br>
                        <hr>
                </div1>
		<h1>게시글 작성</h1>
		<form action="write.php" method="POST">
			<div class="mb-3 mt-5">
				<label class="form-label">제목</label>
				<input type="text" name="title" class="form-control">
			</div>
			<div class="mb-3">
				<label class="form-label">내용</label>
				<textarea class="form-control" name="content" style="height: 150px;"></textarea>
				</div>
			<?php
                                if( $session_username == "king" ) { ?>
					<div class="form-check"><input class="form-check-input" type="checkbox" name="notice">공지 등록</div>
			<?php } ?>
			<div class="text-end mt-3">
				<button class="btn btn-dark">생성</button>
			</div>
		</form>
		
		<?php
		if( $tm == 1 ){
		?>
			<p><span style='color:red;'>제목을 입력해주세요.</span></p>
		<?php
		}
		?>

		<?php
		if( $cm == 1 ){
		?>
			<p><span style='color:red;'> 내용을 입력해주세요.</span></p>
		<?php
		}
		?>

		<div class="text-end mt-4">
			<a href="board.php"><button class="btn btn-dark">돌아가기</button></a>
		</div>
	</body>
</html>

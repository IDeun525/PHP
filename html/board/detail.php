<?php
        require $_SERVER['DOCUMENT_ROOT']."/require/check_session.php";
        require $_SERVER['DOCUMENT_ROOT']."/require/db_conn.php";
        require $_SERVER['DOCUMENT_ROOT']."/require/header.php";
?>
<!doctype html>
<html lang="ko">
	<head>
                <meta charset="utf-8">
                <title>자세히 보기</title>
        </head>
	<body>
	<div class="container">
		<?php
			$num = $_GET['num'];
			$page = isset($_GET["page"])? $_GET["page"] : 1;
			$sql = "SELECT * FROM board where num= '$num';";
			$result = mysqli_query( $db_conn, $sql );
			$row = mysqli_fetch_array( $result );
			$redate = $row[ 'redate' ];
                ?>

                <div>
                <?php
                        echo '<h1>' .$row[ 'title' ]. '<hr></h1>';
                ?>
                </div1>

                <?php
			echo '<h4> 작성자 : ' .$row[ 'writer' ]. '</h4>';
			echo '<h4> 작성일 :' .$row[ 'date' ]. '</h4>';
			if (!is_null($redate)) { 
			echo '<h4> 수정일 :' .$row[ 'redate' ]. '</h4>';
			}
			echo '<textarea disabled>' .$row[ 'content' ]. '</textarea>
			<br><br>';
			
		?>

		<p>
			<?php
				if ( $row[ 'writer' ] == $session_username or king == $session_username) {
			?>
					<a href="update.php?num=<?php echo $num; ?>"><button class="btn btn-dark">수정</button></a>
					<a href="delete.php?num=<?php echo $num; ?>"><button class="btn btn-dark">삭제</button></a>
			<?php
			} ?>
			<a href="board.php?page=<?php echo $page; ?>"><button class="btn btn-dark">돌아가기</button></a>
		</p>
		<br><br>
		<h3> Reply </h3>
		<form action="reply_write.php?num=<?php echo $num; ?>" method="POST">
                        <textarea class="form-control" name="reply_content"></textarea>
                        <button>댓글 달기</button>
		</form>
                <hr>
                <?php
                        $reply_sql = "SELECT * FROM reply where board_num='$num';";
                        $reply_result = mysqli_query( $db_conn, $reply_sql );
                        while ( $reply_row = mysqli_fetch_array( $reply_result )) {
                                $reply_num = $reply_row[ 'reply_num' ];
                                if (!is_null( $reply_row[ 'reply_redate' ] ) ) {
                                	echo '<h4> 작성자 : ' .$reply_row[ 'reply_writer' ].
                                        	'  작성일 : ' .$reply_row[ 'reply_date' ].
                                        	'  수정일 : ' .$reply_row[ 'reply_redate' ].'</h4>';
                                } else {
                                	echo '<h4> 작성자 : ' .$reply_row[ 'reply_writer' ].
                                        '  작성일 : ' .$reply_row[ 'reply_date' ].'</h4>';
                                }
				echo '<textarea disabled>' .$reply_row[ 'reply_content' ]. '</textarea>
				<a href="reply_update.php?num='.$num.'&reply_num='.$reply_num.'"><button>수정</button></a>
				<a href="reply_delete.php?num='.$num.'&reply_num='.$reply_num.'"><button>삭제</button></a>
				<br>';
                        }
                ?>
	
	</div>
	</body>
</html>

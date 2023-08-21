<?php
        session_start();
	$session_username = $_SESSION[ 'username' ];
        if ( is_null( $session_username ) ) {
                session_destroy();
                header( 'Location: login.php' );
        }
?>
<!doctype html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<title>파일 저장소</title>
		<style>
		</style>
	</head>
	<body>
		 <h1><?php echo $session_username; ?>님의 파일 저장소</h1>
<?php
        if ( $_POST[ "action" ] == "Upload" ) {
                $uploaded_file_name_tmp = $_FILES[ 'myfile' ][ 'tmp_name' ];
                $uploaded_file_name = $_FILES[ 'myfile' ][ 'name' ];
                $upload_folder = "/uploads/$session_username/";
                echo "<p>" . $upload_folder . "</p>";

                move_uploaded_file( $uploaded_file_name_tmp, $upload_folder .  $uploaded_file_name );
        }
  $data1 = shell_exec("ls -l /uploads/$session_username");
  echo "<pre> $data1 </pre>";
                echo "<p>" . $uploaded_file_name . "을(를) 업로드하였습니다.</p>";
?>
<form action="" method="POST" enctype="multipart/form-data">
        <p><input type="file" name="myfile"></p>
        <p><input type="submit" name="action" value="Upload"></p>
</form>
    <div class="text-end mt-4">
      <a href="login_ok.php"><button class="btn btn-dark">돌아가기</button></a>
    </div>
  </body>
</html>

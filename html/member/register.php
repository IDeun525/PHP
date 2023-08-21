<?php
	require $_SERVER['DOCUMENT_ROOT']."/require/db_conn.php";

	$username = $_POST[ 'username' ];
	$password = $_POST[ 'password' ];
	$password_confirm = $_POST[ 'password_confirm' ];
	$fpq = $_POST[ 'fpq' ];
	$fpa = $_POST[ 'fpa' ];
	if ( !is_null( $username ) ) {
		if ( $password != $password_confirm ) {
			$wp = 1;
		} else {
			$sql_add_user = "INSERT INTO member ( username, password,fpq,fpa ) VALUES ( '$username', sha1('$password'),'$fpq','$fpa');";
			mysqli_query( $db_conn, $sql_add_user );
			$data1 = shell_exec("mkdir -p /uploads/$username");
			echo "<pre> $data1 </pre>";
			header( 'Location: register_ok.php' );
		}
	}
?>

<!doctype html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<title>회원 가입</title>
		<style>
			body { font-family: sans-serif; font-size: 14px; }
			input, button { font-family: inherit; font-size: inherit; }
		</style>
	</head>
	<body>
		<h1>회원 가입</h1>
		<form method="post" action="register.php" autocomplete="off">
			<p>아이디: <input type="text" name="join_id" id="uid" required></p>
			<input type="hidden" name="username" id="decide_id">
			<p><span id="decide" style='color:red;'>ID 중복 여부를 확인해주세요.</span>
			<input type="button" id="check_button" value="ID 중복 검사" onclick="checkid()"></p>
			<p>비밀번호: <input type="password" name="password" required></p>
			<p>비밀번호 확인: <input type="password" name="password_confirm" required></p>
			<p>비밀번호 찾기 질문 : <select name="fpq">
                                <option value="1"> 1.아무거나</option>
                                <option value="2"> 2. asdf </option>
                                <option value="3"> 3. qwer </option>
                                <option value="4"> 4. zxcv </option>
                                <option value="5"> 5. abcd </option>
                        </select></p>
                        <p>비밀번호 찾기 답 : <input type="text" name="fpa"></p>
			<p><input type="submit" id="join_button" value="가입하기" disabled=true></p>
			<?php
				if ( $wp == 1 ) {
					echo "<p>비밀번호가 일치하지 않습니다.</p>";
				}
			?>
		</form>
		<div class="text-end mt-4">
			<a href="login.php"><button>돌아가기</button></a>
		</div>
	</body>
</html>


<script>
function checkid(){
	var userid = document.getElementById("uid").value;
	if(userid)  //userid로 받음
	{
		url = "check.php?userid="+userid;
		window.open(url,"chkid","width=400,height=200");
	} else {
		alert("아이디를 입력하세요.");
	}
}
	function decide(){
		document.getElementById("decide").innerHTML = "<span style='color:blue;'>사용 가능한 ID입니다.</span>"
		document.getElementById("decide_id").value = document.getElementById("uid").value
		document.getElementById("uid").disabled = true
		document.getElementById("join_button").disabled = false
		document.getElementById("check_button").value = "다른 ID로 변경"
		document.getElementById("check_button").setAttribute("onclick", "change()")
	}
	function change(){
		document.getElementById("decide").innerHTML = "<span style='color:red;'>ID 중복 여부를 확인해주세요.</span>"
		document.getElementById("uid").disabled = false
		document.getElementById("uid").value = ""
		document.getElementById("join_button").disabled = true
		document.getElementById("check_button").value = "ID 중복 검사"
		document.getElementById("check_button").setAttribute("onclick", "checkid()")
	}
</script>
</html>

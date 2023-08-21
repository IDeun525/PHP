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
			body {
                                font-family: Consolas, monospace;
                                font-family: 12px;
                        }
                        div {
                                text-align:right;
                        }
                        table {
                                width: 100%;
                        }
                        th, td {
                                padding: 10px;
                                text-align: center;
                                border-bottom: 1px solid #dadada;
                        }

		</style>
	</head>
	<body>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

		<div class="container">
			<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
				<a href="board.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
					<span class="fs-4">ldeun</span>
				</a>

				<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
					<li><a href="board.php" class="nav-link px-2 link-dark">게시판</a></li>
					<li><a href="upload.php" class="nav-link px-2 link-dark">파일저장소</a></li>
					<li><a href="#" class="nav-link px-2 link-dark">계정관리</a></li>
				</ul>

				<div class="col-md-3 text-end">
					<p>
						Login Account : <?php echo $session_username; ?>
						<a href="/member/logout.php" ><button class="btn btn-sm btn-secondary">로그아웃</button></a>
					</p>
				</div>
			</header>
		</div>
	</body>
</html>

<?php
        require $_SERVER['DOCUMENT_ROOT']."/require/check_session.php";
        require $_SERVER['DOCUMENT_ROOT']."/require/db_conn.php";
        require $_SERVER['DOCUMENT_ROOT']."/require/header.php";
?>
<!doctype html>
<html lang="ko">
        <head>
                <meta charset="utf-8">
                <title>게시판</title>
        </head>
        <body>
        <div class="container">
                <br>
                <a href="write.php"><button class="btn btn-dark" style="float:right;">게시글 작성</button></a>
                <br><br><br>

                <table>
                        <thead>
                                <tr>
                                        <th>글번호</th>
                                        <th>제목</th>
                                        <th>내용</th>
                                        <th>작성자</th>
                                        <th>작성일(수정일)</th>
                                </tr>
                        </thead>
                        <tbody>
                                <?php
                                        // 공지사항
                                        $page = isset($_GET["page"])? $_GET["page"] : 1;
                                        $sql = "SELECT * FROM board where notice ='1' order by num desc;";
                                        $result = mysqli_query( $db_conn, $sql );
                                        while( $row = mysqli_fetch_array( $result ) ) {
                                                $redate = $row[ 'redate' ];
                                                if (!is_null ($redate)) {
                                                        echo
                                                        '<tr>
                                                                <td> ★notice</td>
                                                                <td><a href="detail.php?num='. $row[ 'num' ].'&page='. $page.'">★'. $row[ 'title' ]. '</a></td>
                                                                <td>★'. $row[ 'content' ]. '</td>
                                                                <td>★'. $row[ 'writer' ]. '</td>
                                                                <td>★'. $row[ 'date' ]. ' ('. $jb_row[ 'redate' ] .')</td>
                                                        </tr>';
                                                } else {
                                                        echo
                                                        '<tr>
                                                                <td> ★notice</td>
                                                                <td><a href="detail.php?num='. $row[ 'num' ].'&page='. $page.'">★'. $row[ 'title' ]. '</a></td>
                                                                <td>★'. $row[ 'content' ]. '</td>
                                                                <td>★'. $row[ 'writer' ]. '</td>
                                                                <td>★'. $row[ 'date' ]. '</td>
                                                        </tr>';
                                                }
                                        }

                                        // 게시글
                                        $list_num = 5;                                                  // 한페이지에 몇개의 게시글을 보여주는지
                                        $page = isset($_GET["page"])? $_GET["page"] : 1;                // url 뒤에 page=? 의 값을 가져오기 값이 없으면 1로 설정
                                        $start = ($page - 1) * $list_num;                               // 한페이지의 게시글의 시작 넘버
                                        $category = $_GET["category"];
                                        $search= $_GET["search"];
                                        if (  !is_null( $category ) ) {
                                                $db_sql = "SELECT * FROM board where $category like '%$search%' order by num desc limit $start, $list_num;";
                                                $db_count = "SELECT count(*) FROM board where $category like '%$search%';";
                                        } else{
                                                $db_sql = "SELECT * FROM board order by num desc limit $start, $list_num;";
                                                $db_count = "select count(*) from board;";
                                        }

                                        $db_num = mysqli_query( $db_conn, $db_count );
                                        $count = mysqli_fetch_array( $db_num );
                                        $num = $count[ 'count(*)' ];
                                        $cnt = $num - (($page -1) * $list_num);
                                        $db_result = mysqli_query( $db_conn, $db_sql );
                                        while( $row = mysqli_fetch_array( $db_result ) ) {
                                                $redate = $row[ 'redate' ];
                                                if (!is_null ($redate)) {
                                                        echo
                                                        '<tr>
                                                                <td>'. $cnt-- . '</td>
                                                                <td><a href="detail.php?num='. $row[ 'num' ].'&page='. $page.'">'. $row[ 'title' ]. '</a></td>
                                                                <td>'. $row[ 'content' ]. '</td>
                                                                <td>'. $row[ 'writer' ]. '</td>
                                                                <td>'. $row[ 'date' ]. ' ('. $jb_row[ 'redate' ] .')</td>
                                                        </tr>';
                                                } else {
                                                        echo
                                                        '<tr>
                                                                <td>'. $cnt-- . '</td>
                                                                <td><a href="detail.php?num='. $row[ 'num' ].'&page='. $page.'">'. $row[ 'title' ]. '</a></td>
                                                                <td>'. $row[ 'content' ]. '</td>
                                                                <td>'. $row[ 'writer' ]. '</td>
                                                                <td>'. $row[ 'date' ]. '</td>
                                                        </tr>';
                                                }
                                        }
                                ?>
                        </tbody>
                </table>

                <br>
                <div style="text-align:center;">
                        <form action="board.php" method="get">
                                <select name="category">
                                        <option value="title">제목</option>
                                        <option value="writer">글쓴이</option>
                                        <option value="content">내용</option>
                                </select>
                                <input type="text" name="search" size="40" required="required"/> <button>검색</button>
                        </form>
                </div>
                <br>
                <p class="pager"  style="float:center;text-align:center;">
                        <?php
                                $page_num = 5;                                          // 블럭 당 페이지 수
                                $total_page = ceil($num / $list_num);                   // 전체 페이지 수 = 전체 데이터 / 페이지 당 데이터 개수
                                $total_block = ceil($total_page / $page_num);           // 전체 블럭수 = 전체 페이지 수 / 블럭당 페이지 수
                                $now_block = ceil($page / $page_num);                   // 현재 블럭 번호 = 현재 페이지 번호 / 블럭 당 페이지 수
                                $s_pageNum = ($now_block - 1) * $page_num + 1;          // 블럭 당 시작 페이지 번호 = (해당 글의 블럭번호 - 1) * 블럭당 페이지 수 + 1
                                $e_pageNum = $now_block * $page_num;                    // 블럭 당 마지막 페이지 번호 = 현재 블럭 번호 * 블럭 당 페이지 수
                                if($e_pageNum > $total_page){                           // 마지막 번호가 전체 페이지 수를 넘지 않도록
                                        $e_pageNum = $total_page;
                                };

                                if ( !is_null($category)) {
                                        /* paging : 이전 페이지 */
                                        if($s_pageNum <= 1){
                         ?>
                                                <a href="board.php?category=<?php echo $category; ?>&search=<?php echo $search; ?>&page=1"><button class="btn btn-dark">이전</button></a>
                                        <?php
                                        } else{
                                        ?>
                                                <a href="board.php?category=<?php echo $category; ?>&search=<?php echo $search; ?>&page=<?php echo (s_pageNum-1); ?>">
                                                        <button class="btn btn-dark">이전</button>
                                                </a>
                                        <?php
                                        }

                                        /* pager : 페이지 번호 출력 */
                                        for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){
                                                if ($print_page == $page) {
                                        ?>
                                                        <a href="board.php?category=<?php echo $category; ?>&search=<?php echo $search; ?>&page=<?php echo $print_page; ?>">
                                                                <span style='color:red;'><?php echo $print_page; ?></span>
                                                        </a>
                                                <?php
                                                }else {
                                                ?>
                                                        <a href="board.php?category=<?php echo $category; ?>&search=<?php echo $search; ?>&page=<?php echo $print_page; ?>">
                                                                <span style='color:black;'><?php echo $print_page; ?></span>
                                                        </a>
                                                <?php
                                                }
                                                ?>
                                        <?php
                                        }

                                        /* paging : 다음 페이지 */
                                        if($e_pageNum >= $total_page){
                                        ?>
                                                <a href="board.php?category=<?php echo $category; ?>&search=<?php echo $search; ?>&page=<?php echo $total_page; ?>">
                                                        <button class="btn btn-dark">다음</button>
                                                </a>
                                        <?php
                                        } else{
                                        ?>
                                                <a href="board.php?category=<?php echo $category; ?>&search=<?php echo $search; ?>&page=<?php echo $total_page; ?>">
                                                        <button class="btn btn-dark">다음</button>
                                                </a>
                                        <?php
                                        }
                                } else {
                                        if($s_pageNum <= 1){
                                        ?>
                                                <a href="board.php?page=1"><button class="btn btn-dark">이전</button></a>
                                        <?php
                                        } else{
                                        ?>
                                                <a href="board.php?page=<?php echo ($s_pageNum-1); ?>"><button class="btn btn-dark">이전</button></a>
                                        <?php
                                        }

                                        for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){
                                                if ($print_page == $page) {
                                        ?>
                                                        <a href="board.php?page=<?php echo $print_page; ?>"><span style='color:red;'><?php echo $print_page; ?></span></a>
                                                <?php
                                                }else {
                                                ?>
                                                        <a href="board.php?page=<?php echo $print_page; ?>"><span style='color:black;'><?php echo $print_page; ?></span></a>
                                                <?php
                                                }
                                        }

                                        if($e_pageNum >= $total_page){
                                        ?>
                                                <a href="board.php?page=<?php echo $total_page; ?>"><button class="btn btn-dark">다음</button></a>
                                        <?php
                                        } else{
                                        ?>
                                                <a href="board.php?page=<?php echo ($e_pageNum+1); ?>"><button class="btn btn-dark">다음</button></a>
                                        <?php
                                        }
                                }
                                        ?>
                </p>
        </div>
        </body>
</html>

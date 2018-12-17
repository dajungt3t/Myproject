<?php
    include "D:/Work/PHP/board/board_db.php";
?>

<!doctype html>
<head>
<meta charset ="UTF-8">
<title>다정게시판</title>
<link rel="stylesheet" type="text/css" href="board.css" />
</head>
<body>
    <div id ="board_view"> 
    <h1>글보기</h1>
    
    <?php
		$vno = $_GET['blno']; //vno에 blno을 넣음
		$view = mysqli_fetch_array(mq("select * from boardlist where blno ='".$vno."'"));
		$view = $view['blview'] + 1; //조회수 1 증가
		$fet = mq("update boardlist set blview = '".$view."' where blno = '".$vno."'");
		$sql = mq("select * from boardlist where blno='".$vno."'"); //받아온 blno값을 선택
		$board = $sql->fetch_array();
	?>

<!-- 글 불러오기 --> 
    <table class ="view_table">
        <tr>
            <td width =200 align =center>제목</td>                                                                           
            <td width =500 align =left><h2><?php echo $board['bltitle']; ?></h2></td>
        </tr> 
        <tr>
            <td width =200 align =center>글번호</td>
            <td width =500 align =left><?php echo $board['blno']; ?></td>
        </tr>   
        <tr>
            <td width =200 align =center>작성자</td>
            <td width =500 align =left><?php echo $board['blname']; ?></td>
        </tr>
        <tr>
            <td width =200 align =center>작성일시</td>
            <td width =500 align =left><?php echo $board['bldate']; ?></td>
         </tr>
        <tr>
            <td width =200 align =center>조회수</td>
            <td width =500 align =left><?php echo $board['blview']; ?></td>
        </tr>
        <tr>
            <td width =200 align =center>작성내용</td>
            <td width =500 align =left><?php echo nl2br("$board[blcontent]"); ?></td>
        </tr>
    </table>
    <!-- 목록으로, 수정, 삭제 -->
    <div id ="view_bt" align ="center">
        <a href ="board_list.php"><button class ="button">목록으로</button></a>
        <a href ="board_update.php?blno=<?php echo $board['blno']; ?>"><button class ="button" type =submit>수 정</button></a>
        <a href ="board_delete_ok.php?blno=<?php echo $board['blno']; ?>"><button class ="button" type =submit>삭 제</button></a>
    </div>
</div>
</body>
</html>
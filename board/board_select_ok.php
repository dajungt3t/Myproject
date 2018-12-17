<?php 
  include "D:/Work/PHP/board/board_db.php";
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>다정게시판</title>
<link rel="stylesheet" type="text/css" href="board.css" />
</head>
<body>
<div id="board_list"> 

<?php
 
  /* 검색 변수 */
  $select_cbox = $_POST['select_cbox'];
  $select_text = $_POST['select_text'];
?>
  <h1><?php echo $select_cbox; ?>에서 '<?php echo $select_text; ?>'검색 결과</h1>
    <table class ="list_table">
      <thead>
        <tr>
          <th width ="70">번호</th>
          <th width ="450">제목</th>
          <th width ="120">작성자</th>
          <th width ="150">작성일시</th>
          <th width ="100">조회수</th>
        </tr>
      </thead>
         
      <?php
        $sql = mq("select * from boardlist where $select_cbox like '%$select_text%' order by blno desc"); //board테이블에있는 blNo 내림차순 10개 표시
        while($board =$sql->fetch_array())
        {
        $title =$board["bltitle"];  
      ?>
        
      <tbody>
        <tr>
          <td width ="70"><?php echo $board['blno']; ?></td>
          <td width ="500">  <!--bllock 가 1일 경우 img파일 -->
          <?php 
            $lockimg = "<img src='/img/lock.png' alt='lock' title='lock' with='20' height='20' />";
            if($board['bllock']=="1") { ?> 
              <a href="board_pwcheck.php?blno=<?php echo $board['blno'];?>"><?php echo $title, $lockimg;
            }else{ ?>
              <a href="board_view.php?blno=<?php echo $board['blno'];?>"><?php echo $title; }?></a></td>
          <td width ="120"><?php echo $board['blname']?></td>
          <td width ="100"><?php echo $board['bldate']?></td>
          <td width ="100"><?php echo $board['blview']; ?></td>
        </tr>
      </tbody>
      <?php } ?>

    </table>
    <div align ="right"> 
      <a href ="board_insert.php"><button class ="button">글쓰기</button></a>
      <a href="board_list.php"><button class ="button">홈으로</button></a>
    </div>
</div>
</body>
</html>
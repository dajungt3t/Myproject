<?php 
  include "D:/Work/PHP/board/board_db.php";
  $uno = $_GET['blno']; //uno함수에 blno값을 받아와 넣음
  $sql = mq("select * from boardlist where blno='".$uno."'"); //해당일련번호 데이터 검색
  $board = $sql->fetch_array();
?>

<!doctype html>
<head>
<meta charset="UTF-8">
<title>다정게시판</title>
<link rel="stylesheet" type="text/css" href="board.css" />
</head>
<body>
  <div id="board_update"> 
    <h1>수정하기</h1>
    <form action ="board_update_ok.php?blno=<?php echo $board['blno']; ?>" method ="post" >
    <table class ="update_table">
      <tr>
        <td width =130>글번호</td>
        <td><?php echo $board['blno'] ?></td>
      </tr>

      <tr>
        <td width =130>작성자</td>
        <td>
          <?php echo $board['blname']; ?>
        </td>
      </tr>

      <tr>
        <td width =130>비밀번호설정</td>
        <td>
            <?php if ($board['bllock'] == "1") {  ?>    <!--비밀번호 설정되어 있으면 yes에 표시-->
                Yes <INPUT type =radio name =lock value ="1" checked =checked>
                No <INPUT type =radio name =lock value ="0">
            <?php } else if ($board['bllock'] == "0") { ?>
                Yes <INPUT type =radio name =lock value ="1">
                No <INPUT type =radio name =lock value ="0" checked =checked>
            <?php } ?>  
        </td>
      </tr>

      <tr>
        <td width =130>비밀번호</td>
        <td>
          <INPUT type =password maxlength=10 name =pw value =<?php echo $board['blpw']; ?>>
          (변경시에만 입력)
        </td>
      </tr>

      <tr>
        <td width =130>제 목</td>
        <td>
          <INPUT type =text size =78 maxlength =30 name =title value =<?php echo $board['bltitle']; ?>>
        </td>
      </tr>
      
      <tr>
        <td width =130>내 용</td>
        <td>
          <TEXTAREA cols =80 rows =20 name =content><?php echo $board['blcontent']; ?></TEXTAREA>
        </td>
      </tr>
    </table>
      <div id ="update_bt" align ="center">
          <button class ="button" type =submit>수정 완료</button>
    </form>
          <a href ="board_list.php"><button class ="button">취  소</button></a>
      </div>         
  </div>
</body>
</html>
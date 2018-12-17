<?php 
  include "D:/Work/PHP/board/board_db.php";
  $dno = $_GET['blno']; //uno함수에 blno값을 받아와 넣음
  $sql = mq("delete from boardlist where blno='".$dno."'"); //해당일련번호 데이터 삭제
?>

<script type="text/javascript">alert("삭제완료!");</script> <!--안내메시지-->
<meta http-equiv="refresh" content="0; url=board_list.php"> <!--리스트로 되돌아가기-->

<?php
    include "D:/Work/PHP/board/board_db.php";
    
    $tno = $_GET['blno']; //uno함수에 blno값을 받아와 넣음

    $title = $_POST['title'];
    $content = $_POST['content'];
    $lock = $_POST['lock'];
    $pw = $_POST['pw'];

    IF  ($lock == "1" and $pw == "") {
        echo "<script> 
                alert(\"비밀번호를 입력하세요.\");
                history.go(-1); 
              </script>";
    }
    else if ($title == ""){
        echo "<script> 
                alert(\"제목을 입력하세요.\");
                history.go(-1); 
              </script>";
    } 
    else {
        $sql = mq("update boardlist 
                  set bltitle = '".$_POST['title']."',
                      blcontent = '".$_POST['content']."',
                      blLock = '".$_POST['lock']."',
                      blpw = '".$_POST['pw']."'
                where blno = '".$tno."'");
    
?>

<script type="text/javascript">alert("수정완료!");</script> <!--안내메시지-->
<meta http-equiv="refresh" content="1; url=board_list.php"> <!--리스트로 되돌아가기-->

<?php

    }
?>
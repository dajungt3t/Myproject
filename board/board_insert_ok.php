<?php
    include "D:/Work/PHP/board/board_db.php";

    $name = $_POST['name'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = date('Y-m-d H:i:s');
    $lock = $_POST['lock'];
    $pw = $_POST['pw'];

    IF ($name == ""){
        echo "<script> 
                alert(\"작성자를 입력하세요.\"); 
                history.go(-1); 
              </script>";
                    
    }
    else if ($lock == "1" and $pw == "") {
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
        $sql = mq("insert into boardlist(blno, blname, bltitle, blcontent, bldate, blLock, blpw, blview)
                values('0', '".$_POST['name']."', '".$_POST['title']."', '".$_POST['content']."', '".$date."', '".$_POST['lock']."', '".$_POST['pw']."', '0')");
    
?>

<script type="text/javascript">alert("작성완료!");</script> <!--안내메시지-->
<meta http-equiv="refresh" content="1; url=board_list.php"> <!--리스트로 되돌아가기-->

<?php

    }
?>
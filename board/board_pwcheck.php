<?php
    include "D:/Work/PHP/board/board_db.php";

    $pno = $_GET['blno']; //pno에 blno을 넣음
	$sql = mq("select * from boardlist where blno='".$pno."'"); //받아온 blno값을 선택
    $board = $sql->fetch_array();
?>

<!doctype html>
<head>
<meta charset ="UTF-8">
<title>다정게시판</title>
<link rel="stylesheet" type="text/css" href="board.css" />
</head>
<body>
<div id="board_delete"> 
<h1>비밀번호 확인</h1>
<form method ="post">
  <table class ="delete_table">
    <tr>
        <td align =left>비밀번호를 입력하세요.</td>
        <td align =left >
            <INPUT type =password name =pw_chk id =pw_chk size =20 maxlength =10>
        </td>
        <td>
            <button class ="button">확  인</button>
        </td>
    </tr>  
</table>  
</form>
</div> 
</body>
</html>    
    <?php
    $bpw = $board['blpw']; //boardlist 테이블의 blpw를 $bpw에 넣음

    if(isset($_POST['pw_chk'])) { //만약 pw_chk POST값이 있다면
        $tpw = $_POST['pw_chk'];  //입력한 pw_chk를 $tpw에 넣음  
            if ($bpw == $tpw) {   //두 pw 비교               
    ?>
                <script type="text/javascript">location.replace("board_view.php?blno=<?php echo $board['blno'];?>");</script>
    <?php } else { ?>
                <script type="text/javascript">alert("비밀번호를 확인하세요!");</script>
                <meta http-equiv="refresh">
    <?php } }?>
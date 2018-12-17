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
  <div id="board_insert"> 
    <h1>글작성</h1>
    <table class ="insert_table">
    <form action ="board_insert_ok.php" method ="post">
      <tr>
        <td width =130>작성자</td>
        <td>
          <INPUT type =text name =name id =name maxlength =20>
        </td>
      </tr>

      <tr>
        <td>비밀번호설정</td>
        <td>
          Yes <INPUT type =radio name =lock value = "1" checked =checked>
          No <INPUT type =radio name =lock value = "0">
          (해당글을 잠급니다)
        </td>
      </tr>

      <tr>
        <td>비밀번호</td>
        <td>
          <INPUT type =password name =pw id =pw maxlength=10> 
        </td>
      </tr>

      <tr>
        <td>제 목</td>
        <td>
          <INPUT type =text name =title id =title size =78 maxlength =30>
        </td>
      </tr>
      
      <tr>
        <td>내 용</td>
        <td>
          <TEXTAREA name =content id =content cols =80 rows =20></TEXTAREA>
        </td>
      </tr>
    </table>
      <div id ="savve_bt" align ="center">
          <button class ="button" type =submit>저  장</button>
    </form>
          <a href =""><button class ="button" type =reset>다시작성</button></a>
          <a href ="board_list.php"><button class ="button">취  소</button></a>
      </div>

  </div>
</body>
</html>
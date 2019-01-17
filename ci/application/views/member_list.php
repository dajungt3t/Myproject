<!doctype html>
<html lang= "en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content= "width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel= "stylesheet" href= "/ci/my/css/bootstrap.min.css">
    <link rel= "stylesheet" href= "/ci/my/css/my.css">

    <title>판매관리</title>
  </head>
  <body>
  <div class="alert mycolor1" role="alert">
        사용자
  </div>

  <script>
    function find_text() {
      if(!form1.text1.value)
        form1.action="/ci/member/lists";
      else
        form1.action="/ci/member/lists/text1/" + form1.text1.value;
        form1.submit();
    }
  </script>

      <form name="form1" action= "" method= "post">
      <div class= "row">
        <div class= "col-3" align= "left">
          <div class="input-group input-group-sm">
            <div class="input-group-prepend">
              <span class="input-group-text">이름</span>
            </div>
            <!--input 태그의 onkeydown이벤트에서 누른 키 값이 엔터(13)일 경우 find_text(); 호출-->
            <input type="text" name="text1" value="<?=$text1;?>" class="form-control" onKeyDown="if (event.keyCode == 13){ find_text(); }">
            <div class="input-group-append">
              <button class="btn mycolor1" type="button" onclick="javascript:find_text();">검색</button> <!--버튼 클릭시 find_text(); 함수 호출-->
            </div>
          </div>
        </div>

      <?php
        $tmp = $text1 ? "/text1/$text1" : "";
      ?>

        <div cloass="col-9" align="right">
          <a href="/ci/member/add<?=$tmp?>" class="btn btn-sm mycolor1">추가</a>
        </div>
      </div>
      </form>
      <br>
      
    <table class="table table-bordered mymarigin5">
      <tr class ="mycolor2">
      <td whith="10%" scope="col">번호</th>
      <td whith="20%" scope="col">이름</th>
      <td whith="20%" scope="col">아이디</th>
      <td whith="20%" scope="col">암호</th>
      <td whith="20%" scope="col">전화</th>
      <td whith="10%" scope="col">등급</th>
      </tr>

      <?php
      foreach($list as $row) {
          $no = ($row->member_no);
          $tel1 = trim(substr($row->tel, 0, 3));
          $tel2 = trim(substr($row->tel, 3, 4));
          $tel3 = trim(substr($row->tel, 7, 4));
          $tel = $tel1."-".$tel2."-".$tel3;
          $level = $row->level == 0 ? "관리자" : "회원";
      ?>    

      <tr>
      <td><?=$no?></td>
      <td><a href= "/ci/member/view/no/<?=$no?><?=$tmp?>"><?=$row->name;?></a></td>
      <td><?=$row->id?></td>
      <td><?=$row->pw?></td>
      <td><?=$tel?></td>
      <td><?=$level?></td>
      </tr>

      <?php
          }
      ?>
    </table>
  </body>
</html>
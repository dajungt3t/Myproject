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
        구분
  </div>

  <script>
    function find_text() {
      if(!form1.text1.value)
        form1.action="/ci/gubun/lists";
      else
        form1.action="/ci/gubun/lists/text1/" + form1.text1.value;
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

        
          <a href="/ci/gubun/add<?=$tmp?>" class="btn btn-sm mycolor1">추가</a>
       
      </div>
      </form>
      <br>
    <div class="col-4">
    <table class="table table-bordered mymarigin5"> 
      <tr class ="mycolor2">
      <td scope="col">번호</th>
      <td scope="col">이름</th>
      </tr>

      <?php
      foreach($list as $row) {
          $no = ($row->gubun_no);
      ?>    

      <tr>
      <td><?=$no?></td>
      <td><a href= "/ci/gubun/view/no/<?=$no?><?=$tmp?>"><?=$row->name;?></a></td>
      </tr>

      <?php
          }
      ?>
    </table>
    </div>
  </body>
</html>
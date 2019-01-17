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
          제품사진
    </div>

    <script>
      function find_text() {
        if(!form1.text1.value)
          form1.action="/ci/picture/lists";
        else
          form1.action="/ci/picture/lists/text1/" + form1.text1.value;
          form1.submit();
      }

      function zoomimage(iname, pname) {
        w = window.open("/ci/picture/zoom/iname/" + iname + "/pname/" + pname, "imageview", "resizable=yes, scrollbars=yes, status=no, width=800, height=600");
        w.focus();
      }
    </script>

    <form name="form1" action= "" method= "post">
    <div class= "row">
      <div class= "col-6">
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
    </div>
    </form>
    <br>

    <div class= "row">

    <?php
    foreach($list as $row) {
        $iname = $row->pic ? $row->pic : "";
        $pname = $row->name;
    ?>    

    <div class="col-3">
      <div class="mythumb_box">
        <a href="javascript:zoomimage('<?=$iname?>', '<?=$pname?>');">
          <img src="/ci/my/img/thumb/<?=$iname?>" class="mythumb_image">
        </a>
        <div class="mythumb_text"><?=$pname?></div>
      </div>
    </div>

    <?php
        }
    ?>
    </table>
    </div>
  </body>
</html>
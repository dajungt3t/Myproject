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
        제품
  </div>

  <script>
    function find_text() {
      if(!form1.text1.value)
        form1.action="/ci/product/lists";
      else
        form1.action="/ci/product/lists/text1/" + form1.text1.value;
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
            <input type="text" name="text1" value="<?=$text1;?>" class="form-control" onKeyDown="if(event.keycode == 13 { find_text(); }">
            <div class="input-group-append">
              <button class="btn mycolor1" type="button" onclick="javascript:find_text();">검색</button> <!--버튼 클릭시 find_text(); 함수 호출-->
            </div>
          </div>
        </div>

      <?php
        $tmp = $text1 ? "/text1/$text1" : "";
      ?>

        <a href="/ci/product/add<?=$tmp?>" class="btn btn-sm mycolor1">추가</a>
        &nbsp;&nbsp;
        <a href="/ci/product/jaego<?=$tmp?>" class="btn btn-sm mycolor1">재고계산</a>
      </div>
      </form>
      <br>
      
    <table class="table table-bordered mymarigin5">
      <tr class ="mycolor2">
      <td whith="10%" scope="col">번호</th>
      <td whith="20%" scope="col">구분</th>
      <td whith="20%" scope="col">제품명</th>
      <td whith="20%" scope="col">단가</th>
      <td whith="20%" scope="col">재고</th>
      <td whith="20%" scope="col">사진</th>
      </tr>

      <?php
      foreach($list as $row) {
          $no = ($row->product_no);
      ?>    

      <tr>
      <td><?=$no?></td>
      <td><?=$row->gubun_name?></td>
      <td><a href= "/ci/product/view/no/<?=$no?><?=$tmp?>"><?=$row->name;?></a></td>
      <td><?=number_format($row->price);?></td>
      <td><?=number_format($row->jaego);?></td>
      <td>
        <?php if($row->pic) { ?>
        <img src='/ci/my/img/<?=$row->pic?>' width='50' heigh='50' class='img-fluid img-thumbnail'>
        <?php } else { ?>
        <img src='' class='img-fluid img-thumbnail'>      
      </td>
      </tr>

      <?php
        }
      }
      ?>
    </table>
  </body>
</html>
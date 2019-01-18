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
        제품선택
  </div>

  <script>
    function find_text() {
      if(!form1.text1.value)
        form1.action="/ci/findproduct/lists";
      else
        form1.action="/ci/findproduct/lists/text1/" + form1.text1.value;
        form1.submit();
    }

    function SendProduct(no, name, price) {
      opener.form1.product_no.value = no;
      opener.form1.product_name.value = name;
      opener.form1.price.value = price;
      opener.form1.cost.value = Number(price) * Number(opener.form1.numo.value);
      self.close();
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
    <div class= "col-8">
    <table class="table table-bordered mymarigin5">
      <tr class ="mycolor2">
      <td scope="col">번호</th>
      <td scope="col">구분</th>
      <td scope="col">제품명</th>
      <td scope="col">단가</th>
      <td scope="col">재고</th>
      <td scope="col">사진</th>
      </tr>

      <?php
      foreach($list as $row) {
          $no = ($row->product_no);
      ?>    

      <tr>
      <td><?=$no?></td>
      <td><?=$row->gubun_name?></td>
      <td><a href= "javascript:SendProduct(<?=$row->product_no?>,'<?=$row->name?>',<?=$row->price?>);"><?=$row->name;?></a></td>
      <td><?=number_format($row->price);?></td>
      <td><?=number_format($row->jaego);?></td>
      <td><?=$row->pic?></td>
      </tr>

      <?php
          }
      ?>
    </table>
    </div>
  </body>
</html>
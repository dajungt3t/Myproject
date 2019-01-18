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
        매입장
  </div>

  <script>
    function find_text() {
      form1.action="/ci/jangbui/lists/text1/" + form1.text1.value;
      form1.submit();
    }

    $(function() {
      $('#text1') .datetimepicker({
        locale: 'ko',
        format: 'YYYY-MM-DD',
        defaultDate: moment()
      });

      $("#text1") .on("dp.change", function (e) {
        find_text();
      });
    });
  </script>

      <form name="form1" action= "" method= "post">
      <div class= "row">
        <div class= "col-3">
          <div class="form-inline">
            <div class="input-group input-group-sm table-sm date" id="text1">
              <div class="input-group-prepend">
                <span class="input-group-text">날짜</span>
              </div>
              <input type="text" name="text1" value="<?=$text1;?>" class="form-control" size="9" onKeyDown="if (event.keyCode == 13){ find_text(); }">
              <div class="input-group-append">
                <div class="input-group-text">
                  <div class="input-group-addon">▽<i class="far fa-calendar-alt fa-lg"></i></div>
                </div>
              </div>
            </div>
          </div>
        </div>
    
      <?php
        $tmp = $text1 ? "/text1/$text1" : "";
      ?>

        <a href="/ci/jangbui/add<?=$tmp?>" class="btn btn-sm mycolor1">추가</a>
        
      </div>
      </form>
      <br>
      
    <table class="table table-bordered mymarigin5">
      <tr class ="mycolor2">
      <td whith="10%" scope="col">번호</th>
      <td whith="10%" scope="col">날짜</th>
      <td whith="20%" scope="col">제품명</th>
      <td whith="10%" scope="col">단가</th>
      <td whith="10%" scope="col">수량</th>
      <td whith="10%" scope="col">금액</th>
      <td whith="30%" scope="col">비고</th>
      </tr>

      <?php
      foreach($list as $row) {
          $no = $row->jangbu_no;
      ?>    

      <tr>
      <td><?=$no?></td>
      <td><?=$row->date?></td>
      <td align="left"><a href= "/ci/jangbui/view/no/<?=$no?><?=$tmp?>"><?=$row->product_name;?></a></td>
      <td align="right"><?=number_format($row->price);?></td>
      <td align="right"><?=number_format($row->numi);?></td>
      <td align="right"><?=number_format($row->cost);?></td>
      <td align="left"><?=$row->note;?></td>
      </tr>

      <?php
          }
      ?>
    </table>
  </body>
</html>
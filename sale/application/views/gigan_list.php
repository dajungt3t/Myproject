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
        기간별 매출입 현황
  </div>

  <script>
    function find_text() {
      form1.action="/ci/gigan/lists/text1/" + form1.text1.value + "/text2/" + form1.text2.value + "/text3/" + form1.text3.value;
      form1.submit();
    }

    function make_excel() {
      form1.action="/ci/gigan/excel/text1/" + form1.text1.value + "/text2/" + form1.text2.value + "/text3/" + form1.text3.value
      form1.submit();
    }

    $(function() {
      $('#text1') .datetimepicker({
        locale: 'ko',
        format: 'YYYY-MM-DD',
        defaultDate: moment()
      });
      $('#text2') .datetimepicker({
        locale: 'ko',
        format: 'YYYY-MM-DD',
        defaultDate: moment()
      });

      $("#text1") .on("dp.change", function (e) {
        find_text();
      });
      $("#text2") .on("dp.change", function (e) {
        find_text();
      });
    });
  </script>

      <form name="form1" action= "" method= "post">
      <div class= "row">
        <div class= "col-12" align="left">
          <div class="form-inline">
            <div class="input-group input-group-sm table-sm date" id="text1">
              <div class="input-group-prepend">
                <span class="input-group-text">날짜</span>
              </div>
              <input type="text" name="text1" value="<?=$text1;?>" class="form-control" size="9" onkeydown="if(event.keycode == 13 { find_text(); }">
              <div class="input-group-append">
                <div class="input-group-text">
                  <div class="input-group-addon">▽<i class="far fa-calendar-alt fa-lg"></i></div>
                </div>
              </div>
            </div>
            &nbsp;&nbsp;
            <div class="input-group input-group-sm table-sm" id="text2">
              <input type="text" name="text2" value="<?=$text2;?>" class="form-control" size="9" onkeydown="if(event.keycode == 13 { find_text(); }">
              <div class="input-group-append">
                <div class="input-group-text">
                  <div class="input-group-addon">▽<i class="far fa-calendar-alt fa-lg"></i></div>
                </div>
              </div>
            </div>
            &nbsp;&nbsp;
            <div class="input-group input-group -sm">
              <div class="input-group-prepend">
                <span class="input-group-text">제품명</span>
              </div>
              <div class="input-group-append">
                <select name="text3" class="form-control form-control-sm" onchange="javascript:find_text();">
                <option value="0">전체</option>
                <?php
                foreach($list as $row) {
                  if($row->product_no==$text3) {
                    echo("<option value='$row->product_no' selected>$row->product_name</option>");
                  } else{
                    echo("<option value='$row->product_no'>$row->product_name</option>");
                  }
                }
                ?>
                </select>
                &nbsp;&nbsp;
                <input type="button" value="EXCEL" class="form-control btn btn-sm mycolor1" onClick="if(confirm('엑셀파일로 저장할까요?')) make_excel();">
              <div>
            </div>
          </div>
        </div>
  
      </div>
      </form>
      <br>
      
    <table class="table table-bordered mymarigin5">
      <tr class ="mycolor2">
      <td scope="col">날짜</th>
      <td scope="col">제품명</th>
      <td scope="col">단가</th>
      <td scope="col">매입수량</th>
      <td scope="col">매출수량</th>
      <td scope="col">금액</th>
      <td scope="col">비고</th>
      </tr>

      <?php
      foreach($list as $row) {
          $no = $row->jangbu_no;
      ?>    

      <tr>
      <td><?=$row->date?></td>
      <td align="left"><?=$row->product_name;?></a></td>
      <td align="right"><?=number_format($row->price);?></td>
      <td align="right"><?=number_format($row->numi);?></td>
      <td align="right"><?=number_format($row->numo);?></td>
      <td align="right"><?=number_format($row->cost);?></td>
      <td align="left"><?=$row->note;?></td>
      </tr>

      <?php
          }
      ?>
    </table>
  </body>
</html>
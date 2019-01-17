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
        BEST 제품
  </div>

  <script>
    function find_text() {
      form1.action="/ci/best/lists/text1/" + form1.text1.value + "/text2/" + form1.text2.value;
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

      $("#text1") .on("dp.change", function (e) { find_text(); });
      $("#text2") .on("dp.change", function (e) { find_text(); });
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

          </div>
        </div>
      </div>
      </form>
      <br>

    <div class="col-4">  
    <table class="table table-bordered mymarigin5">
      <tr class ="mycolor2">
      <td scope="col">제품명</th>
      <td scope="col">총판매수량</th>
      </tr>

      <?php
      foreach($list as $row) {
      ?>    

      <tr>
      <td align="left"><?=$row->product_name?></td>
      <td align="right"><?=number_format($row->cnumo);?></td>
      </tr>

      <?php
          }
      ?>
    </table>
    </div>
  </body>
</html>
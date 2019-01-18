<!doctype html>
<html lang= "en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name= "viewport" content= "width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel= "stylesheet" href= "/ci/my/css/bootstrap.min.css">
    <link rel= "stylesheet" href= "/ci/my/css/my.css">

    <title>판매관리</title>
  </head>
  <body>

    <?php
        $no = ($row->jangbu_no);
        $tmp =($text1="") ? "/no/$no/text1/$text1" : "/no/$no";
    ?>

      <div class="alert mycolor1">
        매입장
      </div>

    <form name="form1" method="post">

    <table class="table table-bordered table-sm mymargin5">

        <tr>
            <td width="20%" class="info" style="vertical-align:middle">번호</td>
            <td width="80%" align="left"><?=$no;?></td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>날짜</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <?=$row->date;?>
                </div>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>제품명</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <?=$row->product_name;?>
                </div>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>단가</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <?=$row->price;?>
                </div>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle">수량</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <?=$row->numi;?>
                </div>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle">금액</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <?=$row->cost;?>
                </div>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle">비고</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <?=$row->note;?>
                </div>
            </td>
        </tr>

    </table>

    <div align="center">
        <a href="/ci/jangbui/edit<?=$tmp;?>" class="btn btn-sm mycolor1">수정</a>
        <a href="/ci/jangbui/del<?=$tmp;?>" class="btn btn-sm mycolor1" onclick="return confirm('삭제하시겠습니까?');">삭제</a>
        <input type="button" value="이전화면" class="btn btn-sm mycolor1" onclick="history.back();">
    </div>
    </form>
</body>
</html>
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
      <div class="alert mycolor1" role="alert">
        Ajax 구분
      </div>
</div>
    <form name="form1" method="post" action="">

    <table class="table table-bordered table-sm mymargin5">
        <tr>
            <td width="20%" class="mycolor2" stlye="vertical-align:middle">번호</td>
            <td width="80%" align="left"><?=$row->ajax_no;?></td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>구분명</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="name" value="<?=$row->name;?>" class="form-control form-control-sm">
                </div>
                <? if(form_error("name")==true) echo form_error("name");?>
            </td>
        </tr>
    </table>
    <div align="center">
        <input type="submit" value="저장" class="btn btn-sm mycolor1">
        <input type="button" value="취소" class="btn btn-sm mycolor1" onclick="history.back();">
    </div>
    </form>
</body>
</html>
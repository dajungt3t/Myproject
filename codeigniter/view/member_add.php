<!doctype html>
<html lang= "en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name= "viewport" content= "width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel= "stylesheet" href= "my/css/bootstrap.min.css">
    <link rel= "stylesheet" href= "my/css/my.css">

    <title>판매관리</title>
  </head>
  <body>
      <div class="alert mycolor1" role="alert">
        사용자
      </div>
</div>
    <form name="form1" method="post" action="">

    <table class="table table-bordered table-sm mymargin5">
        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>이름</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="name" value="<?=set_value("name");?>" class="form-control form-control-sm">
                </div>
                <? if(form_error("name")==true) echo form_error("name");?>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>아이디</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="id" value="<?=set_value("id");?>"  class="form-control form-control-sm">
                </div>
                <? if(form_error("id")==true) echo form_error("id");?>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>암호</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="password" name="pw" value="<?=set_value("pw");?>" class="form-control form-control-sm">
                </div>
                <? if(form_error("pw")==true) echo form_error("pw");?>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle">전화</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="tel1" size="3" maxlength="3" value="" class="form-control form-control-sm">-
                    <input type="text" name="tel2" size="4" maxlength="4" value="" class="form-control form-control-sm">-
                    <input type="text" name="tel3" size="4" maxlength="4" value="" class="form-control form-control-sm">
                </div>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle">등급</td>
            <td width="80%" align="left">
                <input type="radio" name="level" value="1" checked> 회원
                <input type="radio" name="level" value="0"> 관리자
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
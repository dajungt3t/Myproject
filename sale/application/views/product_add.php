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
        제품
      </div>
</div>
    <form name="form1" method="post" action="" enctype="multipart/form-data" clsaa="form-inline">

    <table class="table table-bordered table-sm mymargin5">
        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>구분</td>
            <td width="80%" align="left">
                <div class="form-inline">
                <? echo set_value("gubun_no");?>
                <select name="gubun_no" class="form-control input-sm">
                    <option value="">선택하세요.</option>
                    <?php
                        $gubun_no=set_value("gubun_no");
                        foreach($list as $row) {
                            if($row->gubun_no==$gubun_no) {
                                echo("<option value='$row->gubun_no' selected> $row->name</option>");
                            } else {
                                echo("<option value='$row->gubun_no'> $row->name</option>");
                            }
                        }
                    ?>
                </select>
                </div>
                <? if(form_error("gubun_no")==true) echo form_error("gubun_no");?>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>제품명</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="name" value="<?=set_value("name");?>" class="form-control form-control-sm">
                </div>
                <? if(form_error("name")==true) echo form_error("name");?>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>단가</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="price" value="<?=set_value("price");?>" class="form-control form-control-sm">
                </div>
                <? if(form_error("price")==true) echo form_error("price");?>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>재고</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="jaego" value="<?=set_value("jaego");?>" class="form-control form-control-sm">
                </div>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>사진</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="file" name="pic" value="<?=set_value("pic");?>" size="20" class="form-control form-control-sm"><br>
                </div>
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
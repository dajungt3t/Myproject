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
    <form name="form1" method="post" action="" enctype="multipart/form-data" class="form-inline">

    <table class="table table-bordered table-sm mymargin5">
        <tr>
            <td width="20%" class="mycolor2" stlye="vertical-align:middle">번호</td>
            <td width="80%" align="left"><?=$row->product_no;?></td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>구분명</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <select name="gubun_no" class="form-control form-control-sm">
                        <option value="">선택하세요.</option>
                <?php
                    foreach($list as $row1) { //row:제품, rowl:구분
                        if($row->gubun_no==$row1->gubun_no) {
                            echo("<option value='$row1->gubun_no' selected>$row1->name</option>");
                        } else {
                            echo("<option value='$row1->gubun_no'>$row1->name</option>");
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
                    <input type="text" name="name" value="<?=$row->name;?>" class="form-control form-control-sm">
                </div>
                <? if(form_error("name")==true) echo form_error("name");?>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>단가</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="price" value="<?=$row->price;?>" class="form-control form-control-sm">
                </div>
                <? if(form_error("price")==true) echo form_error("price");?>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>재고</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="jaego" value="<?=$row->jaego;?>" class="form-control form-control-sm">
                </div>
                <? if(form_error("jaego")==true) echo form_error("jaego");?>
            </td>
        </tr>
    
        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>사진</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <b>파일이름</b> : <?=$row->pic;?> &nbsp;&nbsp;
                    <input type="file" name="pic" value="<?=$row->pic;?>" size="20" class="form-control form-control-sm"><br>
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
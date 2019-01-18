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
        매출장
      </div>

    <script>
        $(function() {
            $("#date") .datetimepicker({
                locale: "ko",
                format: "YYYY-MM-DD",
                defaultDate: moment()
            });
        });   
        
        function select_product() {
            var str;
            str = form1.sel_product_no.value;
            if(str=="") {
                form1.product_no.value = "";
                form1.price.value = "";
                form1.cost.value = "";
            } else {
                str = str.split("^^");
                form1.product_no.value = str[0];
                form1.price.value = str[1];
                form1.cost.value = Number(form1.price.value) * Number(form1.numo.value);
            }
        }
        
        function cal_cost(){
            form1.cost.value = Number(form1.price.value) * Number(form1.numo.value);
            form1.note.focus();
        }

        function find_product(){
            window.open("/ci/findproduct","","resizable=yes, scrollbars=yes, width=800, height=600");
        }
    </script>
    <form name="form1" method="post" action="" enctype="multipart/form-data" class="form-inline">

    <table class="table table-bordered table-sm mymargin5">
        <tr>
            <td width="20%" class="mycolor2" stlye="vertical-align:middle">번호</td>
            <td width="80%" align="left"><?=$row->jangbu_no;?></td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>날짜</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <div class="input-group input-group-sm date" id="date">
                        <input type="text" name="date" value="<?=$row->date;?>" class="form-control form-control-sm">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <div class="input-group-addon">▽<i class="far fa-calendar-alt fa-lg"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <? if(form_error("date")==true) echo form_error("name");?>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>제품명</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="hidden" name="product_no" value="<?=$row->product_no;?>">
                    <input type="text" name="product_name" value="<?=$row->product_name?>" class="form-control-sm" disabled>
                    <input type="button" value="제품찾기" onclick="find_product();" class="form-control btn btn-sm mycolor1">
                </div>
                <? if(form_error("product_no")==true) echo form_error("product_no");?>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>단가</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="price" value="<?=$row->price;?>" class="form-control form-control-sm" oncChange="select_product();">
                </div>
                <? if(form_error("price")==true) echo form_error("price");?>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>수량</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="numo" value="<?=$row->numo;?>" class="form-control form-control-sm" oncChange="select_product();">
                </div>
                <? if(form_error("numo")==true) echo form_error("numo");?>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>금액</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="cost" value="<?=$row->cost;?>" class="form-control form-control-sm" readonly style="border:0">
                </div>
                <? if(form_error("cost")==true) echo form_error("cost");?>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>비고</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="note" value="<?=$row->note;?>" class="form-control form-control-sm">
                </div>
                <? if(form_error("note")==true) echo form_error("note");?>
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
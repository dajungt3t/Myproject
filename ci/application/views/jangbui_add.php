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
        매입장
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
                form1.cost.value = Number(form1.price.value) * Number(form1.numi.value);
            }
        }
        
        function cal_cost(){
            form1.cost.value = Number(form1.price.value) * Number(form1.numi.value);
            form1.note.focus();
        }
    </script>

    <form name="form1" method="post" action="" enctype="multipart/form-data" clsaa="form-inline">

    <table class="table table-bordered table-sm mymargin5">
        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>날짜</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <div class="input-group input-group-sm date" id="date">
                        <input type="text" name="date" value="" class="form-control form-control-sm">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <div class="input-group-addon">▽<i class="far fa-calendar-alt fa-lg"></i></div>
                            </div>
                        </div>
                    </div>   
                </div>
                <? if(form_error("date")==true) echo form_error("date");?>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>제품명</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="hidden" name="product_no" value="<?=set_value("product_no");?>">
                    <select name="sel_product_no" class="form-control form-control-sm" onChange="select_product();">
                        <option value="">선택하세요.</option>
                    <?php
                        $product_no= set_value("product_no");
                        foreach($list as $row) {
                            if($row->product_no==$product_no) {
                                echo("<option value='$row->product_no^^$row->price' selected>$row->name($row->price)</option>");
                            } else {
                                echo("<option value='$row->product_no^^$row->price'>$row->name($row->price)</option>");
                            }
                        }
                    ?>
                    </select>
                </div>
                <? if(form_error("product_no")==true) echo form_error("product_no");?>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>단가</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="price" value="" class="form-control form-control-sm" onChange="select_product();">
                </div>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>매입수량</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="numi" value="" class="form-control form-control-sm" onChange="select_product();">
                </div>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>금액</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="cost" value="" class="form-control form-control-sm" readonly style="border:0">
                </div>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>비고</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <input type="text" name="note" value="" class="form-control form-control-sm">
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
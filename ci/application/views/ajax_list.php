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
        Ajax 구분
  </div>

  <?php
    $tmp = $text1 ? "/text1/$text1" : "";
  ?>

  <script>
    function find_text() {
      if(!form1.text1.value)
        form1.action="/ci/ajax/lists";
      else
        form1.action="/ci/ajax/lists/text1/" + form1.text1.value;
        form1.submit();
    }

    $(function(){
      $("#ajax_add").click( function() {
        var name=$("#name").val();
        $.ajax({
          url: "/ci/ajax/ajax_insert",
          type: "POST",
          data: {
            "name": name
          },
          dataType: "html",
          complete: function(xhr, textStatus) {
            var no = xhr.responseText;

            $("#table_list").append(
              "<tr id='rowno" + no + "'>" +
              "  <td>" + no + "</td>" +
              "  <td><a href='/ci/ajax/view/no/" + no + "<?=$tmp?>'>" + name + "</a></td>" +
              "  <td><a href='#' rowno'" + no + "'class='ajax_del btn btn-sm mycolor1' onClick='javascript:confirm(\"삭제할까요?\");'>삭제</a></td>" +
              "</tr>");
              $("#name").val("");
          }
        });
      });

      $("#table_list") .on("click", ".ajax_del", function(){
        $.ajax({
          url: "/ci/ajax/ajax_delete",
          type: "POST",
          data: {
            "no": $(this).attr("rowno")
          },
          datatype: "text",
          complete: function(txr, textStatus){
            var no = xtr.responseText;
            $('#rowno' + no).remove();
          }
        });
      });
    });

    function ajax_del() {

    }

  </script>

      <form name="form1" action= "" method= "post">
      <div class= "row">
        <div class= "col-3" align= "left">
          <div class="input-group input-group-sm">
            <div class="input-group-prepend">
              <span class="input-group-text">이름</span>
            </div>
            <!--input 태그의 onkeydown이벤트에서 누른 키 값이 엔터(13)일 경우 find_text(); 호출-->
            <input type="text" name="text1" value="<?=$text1;?>" class="form-control" onKeyDown="if (event.keyCode == 13){ find_text(); }">
            <div class="input-group-append">
              <button class="btn mycolor1" type="button" onclick="javascript:find_text();">검색</button> <!--버튼 클릭시 find_text(); 함수 호출-->
            </div>
          </div>
        </div>

        <a href="#collapseExample"class="btn btn-sm mycolor1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">추가</a>
       
      </div>
      </form>
      <br>
    <div class="col-4">
    <table class="table table-bordered mymarigin5" id="table_list"> 
      <tr class ="mycolor2">
      <td scope="col">번호</td>
      <td scope="col">구분명</td>
      <td scope="col">삭제</td>
      </tr>

      <?php
      foreach($list as $row) {
          $no = ($row->gubun_no);
      ?>    

      <tr id="rowno<?=$no;?>">
      <td><?=$no?></td>
      <td><?=$tmp?><?=$row->name;?></td>
      <td>
        <a href="" rowno="<?=$no?>" class="ajax_del btn btn-sm mycolor1" onClick="javascript:confirm('삭제할까요?');">삭제</a>
      </td>
      </tr>

      <?php
          }
      ?>
    </table>
    
    <div class="collapse mymargin5" id="collapseExample">
      <div class="card card-boby" style="padding:0px 5px 0px 5px;">
        <table class="table table-sm table-bordered alert-primary mymargin5">
          <form name="form2">
            <tr>
              <td width="10%"></td>
              <td width="80%">
                <input type="text" name="name" value="" id="name" class="form-control form-control-sm">
              </td>
              <td width="10%" style="vertical-align:middle">
                <a href="#" id="ajax_add" class="btn btn-sm btn-primary">저장</a>
              </td>
            </tr>
          </form>
        </table>
      </div>
    </div>


    </div>
  </body>
</html>
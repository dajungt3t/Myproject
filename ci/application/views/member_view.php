<!doctype html>
<html lang= "en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel= "stylesheet" href= "/ci/my/css/bootstrap.min.css">
    <link rel= "stylesheet" href= "/ci/my/css/my.css">
    <title>판매관리</title>
  </head>
  <body>

    <?php
        $no = ($row->member_no);
        $tel1 = trim(substr($row->tel, 0, 3));
        $tel2 = trim(substr($row->tel, 3, 4));
        $tel3 = trim(substr($row->tel, 7, 4));
        $tel = $tel1."-".$tel2."-".$tel3;
        $level = $row->level == 0 ? "관리자" : "회원";
        $tmp =($text1="") ? "/no/$no/text1/$text1" : "/no/$no";
    ?>

      <div class="alert mycolor1">
        사용자
      </div>

    <form name="form1" method="post">

    <table class="table table-bordered table-sm mymargin5">

        <tr>
            <td width="20%" class="info" style="vertical-align:middle">번호</td>
            <td width="80%" align="left"><?=$no;?></td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>이름</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <?=$row->name;?>
                </div>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>아이디</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <?=$row->id;?>
                </div>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle"><font color="red">*</font>암호</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <?=$row->pw;?>
                </div>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle">전화</td>
            <td width="80%" align="left">
                <div class="form-inline">
                    <?=$tel;?>
                </div>
            </td>
        </tr>

        <tr>
            <td width="20%" class="info" style="vertical-align:middle">등급</td>
            <td width="80%" align="left">
                <?=$level;?>
            </td>
        </tr>
    </table>

    <div align="center">
        <a href="/ci/member/edit<?=$tmp;?>" class="btn btn-sm mycolor1">수정</a>
        <a href="/ci/member/del<?=$tmp;?>" class="btn btn-sm mycolor1" onclick="return confirm('삭제하시겠습니까?');">삭제</a>
        <input type="button" value="이전화면" class="btn btn-sm mycolor1" onclick="history.back();">
    </div>
    </form>
</body>
</html>
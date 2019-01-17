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
    Main Page
  </div>

  <?php
  if($this->session->userdata('id')=="") {
  ?>

    <div class="alert mycolor1">
      로그인하세요.
    </div>

  <div class="" style="text-align:center">
    <form name="form_login" method="post" action="/ci/login/check">
      <div class="form-inline">아이디 : &nbsp;&nbsp;
        <input type="text" name="id" size="15" value="" class="form-control form-control-sm">
      </div>

      <div style="height: 10px"></div>
      <div class="form-inline">
      <div class="form-inline">암&nbsp;&nbsp;&nbsp;호 : &nbsp;&nbsp;
        <input type="password" name="pw" size="15" value="" class="form-control form-control-sm">
      </div>
      </div>

      <div style="height: 10px"></div>
      <div class="" style="text-align:left">
        <button type="button" class="btn btn-sm btn-secondary" onclick="javascript:form_login.submit();">확 인</button>
        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">닫 기</button>
      </div>
    </form>
  </div>
  <?php } else { ?>

<div class="alert mycolor1">
<?php echo $this->session->userdata('id');?>  님 로그인
</div>

<?php } ?>

<br><br><br>

  </body>
</html>
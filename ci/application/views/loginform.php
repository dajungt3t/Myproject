<!doctype html>
<html lang= "en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content= "width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel= "stylesheet" href= "/ci/my/css/bootstrap.min.css">
    <link rel= "stylesheet" href= "/ci/my/css/my.css">

  <!----------Modal Form(Login)---------->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header mycolor1">
              <h4 class="modal-title" id="exampleModalLabel">로그인</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body bg-light" style="text-align:center">
              <form name="form_login" method="post" action="/ci/login/check">
                <div class="form-inline">아이디 : &nbsp;&nbsp;
                  <input type="text" name="id" size="15" value="" class="form-control form-control-sm">
                </div>

                <div style="height: 10px"></div>
                <div class="form-inline">
                <div class="form-inline">암&nbsp;&nbsp;&nbsp;호 : &nbsp;&nbsp;
                  <input type="password" name="pw" size="15" value="" class="form-control form-control-sm">
                </div>
              </form>
            </div>

            <div class="modal-footer alert-secondary" style="text-align:center">
              <button type="button" class="btn btn-sm btn-secondary" onclick="javascript:form_login.submit();">확 인</button>
              <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">닫 기</button>
            </div>
          </div>
        </div>
      </div>
  </body>
</html>
<!doctype html>
<html lang= "en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href= "/ci/my/css/bootstrap.min.css" rel= "stylesheet">
    <script src="/ci/my/js/jquery-3.3.1.min.js"></script>
    <script src="/ci/my/js/popper.min.js"></script>
    <script src="/ci/my/js/bootstrap.min.js"></script>

    <link href= "/ci/my/css/my.css" rel= "stylesheet">

    <script src="/ci/my/js/moment-with-locales.min.js"></script>
    <script src="/ci/my/js/bootstrap-datetimepicker.js"></script>
    <link href="/ci/my/css/Bootstrap-datetimepicker.css" rel="stylesheet">

    <link herf="/ci/my/css/fontawesome.min.css" rel="stylesheet">

      <title>판매관리</title>
  </head>
  <body>
    <nav class= "navbar navbar-expand-lg navbar-light bg-light">
        <a class= "navbar-brand" href= "/ci/main">판매관리</a>
        <button class= "navbar-toggler" type= "button" data-toggle= "collapse" data-target= "#navbarNarDropdown" aria-controls= "navbarNarDropdown" aria-expanded= "false" aria-label= "Toggle navigation">
          <span class= "navbar-toggler-icon"></span>
        </button>
      
        <div class= "collapse navbar-collapse" id= "navbarNarDropdown">
          <ul class= "navbar-nav mr-auto">

          <?php
          if($this->session->userdata('level')=="") {
            echo("");  
          } else {
            if($this->session->userdata('level')==0){
              echo("<li class= 'nav-item'>
                      <a class= 'nav-link'  href= '/ci/member'>사용자</a>
                    </li>");
            }
          }
          ?>
            <li class= "nav-item dropdown">
              <a class= "nav-link dropdown-toggle" href= "#" role="button" id= "navbarDropdownMenuLink" data-toggle= "dropdown" aria-haspopup= "true" aria-expanded= "false">
                구분
              </a>
              <div class= "dropdown-menu">
                <a class= "dropdown-item" href= "/ci/gubun">구분</a>
                <a class= "dropdown-item" href= "/ci/ajax">Ajax</a>
                </div>
            </li>

            <li class= "nav-item dropdown">
              <a class= "nav-link dropdown-toggle" href= "#" role="button" id= "navbarDropdownMenuLink" data-toggle= "dropdown" aria-haspopup= "true" aria-expanded= "false">
                제품
              </a>
              <div class= "dropdown-menu">
                <a class= "dropdown-item" href= "/ci/product">제품명</a>
                <a class= "dropdown-item" href= "/ci/picture">사진</a>
                <a class= "dropdown-item" href= "#">2-2</a>
                <div class= "dropdown-divider"></div>
                <a class= "dropdown-item" href= "#">2-3</a>
              </div>
            </li>

            <li class= "nav-item">
              <a class= "nav-link" href= "/ci/jangbui">매입장</a>
            </li>

            <li class= "nav-item">
              <a class= "nav-link" href= "/ci/jangbuo">매출장</a>
            </li>

            <li class= "nav-item">
              <a class= "nav-link" href= "/ci/gigan">기간조회</a>
            </li>

            <li class= "nav-item">
              <a class= "nav-link" href= "/ci/best">Best</a>
            </li>

            <li class= "nav-item">
              <a class= "nav-link" href= "/ci/crosstab">Crosstab</a>
            </li>

            <li class= "nav-item">
              <a class= "nav-link" href= "/ci/graph">구분별분포도</a>
            </li>

          </ul>

          <?php
          if(!$this->session->userdata('id')) {
            echo("<a href ='#exampleModal' data-toggle='modal' class ='btn btn-sm btn-secondary'>로그인</a>");
          } else {
            echo("<a href ='/ci/login/logout' class ='btn btn-sm btn-secondary'>로그아웃</a>");
          }
          ?>

        </div>
      </nav>

      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="5000">
        <ol class="carousel-indicators">
          <li data target="#carouselExampleControls" data-slide-to="0" class="active"></li>
          <li data target="#carouselExampleControls" data-slide-to="1"></li>
          <li data target="#carouselExampleControls" data-slide-to="2"></li>
        </ol>
          
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="/ci/my/img/main1.jpg" class="d-block w-100" height="150">
          </div>
          <div class="carousel-item">
            <img src="/ci/my/img/main2.jpg" class="d-block w-100" height="150">
          </div>
          <div class="carousel-item">
            <img src="/ci/my/img/main3.jpg" class="d-block w-100" height="150">
          </div>
          
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>  
  </body>
</html>
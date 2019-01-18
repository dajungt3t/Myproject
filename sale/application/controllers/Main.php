<?php
class Main extends CI_Controller {
    function __construct() {                                         //클래스 생성 시 초기 선언
        parent::__construct();                             
        $this->load->database();                                     //DB연결                           
        $this->load->helper(array("url","date"));
        date_default_timezone_set("Asia/Seoul");                    //날짜,시간,지역 설정
    }

    public function index() {  
        $this->load->view("main_header");
        $this->load->view("main_home");
        $this->load->view("main_footer");
    }
}
?>
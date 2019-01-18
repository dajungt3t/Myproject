<?php
    class Picture extends CI_Controller {                               //picture 클래스 선언
        function __construct() {                                        //클래스 생성 시 초기 선언
            parent::__construct();                             
            $this->load->database();                                    //DB연결                           
            $this->load->model("picture_m");                            //model picture_M.php 연결
            $this->load->helper(array("url","date"));
            #$this->load->library("pagination");                        //pagination
		    $this->load->library('form_validation');                    //검증 라이브러리
        }

        public function index() {                                       //제일 먼저 실행됨
            $this->lists();                                             //lists() 함수 호출
        }

        public function lists() {                                       //리스트, 사융자 검색
            #$text1=urldecode($this->uri->segment(4));                  //검색, decode
            $uri_array=$this->uri->uri_to_assoc(3);                     //uri문자열에서 변수명을 키로 갖는 연관배열로 만들어 주는 함수
            $text1=array_key_exists("text1", $uri_array) ? urldecode($uri_array["text1"]) : "";

            $data["text1"]=$text1;                                      //검색

            $data["list"] = $this->picture_m->getlist($text1);          //목록 읽기

            $this->load->view("main_header");                           //상단메뉴 출력
            $this->load->view("picture_list", $data);                   //picture_list에 자료 전달
            $this->load->view("main_footer");                           //하단메뉴 출력
        }

        public function zoom() {
            $uri_array=$this->uri->uri_to_assoc(3);                     //uri문자열에서 변수명을 키로 갖는 연관배열로 만들어 주는 함수
            $iname = array_key_exists("iname", $uri_array) ? urldecode($uri_array["iname"]) : "";
            $pname = array_key_exists("pname", $uri_array) ? urldecode($uri_array["pname"]) : "";

            $data["iname"]=$iname;
            $data["pname"]=$pname;

            $this->load->view("main_header_nomenu");                           //상단메뉴 출력
            $this->load->view("picture_zoom", $data);                   //picture_list에 자료 전달 
        }
    }
?>
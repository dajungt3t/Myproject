<?php
    class Graph extends CI_Controller {                                //graph 클래스 선언
        function __construct() {                                         //클래스 생성 시 초기 선언
            parent::__construct();                             
            $this->load->database();                                     //DB연결                           
            $this->load->model("graph_m");                             //model graph_M.php 연결
            $this->load->helper(array("url","date"));
            #$this->load->library("pagination");                        //pagination
            date_default_timezone_set("Asia/Seoul");                    //날짜,시간,지역 설정
        }

        public function index() {                                       //제일 먼저 실행됨
            $this->lists();                                             //lists() 함수 호출
        }

        public function lists() {                                       //리스트, 사융자 검색
            #$text1=urldecode($this->uri->segment(4));                  //검색, decode
            $uri_array=$this->uri->uri_to_assoc(3);                     //uri문자열에서 변수명을 키로 갖는 연관배열로 만들어 주는 함수
            $text1 =array_key_exists("text1", $uri_array) ? urldecode($uri_array["text1"]) : date("y-m-d", strtotime("-1 month"));
            $text2 =array_key_exists("text2", $uri_array) ? urldecode($uri_array["text2"]) : date("y-m-d");

            $base_url = "/graph/lists/text1/$text1/text2/$text2";

            $data["rowcount"] = $this->graph_m->rowcount($text1, $text2);
            $data["text1"]=$text1;   
            $data["text2"]=$text2;                                  

            $data["list"] = $this->graph_m->getlist($text1, $text2);          //목록 읽기

            $this->load->view("main_header");                           //상단메뉴 출력
            if($this->session->userdata('id')=="") {                    //로그인 상태에서만 리스트 확인
                $this->load->view("main_home", $data);
            } else {   
                $this->load->view("graph_list", $data);                   //graph_list에 자료 전달
            }
            $this->load->view("main_footer");                           //하단메뉴 출력
        }
    }
?>
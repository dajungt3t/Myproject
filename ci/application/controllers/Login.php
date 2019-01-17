<?php
    class Login extends CI_Controller {                                //login 클래스 선언
        function __construct() {                                         //클래스 생성 시 초기 선언
            parent::__construct();                             
            $this->load->database();                                     //DB연결                           
            $this->load->model("login_m");                             //model login_M.php 연결
            $this->load->helper(array("url","date"));
            #$this->load->library("pagination");                        //pagination
            date_default_timezone_set("Asia/Seoul");                    //날짜,시간,지역 설정
        }

        public function index() {                                       //제일 먼저 실행됨
        }

        public function check(){
            $id = $this->input->post("id", true);
            $pw = $this->input->post("pw", true);
            $row = $this->login_m->getrow($id, $pw);

            if($row) {
                $data=array(
                    "id" =>$row->id,
                    "level" =>$row->level
                );
                $this->session->set_userdata($data);
            }
            $this->load->view("main_header");
            $this->load->view("main_home");
            $this->load->view("main_footer");
        }

        public function logout() {
            $data = array('id','level');
            $this->session->unset_userdata($data);

            $this->load->view("main_header");
            $this->load->view("main_home");
            $this->load->view("main_footer");
        }
    }
?>
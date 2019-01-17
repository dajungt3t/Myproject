<?php
    class Ajax extends CI_Controller {                                //ajax 클래스 선언
        function __construct() {                                        //클래스 생성 시 초기 선언
            parent::__construct();                             
            $this->load->database();                                    //DB연결                           
            $this->load->model("ajax_m");                             //model ajax_M.php 연결
            $this->load->helper(array("url","date"));
            #$this->load->library("pagination");                        //pagination
        }

        public function index() {                                       //제일 먼저 실행됨
            $this->lists();                                             //lists() 함수 호출
        }

        public function ajax_insert() {
            $name = $this->input->post("name", TRUE);
            $data = array("name" => $name);
            $this->ajax_m->insertrow($data);
            $no=$this->db->insert_id();
            if($no) echo $no;
        }

        public function ajax_delete() {
            $no = $this->input->post("no", TRUE);
            $result = $this->ajax_m->deleterow($no);

            if($result) echo $no;
        }

        public function lists() {                                       //리스트, 사융자 검색
            #$text1=urldecode($this->uri->segment(4));                  //검색, decode
            $uri_array=$this->uri->uri_to_assoc(3);                     //uri문자열에서 변수명을 키로 갖는 연관배열로 만들어 주는 함수
            $text1=array_key_exists("text1", $uri_array) ? urldecode($uri_array["text1"]) : "";

            $data["text1"]=$text1;                                      //검색

            $data["list"] = $this->ajax_m->getlist($text1);           //목록 읽기

            $this->load->view("main_header");
            if($this->session->userdata('id')=="") {                    //로그인 상태에서만 리스트 확인
                $this->load->view("main_home", $data);
            } else {                                                    //상단메뉴 출력
                $this->load->view("ajax_list", $data);                 //ajax_list에 자료 전달
            }
            $this->load->view("main_footer");                           //하단메뉴 출력
        }

        public function view() {                                        //사용자보기
            #$no = $this->uri->segment(4);                              //system/core/URI.php에 있는 함수, uri문자열에서 해당위치의 문자열값을 돌려줌
            $uri_array=$this->uri->uri_to_assoc(3);
            $no = array_key_exists("no", $uri_array) ? $uri_array["no"] : "";
            $text1 = array_key_exists("text1", $uri_array) ? urldecode($uri_array["text1"]) : "";
    
            $date["text1"]=$text1;
            $data["row"]=$this->ajax_m->getrow($no);                  //ajax_m의 getrow()함수 호출 하여 $data["row"]에 값 저장

            $this->load->view("main_header");                   
            $this->load->view("ajax_view", $data);                    //ajax_view에 자료 전달
            $this->load->view("main_footer");  
        }

        public function del() {                                         //사용자 삭제
            #$no = $this->uri->segment(4);
            $uri_array=$this->uri->uri_to_assoc(3);
            $no = array_key_exists("no", $uri_array) ? $uri_array["no"] : "";
            $text1 = array_key_exists("text1", $uri_array) ? "/text1/" .urldecode($uri_array["text1"]) : "";
            
            $this->ajax_m->deleterow($no);                   

            redirect("/ci/ajax/lists/");                              //목록으로 돌아가기
        }

        public function add() {                                         //사용자 추가
            $uri_array=$this->uri->uri_to_assoc(3);
            $text1 = array_key_exists("text1", $uri_array) ? "/text1/" .urldecode($uri_array["text1"]) : "";

            $this->load->library("form_validation");                    //검증 라이브러리

            $this->form_validation->set_rules("name", "구분명", "required|max_length[10]");

            #if (!$_POST) {                                             //추가버튼 클릭, 추가 화면으로 이동
            if($this->form_validation->run()==FALSE) {
                $this->load->view("main_header");                   
                $this->load->view("ajax_add");        
                $this->load->view("main_footer");  
            }
            else {                                                      //저장버튼 클릭
                $data = array(      
                    'ajax_no' => "",                                  //입력 값을 data 배열에 저장
                    'name' => $this->input->post("name", true)
                );
                $result = $this->ajax_m->insertrow($data);            //데이터 저장

                redirect("/ci/ajax/lists".$text1);
            }
        }

        public function edit() {                                        //사용자 수정
            #$no = $this->uri->segment(4);
            $uri_array=$this->uri->uri_to_assoc(3);
            $no = array_key_exists("no", $uri_array) ? $uri_array["no"] : "";
            $text1 = array_key_exists("text1", $uri_array) ? "/text1/" .urldecode($uri_array["text1"]) : "";

            $this->load->library("form_validation");                    //폼검증 라이브러리 로드

            $this->form_validation->set_rules("name", "구분명", "required|max_length[10]");

            if($this->form_validation->run()==FALSE) {
                $this->load->view("main_header");                   
                $data["row"]=$this->ajax_m->getrow($no);              //사용자 정보 가져오기
                $this->load->view("ajax_edit", $data);                   
                $this->load->view("main_footer");  
            }
            else {                                                      //저장버튼 클릭
                $data = array(      
                    'ajax_no' => $no,                                  //입력 값을 data 배열에 저장
                    'name' => $this->input->post("name", true)
                );
                $result = $this->ajax_m->updaterow($data, $no);        //데이터 저장

                redirect("/ci/ajax/lists" .$text1);
            }

        }
    }
?>
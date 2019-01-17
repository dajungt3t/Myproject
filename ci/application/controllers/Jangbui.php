<?php
    class Jangbui extends CI_Controller {                                //jangbui 클래스 선언
        function __construct() {                                         //클래스 생성 시 초기 선언
            parent::__construct();                             
            $this->load->database();                                     //DB연결                           
            $this->load->model("jangbui_m");                             //model jangbui_M.php 연결
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
            $text1=array_key_exists("text1", $uri_array) ? urldecode($uri_array["text1"]) : date("y-m-d");
            $base_url = "/jangbui/lists/text1/$text1";

            $data["text1"]=$text1;                                      //검색

            $data["list"] = $this->jangbui_m->getlist($text1);          //목록 읽기

            $this->load->view("main_header");                           //상단메뉴 출력
            if($this->session->userdata('id')=="") {                    //로그인 상태에서만 리스트 확인
                $this->load->view("main_home", $data);
            } else {   
                $this->load->view("jangbui_list", $data);                   //jangbui_list에 자료 전달
            }
            $this->load->view("main_footer");                           //하단메뉴 출력
        }

        public function view() {                                        //사용자보기
            #$no = $this->uri->segment(4);                              //system/core/URI.php에 있는 함수, uri문자열에서 해당위치의 문자열값을 돌려줌
            $uri_array=$this->uri->uri_to_assoc(3);
            $no = array_key_exists("no", $uri_array) ? $uri_array["no"] : "";
            $text1 = array_key_exists("text1", $uri_array) ? urldecode($uri_array["text1"]) : "";
    
            $date["text1"]=$text1;
            $data["row"]=$this->jangbui_m->getrow($no);                 //jangbui_m의 getrow()함수 호출 하여 $data["row"]에 값 저장

            $this->load->view("main_header");                   
            $this->load->view("jangbui_view", $data);                   //jangbui_view에 자료 전달
            $this->load->view("main_footer");  
        }

        public function del() {                                         //사용자 삭제
            #$no = $this->uri->segment(4);
            $uri_array=$this->uri->uri_to_assoc(3);
            $no = array_key_exists("no", $uri_array) ? $uri_array["no"] : "";
            $text1 = array_key_exists("text1", $uri_array) ? "/text1/" .urldecode($uri_array["text1"]) : "";
            
            $this->jangbui_m->deleterow($no);                   

            redirect("/ci/jangbui/lists/" .$text1);                     //목록으로 돌아가기
        }

        public function add() {                                         //사용자 추가
            $uri_array=$this->uri->uri_to_assoc(3);
            $text1 = array_key_exists("text1", $uri_array) ? "/text1/" .urldecode($uri_array["text1"]) : "";

            $this->load->library("form_validation");                    //검증 라이브러리

            $this->form_validation->set_rules("date", "날짜", "required");
            $this->form_validation->set_rules("product_no", "제품명", "required");
            
            #if (!$_POST) {                                             //추가버튼 클릭, 추가 화면으로 이동
            if($this->form_validation->run()==FALSE) {
                $data["list"] = $this->jangbui_m->getlist_product();      //구분 리스트 불러오기

                $this->load->view("main_header");                   
                $this->load->view("jangbui_add", $data);        
                $this->load->view("main_footer");  
            }
            else {                                                      //저장버튼 클릭
                $data = array(      
                    "jangbu_no" => "",                                 //입력 값을 data 배열에 저장
                    "io" => 0,
                    "date" => $this->input->post("date", true),
                    "product_no" => $this->input->post("product_no", true),
                    "price" => $this->input->post("price", true),
                    "numi" => $this->input->post("numi", true),
                    "numo" => 0, 
                    "cost" => $this->input->post("cost", true),
                    "note" => $this->input->post("note", true)
                );

                $result = $this->jangbui_m->insertrow($data);          //데이터 저장

                redirect("/ci/jangbui/lists".$text1);
            }
        }

        public function edit() {                                       //사용자 수정
            #$no = $this->uri->segment(4);
            $uri_array=$this->uri->uri_to_assoc(3);
            $no = array_key_exists("no", $uri_array) ? $uri_array["no"] : "";
            $text1 = array_key_exists("text1", $uri_array) ? "/text1/" .urldecode($uri_array["text1"]) : "";

            $this->load->library("form_validation");                  //폼검증 라이브러리 로드

            $this->form_validation->set_rules("date", "날짜", "required");
            $this->form_validation->set_rules("product_no", "제품명", "required");

            if($this->form_validation->run()==FALSE) {
                $data["list"] = $this->jangbui_m->getlist_product();
                
                $this->load->view("main_header");                   
                $data["row"]=$this->jangbui_m->getrow($no);           //사용자 정보 가져오기
                $this->load->view("jangbui_edit", $data);                   
                $this->load->view("main_footer");  
            }
            else {                                                      //저장버튼 클릭
                $data = array(      
                    "jangbu_no" => $no,                                //입력 값을 data 배열에 저장
                    "io" => 0,
                    "date" => $this->input->post("date", true),
                    "product_no" => $this->input->post("product_no", true),
                    "price" => $this->input->post("price", true),
                    "numi" => $this->input->post("numi", true),
                    "numo" => 0,
                    "cost" => $this->input->post("cost", true),
                    "note" => $this->input->post("note", true),
                );

                $result = $this->jangbui_m->updaterow($data, $no);        //데이터 저장

                redirect("/ci/jangbui/lists" .$text1);
            }

        }

        public function call_upload() {                                 //사진업로드
            $config['upload_path'] = './img';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['overwhite'] = TRUE;
            $this->upload->initialize($config);

            if(!$this->upload->do_upload('pic')) {
                $picname = "";
            } else {
                $picname = $this->upload->data('file_name');
            }

            return $picname;
        }
    }
?>
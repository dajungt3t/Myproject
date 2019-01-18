<?php
    class Product extends CI_Controller {                                //product 클래스 선언
        function __construct() {                                         //클래스 생성 시 초기 선언
            parent::__construct();                             
            $this->load->database();                                     //DB연결                           
            $this->load->model("product_m");                             //model product_M.php 연결
            $this->load->helper(array("url","date"));
            #$this->load->library("pagination");                        //pagination
            $this->load->library("upload");                             //사진 업로드 라이브러리
            $this->load->library("form_validation");                    //검증 라이브러리
            $this->load->library("image_lib");
        }

        public function index() {                                       //제일 먼저 실행됨
            $this->lists();                                             //lists() 함수 호출
        }

        public function lists() {                                       //리스트, 사융자 검색
            #$text1=urldecode($this->uri->segment(4));                  //검색, decode
            $uri_array=$this->uri->uri_to_assoc(3);                     //uri문자열에서 변수명을 키로 갖는 연관배열로 만들어 주는 함수
            $text1=array_key_exists("text1", $uri_array) ? urldecode($uri_array["text1"]) : "";

            $data["text1"]=$text1;                                      //검색

            $data["list"] = $this->product_m->getlist($text1);          //목록 읽기

            $this->load->view("main_header");                           //상단메뉴 출력
            if($this->session->userdata("id")=="") {                    //로그인 상태에서만 리스트 확인
                $this->load->view("main_home", $data);
            } else {   
                $this->load->view("product_list", $data);                   //product_list에 자료 전달
            }
            $this->load->view("main_footer");                           //하단메뉴 출력
        }

        public function view() {                                        //사용자보기
            #$no = $this->uri->segment(4);                              //system/core/URI.php에 있는 함수, uri문자열에서 해당위치의 문자열값을 돌려줌
            $uri_array=$this->uri->uri_to_assoc(3);
            $no = array_key_exists("no", $uri_array) ? $uri_array["no"] : "";
            $text1 = array_key_exists("text1", $uri_array) ? urldecode($uri_array["text1"]) : "";
    
            $date["text1"]=$text1;
            $data["row"]=$this->product_m->getrow($no);                 //product_m의 getrow()함수 호출 하여 $data["row"]에 값 저장

            $this->load->view("main_header");                   
            $this->load->view("product_view", $data);                   //product_view에 자료 전달
            $this->load->view("main_footer");  
        }

        public function del() {                                         //사용자 삭제
            #$no = $this->uri->segment(4);
            $uri_array=$this->uri->uri_to_assoc(3);
            $no = array_key_exists("no", $uri_array) ? $uri_array["no"] : "";
            $text1 = array_key_exists("text1", $uri_array) ? "/text1/" .urldecode($uri_array["text1"]) : "";
            
            $this->product_m->deleterow($no);                   

            redirect("/ci/product/lists/" .$text1);                     //목록으로 돌아가기
        }

        public function add() {                                         //사용자 추가
            $uri_array=$this->uri->uri_to_assoc(3);
            $text1 = array_key_exists("text1", $uri_array) ? "/text1/" .urldecode($uri_array["text1"]) : "";

            $this->form_validation->set_rules("gubun_no", "구분명", "required");
            $this->form_validation->set_rules("name", "이름", "required|max_length[50]");
            $this->form_validation->set_rules("price", "단가", "required|numeric");
            
            #if (!$_POST) {                                             //추가버튼 클릭, 추가 화면으로 이동
            if($this->form_validation->run()==FALSE) {
                $data["list"] = $this->product_m->getlist_gubun();      //구분 리스트 불러오기

                $this->load->view("main_header");                   
                $this->load->view("product_add", $data);        
                $this->load->view("main_footer");  
            }
            else {                                                      //저장버튼 클릭
                $data = array(      
                    "product_no" => "",                                 //입력 값을 data 배열에 저장
                    "gubun_no" => $this->input->post("gubun_no", true),
                    "name" => $this->input->post("name", true),
                    "price" => $this->input->post("price", true),
                    "jaego" => $this->input->post("jaego", true),
                );
                $picname = $this->call_upload();
                if($picname) $data["pic"] = $picname;

                $result = $this->product_m->insertrow($data);          //데이터 저장

                redirect("/ci/product/lists".$text1);
            }
        }

        public function edit() {                                       //사용자 수정
            #$no = $this->uri->segment(4);
            $uri_array=$this->uri->uri_to_assoc(3);
            $no = array_key_exists("no", $uri_array) ? $uri_array["no"] : "";
            $text1 = array_key_exists("text1", $uri_array) ? "/text1/" .urldecode($uri_array["text1"]) : "";

            $this->load->library("form_validation");                  //폼검증 라이브러리 로드

            $this->form_validation->set_rules("gubun_no", "구분명", "required");
            $this->form_validation->set_rules("name", "이름", "required|max_length[50]");
            $this->form_validation->set_rules("price", "단가", "required|numeric");

            if($this->form_validation->run()==FALSE) {
                $data["list"] = $this->product_m->getlist_gubun();
                
                $this->load->view("main_header");                   
                $data["row"]=$this->product_m->getrow($no);           //사용자 정보 가져오기
                $this->load->view("product_edit", $data);                   
                $this->load->view("main_footer");  
            }
            else {                                                      //저장버튼 클릭
                $data = array(      
                    "product_no" => $no,                                //입력 값을 data 배열에 저장
                    "gubun_no" => $this->input->post("gubun_no", true),
                    "name" => $this->input->post("name", true),
                    "price" => $this->input->post("price", true),
                    "jaego" => $this->input->post("jaego", true),
                );
                $picname = $this->call_upload();
                if($picname) $data["pic"]=$picname;

                $result = $this->product_m->updaterow($data, $no);        //데이터 저장

                redirect("/ci/product/lists" .$text1);
            }

        }

        public function call_upload() {                                 //사진업로드
            $config["upload_path"] = "./my/img";
            $config["allowed_types"] = "gif|jpg|png";
            $config["overwhite"] = TRUE;
            $config["max_size"] = 10000000;
            $config["max_width"] = 10000;
            $config["max_height"] = 10000;
            $this->upload->initialize($config);

            if(!$this->upload->do_upload("pic")) {
                $picname = "";
            } else {
                $picname = $this->upload->data("file_name");

                //썸네일 환경설정
                $config["image_library"] = "gd2";
                $config["source_image"] = "./ci/my/img/".$picname;
                $config["thumb_marker"] = "";
                $config["new_image"] = "./ci/my/img/thumb";
                $config["create_thumb"] =TRUE;
                $config["maintain_ratio"] = TRUE;
                $config["width"] = 200;
                $config["height"] = 150;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
            }

            return $picname;
        }

        public function jaego() {
            $uri_array=$this->uri->uri_to_assoc(3);
            $text1 = array_key_exists("text1", $uri_array) ? "/text1/" .urldecode($uri_array["text1"]) : "";

            $data["text1"]=$text1;

            $this->product_m->cal_jaego();

            redirect("/ci/product/lists" .$text1);
        }
    }
?>
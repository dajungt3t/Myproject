<?php
    class Member extends CI_Controller {                                //Member 클래스 선언
        function __construct() {                                        //클래스 생성 시 초기 선언
            parent::__construct();                             
            $this->load->database();                                    //DB연결                           
            $this->load->model("member_m");                             //model Member_M.php 연결
            $this->load->helper(array("url","date"));
            $this->load->library("pagination");
        }

        public function index() {                                       //제일 먼저 실행됨
            $this->lists();                                             //lists() 함수 호출
        }

        public function lists() {                                       //리스트, 사융자 검색
            #$text1=urldecode($this->uri->segment(4));                  //검색, decode
            $uri_array=$this->uri->uri_to_assoc(3);                     //uri문자열에서 변수명을 키로 갖는 연관배열로 만들어 주는 함수
            $text1=array_key_exists("text1", $uri_array) ? urldecode($uri_array["text1"]) : "";

            if($text1=="") {
                $base_url = "/ci/member/lists/page";
            } else {
                $base_url = "/ci/member/lists/text1/$text1/page";
            }

            $page_segment = substr_count(substr($base_url, 0, strpos($base_url, "page")), "/") +1;
            
            $config["per_page"] = 5;
            $config["total_rows"] = $this->member_m->rowcount($text1);  //전체 개수
            $config["uri_segment"] = $page_segment;                     //page가 있는 segment
            $config["base_url"] = $base_url;
            $this->pagination->initialize($config);                     //page 초기화

            $data["page"] = $this->uri->segment($page_segment, 0);
            $date["pagination"] = $this->pagination->create_links();

            $start=$data["page"];
            $limit=$config["per_page"];

            $data["text1"]=$text1;                                      //검색

            $data["list"] = $this->member_m->getlist($text1, $start, $limit);            //목록 읽기

            $this->load->view("main_header");                           //상단메뉴 출력
            $this->load->view("member_list", $data);                    //member_list에 자료 전달
            $this->load->view("main_footer");                           //하단메뉴 출력
        }

        public function view() {                                        //사용자보기
            #$no = $this->uri->segment(4);                               //system/core/URI.php에 있는 함수, uri문자열에서 해당위치의 문자열값을 돌려줌
            $uri_array=$this->uri->uri_to_assoc(3);
            $no = array_key_exists("no", $uri_array) ? $uri_array["no"] : "";
            $text1 = array_key_exists("text1", $uri_array) ? urldecode($uri_array["text1"]) : "";
            $page = array_key_exists("page", $uri_array) ? urldecode($uri_array["page"]) : 0;

            $date["text1"]=$text1;
            $data["page"]=$page;
            $data["row"]=$this->member_m->getrow($no);                  //member_m의 getrow()함수 호출 하여 $data["row"]에 값 저장

            $this->load->view("main_header");                   
            $this->load->view("member_view", $data);                    //member_view에 자료 전달
            $this->load->view("main_footer");  
        }

        public function del() {                                         //사용자 삭제
            #$no = $this->uri->segment(4);
            $uri_array=$this->uri->uri_to_assoc(3);
            $no = array_key_exists("no", $uri_array) ? $uri_array["no"] : "";
            $text1 = array_key_exists("text1", $uri_array) ? "/text1/" .urldecode($uri_array["text1"]) : "";
            $page = array_key_exists("page", $uri_array) ? "/page/" .urldecode($uri_array["page"]) : 0;

            $this->member_m->deleterow($no);                   

            redirect("/ci/member/lists/");                              //목록으로 돌아가기
        }

        public function add() {                                         //사용자 추가
            $uri_array=$this->uri->uri_to_assoc(3);
            $text1 = array_key_exists("text1", $uri_array) ? "/text1/" .urldecode($uri_array["text1"]) : "";
            $page = array_key_exists("page", $uri_array) ? "/page/" .urldecode($uri_array["page"]) : 0;

            $this->load->library("form_validation");                    //검증 라이브러리

            $this->form_validation->set_rules("name", "이름", "required|max_length[10]");
            $this->form_validation->set_rules("id", "아이디", "required|max_length[20]");
            $this->form_validation->set_rules("pw", "비밀번호", "required|max_length[10]");

            #if (!$_POST) {                                             //추가버튼 클릭, 추가 화면으로 이동
            if($this->form_validation->run()==FALSE) {
                $this->load->view("main_header");                   
                $this->load->view("member_add");        
                $this->load->view("main_footer");  
            }
            else {                                                      //저장버튼 클릭
                $tel1 = $this->input->post("tel1", true);
                $tel2 = $this->input->post("tel2", true);
                $tel3 = $this->input->post("tel3", true);
                $tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);    //전화번호 합치기

                $data = array(      
                    'member_no' => "",                                  //입력 값을 data 배열에 저장
                    'name' => $this->input->post("name", true),
                    'id' => $this->input->post("id", true),
                    'pw' => $this->input->post("pw", true),
                    'tel' => $tel,
                    'level' => $this->input->post("level", true)
                );
                $result = $this->member_m->insertrow($data);            //데이터 저장

                redirect("/ci/member/lists".$text1);
            }
        }

        public function edit() {                                        //사용자 수정
            #$no = $this->uri->segment(4);
            $uri_array=$this->uri->uri_to_assoc(3);
            $no = array_key_exists("no", $uri_array) ? $uri_array["no"] : "";
            $text1 = array_key_exists("text1", $uri_array) ? "/text1/" .urldecode($uri_array["text1"]) : "";
            $page = array_key_exists("page", $uri_array) ? "/page/" .urldecode($uri_array["page"]) : 0;

            $this->load->library("form_validation");                    //폼검증 라이브러리 로드

            $this->form_validation->set_rules("name", "이름", "required|max_length[10]");
            $this->form_validation->set_rules("id", "아이디", "required|max_length[20]");
            $this->form_validation->set_rules("pw", "비밀번호", "required|max_length[10]");

            if($this->form_validation->run()==FALSE) {
                $this->load->view("main_header");                   
                $data["row"]=$this->member_m->getrow($no);              //사용자 정보 가져오기
                $this->load->view("member_edit", $data);                   
                $this->load->view("main_footer");  
            }
            else {                                                      //저장버튼 클릭
                $tel1 = $this->input->post("tel1", true);
                $tel2 = $this->input->post("tel2", true);
                $tel3 = $this->input->post("tel3", true);
                $tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);    //전화번호 합치기

                $data = array(      
                    'member_no' => $no,                                  //입력 값을 data 배열에 저장
                    'name' => $this->input->post("name", true),
                    'id' => $this->input->post("id", true),
                    'pw' => $this->input->post("pw", true),
                    'tel' => $tel,
                    'level' => $this->input->post("level", true)
                );
                $result = $this->member_m->updaterow($data, $no);        //데이터 저장

                redirect("/ci/member/lists" .$text1);
            }

        }
    }
?>
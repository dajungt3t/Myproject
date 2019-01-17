<?php
    class Gigan extends CI_Controller {                                //gigan 클래스 선언
        function __construct() {                                         //클래스 생성 시 초기 선언
            parent::__construct();                             
            $this->load->database();                                     //DB연결                           
            $this->load->model("gigan_m");                             //model gigan_M.php 연결
            $this->load->helper(array("url","date"));
            $this->load->library("PHPExcel");                        //pagination
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
            $text3 =array_key_exists("text3", $uri_array) ? urldecode($uri_array["text3"]) : "0";

            $base_url = "/gigan/lists/text1/$text1/text2/$text2/text3/$text3";

            $data["text1"]=$text1;   
            $data["text2"]=$text2;  
            $data["text3"]=$text3;                                     

            $data["list"] = $this->gigan_m->getlist($text1, $text2, $text3);          //목록 읽기

            $this->load->view("main_header");                           //상단메뉴 출력
            if($this->session->userdata('id')=="") {                    //로그인 상태에서만 리스트 확인
                $this->load->view("main_home", $data);
            } else {   
                $this->load->view("gigan_list", $data);                   //gigan_list에 자료 전달
            }
            $this->load->view("main_footer");                           //하단메뉴 출력
        }

        public function excel() {
            $uri_array=$this->uri->uri_to_assoc(3);
            $text1 = array_key_exists("text1", $uri_array) ? urldecode($uri_array["text1"]) : date("y-m-d", strtotime("-1 month"));
            $text2 = array_key_exists("text2", $uri_array) ? urldecode($uri_array["text2"]) : date("y-m-d", strtotime("-1 month"));
            $text3 = array_key_exists("text3", $uri_array) ? urldecode($uri_array["text3"]) : "0";

            $count = $this->gigan_m->rowcount($text1, $text2, $text3);      //레코드 갯수
            $list = $this->gigan_m->getlist($text1, $text2, $text3);        //모든 자료 얻기

            $objPHPExcel = new PHPExcel();                                  //엑셀 클래스 변수 선언

            //각 컬럼(너비, 정렬)
            $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension("B")->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension("C")->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension("E")->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension("F")->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension("G")->setWidth(12);
            $objPHPExcel->getActiveSheet()->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("B")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle("C:F")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->getActiveSheet()->getStyle("G")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            //제목(글자 크기, 굵게)
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A1", "매출입장");
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            
            //기간 (정렬)
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("G1", "기간:" . $text1 . "-" . $text2);
            $objPHPExcel->getActiveSheet()->getStyle("G1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            //2행 헤더 가운데 정렬
            $objPHPExcel->getActiveSheet()->getStyle("A2:G2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("A2:G2")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objPHPExcel->getActiveSheet()->getStyle("A2:G2")->getFill()->getStartColor()->setARGB('FFCCCCCC');
            
            //헤더 글자 출력
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("A2", "날짜")
            ->setCellValue("B2", "제품명")
            ->setCellValue("C2", "단가")
            ->setCellValue("D2", "매입수량")
            ->setCellValue("E2", "매출수량")
            ->setCellValue("F2", "금액")
            ->setCellValue("G2", "비고");

            $i = 3;         //3행부터 자료 출력
            foreach($list as $row) {
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("A$i", $row->date)
                ->setCellValue("B$i", $row->product_name)
                ->setCellValue("C$i", $row->price ? $row->price : "")
                ->setCellValue("D$i", $row->numi ? $row->numi : "")
                ->setCellValue("E$i", $row->numo ? $row->numo : "")
                ->setCellValue("F$i", $row->cost? $row->cost : "")
                ->setCellValue("G$i", $row->note);
                
                $i++;
            }
            
            $objPHPExcel->setActiveSheetIndex(0);
            
            $fname="매출입장($text1~$text2).xlsx";
            $fname=iconv("UTF-8", "EUC-KR", $fname);
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment;filename=$fname");
            header("Cache-Control: max-age=0");
            header("Cache-Control: max-age=1");

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
            $objWriter->save("php://output");
        }
    }
?>
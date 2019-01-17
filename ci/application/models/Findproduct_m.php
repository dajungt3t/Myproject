<?php
    class Findproduct_m extends CI_Model {
        public function getlist($text1) {                //목록
            if($text1 == "") {                           //전체 리스트
                $sql="SELECT product.*, 
                             gubun.name AS gubun_name 
                        FROM PRODUCT LEFT JOIN GUBUN ON (product.gubun_no = gubun.gubun_no)
                       ORDER BY product_no";
            } else {                                    //검색 리스트
                $sql="SELECT product.*, 
                             gubun.name AS gubun_name 
                        FROM PRODUCT LEFT JOIN GUBUN ON (product.gubun_no = gubun.gubun_no)
                       WHERE product.name LIKE '%$text1%' 
                       ORDER BY product_no";
            }
            return $this->db->query($sql)->result();
        }

        function getrow($no) {                          //상세보기
            $sql = "SELECT product.*, 
                           gubun.name AS gubun_name 
                      FROM PRODUCT LEFT JOIN GUBUN ON (product.gubun_no = gubun.gubun_no)
                     WHERE product_no=$no";
            return $this->db->query($sql)->row();
        }

        function rowcount($text1) {
            if(!$text1) {
                $sql = "SELECT * FROM PRODUCT";
            }  else {
                $sql = "SELECT * FROM PRODUCT WHERE name LIKE '%$text1%'";
            }
        }
    }
?>
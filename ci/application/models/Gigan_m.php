<?php
    class Gigan_m extends CI_Model {
        public function getlist($text1, $text2, $text3) {           //목록                             //검색 리스트
            if($text3 =="0") { //제품이 전체인 경우
                $sql = "SELECT jangbu.*,
                               product.name AS product_name
                          FROM jangbu LEFT JOIN product ON (jangbu.product_no = product.product_no)      
                         WHERE jangbu.date between'$text1' and '$text2'
                         ORDER BY jangbu_no";
            } else { 
                $sql = "SELECT jangbu.*,
                               product.name AS product_name
                          FROM jangbu LEFT JOIN product ON (jangbu.product_no = product.product_no)  
                         WHERE jangbu.date between'$text1' and '$text2'
                           AND jangbu.product_no = '$text3'
                         ORDER BY jangbu_no";
            }
            return $this->db->query($sql)->result();
        }

        function getlist_product() {               //제품리스트
            $sql = "SELECT *
                      FROM product
                     ORDER BY name";
            return $this->db->query($sql)->result();
        }

        public function rowcount($text1, $text2, $text3) {
            $sql ="SELECT *
                     FROM JANGBU
                    WHERE io = 1
                      AND jangbu.date between'$text1' and '$text2'";
            return $this->db->query($sql)->num_rows();
        }

    }
?>
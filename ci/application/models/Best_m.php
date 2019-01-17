<?php
    class Best_m extends CI_Model {
        public function getlist($text1, $text2) {           //목록                             //검색 리스트
            $sql = "SELECT product.name AS product_name,
                           COUNT(jangbu.numo) AS cnumo
                      FROM jangbu LEFT JOIN product ON (jangbu.product_no = product.product_no)      
                     WHERE jangbu.date between'$text1' and '$text2'
                     GROUP BY product.name
                     ORDER BY cnumo";
            return $this->db->query($sql)->result();
        }
    }
?>
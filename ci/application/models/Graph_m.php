<?php
    class Graph_m extends CI_Model {
        public function getlist($text1, $text2) {           //목록                             //검색 리스트
            $sql = "SELECT gubun.name AS gubun_name,
                           COUNT(jangbu.numo) AS cnumo
                      FROM (GUBUN RIGHT JOIN 
                           PRODUCT ON gubun.gubun_no = product.gubun_no) RIGHT JOIN
                           JANGBU ON product.product_no = jangbu.product_no
                     WHERE jangbu.date between'$text1' and '$text2'
                     GROUP BY gubun.name
                     ORDER BY cnumo LIMIT 10";
            return $this->db->query($sql)->result();
        }

        public function rowcount($text1, $text2) {
            $sql ="SELECT gubun.name AS gubun_name,
                          COUNT(jangbu.numo) AS cnumo
                     FROM (GUBUN RIGHT JOIN 
                          PRODUCT ON gubun.gubun_no = product.gubun_no) RIGHT JOIN
                          JANGBU ON product.produt_no = janbu.product_no
                    WHERE jangbu.date between'$text1' and '$text2'
                    GROUP BY gubun.name LIMIT 10";
        }
    }
?>
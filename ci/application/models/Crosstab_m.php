<?php
    class Crosstab_m extends CI_Model {
        public function getlist($text1) {           //목록                             //검색 리스트
            $sql = "SELECT product.name AS product_name,
                           SUM(if(month(jangbu.date)=1, jangbu.numo, 0)) AS s1,
                           SUM(if(month(jangbu.date)=2, jangbu.numo, 0)) AS s2,
                           SUM(if(month(jangbu.date)=3, jangbu.numo, 0)) AS s3,
                           SUM(if(month(jangbu.date)=4, jangbu.numo, 0)) AS s4,
                           SUM(if(month(jangbu.date)=5, jangbu.numo, 0)) AS s5,
                           SUM(if(month(jangbu.date)=6, jangbu.numo, 0)) AS s6,
                           SUM(if(month(jangbu.date)=7, jangbu.numo, 0)) AS s7,
                           SUM(if(month(jangbu.date)=8, jangbu.numo, 0)) AS s8,
                           SUM(if(month(jangbu.date)=9, jangbu.numo, 0)) AS s9,
                           SUM(if(month(jangbu.date)=10, jangbu.numo, 0)) AS s10,
                           SUM(if(month(jangbu.date)=11, jangbu.numo, 0)) AS s11,
                           SUM(if(month(jangbu.date)=12, jangbu.numo, 0)) AS s12
                      FROM JANGBU LEFT JOIN PRODUCT ON jangbu.product_no = product.product_no
                     WHERE year(jangbu.date) = $text1
                     GROUP BY jangbu.product_no
                     ORDER BY product.name";
            return $this->db->query($sql)->result();
        }
    }
?>
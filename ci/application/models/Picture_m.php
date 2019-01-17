<?php
    class Picture_m extends CI_Model {
        public function getlist($text1) {                //목록
            if($text1 == "") {                           //전체 리스트
                $sql="SELECT *
                        FROM PRODUCT
                       ORDER BY name";
            } else {                                    //검색 리스트
                $sql="SELECT *
                        FROM PRODUCT
                       WHERE name LIKE '%$text1%' 
                       ORDER BY name";
            }
            return $this->db->query($sql)->result();
        }

        function rowcount($text1) {
            if(!$text1) {
                $sql = "SELECT * FROM PRODUCT";
            }  else {
                $sql = "SELECT * FROM PRODUCT WHERE name LIKE '%$text1%'";
            }

            return $this->db->query($sql)->num_rows();
        }
    }
?>
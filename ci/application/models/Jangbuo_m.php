<?php
    class jangbuo_m extends CI_Model {
        public function getlist($text1) {           //목록                             //검색 리스트
            $sql="SELECT jangbu.*, 
                         product.name AS product_name 
                    FROM jangbu LEFT JOIN product ON (jangbu.product_no = product.product_no)
                   WHERE jangbu.io = 1
                     #AND jangbu.date = '$text1' 
                   ORDER BY jangbu_no";

            return $this->db->query($sql)->result();
        }

        function getrow($no) {                      //상세보기
            $sql = "SELECT jangbu.*, 
                           product.name AS product_name 
                      FROM jangbu LEFT JOIN product ON (jangbu.product_no = product.product_no)
                     WHERE jangbu_no=$no";
            return $this->db->query($sql)->row();
        }

        function deleterow($no) {                   //삭제
            $sql = "DELETE FROM jangbu WHERE jangbu_no=$no";
            return $this->db->query($sql);
        }

        function insertrow($row) {                  //등록
            #$sql = "INSERT INTO jangbu (jangbu_no, name, id, pw, tel, level) VALUES ('', $name, $id, $pw, $tel, $level)";
            #return $this->db->query($sql);
            return $this->db->insert("jangbu", $row);
        }

        function updaterow($row, $no) {             //수정
            $where=array("jangbu_no"=>$no);
            return $this->db->update("jangbu", $row, $where);
        }

        function getlist_product() {               //제품리스트
            $sql = "SELECT *
                      FROM product
                     ORDER BY name";
            return $this->db->query($sql)->result();
        }

    }
?>
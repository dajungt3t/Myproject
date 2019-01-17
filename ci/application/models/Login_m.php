<?php
    class Login_m extends CI_Model {
        public function getrow($id, $pw) {           //목록                             //검색 리스트
            $sql = "SELECT * 
                      FROM MEMBER
                     WHERE id = '$id'
                       AND pw = '$pw'";
            return $this->db->query($sql)->row();
        }
    }
?>
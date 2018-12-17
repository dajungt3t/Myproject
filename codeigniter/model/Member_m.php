<?php
    class Member_m extends CI_Model {
        public function getlist($text1, $start, $limit) {
            if(!$text1) {                           //전체 리스트
                $sql="SELECT * FROM member ORDER BY member_no LIMIT $start, $limit";
            } else {                                //검색 리스트
                $sql="SELECT * FROM member WHERE name LIKE '%$text1%' ORDER BY member_no LIMIT $start, $limit";
            }
            return $this->db->query($sql)->result();
        }

        function getrow($no) {                      //상세보기
            $sql = "SELECT * FROM member WHERE member_no=$no";
            return $this->db->query($sql)->row();
        }

        function deleterow($no) {                   //삭제
            $sql = "DELETE FROM member WHERE member_no=$no";
            return $this->db->query($sql);
        }

        function insertrow($row) {                  //등록
            #$sql = "INSERT INTO member (member_no, name, id, pw, tel, level) VALUES ('', $name, $id, $pw, $tel, $level)";
            #return $this->db->query($sql);
            return $this->db->insert("member", $row);
        }

        function updaterow($row, $no) {             //수정
            $where=array("member_no"=>$no);
            return $this->db->update("member", $row, $where);
        }

        public function rowcount($text1) {
            if (!$text1) {
                $sql = "SELECT * FROM member ORDER BY member_no";
            } else { 
                $sql = "SELECT * FROM member WHERE name LIKE '%$text1%' ORDER BY memer_no";
            }
            return $this->db->query($sql)->num_row();
        }

    }
?>
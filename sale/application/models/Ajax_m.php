<?php
    class Ajax_m extends CI_Model {
        public function getlist($text1) {
            if(!$text1) {                           //전체 리스트
                $sql="SELECT * FROM gubun ORDER BY gubun_no";
            } else {                                //검색 리스트
                $sql="SELECT * FROM gubun WHERE name LIKE '%$text1%' ORDER BY gubun_no";
            }
            return $this->db->query($sql)->result();
        }

        function getrow($no) {                      //상세보기
            $sql = "SELECT * FROM gubun WHERE gubun_no=$no";
            return $this->db->query($sql)->row();
        }

        function deleterow($no) {                   //삭제
            $sql = "DELETE FROM gubun WHERE gubun_no=$no";
            return $this->db->query($sql);
        }

        function insertrow($row) {                  //등록
            #$sql = "INSERT INTO gubun (gubun_no, name, id, pw, tel, level) VALUES ('', $name, $id, $pw, $tel, $level)";
            #return $this->db->query($sql);
            return $this->db->insert("gubun", $row);
        }

        function updaterow($row, $no) {             //수정
            $where=array("gubun_no"=>$no);
            return $this->db->update("gubun", $row, $where);
        }

    }
?>
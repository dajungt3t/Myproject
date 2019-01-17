<?php
    class Product_m extends CI_Model {
        public function getlist($text1) {           //목록
            if($text1 == "") {                           //전체 리스트
                $sql="SELECT product.*, 
                             gubun.name AS gubun_name 
                        FROM PRODUCT LEFT JOIN GUBUN ON (product.gubun_no = gubun.gubun_no)
                       ORDER BY product_no";
            } else {                                //검색 리스트
                $sql="SELECT product.*, 
                             gubun.name AS gubun_name 
                        FROM PRODUCT LEFT JOIN GUBUN ON (product.gubun_no = gubun.gubun_no)
                       WHERE product.name LIKE '%$text1%' 
                       ORDER BY product_no";
            }
            return $this->db->query($sql)->result();
        }

        function getrow($no) {                      //상세보기
            $sql = "SELECT product.*, 
                           gubun.name AS gubun_name 
                      FROM PRODUCT LEFT JOIN GUBUN ON (product.gubun_no = gubun.gubun_no)
                     WHERE product_no=$no";
            return $this->db->query($sql)->row();
        }

        function deleterow($no) {                   //삭제
            $sql = "DELETE FROM product WHERE product_no=$no";
            return $this->db->query($sql);
        }

        function insertrow($row) {                  //등록
            #$sql = "INSERT INTO product (product_no, name, id, pw, tel, level) VALUES ('', $name, $id, $pw, $tel, $level)";
            #return $this->db->query($sql);
            return $this->db->insert("product", $row);
        }

        function updaterow($row, $no) {             //수정
            $where=array("product_no"=>$no);
            return $this->db->update("product", $row, $where);
        }

        function getlist_gubun() {                  //구분리스트
            $sql = "SELECT *
                      FROM GUBUN
                     ORDER BY name";
            return $this->db->query($sql)->result();
        }

        function cal_jaego() {
            $sql="DROP TABLE  if exists TEMP;";
            $this->db->query($sql);

            $sql="CREATE TABLE TEMP (
                  jaego_no int not null auto_increment,
                  product_no int,
                  jaego int default 0,
                  primary key(jaego_no));";
            $this->db->query($sql);

            $sql="UPDATE PRODUCT
                     SET jaego = 0;";
            $this->db->query($sql);
                
            $sql="INSERT INTO TEMP(product_no, jaego)
                  SELECT product_no, sum(numi) - sum(numo) 
                    FROM JANGBU
                   GROUP BY product_no;";
            $this->db->query($sql);  

            $sql="UPDATE PRODUCT INNER JOIN
                         TEMP on product.product_no = temp.product_no
                     SET product.jaego = temp.jaego;";
            $this->db->query($sql);           
        }

    }
?>
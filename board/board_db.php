<?php
session_start();
	header('Content-Type: text/html; charset=utf-8'); // utf-8인코딩

    $db = mysqli_connect("localhost", "root", "1q2w3e4r5t", "test");
    #$db = new mysqli("localhost","root","1q2w3e4r5t","test");
    #$db->set_charset("utf8");
    
	function mq($sql)
	{
		global $db;
		return $db->query($sql);
    }
    
/*
$sql_host = "localhost";
$sql_user = "root";
$sql_pw = "1q2w3e4r5t";
$sql_db = "test";

$conn = mysql_connect($sql_host, $sql_user, $sql_pw, $sql_db);

if($conn) {
    die("실패실패: " . mysql_connect_error());
}

session_start();
*/

?>
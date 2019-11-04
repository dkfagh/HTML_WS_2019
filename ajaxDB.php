<?php
header("Content-Type: text/xml");

$mysql_hostname = 'localhost';
$mysql_username = 'dkfagh';
$mysql_password = 'axf134698!';
$mysql_database = 'dkfagh';
$mysql_port = '3306';
$mysql_charset = 'utf8';

//1. DB 연결
$connect = @mysql_connect($mysql_hostname.':'.$mysql_port, $mysql_username, $mysql_password);

if(!$connect){
	echo '[연결실패] : '.mysql_error().'<br>';//에러메세지 출력
	die('MySQL 서버에 연결할 수 없습니다.');
    
} 
//2. DB 선택
@mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');

//3. 문자셋 지정
mysql_query(' SET NAMES '.$mysql_charset);

//4. 쿼리 생성
$query = 'select name,price from products;';

//5. 쿼리 실행
$result = mysql_query($query);



//6. 결과 처리
$output='<?xml version="1.0" encoding="UTF-8"?>';
$output.='<products>';// 루트엘리먼트
while($row = mysql_fetch_array($result))
{
	//echo $row['name'].'<br>';
    $output.='<product>';
    $output.='<name>'.$row['name'].'</name>';
    $output.='<price>'.$row['price'].'</price>';
    $output.='</product>';
}
$output.='</products>';

echo $output;//출력

//6. 연결 종료
mysql_close($connect);

?>
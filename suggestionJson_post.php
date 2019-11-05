<?php
header("Content-Type: text/json; charset=UTF-8"); 

$mysql_hostname = 'localhost';
$mysql_username = 'dkfagh';
$mysql_password = 'axf134698!';
$mysql_database = 'dkfagh';
$mysql_port = '3306';
$mysql_charset = 'utf8';

//넘어오는 패러미터 값을 받음.
$q = $_REQUEST["q"];//값을 받음.  q:패러미터 이름


//1. DB 연결
$connect = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password);

if(!$connect){
	echo '[연결실패] : '.mysqli_error().'<br>'; 
	die('MySQL 서버에 연결할 수 없습니다.');
    
} 
//2. DB 선택
mysqli_select_db($connect,$mysql_database) or die('DB 선택 실패');

//3. 문자셋 지정
mysqli_query($connect, ' SET NAMES '.$mysql_charset);

//4. 쿼리 생성
$query = 'select address,zipcode from post where address like \'%'.$q.'%\'';

//5. 쿼리 실행
$result = mysqli_query($connect, $query);


$output='';


while($row = mysqli_fetch_array($result))
{	
    if ($output!="")//빈 문자열이 아닐때
    {
        $output.= ",";//콤마붙이기    .=는 +=와 같다(php 문자열 연결)
    }

    $output.='{"address":"'.$row['address'].'","zipcode":"'.$row['zipcode'].'"}';  
   
}
$output='['.$output.']';

echo $_GET["callback"]."(".$output.")";

//6. 연결 종료
mysqli_close($connect);

?>
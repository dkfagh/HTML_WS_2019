<?php
header("Content-Type: text/json; charset=UTF-8"); 

$mysql_hostname = 'localhost';
$mysql_username = 'dkfagh';
$mysql_password = 'axf134698!';
$mysql_database = 'dkfagh';
$mysql_port = '3306';
$mysql_charset = 'utf8';

//1. DB 연결
$connect = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password); 

if(!$connect){
    echo '[연결실패] : '.mysqli_error().'<br>'; 
    die('MySQL 서버에 연결할 수 없습니다.');
} 
//2. DB 선택
mysqli_select_db($connect,$mysql_database) or die('DB 선택 실패');

//3. 문자셋 지정
mysqli_query($connect,' SET NAMES '.$mysql_charset);

//4. 쿼리 생성
$query = "select id,name,address from member where id='".$_REQUEST["id"]."';";

//5. 쿼리 실행
$result = mysqli_query($connect,$query);


//6. 결과 처리
$output='';
while($row = mysqli_fetch_array($result))
{   
    if ($output!="")
    {
        $output.= ",";//콤마붙이기
    }
    $output.='{"id":"'.$row['id'].'","name":"'.$row['name'].'","address":"'.$row['address'].'"}';  
}
//$output='['.$output.']';   //검색되는 객체가 하나이기 때문에 굳이 배열을 사용 할 필요가 없음

echo $output;

//6. 연결 종료
mysqli_close($connect);
?>
<?php
//找到字符串中的数字
function findNum($str=''){
        $str=trim($str);
        if(empty($str)){return '';}
        $reg='/(\d{3}(\.\d+)?)/is';//匹配数字的正则表达式
        preg_match_all($reg,$str,$result); if(is_array($result)&&!empty($result)&&!empty($result[1])&&!empty($result[1][0])){
            return $result[1][0];
        }
        return '';
    }
session_start ();
$con = mysql_connect ("localhost", "root", "hedyfattoo");   //连接数据库
mysql_select_db ("yuyuedb", $con);		//使用预约数据库
$num = $_POST['number'];
$delsql = "delete from appointment where room='$num'";
mysql_query ($delsql);
mysql_select_db ("roomdb", $con);			//使用房间数据库
$onlynum = findNum ($num);
$room;
if (strlen($onlynum) == 3)
{
	$update = "update classroom set user=NULL where roomid='$onlynum'";
	mysql_query ($update);
	echo '<script language=javascript>alert("取消成功")</script>';
    echo '<script language = javascript> window.location.href="http://localhost/appointment.php"</script>';
}
else
{
	$update = "update library set user=NULL where roomid='1'";
	mysql_query ($update);
	echo '<script language=javascript>alert("取消成功")</script>';
    echo '<script language = javascript> window.location.href="http://localhost/appointment.php"</script>';
}
?>

<?php
session_start ();
$con = mysql_connect ("localhost", "root", "hedyfattoo");   //连接数据库
mysql_selectdb ("yuyuedb", $con);   //选择预约数据库
$username = $_SESSION['user'];
$sql = "select room,date from appointment where user = '$username' order by date";	//查询预约情况的sql语句
$result = mysql_query ($sql);	
echo '<div align="center">';
if (mysql_num_rows($result) != 0)	//若查询结果非空
{
	echo '<div>';
	echo "<h2>您的预约情况如下：</h2>";
	echo "</div>";
	echo '<table border="1">';
	echo '<tr>';
	echo '<td>使用时间</td>';
	echo '<td>预约资源</td>';
	echo '</tr>';
	while($row = mysql_fetch_array($result))
	{
		echo '<tr>';
		echo '<td>'.$row['date'].'</td>';
		echo '<td>'.$row['room'].'</td>';
		echo '</tr>';
	}
	echo "</table>";
	echo "</div>";
}
else
{
	echo '<script language = javascript> alert ("暂无预约！")</script>';
	echo '<script language = javascript> window.location.href="http://localhost/yuyue.php"</script>';
}
echo '</div>';
echo '<br>';
echo '<div align="center">';
echo '<form action="cancel.php" method="post">';
echo '请输入资源：<input type="text" name="number">';
echo '<input type="submit" name="cancel" value="取消预约">';
echo '</form>';
echo '</div>';

?>
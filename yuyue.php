<?php
    session_start ();
    //$_SESSION['user'] = false;
    if (!isset($_SESSION['user']))
    {
        echo '<script language = javascript> alert ("游客您好～请先登陆") </script>';
        echo '<script language = javascript> window.location.href="http://loalhost/login.html"</script>';
    }
?>


<html>
<head>
<title>学生预约</title>
</head>
<body>
<div align="center">
	<h2>欢迎来到学生预约系统</h2>
</div>
<div align="center">
    <form action="mkappointment.php" method="post">
        请输入需要预约教室或阅览室：<input type="text" name="room">
        <input type="radio" name="type1" value="class">教室</input>
        <input type="radio" name="type1" value="lib">图书馆</input>
        <input type="submit" name="mkappointment" value="预约">
    </form>
	<form action="appointment.php" method="post">
		<input type="submit" name="myappointment" value="我的预约">
	</form>
    <form method="post">
        <br>
        <input type="radio" name="type" value="classroom">教室</input>
        <input type="radio" name="type" value="library">图书馆</input>
        <input type="submit" name="mkappointment" value="查看使用情况">
        <br>
<?php
session_start ();
$con = mysql_connect ("localhost", "root", "hedyfattoo");   //连接数据库
mysql_selectdb ("roomdb", $con);   //选择可预约房间的数据库
if ($_POST['type'] == 'classroom')
{
    $sql = "select * from classroom";
    $result = mysql_query ($sql);
    if (mysql_num_rows($result) != 0)   //若查询结果非空
    {
        echo '<div>';
        echo "<h2>教室使用情况如下：</h2>";
        echo "</div>";
        echo '<table border="1">';
        echo '<tr>';
        echo '<td>教室</td>';
        echo '<td>使用情况</td>';
        echo '</tr>';
        while($row = mysql_fetch_array($result))
        {
            echo '<tr>';
            echo '<td>'.$row['roomid'].'</td>';
            if ($row['user'] == NULL)
                echo '<td>'.'可用'.'</td>';
            else
                echo '<td>'.'不可用'.'</td>';
            echo '</tr>';
        }
        echo "</table>";
        echo "</div>";
    }

}
if ($_POST['type'] == 'library')
{
    $sql = "select * from library";
    $result = mysql_query ($sql);
    if (mysql_num_rows($result) != 0)   //若查询结果非空
    {
        echo '<div>';
        echo "<h2>图书馆使用情况如下：</h2>";
        echo "</div>";
        echo '<table border="1">';
        echo '<tr>';
        echo '<td>阅览室</td>';
        echo '<td>使用情况</td>';
        echo '</tr>';
        while($row = mysql_fetch_array($result))
        {
            echo '<tr>';
            echo '<td>'.$row['roomid'].'</td>';
            if ($row['user'] == NULL)
                echo '<td>'.'可用'.'</td>';
            else
                echo '<td>'.'不可用'.'</td>';
            echo '</tr>';
        }
        echo "</table>";
        echo "</div>";
    }
}
?>
    </from>
</div>
</body>
</html>
<?php
session_start ();
$username = $_SESSION['user'];
$roomid = $_POST['room'];
$con = mysql_connect ("localhost", "root", "hedyfattoo");   //连接数据库
mysql_selectdb ("roomdb", $con);   //选择可预约房间的数据库
if ($_POST['type1'] == 'class')
{
    $sql = "select * from classroom where roomid = $roomid";
    $result = mysql_query ($sql);
    while($row = mysql_fetch_array($result))
    {
        if ($row['user'] == NULL)
        {
            $update = "update classroom set user = '$username' where roomid= $roomid";
            mysql_query ($update);
            mysql_selectdb ("yuyuedb", $con);
            $date = date ("Y-m-d");
            $insert = "insert into appointment (user, room, date) values ('$username', 'classroom:$roomid', '$date')";
            mysql_query ($insert);
            echo '<script language = javascript>alert("预约成功！")</script>';
            echo '<script language = javascript> window.location.href="http://localhost/yuyue.php"</script>';
        }
        else
        {
            echo '<script language=javascript>alert("该教室或阅览室已被预约")</script>';
            echo '<script language = javascript> window.location.href="http://localhost/yuyue.php"</script>';
        }
    }
}

if ($_POST['type1'] == 'lib')
{
    $sql = "select * from library where roomid = '$roomid'";
    $result = mysql_query ($sql);
    while($row = mysql_fetch_array($result))
    {
        if ($row['user'] == NULL)
        {
            $update = "update library set user = '$username' where roomid= '$roomid'";
            mysql_query ($update);
            mysql_selectdb ("yuyuedb", $con);
            $date = date ("Y-m-d");
            $insert = "insert into appointment (user, room, date) values ('$username', 'library:$roomid', '$date')";
            mysql_query ($insert);
            echo '<script language = javascript>alert("预约成功！")</script>';
            echo '<script language = javascript> window.location.href="http://localhost/yuyue.php"</script>';
        }
        else
        {
            echo '<script language=javascript>alert("该教室或阅览室已被预约")</script>';
            echo '<script language = javascript> window.location.href="http://localhost/yuyue.php"</script>';
        }
    }
}

?>

<?php
    session_start ();
    //$_SESSION['user'] = false;
    if (isset ($_SESSION['user']))
    {
        echo "登陆成功！"."<br>";
        echo "欢迎您！".$_SESSION['user']."<br>";
    }
    else
    {
        echo '<script language = javascript> alert ("游客您好～请先登陆") </script>';
        echo '<script language = javascript> window.location.href="http://localhost/home/login/login.html"</script>';
    }
?>

<html>
<head>
<title>home page</title>
</head>
<body>
<a href="yuyue.php">点我预约</a>
</body>
</html>


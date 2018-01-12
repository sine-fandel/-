<?php
//session_stiart ();

//判断是否有重复用户名
$con = mysql_connect ("localhost", "root", "hedyfattoo");
mysql_select_db ("g_logindb", $con);
$i = 0;   //若有重名则为1
$name = mysql_query ("select username from students");
while ($row = mysql_fetch_array ($name))
{
    if ($row["username"] == $_POST["username"])
    {
        $i = 1;
        echo '<script language = javascript>alert ("the username is exited")</script>';
        $url = "signin.html";
        break;
    }
}

//判断密码是否一致
$pwd1 = $_POST["password1"];
$pwd2 = $_POST["password2"];
if ($pwd1 != $pwd2 and $i != 1)
{
    $url = "signin.html";   //若两次密码不一致，返回注册页面
    echo '<script language = javascript>alert ("the password is not the same")</script>';
    //echo "<meta http-equiv=\"refresh\" content=\"0.5;url=$urls\">";
}
if ($pwd1 == $pwd2 and $i != 1)
{
    $nusr = $_POST["username"];     //获取用户名
    $npwd = $_POST["password1"];     //获取密码
    $newsql = "insert into students(username, password) values ('$nusr', md5('$npwd'))";        //这里为什么要单引号？变量的值难道不是字符串吗
    if(!mysql_query ($newsql));     //插入数据库
    {
        echo mysql_error();
    }
    $url = "login.html";   //注册完成后返回登陆页面
    echo '<script language = javascript>alert ("sign in successfully!")</script>';
}
echo "<meta http-equiv=\"refresh\" content=\"0.5;url=$url\">"; 

?>

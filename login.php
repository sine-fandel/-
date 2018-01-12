<?php
$con = mysql_connect ("localhost", "root", "hedyfattoo");   //连接数据库
$post = $_POST;   //获取表单内容
//去除空格
foreach ($post as $key => $value)
  $post[$key] = trim($value);

//判断是否输入了账号密码
if ($post['username'] == null)
{
    echo '<script language = javascript> alert ("用户名不能为空")</script>';
    echo '<script language = javascript> window.location.href="http://localhost/login.html"</script>';
}
else if ($post['password'] == null)
{
    echo '<script language = javascript> alert ("密码不能为空")</script>';
    echo '<script language = javascript> window.location.href="http://localhost/login.html"</script>';
}

//判断是学生还是管理员
if ($post['who'] == 'student')
{
  $username = $post['username'];        //获取输入的用户名
  $password = md5($post['password']);   //获取输入密码的哈希值

  mysql_selectdb ("g_logindb", $con);   //选择登陆数据库
  //sql语句选择账号密码对应的用户
  $sql = "select username from students where username = '$username' and password = '$password'";
  $result = mysql_query ($sql);
  $row = mysql_fetch_array ($result);
  if (!empty ($row))
  {
      session_start ();   // 启动session
      $_SESSION['user'] = $username;
      echo '<script language = javascript> window.location.href="http://localhost/s_home.php" </script>';
  }
  else
  {
      echo '<script language = javascript> alert ("用户名或密码错误!")</script>';
      echo '<script language = javascript> window.location.href="http://localhost/login.html" </script>';
  }
}

else
{
  $username = $post['username'];        //获取输入的用户名
  $password = md5($post['password']);   //获取输入密码的哈希值

  mysql_selectdb ("g_logindb", $con);   //选择登陆数据库
  //sql语句选择账号密码对应的用户
  $sql = "select username from manager where username = '$username' and password = '$password'";
  $result = mysql_query ($sql);
  $row = mysql_fetch_array ($result);
  if (!empty ($row))
  {
      session_start ();   // 启动session
      $_SESSION['user'] = true;
      echo '<script language = javascript> window.location.href="http://localhost/s_home.html" </script>';
  }
  else
  {
      echo '<script language = javascript> alert ("用户名或密码错误!")</script>';
      echo '<script language = javascript> window.location.href="http://localhost/login.html" </script>';
  }
}

?>

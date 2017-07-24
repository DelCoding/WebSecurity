<?php
/**
 * Created by PhpStorm.
 * User: Junay
 * Date: 2017/7/24
 * Time: 15:57
 */

if (isset($_COOKIE["cookie"])){
    if ($_COOKIE["cookie"]['user'] != "Junay"){
        echo "<p>";
        echo "<h2>你无权访问当前页面！</h2><br>";
        echo "<h3><a href='index.php'>请登录</a></h3><br>";
        //header("Location: http://202.192.32.64/WebSecurity/index.php"); //页面自动跳转
        echo "</p>";
        die("正在退出");
    }
    else {
        date_default_timezone_set("Asia/Shanghai");
        echo "<h3>现在是：".date("h:i:sa")."<br></h3>";
        echo "<h2><b>欢迎你，".$_COOKIE["cookie"]['user']."</b></h2><br>";
    }
}
else {
    echo "<p>";
    echo "<h2 style=\"background-color: deepskyblue\">无权访问当前页面！</h2><br>";
    echo "<h3><a href='index.php'>请登录</a></h3><br>";
    echo "</p>";
    die();
}

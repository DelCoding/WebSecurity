<?php
if (isset($_COOKIE["user"])){
    if ($_COOKIE["user"] != "Junay"){
        echo "<p>";
        echo "<h2>你无权访问当前页面！</h2><br>";
        echo "<h3><a href='index.php'>请登录</a></h3><br>";
        header("Location: http://202.192.32.64/WebSecurity/main.php"); //页面自动跳转
	echo "</p>";
        die("正在退出");
    }
    else {
        date_default_timezone_set("Asia/Shanghai");
        echo "<h3>现在是：".date("h:i:sa")."<br></h3>";
        echo "<h2><b>欢迎你，".$_COOKIE["user"]."</b></h2><br>";
    }
}
else {
    echo "<p>";
    echo "<h2 style=\"background-color: deepskyblue\">无权访问当前页面！</h2><br>";
    echo "<h3><a href='index.php'>请登录</a></h3><br>";
    echo "</p>";
    die();
}
?>

<html>
<head>
    <title>主界面</title>
    <center>
        <h1 style="background-color: aqua">导航</h1><br>
    </center>
</head>
<body>
    <center>
        <h3>
        <ul>
        <li><a name="a1" onmouseover="changeOver(this)" onmouseout="changeOut(this)" href="sqli.php">SQL注入</a><br></li>
        <li><a name="a2" onmouseover="changeOver(this)" onmouseout="changeOut(this)" href="xss.php">XSS+CSRF</a><br></li>
        <li><a name="a3" onmouseover="changeOver(this)" onmouseout="changeOut(this)" href="fileupload.php">文件上传</a><br></li>
        </ul>
        </h3>
    </center>
</body>
<script>
    function changeOver(obj){
        obj.style="background-color: deepskyblue";
    }
    function changeOut(obj){
        obj.style="background-color: #ffffff";
    }
</script>
</html>

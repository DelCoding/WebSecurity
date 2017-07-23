
<html>

<head>
    <title>主界面</title>
    <form name="forms" method="post" action="index.php" onSubmit="return checkform(this)" >
        <center>
        <h1 style="background-color: bisque"><b>登陆</b></h1><br>
        <table border="3">
        <tr>
            <td bgcolor="#7fffd4" >用户名：<input type="text" name="username"><br></td>
        </tr>
        <tr>
            <td bgcolor="#faebd7" >密码：<input type="password" name="password"><br></td>
        </tr>
        </table>
        <input type="submit">
        </center>

    </form>
    <script>
    function checkform(form){
        if (form.username.value==""){
            alert("用户名不能为空！");
            form.username.focus();
            return false;
        }
        if (form.password.value==""){
            alert("密码不能为空！");
            form.password.focus();
            return false;
        }

        return true;

    }
    </script>
</head>

<body>

<?php
function _get($str){
    $val = isset($_POST[$str])?$_POST[$str]:null;
    return $val;
}

function checkArgs($name, $passwd){
    if(preg_match("/\W/", $name) || preg_match("/\s/", $name)){
       echo "<h3 >检测到恶意代码</h3 >"."<br>";
        return false;
    }
    $num = preg_match_all("/</", $passwd) + preg_match_all("/>/", $passwd);
    if (preg_match_all("/<script>/i", $passwd) || $num > 2){
        echo "<h3>检测到恶意代码</h3><br>";
        return false;
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = _get("username");
    $pass = _get("password");

    $pass = htmlspecialchars($pass);

    if (checkArgs($name, $pass)){
        if ($name == "junay" && $pass == "junay"){
            setcookie("user","Junay",time()+3600); //设置COOKIE
            echo "<script> alert(登陆成功！)</script>";
            header("Location: http://202.192.32.64/WebSecurity/main.php"); //页面自动跳转
            exit;
        }
       else {
           echo "<script>alert(用户名或密码不正确！)</script>";
        }
    }
}

?>

</body>
</html>

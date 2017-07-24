<html>
<?php
include 'head.php';
?>

<head>
    <title>主界面</title>
    <center>
        <h1 style="background-color: aqua">导航</h1><br>
    </center>
</head>
<body>
    <center>
        <h3>
            <form name="level_form" method="post" action="main.php">
                级别：
                <select name="level">
                    <option value="low">低</option>
                    <option value="mid">中</option>
                    <option value="high">高</option>
                </select>
                <input type="submit" value="提交">
            </form>
        <ul>
            <?php
            function _get($str){
                $val = isset($_POST[$str])?$_POST[$str]:null;
                return $val;
            }

            $level = _get('level');
            if (preg_match_all("/\W/",$level) > 0){
                echo "<h2>匹配到非法字符</h2><br>";
                echo "<script>alert('匹配到非法字符')</script>";
                die();
            }
            setcookie("cookie[level]",$level);

            //echo $level;
            $sqli = "sqli.php";
            $xss = "xss.php";
            $upload = "fileupload.php";

            echo "<li><a name=\"a1\" onmouseover=\"changeOver(this)\" onmouseout=\"changeOut(this)\" href=$sqli>SQL注入</a><br></li>";
            echo "<li><a name=\"a2\" onmouseover=\"changeOver(this)\" onmouseout=\"changeOut(this)\" href=$xss>XSS+CSRF</a><br></li>";
            echo "<li><a name=\"a3\" onmouseover=\"changeOver(this)\" onmouseout=\"changeOut(this)\" href=$upload>文件上传</a><br></li>";

            ?>

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

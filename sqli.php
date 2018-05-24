<html>
<?php
include 'head.php';
?>

<head>
    <title>SQL注入</title>
    <center>
        <h1><b>SQL注入演练</b></h1>
    </center>
</head>
<body>
<script>
    function submitform(){

        var form11 = document.getElementById("selects").value;
        var form22 = document.getElementById("id").value;

        var arr = new Array();
        arr.push(form11);
        arr.push(form22);
        return arr;
    }
</script>
<script>
    function getlevel(){
        var obj = document.getElementById('selects');
        //alert(obj.value);
        return obj.value;
    }
</script>

<center>

<form id="form2" method="get" action="sqli.php">
    <table border="2">
        <tr>
            <td>ID：<input type="text" name="id" id="id"></td>
        </tr>
    </table>
<!--    <input type="button" value="提交" onclick="submitform()">-->
    <input type="submit">
</form>
</center>



<?php
//    $level = "<script>document.write(getlevel())</script>";
    $level = $_COOKIE['cookie']['level'];
    $id = isset($_GET['id'])?$_GET['id']:null;
//    echo $level."<br>";
//    echo $id."<br>";


    //低级别
    if ($level == 'low'){
        echo "<h3>当前级别为：".$level."</h3><br>";
        query($id);
    }
    elseif ($level == 'mid'){
        echo "<h3>当前级别为：".$level."</h3><br>";
        if (strpos($id,'select') || strpos($id,'and')){
            echo "<script>alert('检测到恶意代码')</script>";
            die();
        }

        query($id);
    }
    elseif ($level == 'high'){
        echo "<h3>当前级别为：".$level."</h3><br>";
        if (preg_match_all('/\W/',$id)){
            echo "<script>alert('检测到恶意代码')</script>";
            die();
        }
        query($id);
    }
    else {
        echo "<h2>请检查参数</h2><br>";
    }

function query($id){
    //连接数据库
    $con = new mysqli("127.0.0.1","root","","my_db");
    if ($con->connect_errno){
        echo "<h2>连接数据库失败！</h2><br>";
        die();
    }
    $sql = "select ID, sex, age, email from Persons WHERE ID=$id";
    echo "<h3>正在查询：".$sql."</h3><br>";
    $result = $con->query($sql);
    echo "<br><h3>".$con->error."</h3><br>";
    while (@$row = $result->fetch_assoc()) {
        echo "<h3>ID：" . $row["ID"] . "</h3><br>";
        echo "<h3>性别：" . $row["sex"] . "</h3><br>";
        echo "<h3>年龄：" . $row["age"] . "</h3><br>";
        echo "<h3>Email：" . $row["email"] . "</h3><br>";
    }
    $con->close();
}
?>


</body>
</html>

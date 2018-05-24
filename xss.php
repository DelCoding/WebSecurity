<html>
<?php
include 'head.php'
?>
<head>
    <title>储存型XSS</title>
    <center>
        <h1>储存型XSS</h1>
    </center>
</head>
<body>
<br>
<br>
<center>
    <form method="post" action="xss.php">
        <table border="4">
            <tr>
                <td>*name：<input type="text" name="name"></td>
            </tr>
            <tr>
                <td>*message：<input type="text" name="message"></td>
            </tr>
        </table>
        <input type="submit">
    </form>
</center>

<?php
    $name = isset($_POST['name'])?$_POST['name']:null;
    $msg = isset($_POST['message'])?$_POST['message']:null;
    $level = $_COOKIE['cookie']['level'];
    echo "<br><p><h3>当前级别：".$level.'</h3></p><br>';
    $con = new mysqli("127.0.0.1","root","","xss_msg");
    if ($level == 'low' && $name != null){
        $name = stripslashes($name);
        $msg = stripslashes($msg);
        $name = mysqli_real_escape_string($con,$name);
        $msg = mysqli_real_escape_string($con,$msg);
        $id = $con->query("SELECT COUNT(*) from message");
        $ids = mysqli_fetch_array($id);
        $id = $ids[0] + 1;

        $query = "INSERT INTO message(id, name, msg) VALUES ($id,'$name','$msg')";
        $con->query($query);
        echo $con->error;
    }
    elseif ($level == 'mid' && $name != null){
        $name = stripslashes($name);
        $name = str_replace("<script>",'',$name);

        $msg = str_replace('<script>','',$msg);
        $id = $con->query("SELECT COUNT(*) from message");
        $ids = mysqli_fetch_array($id);
        $id = $ids[0] + 1;

        $query = "INSERT INTO message(id, name, msg) VALUES ($id,'$name','$msg')";
        $con->query($query);
        echo $con->error;
    }
    elseif ($level == 'high' && $name != null){
        $name = str_replace(" ",'',$name);
        $msg = str_replace(" ",'',$msg);
        if (strlen($name) > 10){
            $name = substr($name,0,10);
        }
        $msg = preg_replace("/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t/i","",$msg);
        $id = $con->query("SELECT COUNT(*) from message");
        $ids = mysqli_fetch_array($id);
        $id = $ids[0] + 1;

        $query = "INSERT INTO message(id, name, msg) VALUES ($id,'$name','$msg')";
        $con->query($query);
        echo $con->error;
    }

    $result = $con->query("select * from message");
    printTable($result);


function printTable($t){
    echo "<table border='5'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Message</th>
";

    while ($row = $t->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row['msg']."</td>";
        echo "</tr>";
    }

    echo "</table>";
}

    $con->close();
?>

</body>
</html>

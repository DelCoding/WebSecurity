<?php
//    include("2.php");
    $con = mysqli_connect("127.0.0.1", "root", "", "my_db");
/*
 *       创建数据库及my_db表*/
    if(!$con){
        echo "<h3>数据库连接失败</h3>";
        die();
    }
    if(mysqli_query($con, "CREATE DATABASE my_db")){
        echo "<h3>数据库创建成功</h3>";
    }
    else {
        echo "<h3>数据库创建失败".mysqli_error()."</h3><br>";
    }

    //mysql_select_db("my_db", $con);
    $sql = "CREATE TABLE Persons
        (
            ID int NOT NULL AUTO_INCREMENT,
            primary key(ID),
            name varchar(20),
            age int
        )";

    mysqli_query($con, $sql);

    echo "<br><h3>创建表成功</h3><br>";

    //mysql_select_db("my_db", $con);
    $ins1 = "alter table Persons add column email varchar(30)";
    $ins2 = "alter table Persons add column sex varchar(4)";
    $ins3 = "alter table Persons add column passwd varchar(40)";
    mysqli_query($con,$ins1);
    mysqli_query($con,$ins2);
    mysqli_query($con,$ins3);
    echo "<h3>新增列成功";
    echo "正在退出</h3>";

    $sqls = "insert into Persons (ID, name, age, email, sex, passwd) VALUES ('1', 'root','21', '123@qq.com','m','aaaaaa')";
    mysqli_query($con,$sqls);
    $sqls = "insert into Persons (ID, name, age, email, sex, passwd) VALUES ('2', 'a','21', '123@qq.com','m','aaaaaa')";
    mysqli_query($con,$sqls);
    $sqls = "insert into Persons (ID, name, age, email, sex, passwd) VALUES ('3', 'b','21', '123@qq.com','m','aaaaaa')";
    mysqli_query($con,$sqls);
    $sqls = "insert into Persons (ID, name, age, email, sex, passwd) VALUES ('4', 'c','21', '123@qq.com','m','aaaaaa')";
    mysqli_query($con,$sqls);
    $sqls = "insert into Persons (ID, name, age, email, sex, passwd) VALUES ('5', 'test','21', '123@qq.com','m','aaaaaa')";
    mysqli_query($con,$sqls);
    $sqls = "insert into Persons (ID, name, age, email, sex, passwd) VALUES ('6', 'd','21', '123@qq.com','m','aaaaaa')";
    mysqli_query($con,$sqls);
//创建过滤器
/*
    $filters = array
    (
        "name" => array("filter" => FILTER_SANITIZE_STRING),
        "age" => array("filter" => FILTER_VALIDATE_INT, "options" => array("min_range"=>1, "max_range"=>120)),
        "email" => FILTER_VALIDATE_EMAIL,
    );

    $result = filter_input_array(INPUT_POST, $filters);

    if(!$result["age"]){
        echo "<h3>Age must be a number between 1 and 120</h3><br />";
        die();
    }
    elseif (!$result["email"]) {
        echo "<h3>E-Mail is invaild.</h3><br />";
        die();
    }
    else{
        echo "<h2>User input is vaild</h2><br>";
    }

    mysqli_select_db($con, "my_db");
    $sqls = "insert into Persons (ID, name, age, email, sex, passwd)
    VALUES ('$_POST[ID]', '$_POST[username]','$_POST[age]', '$_POST[email]','$_POST[gender]','$_POST[password]')";

    if (!mysqli_query($con,$sqls)){
        die('插入失败'.mysqli_error());
    }
    else{
        echo "<h3>插入记录成功</h3>";
    }
*/

    mysqli_close($con);

?>

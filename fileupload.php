<?php
include 'head.php';
?>
<html>
<head>
    <title>文件上传</title>
    <center>
        <h1>文件上传</h1><br>
    </center>
</head>
<body>
<form target="_blank" action="fileupload.php" method="post" enctype="multipart/form-data">
    <h2><br>文件上传<br></h2>
    <label for="file">Filename:</label>
    <input type="file" name="file" id="file" />
    <br />
    <input type="submit" name="submit" value="Submit" />
</form>

<?php
    function _get($str)
    {
        $val = !empty($_FILES["file"][$str])?$_FILES["file"]["$str"]:null;
        return $val;
    }

    function access(){
        echo "Upload: "._get("name")."<br />";
        echo "Type: "._get("type")."<br />";
        echo "Size: "._get("size")."<br />";
        echo "Tmp_File: "._get("tmp_name")."<br />";

        if (file_exists("upload/"._get("name"))) {
            echo _get("tmp_name")."already exists.";
        }
        else {
            move_uploaded_file(_get("tmp_name"), "upload/"._get("name"));
            echo "Had stored in:  upload/".$_FILES["file"]["name"];
        }
    }
    echo "<br><h3>允许上传的文件类型有：gif、jpg</h3><br>";
    $level = $_COOKIE['cookie']['level'];
    if ($level == 'low' && _get("name")){
        if ((_get("type") == "image/gif") || (_get("type") == "image/jpeg") || (_get("type")) == "image/pjpeg") {

            if (_get("error") > -1) {
                echo "Return Code: ".$_FILES["file"]["error"]."<br />";
            }
            else {
                access();
            }
        }
        else {
            echo "<h2>不是允许上传的文件类型</h2>";
            echo "<h3><b>请上传gif, jpg文件类型</b></h3>";
        }
    }
    elseif ($level == 'mid' && _get("name")){
        if ((_get("type") == "image/gif") || (_get("type") == "image/jpeg") || (_get("type")) == "image/pjpeg"){
            if (strpos(_get("name"),"gif") || strpos(_get("name"),"jpg")){
                access();
            }
            else {
                echo "<h2>不是允许上传的文件类型</h2>";
                echo "<h3><b>请上传gif, jpg文件类型</b></h3>";
            }
        }
        else {
            echo "<h2>不是允许上传的文件类型</h2>";
            echo "<h3><b>请上传gif, jpg文件类型</b></h3>";
        }
    }
    elseif ($level == 'high' && _get("name")){
        if ((_get("type") == "image/gif") || (_get("type") == "image/jpeg") || (_get("type")) == "image/pjpeg"){
            if (preg_match_all("/\.gif$/",_get("name")) || preg_match_all("/\.jpg$/",_get("name"))){
                access();
            }
            else {
                echo "<h2>不是允许上传的文件类型</h2>";
                echo "<h3><b>请上传gif, jpg文件类型</b></h3>";
            }
        }
        else {
            echo "<h2>不是允许上传的文件类型</h2>";
            echo "<h3><b>请上传gif, jpg文件类型</b></h3>";
        }
    }
?>
</body>
</html>

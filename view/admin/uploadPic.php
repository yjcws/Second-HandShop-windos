

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>图片上传</title>

</head>
<body>
<?php
if(@$_GET["action"]=="sava")
{
    //1、首先判断一个是不是有效文件
    if(!is_uploaded_file($_FILES["upload"]["tmp_name"]))
    {
//        echo "<pre>";
//        var_dump($_FILES);
//        echo "</pre>";

        echo "<script>alert('请选择具体的缩略图文件');location.href='uploadPic.php';</script>";
        exit(0);
    }
    $file=$_FILES["upload"];
    $savadir="../upload/";
    $isoktype=array(
        "image/jpeg","image/gif","image/pjpeg","image/png"
    );
    $isoksize=1024*1024*2; //允许上传的大小2M



    //2、判断文件格式
    if(!in_array($file["type"],$isoktype))
    {
        echo "<script>alert('不允许的格式');location.href='uploadPic.php'</script>";
        exit(0);
    }

    //3、判断图片大小
    if($isoksize<$file["size"])
    {
        echo "<script>alert('文件过大');location.href='uploadPic.php'</script>";
        exit(0);
    }

    //4、水印
    //5、缩略图

    $exe=substr($file["name"],  (stripos($file["name"],".")+1));
    //var_dump($file);
    $newname=time();
    $newname.=rand()*1000;
    //echo $newname;
    //echo $exe;

    //执行保存操作
    move_uploaded_file($file["tmp_name"],$savadir.$newname.".".$exe);
    $picurl=$newname.".".$exe;
    echo "上传成功 <a href='uploadPic.php'>返回上传</a>";
    //JS把得到的地址赋值给咱们的FORM下面的PICURL
    echo "<script>parent.document.myform.picurl.value='$picurl';</script>";
}
else{


?>
<div   style="margin-top:0px;padding: 0px">
    <form action="?action=sava" method="post" enctype="multipart/form-data">
        <input type="file" name="upload"><input type="submit" value="提交">
    </form>
</div>

    <?php
        }
    ?>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>校园二手市场后台管理系统-新增管理员</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.index.css" />
    <style>
    </style>
</head>
<body>

<div id="global">

<?php



//头部菜单
include "./publicHtml/header.php";
//    左边表格
    include "./publicHtml/left.php";
//    右边表格
   // include "loginLog.table.php";

    //查询数据
    $id = $_GET['id'];
    $UserWhere = array(
        'table' => 'articleType ',
        'field' => '*',
        'where' => "id = ".$id

    );
    $UserRestful = $helper->getOne($UserWhere);

    ?>

    <div id="content_body">

        <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 修改文章分类</font></div>
        <hr>

        <form action="../../public/Admin/Aticle.class.php?tab=edi&id=<?php echo $id;?>" method="post" name="myform" onSubmit="return test();">
            <fieldset>
                <legend>分类信息:</legend>
                分类名称: <input type="text" name="fl" size="30" value="<?php echo $UserRestful['typename']?>" ><br>

                <input class="submit" type="submit"  value="修改">
                <input class = "reset" type="reset" value="重置">

            </fieldset>
        </form>


    </div>
    <div id="floor"></div>


</div>
</body>
<script language="JavaScript">

    function test()
    {
        if(document.myform.fl.value=='')
        {
            alert('分类名不能为空');
            return false;
        }
    }
</script>

</html>
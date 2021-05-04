<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>校园二手市场后台管理系统-管理员修改</title>
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

    //查询管理员基本信息
    $id = $_GET['id'];
    $NumWhere=array(
        'table' => 'admin_user',
        'field' => '*',
        "where"=>"id = $id"
    );
    $adminInfo = $helper->getOne($NumWhere);

    //var_dump($adminInfo);

    ?>

    <div id="content_body">

        <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 管理员修改</font></div>
        <hr>

        <form action="../../public/Admin/adminEdit.php?id=<?php echo $id;?>&tab=edi" method="post" name="myform" onSubmit="return test();">
            <fieldset>
                <legend>管理员基本信息:</legend>
                管理员账号: <input type="text" name="zh" size="30" value="<?php echo $adminInfo['username'];?>"><span>登陆后台账号</span><br>
                管理员密码: <input type="password" name="pw" size="30" value="<?php echo $adminInfo['password'];?>"><span>登陆后台密码</span><br>
                管理员身份: <select name="rights" id="rights">
                    <option value="2"
                        <?php
                        if($adminInfo['rights']==1)
                        {
                            echo "selected";
                        }
                        ?>
                    >普通管理员</option>
                    <option value="1"
                        <?php
                        if($adminInfo['rights']==2)
                        {
                            echo "selected";
                        }
                        ?>
                    >超级管理员</option>
                </select><br>

                <input class="submit" type="submit"  value="提交">
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
        //console.log(document.myform.zh.value=='<?php //echo $adminInfo['username'];?>//');
        //console.log(document.myform.pw.value=='<?php //echo  $adminInfo['password'];?>//');
        //console.log(document.myform.rights.value=='<?php //echo $adminInfo['rights'];?>//');


        if(document.myform.rights.value=='<?php echo $adminInfo['rights'];?>' && document.myform.zh.value=='<?php echo $adminInfo['username'];?>' && document.myform.pw.value=='<?php echo  $adminInfo['password'];?>')
        {
           // console.log(document.myform.zh.value);
            alert('信息前后信息一致,无需提交');
            return false;
        }
        if(document.myform.zh.value=='')
        {
            alert('管理员账号不能为空');
            return false;
        }
        if(document.myform.pw.value=='')
        {
            alert('管理员密码不能为空');
            return false;
        }
        return true;
    }
</script>

</html>
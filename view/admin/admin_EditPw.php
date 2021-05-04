<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>校园二手市场后台管理系统-修改管理员密码</title>
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


    ?>

    <div id="content_body">

        <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 修改管理员密码</font></div>
        <hr>

        <form action="../../public/Admin/adminEdit.php?id=<?php echo $id;?>&tab=ediPw" method="post" name="myform" onSubmit="return test();">
            <fieldset>
                <legend>管理员基本信息:</legend>
                管理员账号: <input name="username" type="hidden" id="username" name="username" size="30"  value=""/><?php echo $helper->getAdminname()['username'];?><span>登陆后台账号</span><br>
                管理员密码: <input type="password" id = "password" name="password" size="30" ><span>登陆后台密码</span><br>

                <input class="submit" type="submit"  value="修改密码">
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
        if(document.myform.pw.value=='')
        {
            alert('管理员密码不能为空');
            return false;
        }
        return true;
    }
</script>

</html>
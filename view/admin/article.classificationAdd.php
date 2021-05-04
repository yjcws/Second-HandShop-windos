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

?>

<div id="content_body">

        <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 添加文章分类</font></div>
    <hr>

    <form action="../../public/Admin/Aticle.class.php" method="post" name="myform" onSubmit="return test();">
            <fieldset>
                <table width="100%" border="0" cellspacing="0">
                    <tr>
                        <th width="15%" height="35" bgcolor="#999999" scope="col">分类信息</th>
                        <th width="75%" height="35" scope="col">&nbsp;</th>
                        <th width="10%" height="35" scope="col">&nbsp;</th>
                    </tr>
                    <tr>
                        <td height="35" align="right">分类类型：</td>
                        <td height="35"><select name="leixing">
                                <option value="0">校园快报</option>
                                <option value="1">热门活动</option>
                                <option value="2">校园帖子</option>
                            </select>
                        </td>
                        <td height="35">&nbsp;</td>
                    </tr>
                    <tr>
                        <td height="35" align="right">分类名称：</td>
                        <td height="35"><input name="fl" type="text" id="fl" size="30" /></td>
                        <td height="35">&nbsp;</td>
                    </tr>
                    <tr>
                        <td height="35">&nbsp;</td>
                        <td height="35"><input type="submit" name="Submit" value="提交" />
                            <input type="reset" name="Submit2" value="重置" /></td>
                        <td height="35">&nbsp;</td>
                    </tr>
                </table>            </fieldset>
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
            alert('分类名称不能为空');
            return false;
        }
    }
</script>

</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>校园二手市场后台管理系统-新增管理员</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.index.css" />
    <style>
    </style>
</head>


<script language="JavaScript">



    function test()
    {
        if(document.myform.typename.value=='')
        {
            alert('请输入分类名称');
            return false;
        }
        if(document.myform.typeorder.value=='')
        {
            alert('请输入分类的排序');
            return false;
        }
        return true;
    }
</script>

<body>
<div id="global">


<?php
//登陆检测
//头部菜单

include "./publicHtml/header.php";

//    左边表格
include "./publicHtml/left.php";
//    右边表格

//获取最大值
$OrderWhere=array(
    'table' => 'feedbackType',
    'field' => "max(typeorder)  as 'Maxtype'",
);
$Order= $helper->getOne($OrderWhere);

?>


<div id="content_body">

    <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 添加留言分类</font></div>

    <hr>


    <fieldset style="border-radius:5px;" >
        <form id="myform" name="myform" method="post" action="../../public/Admin/FeedBackType.class.php?tab=FbAdd" onSubmit="return test()">
            <table width="100%" border="0" cellspacing="0">
                <tr>
                    <td height="30" colspan="2" bordercolor="#000000" bgcolor="#999999">留言分类信息：</td>
                </tr>
                <tr>
                    <td width="15%" height="30" align="right" valign="middle" bordercolor="#000000">分类名称：</td>
                    <td width="85%" height="30" bordercolor="#000000"><label>
                            <input name="typename" type="text" id="typename" size="30" />
                </tr>
                <tr>
                    <td height="30" align="right" valign="middle" bordercolor="#000000">分类排序 ：</td>
                    <td height="30" bordercolor="#000000"><label>
                            <input name="typeorder" type="text" id="typeorder" size="30" value="<?php echo $Order['Maxtype'];?>"/>                            　<span class="STYLE4" style="color: #5c6370">默认显示最大排序</span></label>
                </tr>
                <tr>
                    <td height="30" align="right" valign="middle" bordercolor="#000000">显示状态：</td>
                    <td height="30" bordercolor="#000000"><label>
                            <input type="radio" name="typezt" value="1" />
                            开启
                            <input type="radio" name="typezt" value="0" />
                            关闭
                </tr>
                <tr>
                    <td height="30" align="right" valign="middle" bordercolor="#000000">&nbsp;</td>
                    <td height="30" bordercolor="#000000"><label></label>
                        <label>
                            <input type="submit" name="Submit" value="提交" />
                            <input type="reset" name="reset" value="重置" />
                        </label></td>
                </tr>
            </table>
        </form>
    </fieldset>

</div>

<div id="floor"></div>
</div>
</body>

</html>


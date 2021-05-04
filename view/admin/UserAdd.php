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
        // if(document.myform.numbers.value=='')
        // {
        //     alert('商品编号不能为空');
        //     return false;
        // }
        if(document.myform.title.value=='')
        {
            alert('商品名字不能为空');
            return false;
        }
        if(document.myform.typeid.value=='')
        {
            alert('商品所属分类不能为空');
            return false;
        }
        if(document.myform.kucun.value=='')
        {
            alert('库存不能为空');
            return false;
        }
        if(document.myform.hits.value=='')
        {
            alert('请填写默认的浏览数量');
            return false;
        }
        if(document.myform.picurl.value=='')
        {
            alert('请为商品选择一张缩略图');
            return false;
        }
        return true;
    }
</script>

<body>
<div id="global">


<?php
//头部菜单

include "./publicHtml/header.php";

//    左边表格
include "./publicHtml/left.php";
//    右边表格


?>


<div id="content_body">

    <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 基本设置</font></div>

    <hr>


    <fieldset style="border-radius:5px;" >
        <form id="myform" name="myform" method="post" action="../../public/Admin/User.class.php?tab=UserAdd">
            <table width="100%" border="0" cellspacing="0">
                <tr>
                    <td height="30" colspan="2" bordercolor="#000000" bgcolor="#999999">用户信息：</td>
                </tr>
                <tr>
                    <td width="15%" height="30" align="right" valign="middle" bordercolor="#000000">用户名称：</td>
                    <td width="85%" height="30" bordercolor="#000000"><label>
                            <input name="username" type="text" id="username" size="30" />
                            <span class="STYLE4">                    用户的登陆帐号</span></label></td>
                </tr>
                <tr>
                    <td height="30" align="right" valign="middle" bordercolor="#000000">用户密码：</td>
                    <td height="30" bordercolor="#000000"><label>
                            <input name="pw" type="text" id="pw" size="30" />
                            <span class="STYLE5">用户登陆密码</span></label></td>
                </tr>
                <tr>
                    <td height="30" align="right" valign="middle" bordercolor="#000000">会员邮箱：</td>
                    <td height="30" bordercolor="#000000"><label>
                            <input name="email" type="text" id="email" size="30" />　<span class="STYLE4">会员邮箱</span></label></td>
                </tr>
<!--                <tr>-->
<!--                    <td height="30" align="right" valign="middle" bordercolor="#000000">提问问题：</td>-->
<!--                    <td height="30" bordercolor="#000000"><label>-->
<!--                            <input name="twwt" type="text" id="twwt" size="30" />-->
<!--                            <span class="STYLE5">密保</span></label></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td height="30" align="right" valign="middle" bordercolor="#000000">回答问题：</td>-->
<!--                    <td height="30" bordercolor="#000000"><label>-->
<!--                            <input name="huida" type="text" id="huida" size="30" />-->
<!--                        </label></td>-->
<!--                </tr>-->
                <tr>
                    <td height="30" align="right" valign="middle" bordercolor="#000000">状态：</td>
                    <td height="30" bordercolor="#000000"><label>
                            <select name="zhuntai" id="zhuntai">
                                <option value="1">待审核</option>
                                <option value="2">正常</option>
                                <option value="3">锁定</option>

                            </select>
                        </label></td>
                </tr>
                <tr>
                    <td height="30" align="right" valign="middle" bordercolor="#000000">真实姓名：</td>
                    <td height="30" bordercolor="#000000"><label>
                            <input name="zsxm" type="text" id="zsxm" size="30" />
                        </label></td>
                </tr>
                <tr>
                    <td height="30" align="right" valign="middle" bordercolor="#000000">称为：</td>
                    <td height="30" bordercolor="#000000"><label></label>
                                <input type="radio" name="xs" value="1" />
                            先生
                                <input type="radio" name="ns" value="0" />
                            女士
                    </td>
                </tr>
                <tr>
                    <td height="30" align="right" valign="middle" bordercolor="#000000">手机号码：</td>
                    <td height="30" bordercolor="#000000"><label>
                            <input name="phone" type="text" id="phone" size="30" />
                        </label></td>
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


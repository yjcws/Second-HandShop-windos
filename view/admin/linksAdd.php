<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.index.css" />

    <style type="text/css">
        <!--
        .STYLE1 {
            font-family: "宋体";
            font-size: 18px;
            color: #333333;
        }
        .STYLE2 {font-family: "宋体"}
        -->
    </style>


</head>
<script>
    function test()
    {
        if(document.links.webname.value=='')
        {
            alert('请填写链接网站名称');
            return false;
        }
        if(document.links.weburl.value=='')
        {
            alert('请填写链接网站网址');
            return false;
        }
        if(document.links.styleid[0].checked  &&  document.links.logourl.value=='')
        {
            alert('LOGO类型链接必须选择LOGO上传地址');
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
    // include "loginLog.table.php";

    ?>

    <div id="content_body">

        <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 添加友情链接</font></div>

        <hr>
        <form width="100%" action="../../public/Admin/Links.class.php?tab=linksAdd" method="post" enctype="multipart/form-data" name="links" id="links" onsubmit="return test();">
            <fieldset style="border-radius:5px;" >

                <table width="100%" height="40%" border="0" cellspacing="0">
                    <tr>
                        <th height="35" colspan="3" align="left" bgcolor="#CCCCCC" scope="col"><span class="STYLE1">链接基本信息</span></th>
                    </tr>
                    <tr>
                        <th height="35" align="center" valign="middle" scope="col">链接类型：</th>
                        <th height="35" align="center" scope="col"><label>
                                <input type="radio" name="styleid" id="styleid" value="1" checked="checked"/>
                                LOGO链接</label> <label>
                                <input type="radio"name="styleid" id="styleid" value="2" />
                                文本链接</label></th>
                        <th height="35" scope="col">&nbsp;</th>
                    </tr>
                    <tr>
                        <td width="101" height="35" align="center" valign="middle">网站名称：</td>
                        <td width="347" height="35" align="center"><label>
                                <input name="webname" type="text" value="" size="40" />
                            </label></td>
                        <td width="595" height="35">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="101" height="35" align="center" valign="middle">网站地址：</td>
                        <td width="347" height="35" align="center"><label>
                                <input name="weburl" type="text" size="40" />
                            </label></td>
                        <td width="595" height="35">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="101" height="35" align="center" valign="middle">LOGO地址：</td>
                        <td width="347" height="35" align="center"><label>
                                <input name="logourl" type="file" size="31" />
                            </label></td>
                        <td width="595" height="35">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="101" height="100" align="center" valign="middle">网站简介：</td>
                        <td width="347" height="100" align="center"><label>
                                <textarea name="intro" cols="40" rows="10"></textarea>
                            </label></td>
                        <td width="595" height="100">&nbsp;</td>
                    </tr>
                    <tr>
                        <td height="50" align="center" valign="middle">&nbsp;</td>
                        <td height="50" colspan="2" align="left"><label>
                                <input type="submit" name="Submit" value="提交" />
                            </label>
                            <label>
                                <input type="reset" name="Submit2" value="重置" />
                            </label></td>
                    </tr>
                </table>
            </fieldset>
        </form>

    </div>
<div id="floor"></div>

</div>
</body>
</html>

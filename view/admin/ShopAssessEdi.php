<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>校园二手市场后台管理系统</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.index.css" />


    <script>
        function test()
        {
            // if(document.myform.pid.value=='')
            // {
            //     alert('商品ID不能为空');
            //     return false;
            // }
            if(document.myform.content.value=='')
            {
                alert('评论内容不能为空');
                return false;
            }
            if(document.myform.usernameshow.value=='')
            {
                alert('提交人不能为空');
                return false;
            }

            return true;
        }
    </script>


</head>
<body>
<div id="global">

<?php

//登陆检测

//头部菜单
include "./publicHtml/header.php";
//    左边表格
include "./publicHtml/left.php";
////    右边表格
//include "index.table.php";

$tid = $id = @$_GET['id'];
$SaWhere = array(
    'table' => 'assess ',
    'field' => '*',
    'where'=>"id=".$id
);
$ShopRestful = $helper->getOne($SaWhere);

?>

    <div id="content_body">
        <!--../../public/Aticle.class.php-->
        <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 修改评论</font></div>
        <hr>

        <fieldset style="border-radius:5px;" >
            <form id="myform" name="myform" method="post" action="../../public/Admin/ShopAssess.class.php?tab=SaEdi" onsubmit="return test()">
                <table width="100%" border="0" cellspacing="0" >
                    <tr>
                        <td height="30" colspan="2" bordercolor="#000000" bgcolor="#999999">评论管理基本信息：</td>
                    </tr>
                    <tr>
                        <td width="15%" height="30" align="right" valign="middle" bordercolor="#000000">所属商品：</td>
                        <td width="85%" height="30" bordercolor="#000000"><label>
                                <input name="pid" type="text" id="pid" size="30" value="<?php echo $ShopRestful['pid'];?>" disabled/>
                                <input name="pid" type="hidden" id="pid" size="30" value="<?php echo $ShopRestful['pid'];?>"/>
                                <span class="STYLE4">                    关联的是商品的ID号</span></label></td>
                    </tr>
                    <tr>
                        <td height="30" align="right" valign="middle" bordercolor="#000000">信息状态：</td>
                        <td height="30" bordercolor="#000000"><label>
                                <input type="radio" name="issh" value="0" <?php if($ShopRestful['issh']==0) echo "checked";?> />
                                待审核
                                <input type="radio" name="issh" value="1" <?php if($ShopRestful['issh']==1) echo "checked";?> />
                                已审核</label></td>
                    </tr>
                    <tr>
                        <td height="30" align="right" valign="middle" bordercolor="#000000">置顶状态：</td>
                        <td height="30" bordercolor="#000000"><label>
                                <input type="radio" name="istop" value="0" <?php if($ShopRestful['istop']==0) echo "checked";?>/>
                                待置顶
                                <input type="radio" name="istop" value="1" <?php if($ShopRestful['istop']==1) echo "checked";?>/>
                                已置顶</label></td>
                    </tr>
                    <tr>
                        <td height="30" align="right" valign="middle" bordercolor="#000000">推荐状态：</td>
                        <td height="30" bordercolor="#000000"><label>
                                <input type="radio" name="recommend" value="0" <?php if($ShopRestful['recommend']==0) echo "checked";?>/>
                                待推荐
                                <input type="radio" name="recommend" value="1" <?php if($ShopRestful['recommend']==1) echo "checked";?>/>
                                已推荐</label></td>
                    </tr>
                    <tr>
                        <td height="30" align="right" valign="middle" bordercolor="#000000">评论等级：</td>
                        <td height="30" bordercolor="#000000"><label>
                                <select name="pinglun" id="pinglun">
                                    <option value="1" <?php if($ShopRestful['pinglun']==1) echo "selected";?>>一星</option>
                                    <option value="2" <?php if($ShopRestful['pinglun']==2) echo "selected";?>>二星</option>
                                    <option value="3" <?php if($ShopRestful['pinglun']==3) echo "selected";?>>三星</option>
                                    <option value="4" <?php if($ShopRestful['pinglun']==4) echo "selected";?>>四星</option>
                                    <option value="5" <?php if($ShopRestful['pinglun']==5) echo "selected";?>>五星</option>
                                </select>
                            </label></td>
                    </tr>
                    <tr>
                        <td height="30" align="right" valign="middle" bordercolor="#000000">评价内容：</td>
                        <td height="30" bordercolor="#000000"><label>
                                <textarea name="content" cols="60" rows="10" id="content"><?php echo $ShopRestful['content'];?></textarea>
                            </label></td>
                    </tr>
                    <tr>
                        <td height="30" align="right" valign="middle" bordercolor="#000000">提交用户：</td>
                        <td height="30" bordercolor="#000000"><label>
                                <input name="usernameshow" type="text" id="usernameshow" size="30" value="<?php echo $ShopRestful['usernameshow'];?>" />
                                <span class="STYLE5">前台显示提交人的姓名</span></label></td>
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

</div>
</body>
</html>
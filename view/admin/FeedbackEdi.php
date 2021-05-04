<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>校园二手市场后台管理系统</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.index.css" />


    <script>
            function test()
            {
                if(document.myform.typeid.value=='')
                {
                    alert('请选择留言所属分类');
                    return false;
                }
                if(document.myform.content.value=='')
                {
                    alert('请填写留言内容');
                    return false;
                }
                if(document.myform.usernameshow.value=='')
                {
                    alert('请填写提交用户名称');
                    return false;
                }
                return true;
            }

    </script>


</head>
<body>
<div id="global">

<?php
//头部菜单
include "./publicHtml/header.php";
//    左边表格
include "./publicHtml/left.php";
////    右边表格
//include "index.table.php";

//留言分类查询
$FbWhere = array(
    'table' => 'feedbacktype ',
    'field' => '*',
    'order' => [
        'field'=>'typeorder ',
        'order'=>'asc'
    ],
    'where'=>'typezt=1'
);
$FbRestful = $helper->getAll($FbWhere);
//var_dump($FbRestful);

//修改信息查询
$id = @$_GET['id'];
$FbaWhere = array(
    'table' => 'feedback',
    'field' => '*',
    'where'=>'id='.$id
);
$FbaRestful = $helper->getOne($FbaWhere);

//var_dump($FbaRestful);

?>

    <div id="content_body">
        <!--../../public/Aticle.class.php-->
        <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 添加留言</font></div>
        <hr>

        <fieldset style="border-radius:5px;" >
            <form id="myform" name="myform" method="post" action="../../public/Admin/FeedBack.class.php?tab=FbEdi" onsubmit="return test()">
                <table width="100%" border="0" cellspacing="0" >
                    <tr>
                        <td height="30" colspan="2" bordercolor="#000000" bgcolor="#999999">留言管理基本信息：</td>
                    </tr>
                    <tr>
                        <td width="15%" height="30" align="right" valign="middle" bordercolor="#000000">留言分类：</td>
                        <td width="85%" height="30" bordercolor="#000000"><label>
                                <select name="typeid" id="typeid">
                                    <option value="">请选择分类</option>
                                    <?php

                                    foreach($FbRestful as $row)
                                    {
                                        if ($FbaRestful['typeid']==$row["id"]) {
                                            echo "<option value='".$row["id"]."' selected>".$row["typename"]."</option>";
                                        }else{
                                            echo "<option value='".$row["id"]."'>".$row["typename"]."</option>";
                                        }
                                    }
                                    ?>
                                </select>

                                <input name="id" type="hidden" value="<?php echo $id;?>">
                            </label></td>
                    </tr>
                    <tr>
                        <td height="30" align="right" valign="middle" bordercolor="#000000">信息状态：</td>
                        <td height="30" bordercolor="#000000"><label>
                                <input type="radio" name="issh" value="0"
                                    <?php if($FbaRestful['issh']==0) echo "checked";?>
                                />
                                待审核
                                <input type="radio" name="issh" value="1"
                                    <?php if($FbaRestful['issh']==1) echo "checked";?>
                                />
                                已审核</label></td>
                    </tr>
                    <tr>
                        <td height="30" align="right" valign="middle" bordercolor="#000000">回复状态：</td>
                        <td height="30" bordercolor="#000000"><label>
                                <input type="radio" name="ishf" value="0" <?php if($FbaRestful['ishf']==0) echo "checked";?>/>
                                待回复
                                <input type="radio" name="ishf" value="1" <?php if($FbaRestful['ishf']==1) echo "checked";?>/>
                                已回复</label></td>
                    </tr>
                    <tr>
                        <td height="30" align="right" valign="middle" bordercolor="#000000">留言内容：</td>
                        <td height="30" bordercolor="#000000"><label>
                                <textarea name="content" cols="60" rows="10" id="content"><?php echo $FbaRestful['content'];?></textarea>
                            </label></td>
                    </tr>
                    <tr>
                        <td height="30" align="right" valign="middle" bordercolor="#000000">回复内容：</td>
                        <td height="30" bordercolor="#000000"><label>
                                <textarea name="recontent" cols="60" rows="10" id="recontent"><?php echo $FbaRestful['recontent'];?></textarea>
                            </label></td>
                    </tr>
                    <tr>
                        <td height="30" align="right" valign="middle" bordercolor="#000000">提交用户：</td>
                        <td height="30" bordercolor="#000000"><label>
                                <input name="usernameshow" type="text" id="usernameshow" size="30" value='<?php echo $FbaRestful['usernameshow'];?>'/>
                                <span class="STYLE5 STYLE1">        前台显示提交人的姓名</span></label></td>
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
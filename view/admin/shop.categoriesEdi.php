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


//下拉菜单无限分类

include "../../public/Admin/ShopWxCategories.class.php";

$tid = $id = @$_GET['id'];
$ShopWhere = array(
    'table' => 'productlist ',
    'field' => '*',
    'where'=>"id=".$id
);
$ShopRestful = $helper->getOne($ShopWhere);

//var_dump($ShopRestful,$tid);

if (empty($ShopRestful)){
    $helper->Redirect('分类名称不存在！','admin/shop.categories.php');
}


?>

<div id="content_body">

        <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 添加文章分类</font></div>
    <hr>

    <form action="../../public/Admin/ShopCategories.class.php?tab=ScEdit" method="post" name="myform" onSubmit="return test();">
            <fieldset>
<!--                <legend>分类信息:</legend>-->
                <table width="100%" height="140" border="0" cellspacing="0">
                    <tr>
                        <th width="16%" height="35" align="left" bgcolor="#CCCCCC" scope="col">分类信息</th>
                        <th width="71%" height="35" bgcolor="#CCCCCC" scope="col">&nbsp;</th>
                        <th width="13%" height="35" bgcolor="#CCCCCC" scope="col">&nbsp;</th>
                    </tr>
                    <tr>
                        <td height="35" align="right">所属分类：</td>
                        <td height="35">
                            <label>
                                <select name="tid">
                                    <option value="<?php echo $id;?>"><?php echo $ShopRestful['typename'];?></option>

<!--                                    --><?php
//                                    echo (new ShopWxCategories())->OptionSelected(0,$tid);
//                                    ?>
                                </select>
                            </label>
                        </td>
                        <td height="35">&nbsp;</td>
                    </tr>
                    <tr>
                        <td height="35" align="right">分类名称：</td>
                        <td height="35">
                            <label>
                                <input type="text" name="typename" value="<?php echo $ShopRestful['typename'];?>"/>
                            </label>
                        </td>
                        <td height="35">&nbsp;</td>
                    </tr>
                    <tr>
                        <td height="35">&nbsp;</td>
                        <td height="35">
                            <label>
                                <input type="submit" name="Submit2" value="提交" />
                            </label>
                            <label>
                                <input type="reset" name="Submit" value="重置" />
                            </label>
                        </td>
                        <td height="35">&nbsp;</td>
                    </tr>
                </table>

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
            alert('分类名称不能为空');
            return false;
        }
    }
</script>

</html>
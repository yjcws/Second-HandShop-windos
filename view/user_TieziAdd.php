
<?php
include "../config/Webconfig.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $webname."-".$webUrl;?></title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="./admin/ueditor/themes/default/css/ueditor.css">
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- 配置文件 -->
    <script type="text/javascript" src="./admin/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="./admin/ueditor/ueditor.all.js"></script>
    <script type="text/javascript" charset="utf-8" src="./admin/ueditor/lang/zh-cn/zh-cn.js"></script>

</head>
<body>
<!--头部-->

<?php
include "./public/header.php";
//下拉菜单无限分类
include "../public/Admin/ShopWxCategories.class.php";


$helper->isUserLogin();

//$ScWhere = array(
//    'table' => 'user',
//    'field' => '*',
//    'where'=>"username="."'{$helper->getUsernames()['username']}'",
//);
//
//$SaRestful = $helper->getOne($ScWhere);

//echo '<pre>';
//var_dump($SaRestful);
//echo '</pre>';


?>

<hr>

<div class="main-box-top">
    <div class="main">
        <font size="25">发布帖子</font>
        <hr size="5" noshade>
    </div>

    <div class="main">
        <!--        左边-->
        <div class="main-left" >
            <?php include "public/UserMainleft.php";?>
        </div>

        <!--        间隙-->
        <div class="main-jianxi">&nbsp;&nbsp;</div>



        <!--        剧中-->
        <div class="main-center" style="width: 80%;">
            <!--            <div style="float: right;margin-bottom: 10px"><a href="">添加新的收货地址</a> </div>-->

            <form action="../public/Article.class.php?tab=ArticleAdd" method="post" name="myform" onSubmit="return test();">
                <fieldset>
                    <legend>帖子信息:</legend>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                        <tr>
                            <td  width="10%" height="30" align="right">帖子标题:&nbsp;</td>
                            <td  width="30%"><input type="text" name="title" size="30"></td>
                            <td  width="32%" height="30" align="right"> &nbsp;</td>

                        </tr>
<!--                        <tr>-->
<!--                            <td  width="10%" height="30" align="right">帖子分类:&nbsp;</td>-->
<!--                            <td  width="30%">-->
<!---->
<!--                                <select name="typeid">-->
<!--                                    <option value="">请选择帖子分类-->
<!--                                    </option>-->
<!---->
<!--                                    --><?php //foreach ($UserRestful as $k => $v){?>
<!--                                        <option value="--><?php //echo $v['id'];?><!--">--><?php //echo  $v['typename'];?>
<!--                                        </option>-->
<!--                                    --><?php //}?>
<!--                                </select>-->
<!--                            </td>-->
<!--                            <td  width="32%" height="30" align="right">&nbsp;</td>-->
<!---->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td  width="10%" height="30" align="right">帖子作者:&nbsp;</td>-->
<!--                            <td  width="30%">-->
<!---->
<!--                                <input type="text" name="author" size="30">-->
<!--                            </td>-->
<!--                            <td  width="32%" height="30" align="right">&nbsp;</td>-->
<!---->
<!--                        </tr>-->
                        <tr>
                            <td  width="10%" height="30" align="right">帖子来源:&nbsp;</td>
                            <td  width="30%"><input type="text" name="com" size="30"></td>
                            <td  width="32%" height="30" align="right">&nbsp;</td>

                        </tr>
<!--                        <tr>-->
<!--                            <td  width="10%" height="30" align="right">浏览量:&nbsp;</td>-->
<!--                            <td  width="30%"><input type="text" name="hits" size="30"></td>-->
<!--                            <td  width="32%" height="30" align="right">&nbsp;</td>-->
<!---->
<!--                        </tr>-->
                        <tr>
                            <!--                      合并单元格2列：colspan="2"  -->
                            <td  width="10%" height="30" align="right">帖子内容:&nbsp;</td>
                            <td  width="60%" colspan="2">
                            <textarea  id = "container" name="content" rows="10" cols="30">
                            </textarea>
                                <script id="container" name="content" type="text/plain"> </script>

                            </td>
                            <!--                        <td  width="32%" height="30" align="right">&nbsp;</td>-->

                        </tr>
                        <tr>
                            <td  width="10%" height="30" align="right">&nbsp;</td>
                            <td  width="30%">
                                <input class="submit" type="submit"  value="创建">&nbsp;
                                <input class = "reset" type="reset" value="重置">
                            </td>
                            <td  width="32%" height="30" align="right">
                            </td>

                        </tr>


                    </table>


                </fieldset>
            </form>

        </div>




        <div style="clear: both"></div>





    </div>
</div>
<script type="text/javascript">
    $(function(){

        var ue = UE.getEditor('container');

    });
</script>

<script type="text/javascript">
function test()
{


if(document.myform.title.value=='')
{
alert('请输入标题');
return false;
}
if(document.myform.com.value=='')
{
alert('请填写文章来源');
return false;
}
if(content== ''){
alert("编辑器不能为空!")

}
return true;
}
</script>
</body>
</html>
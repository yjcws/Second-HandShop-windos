
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

$productID = @$_GET['id'];
$ShopEdiWhere = array(
    'table' => 'product',
    'field' => '*',
    "where" =>"numbers = " .$productID,
    'order' => [
        'field' => 'id ',
        'order' => 'desc'
    ],
);
$ShopEdiRes = $helper->getOne($ShopEdiWhere);


?>

<hr>

<div class="main-box-top">
    <div class="main">
        <font size="25">添加收货地址</font>
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

            <form action="../public/UserLogin.class.php?tab=ShopEdi
" method="post" name="myform" onSubmit="return test();">
                <fieldset>
                    <legend>商品信息:</legend>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">商品编号:&nbsp;</td>
                            <td height="30" colspan="2">
                                <input type="text" name="numbers" size="30" value="<?php echo $productID;?>" disabled>
                                <input type="hidden" name="numbers" size="30" value="<?php echo $productID;?>">
                                <span class="STYLE2" style="color:#666666;">　商品编号，用于商品管理，无编号系统自动生成</span></td>
                        </tr>
                        <tr>
                            <td width="10%" height="30" align="right" bordercolor="#F0F0F0" bgcolor="#F0F0F0">商品名称:&nbsp;</td>
                            <td height="30" colspan="2"><input type="text" name="title" size="30" value="<?php echo $ShopEdiRes['title'];?>"/>                          <span class="STYLE3" style="color:#666666;">　商品名称，用于前台展示使用</span></td>
                        </tr>
                        <tr>
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">商品分类:&nbsp;</td>
                            <td height="30" colspan="2">

                                <select name="typeid">
                                    <option value="">请选择分类                                </option>

                                    <?php
                                    echo (new ShopWxCategories())->ShopEdiOption(0,$ShopEdiRes['typeid']);
                                    ?>

                                </select>
                                <span  class="STYLE3" style="color:#666666;">　　　　　　　　　　所属分类，用于商品归类 </span>
                            </td>
                        </tr>
                        <tr>
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" height="30" align="right">商品属性:&nbsp;</td>
                            <td height="30" colspan="2"><label>
                                    <input name="hot" type="checkbox" value="1" <?php
                                    if($ShopEdiRes['hot']==1)
                                    {echo "checked";}
                                    ?>>
                                    热销 <input name="drops" type="checkbox" value="1" <?php
                                    if($ShopEdiRes['drops']==1)
                                    {
                                        echo "checked";
                                    }
                                    ?>>降价 <input name="recommend" type="checkbox" value="1"
                                        <?php
                                        if($ShopEdiRes['recommend']==1)
                                        {
                                            echo "checked";
                                        }
                                        ?>>推荐                            </label>                          　　<span class="STYLE3" style="color:#666666;">　　　&nbsp;商品的名称，用于前台展示 使用</span></td>
                        </tr>

                        <tr>
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" height="30" align="right">商品状态:&nbsp;</td>
                            <td height="30" colspan="2"><label>
                                    <input type="radio" name="shelves" value="1" <?php if($ShopEdiRes['shelves']==1) echo 'checked';?>>上架
                                    <input type="radio" name="shelves" value="0" <?php if($ShopEdiRes['shelves']==0) echo 'checked';?>>下架
                                </label>
                                　　<span class="STYLE3" style="color:#666666;">　　　　　　　&nbsp;商品的状态</span></td>
                        </tr>

                        <tr>
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">商品库存:&nbsp;</td>
                            <td height="30" colspan="2">

                                <input type="text" name="kucun" size="30" value="<?php echo $ShopEdiRes['kucun'];?>">                        <span class="STYLE3" style="color:#666666;">　如果库存等于0时，则不能进行下单</span></td>
                        </tr>
                        <!--                    <tr>-->
                        <!--                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">浏览量:&nbsp;</td>-->
                        <!--                        <td height="30" colspan="2"><input type="text" name="hits" size="30" value="--><?php //echo $ShopEdiRes['hits'];?><!--">                          <span class="STYLE3" style="color:#666666;">　可以初始化一个数量，用于展示该商品浏览量 </span></td>-->
                        <!--                    </tr>-->
                        <tr>
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">打折价格:&nbsp;</td>
                            <td height="30" colspan="2"><input type="text" name="price" size="30" value="<?php echo $ShopEdiRes['price'];?>">                          </td>
                        </tr>
                        <tr>
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">原价格:&nbsp;</td>
                            <td height="30" colspan="2"><input type="text" name="yprice" size="30" value="<?php echo $ShopEdiRes['yprice'];?>">                          </td>
                        </tr>

                        <tr>
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">优惠:&nbsp;</td>
                            <td height="30" colspan="2"><input type="text" name="youhui" size="30" value="0">                          <span class="STYLE3" style="color:#666666;"></span></td>
                        </tr>
                        <tr>
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">邮费:&nbsp;</td>
                            <td height="30" colspan="2"><input type="text" name="youfei" size="30" value="0">                          <span class="STYLE3" style="color:#666666;"></span></td>
                        </tr>
                        <tr>
                            <td width="10%" height="30" align="right" valign="middle" bordercolor="#F0F0F0" bgcolor="#F0F0F0">商品图片:&nbsp;</td>
                            <td height="30" colspan="2" valign="middle">
                                <input type="text" name="picurl" size="30" style="margin-bottom: 10px" value="<?php echo $ShopEdiRes['picurl'];?>">　
                                <iframe name="upfile" frameborder="0" width="350"  height="31" src="./admin/uploadPic.php" scrolling="no" ><span class="STYLE2"><span class="STYLE3"></span></span></iframe></td>
                        </tr>

                        <tr>
                            <!--                      合并单元格2列：colspan="2"  -->
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">商品介绍:&nbsp;</td>
                            <td  width="60%" colspan="2">
                            <textarea  id = "container" name="content" rows="10" >
<?php echo $ShopEdiRes['content'];?>
                            </textarea>
                                <!--                            <script id="container" name="content" type="text/plain"> </script>-->
                            </td>
                            <!--                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="32%" height="30" align="right">&nbsp;</td>-->
                        </tr>
                        <tr>
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">&nbsp;</td>
                            <td  width="60%">
                                <input class="submit" type="submit"  value="创建">&nbsp;
                                <input class = "reset" type="reset" value="重置">
                            </td>
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="32%" height="30" align="right"></td>
                        </tr>
                    </table>            </fieldset>
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
        // if(content== ''){
        //     alert("请填写商品介绍!")
        //
        // }
        return true;
    }
</script>
</body>
</html>
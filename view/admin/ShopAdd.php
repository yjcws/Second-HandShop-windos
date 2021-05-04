<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>校园二手市场后台管理系统-新增管理员</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.index.css" />

    <link rel="stylesheet" type="text/css" href="./ueditor/themes/default/css/ueditor.css">
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- 配置文件 -->
    <script type="text/javascript" src="./ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="./ueditor/ueditor.all.js"></script>
    <script type="text/javascript" charset="utf-8" src="./ueditor/lang/zh-cn/zh-cn.js"></script>
</head>

<body>
<div id="global">

<?php
//头部菜单

include "./publicHtml/header.php";

//    左边表格
    include "./publicHtml/left.php";
//    右边表格

    //下拉菜单无限分类
    include "../../public/Admin/ShopWxCategories.class.php";

    //swfupload上传图片信息清空
    $_SESSION["urlfile_info"] = array();


    //商品ID
    $productID=time();
    $productID.=rand(333,555)*1000;



    ?>

    <div id="content_body">
<!--../../public/Aticle.class.php-->
        <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 添加新商品</font></div>
        <hr>
        <form action="../../public/Admin/Shop.class.php?tab=ShopAdd
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
                        <td height="30" colspan="2"><input type="text" name="title" size="30" />                          <span class="STYLE3" style="color:#666666;">　商品名称，用于前台展示使用</span></td>
                    </tr>
                    <tr>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">商品分类:&nbsp;</td>
                        <td height="30" colspan="2">

                            <select name="typeid">
                                <option value="">请选择分类                                </option>

                                <?php
                                echo (new ShopWxCategories())->Option(0);
                                ?>

                            </select>
                            <span  class="STYLE3" style="color:#666666;">　　　　　　　　　　所属分类，用于商品归类 </span>
                        </td>
                    </tr>
                    <tr>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" height="30" align="right">商品属性:&nbsp;</td>
                        <td height="30" colspan="2"><label>
                                <input type="checkbox" name="hot" value="1" />
                                热销
                                <input type="checkbox" name="drops" value="1" />
                                降价
                                <input type="checkbox" name="recommend" value="1" />
                                推荐
                            </label>                          　　<span class="STYLE3" style="color:#666666;">　　　&nbsp;商品的名称，用于前台展示 使用</span></td>
                    </tr>
                    <tr>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" height="30" align="right">商品状态:&nbsp;</td>
                        <td height="30" colspan="2"><label>
                                <input type="radio" name="shelves" value="1">上架
                                <input type="radio" name="shelves" value="0">下架
                            </label>
                            　　<span class="STYLE3" style="color:#666666;">　　　　　　　&nbsp;商品的状态</span></td>
                    </tr>
                    <tr>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" height="30" align="right">审核状态:&nbsp;</td>
                        <td height="30" colspan="2"><label>
                                <input type="radio" name="issh" value="0">未审核
                                <input type="radio" name="issh" value="1">已审核
                            </label>
                            　　<span class="STYLE3" style="color:#666666;">　　　　　　　&nbsp;商品的状态</span></td>
                    </tr>
                    <tr>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">商品库存:&nbsp;</td>
                        <td height="30" colspan="2">

                            <input type="text" name="kucun" size="30" value="0">                        <span class="STYLE3" style="color:#666666;">　如果库存等于0时，则不能进行下单</span></td>
                    </tr>
<!--                    <tr>-->
<!--                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">浏览量:&nbsp;</td>-->
<!--                        <td height="30" colspan="2"><input type="text" name="hits" size="30" value="0">                          <span class="STYLE3" style="color:#666666;">　可以初始化一个数量，用于展示该商品浏览量 </span></td>-->
<!--                    </tr>-->
                    <tr>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">打折价格:&nbsp;</td>
                        <td height="30" colspan="2"><input type="text" name="price" size="30" value="0">                          <span class="STYLE3" style="color:#666666;"></span></td>
                    </tr>
                    <tr>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">原价格:&nbsp;</td>
                        <td height="30" colspan="2"><input type="text" name="yprice" size="30" value="0">                          <span class="STYLE3" style="color:#666666;"></span></td>
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
                            <input type="text" name="picurl" size="30" style="margin-bottom: 10px">　
<!--                            height="31"-->
                            <iframe name="upfile" frameborder="0" width="350"  height="31" src="uploadPic.php" scrolling="no" ><span class="STYLE2"><span class="STYLE3"></span></span></iframe></td>
                    </tr>

                    <tr>
                        <!--                      合并单元格2列：colspan="2"  -->
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">商品介绍:&nbsp;</td>
                        <td  width="60%" colspan="2">
                                <textarea  id="container" name="content" rows="10" >
                                <?php echo $ShopEdiRes['content'];?>
                                </textarea>

                            <script id="container" name="content" type="text/plain"> </script>


                        </td>

                    </tr>
                    <tr>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">&nbsp;</td>
                        <td  width="60%">
                            <input class="submit" type="submit"  value="创建">&nbsp;
                            <input class = "reset" type="reset" value="重置">
                        </td>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="32%" height="30" align="right"></td>
                    </tr>
                </table>
            </fieldset>
        </form>


    </div>
    <div id="floor"></div>


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
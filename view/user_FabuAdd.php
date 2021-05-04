
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

//商品ID
$productID=time();
$productID.=rand(333,555)*1000;

?>

<hr>

<div class="main-box-top">
    <div class="main">
        <font size="25">发布商品</font>
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

            <form action="../public/UserLogin.class.php?tab=shopAdd
" method="post" name="myform" id="myform" onSubmit="return test();">
                <fieldset>
                    <legend>商品信息:</legend>

                    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f1f1f1">
                        <tr>
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">商品编号:&nbsp;</td>
                            <td height="30" colspan="2">
                                <input type="text" name="numbers" size="30" value="<?php echo $productID;?>" disabled>
                                <input type="hidden" name="numbers" size="30" value="<?php echo $productID;?>">
                                <span class="STYLE2" style="color:#666666;">　商品编号，用于商品管理，无编号系统自动生成</span></td>
                        </tr>
                        <tr>
                            <td width="10%" height="30" align="right" bordercolor="#F0F0F0" bgcolor="#F0F0F0">商品名称:&nbsp;</td>
                            <td height="30" colspan="2"><input type="text" name="title" size="30" />                          <span class="STYLE3" style="color:#666666;">　商品名称，用于首页展示使用</span></td>
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
                                    <input type="checkbox" name="hot" id="hot" value="1" />
                                    热销
                                    <input type="checkbox" name="drops" id="drops" value="1" />
                                    降价
                                    <input type="checkbox" name="recommend" id="recommend" value="1" />
                                    推荐
                                </label>                          　　<span class="STYLE3" style="color:#666666;">　　　&nbsp;商品的名称， 用于首页展示使用</span></td>
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
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">商品库存:&nbsp;</td>
                            <td height="30" colspan="2">

                                <input type="text" name="kucun" size="30" value="0">                        <span class="STYLE3" style="color:#666666;">　如果库存等于0时，则不能进行下单</span></td>
                        </tr>
<!--                        <tr>-->
<!--                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">浏览量:&nbsp;</td>-->
<!--                            <td height="30" colspan="2"><input type="text" name="hits" size="30" value="0">                          <span class="STYLE3" style="color:#666666;">　可以初始化一个数量，用于展示该商品浏览量 </span></td>-->
<!--                        </tr>-->
                        <tr>
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">打折价格:&nbsp;</td>
                            <td height="30" colspan="2"><input type="text" name="price" size="30" value="0">                          <span class="STYLE3" style="color:#666666;">　*打折价格需大于0</span></td>
                        </tr>
                        <tr>
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">原价格:&nbsp;</td>
                            <td height="30" colspan="2"><input type="text" name="yprice" size="30" value="0">                          <span class="STYLE3" style="color:#666666;">　*原价格需大于0且大于打折价格</span></td>
                        </tr>
                        <tr>
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">优惠:&nbsp;</td>
                            <td height="30" colspan="2"><input type="text" name="youhui" size="30" value="0">                          <span class="STYLE3" style="color:#666666;">　&nbsp;*可以不填</span></td>
                        </tr>
                        <tr>
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">邮费:&nbsp;</td>
                            <td height="30" colspan="2"><input type="text" name="youfei" size="30" value="0">                          <span class="STYLE3" style="color:#666666;">　&nbsp;*可以不填</span></td>
                        </tr>
                        <tr>
                            <td width="10%" height="30" align="right" valign="middle" bordercolor="#F0F0F0" bgcolor="#F0F0F0">商品图片:&nbsp;</td>
                            <td height="30" colspan="2" valign="middle">
                                <input type="text" name="picurl" size="30" style="margin-bottom: 10px">　
                                <!--                            height="31"-->
                                <iframe name="upfile" frameborder="0" width="350"  height="31" src="./admin/uploadPic.php" scrolling="no" ><span class="STYLE2"><span class="STYLE3"></span></span></iframe></td>
                        </tr>

                        <tr>
                            <!--                      合并单元格2列：colspan="2"  -->
                            <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">商品介绍:&nbsp;</td>
                            <td  width="60%" colspan="2">
                                <textarea  id="container" name="content" rows="10" >
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




        <div style="clear: both"></div>





    </div>
</div>
<script type="text/javascript">
    $(function(){

        var ue = UE.getEditor('container');

          ue.ready(function() {
             ue.setHeight(400);
             //设置编辑器的内容
           // ue.setContent('hello');
              // //获取html内容，返回: <p>hello</p>
             // var html = ue.getContent();
             // //获取纯文本内容，返回: hello
            // var txt = ue.getContentTxt();
         });

    });
</script>
<script type="text/javascript">


    function test()
    {
        var title =document.myform.title.value;
        var kucun = document.myform.kucun.value;
        var typeid = document.myform.typeid.value;
        var price = document.myform.price.value;
        var ishot = $('#hot').prop('checked');
        var isdrops = $('#drops').prop('checked');
        var isrecommend = $('#recommend').prop('checked');
        var shelves = $("input[name='shelves']:checked").val();
        var yprice = document.myform.yprice.value;
        var youhui = document.myform.youhui.value;
        var youfei = document.myform.youfei.value;
        var pic = document.myform.picurl.value;

        // alert(shelves);
        if(title=='')
        {
            alert('商品名字不能为空');
            return false;
        }
        if(typeid=='')
        {
            alert('商品所属分类不能为空');
            return false;
        }

        if(!(ishot || isdrops || isrecommend)){
            alert('请勾选【商品属性】');
            return false;
        }

        if(!(shelves==0 ||shelves==1)){
            alert('请选择【商品状态】');
            return false;
        }



        if(kucun=='')
        {
            alert('库存不能为空');
            return false;
        }

        if(kucun <=0){
            alert('【商品库存】请填写大于0的数字');
            return false;
        }
        if(isNaN(kucun) && kucun !== 'number') {
            alert('【商品库存】请输入正确数值');
            return false;
        }
        //打折价格
        if(price=='')
        {
            alert('【打折价格】不能为空');
            return false;
        }

        if(price <=0){
            alert('【打折价格】请填写大于0的数字');
            return false;
        }
        if(isNaN(price) && price !== 'number') {
            alert('【打折价格】请输入正确数值');
            return false;
        }
        //原价格
        if(yprice=='')
        {
            alert('【原价格】不能为空');
            return false;
        }

        if(yprice <=0){
            alert('【原价格】请填写大于0的数字');
            return false;
        }
        if(isNaN(yprice) && yprice !== 'number') {
            alert('【原价格】请输入正确数值');
            return false;
        }

        //原价格大于打折价格
        if(eval(yprice)<eval(price)){
            alert('【原价格】应大于【打折价格】');
            return false;
        }
        //优惠
        if(youhui=='')
        {
            alert('【优惠】不能为空');
            return false;
        }

        if(youhui <0){
            alert('【优惠】请填写大于0的数字');
            return false;
        }
        if(isNaN(youhui) && youhui !== 'number') {
            alert('【优惠】请输入正确数值');
            return false;
        }

        //邮费
        if(youfei=='')
        {
            alert('【邮费】不能为空');
            return false;
        }

        if(youfei <0){
            alert('【邮费】请填写大于0的数字');
            return false;
        }
        if(isNaN(youfei) && youfei !== 'number') {
            alert('【邮费】请输入正确数值');
            return false;
        }

        if(pic=='')
        {
            alert('请为商品选择一张缩略图');
            return false;
        }

        return true;
    }

</script>
</body>
</html>
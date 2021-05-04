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


<script type="text/javascript">




    function test()
    {


                if(document.myform.title.value=='')
                {
                    alert('请输入标题');
                    return false;
                }
                if(document.myform.typeid.value=='')
                {
                    alert('请输入文章分类');
                    return false;
                }
                if(document.myform.author.value=='')
                {
                    alert('请填写文章作者');
                    return false;
                }
                if(document.myform.com.value=='')
                {
                    alert('请填写文章来源');
                    return false;
                }
                if(document.myform.hits.value=='')
                {
                    alert('请填写默认浏览数');
                    return false;
                }
                if(content== ''){
                    alert("编辑器不能为空!")

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
    //查询数据
    $UserWhere = array(
        'table' => 'articleType ',
        'field' => '*',

    );
    $UserRestful = $helper->getAll($UserWhere);
    //var_dump($UserRestful);

    ?>

    <div id="content_body">
<!--../../public/Aticle.class.php-->
        <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 添加新文章</font></div>
        <hr>

        <form action="../../public/Admin/Aticle.class.php?tab=articleAdd" method="post" name="myform" onSubmit="return test();">
            <fieldset>
                <legend>文章信息:</legend>

                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">文章标题:&nbsp;</td>
                        <td  width="30%"><input type="text" name="title" size="30"></td>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="32%" height="30" align="right"> &nbsp;</td>

                    </tr>
                    <tr>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">文章分类:&nbsp;</td>
                        <td  width="30%">

                            <select name="typeid">
                                <option value="">请选择文章分类
                                </option>

                                <?php foreach ($UserRestful as $k => $v){?>
                                <option value="<?php echo $v['id'];?>"><?php echo  $v['typename'];?>
                                   </option>
                                <?php }?>
                            </select></td>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="32%" height="30" align="right">&nbsp;</td>

                    </tr>
                    <tr>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">文章作者:&nbsp;</td>
                        <td  width="30%">

                            <input type="text" name="author" size="30">
                        </td>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="32%" height="30" align="right">&nbsp;</td>

                    </tr>
                    <tr>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">文章来源:&nbsp;</td>
                        <td  width="30%"><input type="text" name="com" size="30"></td>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="32%" height="30" align="right">&nbsp;</td>

                    </tr>
                    <tr>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">状态:&nbsp;</td>
                        <td  width="30%">
                            <input type="radio" name="issh" value="1" >审核
                            <input type="radio" name="issh" value="0" >未审核

                        </td>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="32%" height="30" align="right">&nbsp;</td>

                    </tr>
<!--                    <tr>-->
<!--                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">浏览量:&nbsp;</td>-->
<!--                        <td  width="30%"><input type="text" name="hits" size="30"></td>-->
<!--                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="32%" height="30" align="right">&nbsp;</td>-->
<!---->
<!--                    </tr>-->
                    <tr>
<!--                      合并单元格2列：colspan="2"  -->
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">文章内容:&nbsp;</td>
                        <td  width="60%" colspan="2">
                            <textarea  id = "container" name="content" rows="10" cols="30">
                            </textarea>
                            <script id="container" name="content" type="text/plain"> </script>

                        </td>
<!--                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="32%" height="30" align="right">&nbsp;</td>-->

                    </tr>
                    <tr>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="10%" height="30" align="right">&nbsp;</td>
                        <td  width="30%">
                            <input class="submit" type="submit"  value="创建">&nbsp;
                            <input class = "reset" type="reset" value="重置">
                        </td>
                        <td bordercolor="#F0F0F0" bgcolor="#F0F0F0" width="32%" height="30" align="right">
</td>

                    </tr>


                </table>
<!--                文章标题: <input type="text" name="title" size="30"><br>-->
<!--                文章分类: <input type="text" name="fl" size="30"><br>-->
<!--                文章来源: <input type="text" name="com" size="30"><br>-->
<!--                浏览量: <input type="text" name="num" size="30"><br>-->
<!--                文章内容: <input type="text" name="content" size="30"><br>-->
<!--                文章标题: <input type="text" name="content" size="30"><br>-->
<!---->


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
</body>

</html>
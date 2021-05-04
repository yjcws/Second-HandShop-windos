
<?php
include "../config/Webconfig.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $webname."-".$webUrl;?></title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</head>
<body>
<!--头部-->

<?php
include "./public/header.php";
$helper->isUserLogin();


$ScWhere = array(
    'table' => 'product',
    'field' => '*',
    'where'=>"inputer='{$helper->getUsernames()['username']}'",
    'order' => [
        'field' => 'addtime ',
        'order' => 'desc'
    ],
);

$SaRestful = $helper->getAll($ScWhere);


//$helper->dd($SaRestful);




?>

<hr>

<div class="main-box-top">
    <div class="main">
        <font size="25">我的发布</font>
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
            <div style="float: right;margin-bottom: 10px"><a href="user_FabuAdd.php"><input type="button" value="发布商品"></a> </div>




            <form id="form1" name="form1" method="post" action="" >
                <table  width="100%" border="0" cellspacing="0"  style="border:1px solid #CCCCCC;">
                    <tr>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">&nbsp;</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">商品图片</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">商品名称</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">价格</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">状态</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">人气</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">发布时间</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">操作</th>
                    </tr>
                    <?php
                    /**
                     * 如果为空就不输出
                     */

                    if (!empty($SaRestful)){
                    foreach ($SaRestful as $k=>$val) {

                        ?>
                        <tr>
                            <td rowspan="2" align="center" valign="middle">
<!--                                <input type="checkbox" name="check[]" id='check' value="--><?php //echo $val['numbers'];?><!--" />-->
                                <input type="hidden" name="id" id='id' value="<?php echo $val['numbers'];?>" />
                            </td>
                            <td rowspan="2" align="center" valign="middle"><img src="./upload/<?php echo $val['picurl'];?>" width="75" height="75" />&nbsp;</td>

                            <?php if ($val['issh']){?>
                            <td height="35" style=" table-layout:fixed; width: 225px; white-space: normal; word-break : break-all;"  align="center" valign="middle" rowspan="2"><a href="ShopInfo.php?id=<?php echo $val['numbers'];?>" ><?php echo $val['title'];?></a></td>

                            <?php }else{?>
                                <td height="35" style=" table-layout:fixed; width: 225px; white-space: normal; word-break : break-all;"  align="center" valign="middle" rowspan="2"><font color="gray"><?php echo $val['title'];?></font></td>

                            <?php }?>
                            <td rowspan="2" align="center" valign="middle"><font color="red">￥：<?php echo $val['price'];?></font></td>
                            <td rowspan="2" align="center" valign="middle"><?php echo $helper->getIsshAttr($val['issh']);?></td>
                            <td rowspan="2" align="center" valign="middle"><?php echo $val['hits'];?></td>
                            <td rowspan="2" align="center" valign="middle">&nbsp;<?php echo date('Y-m-d',$val['addtime']);?></td>

                        </tr>
                        <tr>
                            <td height="35" colspan="2" align="center" valign="middle">
                                <a href="user_FabuEdi.php?id=<?php echo $val['numbers'];?>"><input type="button" value="修改"></a>&nbsp;|&nbsp;
                                <a href="../public/UserLogin.class.php?tab=ShopDel&id=<?php echo $val['numbers'];?>"><input type="button" value="取消发布"></a>
                            </td>

                        </tr>
                        <tr>
                            <td height="35" colspan="8" align="center" valign="middle"><hr></td>
                        </tr>

                    <?php
                    }
                    }else{
                        echo "<tr>
                                <td height=\"50\" align=\"center\" valign=\"middle\" colspan='8'><font color='red'>你还没有发布自己的商品喔！赶紧行动起来吧</font></td></tr>";
                    }
                    ?>
                </table>
<!--                <table  width="100%" border="0" cellspacing="0"  style="border:1px solid #CCCCCC;">-->
<!--                    <tr >-->
<!--                        <th height="35"  align="left" valign="middle" ><input type="submit" name="Submit2" value="批量取消收藏" /></th>-->
<!--                        <th width="40%" height="35" align="left" valign="middle">&nbsp;</th>-->
<!--                        <th width="3%" height="35" align="center" valign="middle">&nbsp;</th>-->
<!--                        <th width="3%" height="35" align="center" valign="middle">&nbsp;</th>-->
<!--                        <th width="3%" height="35" align="center" valign="middle">&nbsp;</th>-->
<!--                        <th width="3%" height="35" align="center" valign="middle">&nbsp;</th>-->
<!--                        <th width="35%" height="35" align="center" valign="middle">共有--><?php //echo $_SESSION['ScData']['ScTatol'];?><!--个收藏 </th>-->
<!--                    </tr>-->
<!--                </table>-->


            </form>

        </div>




        <div style="clear: both"></div>





    </div>
</div>
<!--<script>-->
<!---->
<!--    /**-->
<!--     * 判断是否选中商品-->
<!--     * @returns {*}-->
<!--     */-->
<!--    function Check() {-->
<!--        // 获取checkbox元素  // 判断是否被拒选中，选中返回true，未选中返回false-->
<!--        var box=document.getElementById("check").checked;-->
<!---->
<!--        // alert(!box);-->
<!--        //-->
<!--        if (!box){-->
<!--            alert('请选中一个商品！');-->
<!--            return false;-->
<!--        }-->
<!--        return true;-->
<!--    }-->
<!---->
<!--</script>-->

</body>
</html>
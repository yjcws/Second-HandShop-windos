<?php
include "../config/Webconfig.php";

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $webname."-".$webUrl;?></title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
<!--头部-->

<?php
include "./public/header.php";
$helper->isUserLogin();
//echo 123;



/*校园帖子
 * 校园帖子类型id=21
 *table:article
 *
 * */
$RAtWhere = array(
    'table' => 'article',
    'field' => 'id,title',
    'where'=>"typeid=21 AND issh=1",
    'order' => [
        'field'=>'hits ',
        'order'=>'desc'
    ],
    'limit'=>'5'
);

$RAtRestful = $helper->getAll($RAtWhere);

$NumWhere = array(
    'table' => 'user_main',
    'field' => '*',
    'where' =>"'{$helper->getUsernames()['username']}'"
);

$NumRs = $helper->getOne($NumWhere);


//$helper->dd($NumRs);



?>

<hr>

<div class="main-box-top">
    <div class="main">
        <font size="25">我的地盘</font>
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
        <div class="main-center">

                <table width="100%" border="0" cellspacing="0" bordercolor="#CCCCCC" style="border:1px solid #CCCCCC;">
                    <tr>
                        <th width="21%" rowspan="4" scope="col"><img src="./image/<?php echo 'photo'.rand(1,4).'.png';?>" width="132" height="131" ></th>
                        <th height="40" colspan="3" scope="col">
                            <font size="5"> 欢迎您！<?php echo $helper->getUsernames()['username'];?></font>
                        </th>
                        <th width="24%" height="40"><a href="user_Edit.php">编辑个人信息</a></th>

                    </tr>
<!--                    <tr>-->
<!--                        <td width="16%" height="40" align="right" valign="middle">交易提醒：</td>-->
<!--                        <td width="16%" height="40" align="left" valign="middle">待支付(<font color="red">--><?php //echo $NumRs['daiZhifu'];?><!--</font>)</td>-->
<!--                        <td width="16%" height="40" align="left" valign="middle">已发货(<font color="red">--><?php //echo $NumRs['yifahuo'];?><!--</font>)</td>-->
<!--                        <td height="40" align="left" valign="middle">待评价(<font color="red">--><?php //echo $NumRs['daipjia'];?><!--</font>)</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td height="40" align="right" valign="middle">收藏提醒：</td>-->
<!--                        <td height="40" align="left" valign="middle">促销中(0)</td>-->
<!--                        <td height="40" align="left" valign="middle">即将售完(0)</td>-->
<!--                        <td height="40" align="left" valign="middle">新到货(0)</td>-->
<!--                    </tr>-->
                    <tr>
                        <td height="40" align="center" valign="middle">&nbsp;</td>
                        <td height="40" align="center" valign="middle">&nbsp;</td>
                        <td height="40" align="center" valign="middle">&nbsp;</td>
                        <td height="40" align="center" valign="middle">&nbsp;</td>
                    </tr>
                </table>

<!--正在促销-->
<!--            <table width="15%" border="0" cellspacing="0" class="main-box-top" id="table-radius">-->
<!--                <tr>-->
<!--                    <td height="35"  rowspan="8" align="center">更多促销&nbsp;</td>-->
<!---->
<!--                </tr>-->
<!--            </table>-->
<!---->
<!--            <table width="100%" border="0" cellspacing="0" align="center" bordercoloer="#CCCCCC"  style="border:1px solid #CCCCCC;">-->
<!--                <tr>-->
<!--                    <th width="33%" height="200" colspan="2" align="center" scope="col"><img src="image/img.jpg" width="219" height="227"></th>-->
<!--                    <th width="33%" height="200" scope="col" align="center"><img src="image/img.jpg" width="219" height="227"></th>-->
<!--                    <th width="33%" height="200" scope="col" align="center"><img src="image/img.jpg" width="219" height="227"></th>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td height="40" colspan="2"><a href=""> Pure Cashmere精选推荐 多种戴法山羊绒蝴蝶结贝雷帽子女秋冬百搭</a></td>-->
<!--                    <td height="40"><a href=""> Pure Cashmere精选推荐 多种戴法山羊绒蝴蝶结贝雷帽子女秋冬百搭</a></td>-->
<!--                    <td height="40"><a href=""> Pure Cashmere精选推荐 多种戴法山羊绒蝴蝶结贝雷帽子女秋冬百搭</a></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td height="40" colspan="2">价格：<span style="color: red;">￥200.00</span></td>-->
<!--                    <td height="40">价格：<span style="color: red;">￥200.00</span></td>-->
<!--                    <td height="40">价格：<span style="color: red;">￥200.00</span></td>-->
<!--                </tr>-->
<!---->
<!---->
<!--                <tr>-->
<!--                    <th height="200" colspan="2" align="center" scope="col"><img src="image/img.jpg" width="219" height="227"></th>-->
<!--                    <th width="33%" height="200" scope="col" align="center"><img src="image/img.jpg" width="219" height="227"></th>-->
<!--                    <th width="28%" height="200" scope="col" align="center"><img src="image/img.jpg" width="219" height="227"></th>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td height="40" colspan="2"><a href=""> Pure Cashmere精选推荐 多种戴法山羊绒蝴蝶结贝雷帽子女秋冬百搭</a></td>-->
<!--                    <td height="40"><a href=""> Pure Cashmere精选推荐 多种戴法山羊绒蝴蝶结贝雷帽子女秋冬百搭</a></td>-->
<!--                    <td height="40"><a href=""> Pure Cashmere精选推荐 多种戴法山羊绒蝴蝶结贝雷帽子女秋冬百搭</a></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td height="40" colspan="2">价格：<span style="color: red;">￥200.00</span></td>-->
<!--                    <td height="40">价格：<span style="color: red;">￥200.00</span></td>-->
<!--                    <td height="40">价格：<span style="color: red;">￥200.00</span></td>-->
<!--                </tr>-->
<!--            </table>-->

        </div>




        <!--        间隙-->
        <div class="main-jianxi" > &nbsp;&nbsp;</div>


<!--右边-->
    <div class="main-right">
        <table width="100%" border="0" cellspacing="0" style="border:1px solid #CCCCCC;">
            <tr>
                <th height="28" bgcolor="#BEEDC7" scope="col">校园热门帖子</th>
            </tr>

            <?php foreach ($RAtRestful as $val){?>
                <tr>
                    <td height="28" align="center"><a href="XyTieZiInfo.php?id=<?php echo $val['id'];?>"><?php echo $helper->GetstrLeft($val['title'],10);?></a></td>
                </tr>
            <?php }?>



            <tr>
                <td height="28" align="right"><a href="XyTiezi.php"><input type="button" name="Submit" value="更多帖子" /></a>
                        </td>
            </tr>
        </table>
    </div>

        <div style="clear: both"></div>


    </div>
</div>


</body>
</html>
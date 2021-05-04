
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


$ScWhere = array(
    'table' => 'receive',
    'field' => '*',
    'order' => [
        'field' => 'id ',
        'order' => 'desc'
    ],
);

$SaRestful = $helper->getAll($ScWhere);


//echo '<pre>';
//var_dump($SaRestful);
//echo '</pre>';
//unset($_SESSION['productCart']);
$Cart = $_SESSION['productCart'];
//$helper->dd($Cart);
?>

<hr>

<div class="main-box-top">
    <div class="main">
        <font size="25">我的购物车</font>
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
            <div style="float: left;margin-bottom: 10px"><a href="index.php"><input type="button" value="继续购买"></a> </div>

            <form action="../public/Cart.class.php?tab=delAll" method="post">


                <table width="100%" border="0" cellspacing="0"  style="border:1px solid #CCCCCC;">
                    <tr>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">&nbsp;</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">商品图片</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col" style="table-layout:fixed; width: 200px; white-space: normal; word-break : break-all;
" >商品名称</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">原价</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">打折价</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">小计</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">商品数量</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">操作</th>
                    </tr>
                    <?php
                    if (!empty($Cart)){
                    foreach ($Cart as $shopid =>$val) {?>

                        <tr>
                            <td rowspan="2" align="center" valign="middle"><input type="checkbox" name="check[]" value="<?php echo $shopid;?>" /></td>
                            <td rowspan="2" align="center" valign="middle"><img src="./upload/<?php echo $val['picurl'];?>" width="75" height="75">&nbsp;</td>
                            <td rowspan="2" align="center" valign="middle"><a href="ShopInfo.php?id=<?php echo $shopid;?>"><?php echo $val['title'];?></a></td>
                            <td rowspan="2" align="center" valign="middle">￥:<font color="red"><?php echo $val['yPrice'];?></font></td>
                            <td rowspan="2" align="center" valign="middle">￥:<font color="red"><?php echo $val['Price'];?></font></td>
                            <td rowspan="2" align="center" valign="middle">￥:<font color="red"><?php echo $val['xiaoji'];?></font></td>
                            <td rowspan="2" align="center" valign="middle"><?php echo $val['CartTotal'];?></td>
                            <td height="35" align="center" valign="middle"><a href="OrderAdd.php?id=<?php echo $shopid;?>"><input type="button" name="button" value="立即购买" /></a></td>
                        </tr>
                        <tr>
                            <td height="35" align="center" valign="middle"><a href="../public/Cart.class.php?tab=CartDel&id=<?php echo $shopid;?>">删除</a></td>
                        </tr>
                        <tr>
                            <td height="35" align="center" valign="middle" colspan="8"><hr></td>
                        </tr>
                    <?php }
                    }else{
                        echo "<tr>
                            <td height=\"50\" align=\"center\" valign=\"middle\" colspan='8'><font color='red'>你还没有商品加入购物车喔！赶紧去逛 逛吧</font></td></tr>
";
                    }
                    ?>
                </table>
                <?php if (!empty($Cart)){?>
                <table  width="100%" border="0" cellspacing="0"  style="border:1px solid #CCCCCC;">
                    <tr >
                        <th height="35"  align="left" valign="middle" >
<!--                            <input type="button" name="Submit2" value="批量购买" />&nbsp;&nbsp;-->
                            <input type="submit" name="Submit3" value="批量删除" />
                        </th>
                        <th height="35" align="center" valign="middle"></th>
                        <th height="35" align="center" valign="middle"></th>
                        <th height="35" align="center" valign="middle">&nbsp;</th>
                        <th height="35" align="center" valign="middle">&nbsp;</th>
                        <th height="35" align="center" valign="middle">&nbsp;</th>
                        <th height="35" align="center" valign="middle">&nbsp;</th>
                        <th height="35" align="right" valign="middle">共有<font color="red"><?php echo $_SESSION['cartCount'];?></font>个商品 &nbsp;&nbsp;共<font color="red"><?php echo $_SESSION['cartPrice'];?></font>元</th>
                    </tr>

                </table>
                <?php }?>

            </form>

        </div>




        <div style="clear: both"></div>





    </div>
</div>


</body>
</html>
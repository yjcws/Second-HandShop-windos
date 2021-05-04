
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
/**
 * 初始化订单
 */
$helper->GetOrder();


//$ScWhere = array(
//    'table' => 'receive',
//    'field' => '*',
//    'order' => [
//        'field' => 'id ',
//        'order' => 'desc'
//    ],
//);
//
//$SaRestful = $helper->getAll($ScWhere);


$Order = $_SESSION['orderList'];




/**
 * 搜索订单
 */
if (isset($_GET['ziduan']) && isset($_GET['key'])){
    $key = $_GET['key'];
    /**
     * 订单号查询
     */
    if($_GET['ziduan'] == 'OrderId') {
        foreach (array_keys($Order) as $val) {
            if (!strstr($val, $key)) {
                continue;
            }
            $Arr[$val] = $Order[$val];
        }
        $Order = $Arr;
    }

    /**
     * 商品名称查询
     */
    if ($_GET['ziduan'] == 'title'){

        foreach ($Order as $k=>$v){
            if (!strstr($v['title'], $key)) {
                continue;
            }
            $Arr[$k] = $Order[$k];
        }
        $Order = $Arr;

    }

}
//$helper->dd($Order);

//$helper->IsPingLun();
//$helper->dd($helper->IsPingLun());

//var_dump($helper->IsPingLun());


?>

<hr>

<div class="main-box-top">
    <div class="main">
        <font size="25">我的订单</font>
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

            <div style="float: right;margin-bottom: 10px">
                <form action="userOrder.php" method="get"  id="formsearch" name="formsearch" onSubmit="return test();">
                    商品关键字：
                    <select name="ziduan" id="ziduan">
                        <option value="OrderId" selected="selected">订单号</option>
                        <option value="title">商品名称</option>
                    </select>
                    &nbsp;
                    <input name="key" type="text" /> <input name="" type="submit" value="查询" />
                </form>
            </div>


                <table width="100%" border="0" cellspacing="0"  style="border:1px solid #CCCCCC;">
                    <tr>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">订单号</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">订单商品</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col" style="table-layout:fixed; width: 200px; white-space: normal; word-break : break-all;
" >收货人</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">订单金额</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">下单时间</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">支付状态</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">订单状态</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">操作</th>
                    </tr>
                    <?php
                    if (!empty($Order)){
                        foreach ($Order as $OrderId =>$val) {?>

                            <tr>
                                <td rowspan="2" align="center" valign="middle"><font color="gray"><?php echo $OrderId;?></font></td>
                                <td rowspan="2" align="center" valign="middle"><a href="ShopInfo.php?id=<?php echo $val['shopid'];?>"><img src="./upload/<?php echo $val['picurl'];?>" width="75" height="75"></a></td>
                                <td rowspan="2" align="center" valign="middle"><font color="gray"><?php echo $val['shr'];?></font></td>
                                <td rowspan="2" align="center" valign="middle">￥:<font color="red"><?php echo $val['Price'];?></font></td>
                                <td rowspan="2" align="center" valign="middle"><font color="gray"><?php echo date('Y-m-d',$val['addtime']);?></font></td>
                                <td rowspan="2" align="center" valign="middle"><font color="gray"><?php echo $val['PaymentState'];?></font></td>
                                <td rowspan="2" align="center" valign="middle"><?php echo $val['OrderState'];?></td>
                                <td height="43" align="center" valign="middle"><a href="OrderInfo.php?id=<?php echo $OrderId;?>">
                                  <input type="button" name="button" value="订单详情" />
                                  </a></td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle">

                                    <?php
                                    /**
                                     * 支付状态PaymentState1.待支付2.已支付3.待退款4.已退款
                                     * 订单状态OrderState：1.待处理2.已发货3.已收货4.已取消5.交易完完成
                                     */

                                    if($val['PaymentState'] == '待支付') {
                                        /**
                                         * 取消订单
                                         */
                                        if ($val['OrderState'] != '已取消' && $val['OrderState'] != '已发货' && $val['OrderState'] != '已收货'){
                                            echo "<a href=\"../public/Admin/Order.class.php?id={$OrderId}&tab=quxiao\"><input name=\"tuikuan\" type=\"button\" id=\"tuikuan\" value=\"取消订单\" ></a>
";                                        }

                                        /**
                                         * 如果发货
                                         */
                                        if ($val['OrderState'] == '已发货') {
                                            echo "<a href='../public/Admin/Order.class.php?id={$OrderId}&tab=qrsh'><input name=\"fahuo\" type=\"button\" id=\"fahuo\" value=\"确认收货\" ></a>
";
                                        }
                                        /**
                                         * 确认收货：显示评论
                                         */
                                        if ($val['OrderState'] == '已收货') {
//                                            var_dump(empty($helper->IsPingLun()));
                                            if (empty($helper->IsPingLun()) || !in_array($OrderId, $helper->IsPingLun())) {
                                                echo "<a href=\"userAssessAdd.php?id={$OrderId}\"><input name=\"pinglun\" type=\"button\" id=\"pinglun\" value=\"去评论\"></a>";
                                            } else {
                                                echo "<input name=\"pinglun\" type=\"button\" id=\"pinglun\" value=\"已评论\" disabled>
";
                                            }
                                        }
                                    }

                                /**
                                 * 已支付
                                 */
                                 if ($val['PaymentState'] == '已支付'){
                                     echo "<a href='../public/Admin/Order.class.php?id={$OrderId}&tab=tk'><input name=\"tuikuan\" type=\"button\" id=\"tuikuan\" value=\"退款\" ></a> ";

                                     /**
                                      * 如果发货
                                      */
                                     if($val['OrderState'] == '已发货'){
                                         echo "<a href='../public/Admin/Order.class.php?id={$OrderId}&tab=qrsh'><input name=\"fahuo\" type=\"button\" id=\"fahuo\" value=\"确认收货\" ></a>
";
                                     }
                                     /**
                                      * 确认收货：显示评论
                                      */
                                     if ($val['OrderState']=='已收货') {
                                         if(empty($helper->IsPingLun()) || !in_array($OrderId,$helper->IsPingLun())){
                                             echo "<a href=\"userAssessAdd.php?id={$OrderId}\"><input name=\"pinglun\" type=\"button\" id=\"pinglun\" value=\"去评论\"></a>";
                                         }else{
                                             echo "<input name=\"pinglun\" type=\"button\" id=\"pinglun\" value=\"已评论\" disabled>
";
                                         }

                                 }



                                    }?>



                                </td>
                            </tr>

                            <tr>
                                <td height="35" align="center" valign="middle" colspan="8"><hr></td>
                            </tr>
                        <?php }
                    }else{
                        echo "<tr>
                            <td height=\"50\" align=\"center\" valign=\"middle\" colspan='8'><font color='red'>你还没有订单喔！赶紧去逛逛 吧</font></td></tr>
";
                    }
                    ?>
                </table>



        </div>




        <div style="clear: both"></div>





    </div>
</div>


</body>
</html>
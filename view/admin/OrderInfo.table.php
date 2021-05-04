<?php



$OrderWhere = array(
    'table' => 'productorder',
    'field' => '*',
    'where' =>'orderID='.@$_GET['id']
);
$OrderInfo = $helper->getOne($OrderWhere);



/**
 * 收货表
 */
$ShWhere = array(
    'table' => 'receive',
    'field' => '*',
    'where'=>"id={$OrderInfo['receive_id']} AND is_mr=1",
);

$ShRs = $helper->getOne($ShWhere);


//$helper->dd($OrderInfo);

?>


<div id="content_body">

    <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 订单详情</font></div>


    <div class="body-center" >

        <!--收货地址-->
        <table width="100%" border="0" cellspacing="0" bgcolor="#FFFFFF">
            <tr>
                <th height="40" colspan="3" align="left" scope="col">收货信息</th>
            </tr>
            <tr>
                <th height="40" colspan="3" align="left" scope="col"><hr></th>
            </tr>
            <tr>
                <td width="2%" align="right">&nbsp;</td>
                <td width="11%" height="40" align="center" valign="middle"><font color="gray">收货人：</font></td>
                <td width="87%" height="40">&nbsp;<?php echo $ShRs['shren'];?></td>
            </tr>
            <tr>
                <td align="right">&nbsp;</td>
                <td height="40" align="center" valign="middle"><font color="gray">收货地址：</font></td>
                <td height="40">&nbsp;<?php echo $ShRs['shdizhi'];?></td>
            </tr>
            <tr>
                <td align="right">&nbsp;</td>
                <td height="40" align="center" valign="middle"><font color="gray">邮政编码：</font></td>
                <td height="40">&nbsp;<?php echo $ShRs['youbian'];?></td>
            </tr>
            <tr>
                <td align="right">&nbsp;</td>
                <td height="40" align="center" valign="middle"><font color="gray">手机：</font></td>
                <td height="40">&nbsp;<?php echo $ShRs['mobile'];?></td>
            </tr>
            <tr>
                <td align="right">&nbsp;</td>
                <td height="40" align="center" valign="middle"><font color="gray">固定电话：</font></td>
                <td height="40">&nbsp;<?php echo $ShRs['tel'];?></td>
            </tr>
        </table>
        <!--            支付及配送方式-->

        <table width="100%" border="0" cellspacing="0" bgcolor="#FFFFFF">
            <tr>
                <th height="40" colspan="3" align="left" scope="col">支付及配送方式</th>
            </tr>
            <tr>
                <td height="40" colspan="3"><hr>&nbsp;</td>
            </tr>
            <tr>
                <td width="2%">&nbsp;</td>
                <td width="87%" height="40"><font color="gray">支付方式：</font><?php echo $helper->getPaymentAttr($OrderInfo['payment']);?></td>
                <td width="11%" height="40">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td height="40"><font color="gray">配送方式：</font>城市配送</td>
                <td height="40">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td height="40"><font color="gray">邮费：￥：</font><?php echo $OrderInfo['yunfei'];?></td>
                <td height="40">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td height="40"><font color="gray">送货时间：</font><?php echo $helper->getSonghuAttr($OrderInfo['songhu']);?></td>
                <td height="40" >&nbsp;</td>
            </tr>
        </table>
        <!--            商品详情-->
        <table width="100%" border="0" cellspacing="0" bgcolor="#FFFFFF"  >
            <tr>
                <th height="35" colspan="5" align="left" scope="col">商品清单</th>
            </tr>
            <tr>
                <td height="35" colspan="5" align="center" valign="middle" scope="col"><hr>&nbsp;</td>
            </tr>
            <tr>
                <td height="35" align="center" valign="middle" bgcolor="#999999" scope="col">商品图片</td>
                <td height="35" align="center" valign="middle" bgcolor="#999999" scope="col" style="table-layout:fixed; width: 200px; white-space: normal; word-break : break-all;
    " >商品名称</td>
                <td height="35" align="center" valign="middle" bgcolor="#999999" scope="col">价格</td>
                <td height="35" align="center" valign="middle" bgcolor="#999999" scope="col">小计</td>
                <td height="35" align="center" valign="middle" bgcolor="#999999" scope="col">商品数量</td>
            </tr>
            <?php
            if (!empty($OrderInfo)){?>

            <tr>
                <td rowspan="2" align="center" valign="middle"><img src="../upload/<?php echo $OrderInfo['picurl'];?>" width="75" height="75">&nbsp;</td>
                <td rowspan="2" align="center" valign="middle"><?php echo $OrderInfo['title'];?></td>
                <td rowspan="2" align="center" valign="middle">￥:<font color="red"><?php echo $OrderInfo['price'];?></font></td>
                <td rowspan="2" align="center" valign="middle">￥:<font color="red"><?php echo $OrderInfo['total']*$OrderInfo['price'];?></font></td>
                <td rowspan="2" align="center" valign="middle"><?php echo $OrderInfo['total'];?></td>
                <?php
                }else{
                    echo "<tr>
                                <td height=\"50\" align=\"center\" valign=\"middle\" colspan='8'><font color='red'>你还没有商品订单喔！再去逛 逛 吧</font></td></tr>
    ";
                }
                ?>
        </table>

        <!--            结算信息-->
        <table width="100%" border="0" cellspacing="0" bgcolor="#FFFFFF">
            <tr>
                <th height="40" colspan="5" align="left" scope="col">结算信息</th>
            </tr>
            <tr>
                <td height="40" colspan="5" align="right"><hr>&nbsp;</td>
            </tr>
            <tr>
                <td width="50%" height="40" align="right">商品件数:<font color="gray"><?php echo $OrderInfo['total'];?></font>件</td>
                <td width="17%" height="40" align="center">商品金额:<font color="gray">￥:<?php echo $OrderInfo['price'];?></font></td>
                <td width="11%" height="40">邮费 :<font color="gray">￥:<?php echo $OrderInfo['yunfei'];?></font> </td>
                <td width="20%" height="40" colspan="2">优惠:<font color="gray">￥:<?php echo $OrderInfo['youhui'];?></font></td>
            </tr>
            <tr>
                <td height="40">&nbsp;</td>
                <td height="40">&nbsp;</td>
                <td height="40">&nbsp;</td>
                <td height="40" width="20%" colspan="2">支付金额:<font color="red" size="5">￥:<?php echo sprintf("%.2f",$OrderInfo['total']*$OrderInfo['price']+$OrderInfo['yunfei']-$OrderInfo['youhui']);?></font></td>
            </tr>
        </table>
    </div>
    <hr>



<div id="floor"></div>


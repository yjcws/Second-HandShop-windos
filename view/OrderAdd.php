
<?php
include "../config/Webconfig.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $webname."-".$webUrl;?></title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <!--    引入jquery CDN-->
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>
<!--头部-->

<?php
include "./public/header.php";

$helper->isUserLogin();

$id = $_GET['id'];


/**
 * 购物车购买
 */
if (!empty($id) && !empty($_SESSION['productCart'][$id])){

    $Cart = $_SESSION['productCart'][$id];

}


//$helper->dd($Cart);


/**
 * 收货表
 */
$ShWhere = array(
    'table' => 'receive',
    'field' => '*',
    'where'=>"username='{$helper->getUsernames()['username']}' AND is_mr=1",
);

$ShRs = $helper->getOne($ShWhere);

//echo '<pre>';
//var_dump($ShRs);
//echo '</pre>';


?>

<hr>

<div class="main-box-top">
    <div class="main">
        <font size="25">确认订单详情</font>
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
<!--收货地址-->
            <table width="100%" border="0" cellspacing="0">
                <tr>
                    <th height="40" colspan="3" align="left" bgcolor="#999999" scope="col">1.收货地址</th>
                </tr>
                <tr>
                    <td width="4%" align="right">&nbsp;</td>
                    <td width="9%" height="40" align="center" valign="middle">收货人：</td>
                    <td width="87%" height="40"><input name="shr" type="text" id="shr" size="30" value="<?php echo $ShRs['shren'];?>"/></td>
                </tr>
                <tr>
                    <td align="right">&nbsp;</td>
                    <td height="40" align="center" valign="middle">收货地址：</td>
                    <td height="40"><input name="shdizhi" type="text" id="shdizhi" size="30" value="<?php echo $ShRs['shdizhi'];?>"/></td>
                </tr>
                <tr>
                    <td align="right">&nbsp;</td>
                    <td height="40" align="center" valign="middle">邮政编码：</td>
                    <td height="40"><input name="youbian" type="text" id="youbian" size="30" value="<?php echo $ShRs['youbian'];?>"/></td>
                </tr>
                <tr>
                    <td align="right">&nbsp;</td>
                    <td height="40" align="center" valign="middle">手机：</td>
                    <td height="40"><input name="mobile" type="text" id="mobile" size="30" value="<?php echo $ShRs['mobile'];?>"/></td>
                </tr>
                <tr>
                    <td align="right">&nbsp;</td>
                    <td height="40" align="center" valign="middle">固定电话：</td>
                    <td height="40"><input name="tel" type="text" id="tel" size="30" value="<?php echo $ShRs['tel'];?>"/></td>
                </tr>
                <tr>
                    <td align="right">&nbsp;</td>
                    <td height="40" align="center" valign="middle">&nbsp;</td>
                    <td height="40"><input type="button" name="Submit" id="Xgdz" value="修改当前地址" />
                        <a href="user_ShouhAdd.php"><input type="button" name="Submit2" value="添加新地址" /></a>
                    </td>
                </tr>
            </table>
<!--            支付及配送方式-->

            <form name="formOrder" id="formOrder" action="" method="post">

                <input name="shren" type="hidden" id="shren" size="30" value="<?php echo $ShRs['shren'];?>"/>
                <input name="revice_id" type="hidden" id="revice_id" size="30" value="<?php echo $ShRs['id'];?>"/>
                <input name="OrderId" type="hidden" id="OrderId" size="30" value="<?php echo $helper->SetUuId();?>"/>
                <input name="ShopId" type="hidden" id="ShopId" size="30" value="<?php echo $id;?>"/>
                <table width="100%" border="0" cellspacing="0">
                    <tr>
                        <th align="left" bgcolor="#999999" scope="col">&nbsp;</th>
                        <th height="40" align="left" bgcolor="#999999" scope="col" >2.支付及配送方式</th>
                        <th height="40" scope="col" bgcolor="#999999">&nbsp;</th>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td height="40">&nbsp;</td>
                        <td height="40">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td height="40"><input type="radio" name="payment" id="payment"  value="1">
                            货到付款</td>
                        <td height="40">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td height="40"><input type="radio" name="payment" id="payment" value="2">
                            &nbsp;在线付款</td>
                        <td height="40">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td height="40"><input type="radio" name="payment" id="payment" value="3">
                            &nbsp;银行汇款</td>
                        <td height="40">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td height="40">送货时间</td>
                        <td height="40">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td height="40"><input type="radio" name="songhu" id="songhu" value="1">&nbsp;工作日、双休日和假日均可送货<br /></td>
                        <td height="40">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td height="40"><input type="radio" name="songhu" id="songhu" value="2">只双休日、假日送货(工作日不送)<br /></td>
                        <td height="40">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td height="40"><input type="radio" name="songhu" id="songhu" value="3">&nbsp;只工作日送货(双休日、假日不送)<br /></td>
                        <td height="40">&nbsp;</td>
                    </tr>
                </table>
            <!--            商品详情-->
                <table width="100%" border="0" cellspacing="0"  style="border:1px solid #CCCCCC;">
                    <tr>
                        <th height="35" colspan="5" align="left" bgcolor="#999999" scope="col">3.商品清单</th>
                    </tr>
                    <tr>
                        <td height="35" align="center" valign="middle" scope="col">&nbsp;</td>
                        <td height="35" align="center" valign="middle" scope="col" style="table-layout:fixed; width: 200px; white-space: normal; word-break : break-all;
    " >&nbsp;</td>
                        <td height="35" align="center" valign="middle" scope="col">&nbsp;</td>
                        <td height="35" align="center" valign="middle" scope="col">&nbsp;</td>
                        <td height="35" align="center" valign="middle" scope="col">&nbsp;</td>
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
                    if (!empty($Cart)){?>

                    <tr>
                        <td rowspan="2" align="center" valign="middle"><img src="./upload/<?php echo $Cart['picurl'];?>" width="75" height="75">&nbsp;</td>
                        <td rowspan="2" align="center" valign="middle"><a href="ShopInfo.php?id=<?php echo $Cart['numbers'];?>"><?php echo $Cart['title'];?></a></td>
                        <td rowspan="2" align="center" valign="middle">￥:<font color="red"><?php echo $Cart['Price'];?></font></td>
                        <td rowspan="2" align="center" valign="middle">￥:<font color="red"><?php echo $Cart['xiaoji'];?></font></td>
                        <td rowspan="2" align="center" valign="middle"><?php echo $Cart['CartTotal'];?></td>
                        <?php
                        }else{
                            echo "<tr>
                                <td height=\"50\" align=\"center\" valign=\"middle\" colspan='8'><font color='red'>你还没有商品加入购物车喔！再去逛 逛 吧</font></td></tr>
    ";
                        }
                        ?>
                </table>

            <!--            结算信息-->
                <table width="100%" border="0" cellspacing="0">
                    <tr>
                        <th height="40" colspan="5" align="left" bgcolor="#999999" scope="col">4.结算信息</th>
                    </tr>
                    <tr>
                        <td width="50%" height="40" align="right">商品件数:<font color="gray"><?php echo $Cart['CartTotal'];?></font>件</td>
                        <td width="17%" height="40" align="center">商品金额:<font color="gray">￥:<?php echo $Cart['Price'];?></font></td>
                        <td width="11%" height="40">邮费 :<font color="gray">￥:<?php echo $Cart['youfei'];?></font> </td>
                        <td width="11%" height="40" colspan="2">优惠:<font color="gray">￥:<?php echo $Cart['youhui'];?></font></td>
                    </tr>
                    <tr>
                        <td height="40">&nbsp;</td>
                        <td height="40">&nbsp;</td>
                        <td height="40">&nbsp;</td>
                        <td height="40" width="20%" colspan="2">应付金额:<font color="red" size="5">￥:<?php echo sprintf("%.2f",$Cart['Price']*$Cart['CartTotal']+$Cart['youfei']-$Cart['youhui']);?></font></td>
                    </tr>
                </table>
            <!--订单留言-->
                <table width="100%" border="0" cellspacing="0">
                    <tr>
                        <th height="40" colspan="2" align="left" bgcolor="#999999" scope="col">订单留言</th>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td height="25" align="left" valign="middle"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td height="60" align="left" valign="middle"><textarea name="liuyan" cols="60" rows="10" id="liuyan"></textarea></td>
                    </tr>
                    <tr>
                        <td width="5%">&nbsp;</td>
                        <td width="95%" height="40" align="center"><input type="submit" name="orderOK" id="orderOK" value="确认无误,提交订单" /></td>
                    </tr>
                </table>
            </form>
        </div>

        <div style="clear: both"></div>

    </div>
</div>



<script>
    //修改收货地址
    $(function () {
        $('#Xgdz').click(function () {
            var id=<?php echo $ShRs['id']?>;
            var shr= $('#shr').val();
            var shdizhi= $('#shdizhi').val();
            var youbian= $('#youbian').val();
            var tel= $('#tel').val();
            var mobile= $('#mobile').val();

            if(!shr){
                alert('请填写收货人！');
                return false;
            }
            if(!shdizhi)
            {
                alert('请填写收货地址');
                return false;
            }
            if(!youbian)
            {
                alert('请填写邮编');
                return false;
            }
            if(!tel){
                alert('请填写电话');
                return false;
            }
            if(!mobile)
            {
                alert('请填写手机');
                return false;
            }



           jQuery.ajax({
               url:"../public/UserLogin.class.php",
               type:"POST",
               data:"id="+id+"&tab=OrShEdi&shr="+shr+"&shdizhi="+shdizhi+"&youbian="+youbian+"&tel="+tel+"&mobile="+mobile,
               success:function (data) {
                    //console.log(data);
                   switch (data) {
                       case "0":
                           alert('修改成功!');
                           break;
                       case "1":
                           alert('修改失败!');
                           break;
                       case "2":
                           alert('【收货人】不能为空，请重新输入');
                           break;
                       case "3":
                           alert('【收货地址】不能为空，请重新输入');
                           break;
                       case "4":
                           alert('【邮编】不能为空，请重新输入！');
                           break;
                       case "5":
                           alert('【手机】不能为空，请重新输入！');
                           break;
                       default:
                           console.log(data);

                   }
               },
               error:function () {
                    alert('错误');
               }

           });
        });

        //提交订单
        $('#orderOK').click(function(){


            if($('input[name=payment]:checked').length<1){
                alert('请选择付款方式!');
                return false;
            }

            if($('input[name=songhu]:checked').length<1){
                alert('请选择送货时间!');
                return false;
            }
            // $('#id_action_submit').hide();
            // $('#id_action_waiting').show();


            jQuery.ajax({
                url:"../public/Cart.class.php",
                type:"POST",
                data:$('#formOrder').serialize()+"&tab=OrderAdd",
                success:function(data){
                    switch (data) {
                        case '0':
                            alert('支付失败！');
                            break;
                        case '1':
                            alert('支付成功，将在商家确认后发货，请耐心等待！');
                            location.href="userOrder.php";
                            break;
                        case '2':
                            alert('支付失败，库存不足！');
                            break;
                            default:
                                console.log(data);
                                break;
                    }

                },
                error:function(){
                    alert('错误');
                }
            })

            return false;
        });

    })


</script>
</body>
</html>
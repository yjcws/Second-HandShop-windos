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
    <script>
        function test()
        {
            if(document.formsearch.key.value=='')
            {
                alert('请输入一个查询的关键词');
                return false;
            }

            return true;
        }

    </script>

</head>

<body>
<!--头部-->

<?php
include "./public/header.php";
//include "../controller/MysqlConnection.php";
include $helper::GetDiR()."/controller/page.class.php";

/**
 * 商品详情页面
 */
$numbers= @$_GET['id'];
$ShopInfoWhere = array(
    'table' => 'product',
    'field' => 'numbers,title,picurl,price,yprice,content,hits,kucun,youhui,youfei,inputer',
    'where' => 'numbers='.$numbers
);


$ShopInfoRes = $helper->getOne($ShopInfoWhere);

//$helper->dd($ShopInfoRes);

/**$ShouCan:初始化该用户收藏 的shopid
 * 判断商品是否收藏
 */
$ShouCan=$_SESSION['ShouCan'];
if (empty($ShouCan)) {
    $isSC=true;
}

/**
 *浏览量
 */

$IndrRs = $helper->Exec("UPDATE product SET hits=hits+1 WHERE numbers=".$numbers);

//var_dump($IndrRs);


/**
 * 评论
 */


$AsWhere = array(
    'table' => 'assess as a',
    'field' => 'a.istop,a.pinglun,a.usernameshow,a.content,a.addtime,u.photot',
    'join'=>[
        'table'=>'user as u',
        'where'=>'a.inputer=u.email AND a.pid='.$numbers." AND issh=1"
    ],
    'order'=>[
        'field'=>'a.istop desc,a.addtime ',
        'order'=>'desc'
    ],

);

$AsRs =  $helper->getAll($AsWhere);

//$helper->dd($AsRs);


?>

<!--logo-->

<div class="main">
    <img src="image/logo.jpg" align="left" width="100" height="80" border="0" >

</div>
<!--    搜索栏-->


    <div style="margin-top: 20px;">
        <div class="main">

        <!--    搜索栏-->
        <div align="center">

            <form action="Fenlei.php" method="get" name="formsearch" onsubmit="return test();">
            <input type="text" name="key" size="50" value="<?php echo $key;?>">
            <input class="submit" type="submit" value="搜索">
        </form>
            <div >
                <font size="2" color="Gray">搜索商品标题</font>
            </div>
        </div>

    </div>
</div>
<hr style="margin-top: 20px">


<!--主体-->
<div style="background-color:#f1f1f1;">
    <div class="main">
        <!--        左边-->
        <div class="main-left" >
            <?php include "public/indexleft.php";?>
        </div>

        <!--        间隙-->
        <div class="main-jianxi">&nbsp;&nbsp;</div>

        <div style="width: 79%;height: 100%;float: left">

<form name="Shoucan" action="OrderAddS.php?id=<?php echo $ShopInfoRes['numbers'];?>" method="post" id="Shoucan" onsubmit="return Shop();">
            <table width="100%" border="0" cellspacing="0" style="border: 1px solid #cccccc" bgcolor="#FFFFFF">
                <tr>
                    <th colspan="2" rowspan="8" scope="col" align="center">&nbsp;<img src="./upload/<?php echo $ShopInfoRes['picurl'];?>" width="349" height="344"> <input type="hidden" name="picurl" id="picurl" value="<?php echo $ShopInfoRes['picurl'];?>"/></th>
<!--                    标题-->
                    <th height="40" colspan="3" scope="col"><font size="5"><?php echo $ShopInfoRes['title'];?></font> <input type="hidden" name="title" id="title" value="<?php echo $ShopInfoRes['title'];?>"/></th>
                </tr>
                <tr>
                    <td width="10%" height="40" align="right"><b>打折价：</b></td>
                    <td width="22%" height="40" >
                        <span style="color: red">￥</span><font color="red" size="5"><?php echo $ShopInfoRes['price'];?></font>
                        <input type="hidden" name="price" id="price" value="<?php echo $ShopInfoRes['price'];?>"/>
                        <input type="hidden" name="youhui" id="youhui" value="<?php echo $ShopInfoRes['youhui'];?>"/>
                        <input type="hidden" name="youfei" id="youfei" value="<?php echo $ShopInfoRes['youfei'];?>"/>
                        <input type="hidden" name="hits" id="hits" value="<?php echo $ShopInfoRes['hits'];?>"/>
                        <input type="hidden" name="numbers" id="numbers" value="<?php echo $ShopInfoRes['numbers'];?>"/>
                    </td>
                    <td width="30%" height="40"><b>商品编号 ：</b><?php echo $ShopInfoRes['numbers'];?>  </td>
                </tr>
                <tr>
                    <td height="40" align="right"><b>原  价：</b></td>
                    <td height="40"><span style="color: red">￥</span><font  color="red" size="5" style="text-decoration:line-through;"><?php echo $ShopInfoRes['yprice'];?></font></td>
                    <td height="40"><b>优惠：</b><?php echo $ShopInfoRes['youhui'];?>&nbsp;</td>
                </tr>
                <tr>
                    <td height="40" align="right"><b>库  存 ：</b> </td>
                    <td height="40" align="left">&nbsp;<?php echo $ShopInfoRes['kucun'];?><input type="hidden" value="<?php echo $ShopInfoRes['kucun'];?>" name="kucun" id="kucun"></td>
                    <td height="40"><b>邮费：</b><?php echo $ShopInfoRes['youfei'];?>&nbsp;</td>
                </tr>
                <tr>
                    <td height="40" colspan="3" align="center" bgcolor="#CCCCCC"><b>我要买</b>
                        <input type="text" name="num" id="num" size="8"/><b>件</b>
                        <input type="hidden" name="id" id="id" value="<?php echo $ShopInfoRes['numbers'];?>"/>
                        </td>
                </tr>
                <tr>
                    <td height="40" align="right">&nbsp;</td>
                    <td height="40" align="center" colspan="2">
                        <input type="submit" id="addOrder" value="我要购买" />
                        <input type="button" id="addcart" value="加入购物车" />
<!--!in_array($numbers,$_SESSION['ShouCan'])-->
                        <?php if($isSC){
                            echo '<input type="button" id="addShoucan" value="加入收藏" />';
                        }else{
                            if (in_array($numbers,$ShouCan)){
                                echo '<input type="button" value="已收藏" disabled/>';
                            }else{
                            echo '<input type="button" id="addShoucan" value="加入收藏" />';
                            }
                        }?>
                    </td>
                </tr>
                <tr>
                    <td height="40" align="right"><b>浏览：</b></td>
<!--                    hits-->
                    <td height="40" align="left">&nbsp;<?php echo $ShopInfoRes['hits'];?> </td>
                    <td height="40">&nbsp;</td>
                </tr>
                <tr>
                    <td height="40" align="right"><b>发布者：</b></td>
                    <td height="40" align="left"><?php if ( $ShopInfoRes['inputer']=='admin'){echo '管理员';}else{
                        echo $ShopInfoRes['inputer'];
                        }?></td>
                    <td height="40">&nbsp;</td>
                </tr>
            </table>
</form>

<!--            商品详情-->
            <table width="100%" border="0" cellspacing="0" style="margin-top: 10px">
                <tr>
                    <th width="13%" height="35" bgcolor="#999999" scope="col">商品详情</th>
                    <th width="23%" scope="col">&nbsp;</th>
                    <th width="26%" height="35" scope="col">&nbsp;</th>
                    <th width="18%" height="35" scope="col">&nbsp;</th>
                    <th width="20%" height="35" scope="col">&nbsp;</th>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" style="border: 1px solid #cccccc" bgcolor="#FFFFFF">
                <tr>
                    <td height="200" colspan="2" align="center" valign="middle">
                        <?php echo $helper->GetArticalHtml($ShopInfoRes['content']);?>
                    </td>
                </tr>
            </table>
<!--        商品评论    -->
            <table width="100%" border="0" cellspacing="0" style="margin-top: 20px" bgcolor="#FFFFFF">
                <tr>
                    <th width="16%" height="45" align="left" bgcolor="" scope="col">用户点评（<?php echo count($AsRs);?>）</th>
                    <th width="43%" height="45" align="left" scope="col">&nbsp;</th>
                    <th width="29%" height="45" scope="col">&nbsp;</th>
                    <th width="12%" height="45" scope="col">&nbsp;</th>
                </tr>
                <tr>
                    <td height="21" colspan="4"><hr></td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" bgcolor="#FFFFFF">

                <tr>
                    <td width="15%" height="35">宝贝评分：<font color="red"><?php echo sprintf("%.1f",$helper->GetSorce($numbers));?></font></td>
                    <td width="33%" height="35">&nbsp;</td>
                    <td height="35">&nbsp;</td>
                    <td height="35">&nbsp;</td>
                </tr>
                <tr>
                    <td height="20" colspan="4"><hr></td>
                </tr>

                <?php
                if (!empty($AsRs)){
                    foreach ($AsRs as $v){
                ?>

                <tr>
                    <td rowspan="3"><img src="./image/<?php echo 'photo'.rand(1,4).'.png';?>" width="92" height="90"></td>
                    <td height="35"><font color="gray"><?php echo $v['usernameshow'];?></font></td>
                    <td height="35">&nbsp;</td>
                    <td height="35" align="right"><font color="gray"><?php echo date('Y-m-d',$v['addtime']);?></font></td>
                </tr>
                <tr>
                    <td height="35"><img src="<?php echo './admin/image/icon_star_'.$v['pinglun'].'.gif';?>"></td>
                    <td height="35">&nbsp;</td>
                    <td height="35">&nbsp;</td>
                </tr>
                <tr>
                    <td height="35" colspan="3"><?php echo $v['content'];?></td>
                </tr>
                <tr>
                    <td height="21" colspan="4"><hr></td>
                </tr>
                <?php }

                }else{
                    echo " 
                    <tr>
                    <td height=\"35\" colspan=\"3\" align='center'><font color=\"red\">暂无评论！快去购买商品吧</font></td>
                </tr>
                <tr>
                    <td height=\"21\" colspan=\"4\"><hr></td>
                </tr>
"  ;
                }
                ?>
            </table>



        </div>

            <hr>





        </div>

        <div style="clear: both"></div>




    </div>

</div>

<script type="text/javascript">
    function Shop() {
        var num = document.Shoucan.num.value;

        var kucun = document.Shoucan.kucun.value;
        // alert(num > kucun);
        // console.log(num > kucun);

        if (num == ''){
            alert('请输入要购买的数量');

            return false;
        }
        if ( num <= 0){
            alert('请输入正确数值');

            return false;
        }
        if(isNaN(num) && num !== 'number'){
            alert('请输入正确数值');
            return false;
        }

        if (eval(num) > eval(kucun)){
            alert('库存不足');
            return false;

        }
        return true;

    }
</script>

<script>
    $(function(){


        //加入购物车
        $('#addcart').click(function(){
            var num = $('#num').val();
            var id = $('#id').val();

            if(!num){
                alert('请输入要购买的数量');
                return false;
            }
            if ( num <= 0){
                alert('请输入正确数值');

                return false;
            }
            if(isNaN(num) && num !== 'number'){
                alert('请输入正确数值');
                return false;
            }

            jQuery.ajax({
                url:"../public/Cart.class.php",
                type:"POST",
                data:"id="+id+"&sum="+num+"&tab=AddCart",
                success:function(data){
                    switch(data){
                        case "0":
                            alert('您还未登陆喔!');
                            location.href='login.php';
                            break;
                        case "2":
                            alert('库存不足');
                            break;
                        case "1":
                            alert('加入购物车成功！');
                            location.href='userCart.php';
                            break;
                        case "3":
                            alert('加入购物车失败！');
                            location.href='userCart.php';
                            break;
                        case "4":
                            alert('此商品不存在！');
                            location.href='userCart.php';
                            break;
                        default:
                            console.log(data);

                    }
                },
                error:function(){
                    alert('错误');
                }
            });

        });

        //加入收藏夹
        $('#addShoucan').click(function(){
           // ScVal = $('#addShoucan');
            id = $('#id').val();

            // $('#Shoucan').serializeObject();
            jQuery.ajax({
                url:"../public/Cart.class.php",
                type:"POST",
                data:"id="+id+"&tab=AddSc&"+$('#Shoucan').serialize(),
                success:function(data){
                    switch(data){
                        case "0":
                            alert('您还未登陆喔!');
                            location.href='login.php';
                            break;
                        // case "2":
                        //     alert('库存不足');
                        //     break;
                        case "1":
                            // ScVal.attr('value','已经收藏');
                            // $('#addShoucan').attr('disabled',true)
                            alert('收藏商品成功！');
                            location.href='ShopInfo.php?id='+id;
                            break;
                        case "3":
                            alert('收藏商品失败或已经被收藏！');
                            //location.href='userCart.php';
                            break;
                        default:
                            alert(data);

                    }
                },
                error:function(){
                    alert('错误');
                }
            });

        });

    })
</script>
</body>
</html>
<?php
include "../config/Webconfig.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $webname."-".$webUrl;?></title>
    <link rel="stylesheet" type="text/css" href="./css/index.css">

    <script>
        function test()
        {
            if(document.formsearch.key.value=='')
            {
                alert('请输入一个商品标题');
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

/**校园快报
 * 校园快报文章类型id=19
 *table:article
 *
 * */
$AtWhere = array(
    'table' => 'article',
    'field' => 'id,title',
    'where'=>"typeid=19 ANd issh=1",
    'limit'=>'5'
);

$AtRes = $helper->getAll($AtWhere);



/**
 * 热销
 */

$HotWhere = array(
    'table' => 'product',
    'field' => 'numbers,title,picurl,price',
    'where'=>'hot=1 AND issh=1 AND shelves=1 AND kucun >0',
    'order'=>[
        'field'=>'hits ',
        'order'=>'desc'
    ],
    'limit'=>'0,8'

);

$hotRs =  $helper->getAll($HotWhere);

/**
 * 降价
 */

$DropsWhere = array(
    'table' => 'product',
    'field' => 'numbers,title,picurl,price,yprice',
    'where'=>'drops=1 AND issh=1 AND shelves=1 AND kucun >0',
    'order'=>[
        'field'=>'(yprice-price) ',
        'order'=>'desc'
    ],
    'limit'=>'0,8'

);

$DropRs =  $helper->getAll($DropsWhere);

/**
 * 推荐
 */

$RecWhere = array(
    'table' => 'product',
    'field' => 'numbers,title,picurl,price,yprice',
    'where'=>'recommend=1 AND issh=1 AND shelves=1 AND kucun >0',
    'order'=>[
        'field'=>'addtime ',
        'order'=>'desc'
    ],
    'limit'=>'0,8'

);

$RecRs =  $helper->getAll($RecWhere);

//$helper->dd($hotRs);




?>

<!--logo-->

<div class="main">
    <img src="./image/logo.jpg" align="left" width="100" height="80" border="0" >

</div>
<!--    搜索栏-->


    <div style="margin-top: 20px;">
        <div class="main">

        <!--    搜索栏-->
        <div align="center">

            <form action="./Fenlei.php" method="get" name="formsearch" onsubmit="return test();">
            <input type="text" name="key" size="50" value="电动车">
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
            <?php include "./public/left.php";?>
        </div>

        <!--        间隙-->
        <div class="main-jianxi">&nbsp;&nbsp;</div>

        <div class="main-center" align="center">
            <img src="./image/lbt.jpeg" width="715" height="445" >
        </div>

        <!--        间隙-->
        <div class="main-jianxi">&nbsp;&nbsp;</div>

        <!--右边-->

        <div class="main-right">

            <table width="100%" border="0" cellspacing="0" style="border: 1px solid #cccccc">
                <tr>
                    <th height="93" colspan="2" scope="col"><a href="./userMain.php"><img src="./image/<?php echo 'photo'.rand(1,4).'.png';?>" width="85" height="80"></a></th>
                </tr>
                <tr>
                    <td height="45" colspan="2" align="center" valign="middle">hai你好<?php if (!empty($helper->getUsernames())) {echo $helper->getUsernames()['username'];}?></td>
                </tr>
                <tr>
                    <?php if(empty($helper->getUsernames())){?>
                    <td height="35" align="right"><a href="./login.php"><input type="button" name="button" value="登陆" /></a>&nbsp;&nbsp;</td>
                    <td height="35" align="left">&nbsp;&nbsp;<a href="./login.php" ><input type="button" name="button" value="注册" /></a></td>
                    <?php }?>
                </tr>
            </table>

            <table width="100%" border="0" cellspacing="0" style="border:1px solid #CCCCCC;margin-top: 20px">
                <tr>
                    <th height="28" bgcolor="#BEEDC7" scope="col">校园快报</th>
                </tr>
                <?php foreach ($AtRes as $val){?>

                <tr>
                    <td height="35" align="center"><a href="./XyKaibaoInfo.php?id=<?php echo $val['id'];?>"><?php echo $helper->GetstrLeft($val['title'],10);?></a></td>
                </tr>
                <?php }?>

                <tr>
                    <td height="28" align="right"><a href="#"></a>
                        <a href="./XyKaibao.php"> <input type="button" name="Submit" value="更多快报" />  </a>  </td>
                </tr>
            </table>

        </div>
        <div style="clear: both"></div>

    </div>

<!--热销-->
    <div class="main">
        <div style="float:left;width:80%;height: 100%;">
            <table width="15%" border="0" cellspacing="0" class="main-box-top" >
                <tr>
                    <td height="35"  rowspan="8" align="center" bgcolor="#BEEDC7"><a href="./Fenlei.php?tab=ys">更多热销>></a>&nbsp;</td>

                </tr>
            </table>

<!--            左浮动-->


            <?php

            foreach ($hotRs as $v){?>
            <div style="float: left;border:1px solid #CCCCCC;table-layout:fixed;width: 225px;white-space: normal;word-break : break-all;margin-right:10px; margin-bottom: 6px;">
            <table  width="10%" border="0" cellspacing="0" align="left" bordercoloer="#CCCCCC"  bgcolor="#FFFFFF">
                <tr>
                    <th width="220" height="200" colspan="2" align="left" scope="col"><a href="./ShopInfo.php?id=<?php echo $v['numbers'];?>"><img src="./upload/<?php echo $v['picurl'];?>" width="219" height="227"></a></th>
                </tr>
                <tr >
                    <td height="60" colspan="2" >
                        <a href="./ShopInfo.php?id=<?php echo $v['numbers'];?>"><?php echo $helper->GetstrLeft($v['title'],15);?></a>
                    </td>
                </tr>
                <tr>
                    <td height="40" width="220" colspan="2">

                            价格：<span style="color: red;">￥：<?php echo $v['price'];?></span>
                    </td>
                </tr>

            </table>
            </div>

            <?php
            }
            ?>
        <div style="clear: both"></div>
        </div>


</div>


    <!--降价-->
    <div class="main">
        <div style="float:left;width:80%;height: 100%;">

            <table width="15%" border="0" cellspacing="0" class="main-box-top" >
                <tr>
                    <td height="35"  rowspan="8" align="center" bgcolor="#BEEDC7"><a href="./Fenlei.php?tab=jj">更多降价>>&nbsp;</a></td>

                </tr>
            </table>
            <!--左浮动-->
        <?php foreach ($DropRs as $v){?>
            <div style="float: left;border:1px solid #CCCCCC;table-layout:fixed;width: 225px;white-space: normal;word-break : break-all;margin-right:10px; margin-bottom: 6px;">
                <table width="100%" border="0" cellspacing="0"  bgcolor="#FFFFFF">
                <tr>
                    <th width="30%" height="200" colspan="2" align="center" scope="col"><a href="./ShopInfo.php?id=<?php echo $v['numbers'];?>"><img src="./upload/<?php echo $v['picurl'];?>" width="210" height="227"></a></th>
                </tr>
                <tr>
                    <td height="40" colspan="2"><a href="./ShopInfo.php?id=<?php echo $v['numbers'];?>"> <?php echo $helper->GetstrLeft($v['title'],15);?></a></td>
                </tr>
                <tr>
                    <td height="40" colspan="2">原价：<span style="color: red;text-decoration:line-through;">￥：<?php echo $v['yprice'];?></span><br>
                        现价：<span style="color: red;">￥：<?php echo $v['price'];?></span><br>
                        降价：<span style="color: red;">￥：<?php echo sprintf('%.2f',$v['yprice']-$v['price']);?></span><br>
                    </td>
                </tr>

            </table>
                </div>
<?php }?>
        </div>
        <div style="clear: both"></div>

    </div>


        <!--推荐-->
    <div class="main">
        <div style="float:left;width:80%;height: 100%;">

            <table width="15%" border="0" cellspacing="0" class="main-box-top" >
                <tr>
                    <td height="35"  rowspan="8" align="center"  bgcolor="#BEEDC7"><a href="./Fenlei.php?tab=tj">更多推荐>>&nbsp;</a></td>

                </tr>
            </table>
            <!--左浮动-->

        <?php foreach ($RecRs as $v){?>
            <div style="float: left;border:1px solid #CCCCCC;table-layout:fixed;width: 225px;white-space: normal;word-break : break-all;margin-right:10px; margin-bottom: 6px;">

            <table class="tableSZ" width="100%" border="0" cellspacing="0"  bgcolor="#FFFFFF">
                <tr>
                    <th width="30%" height="200" colspan="2" align="center" scope="col"><a href="./ShopInfo.php?id=<?php echo $v['numbers'];?>"><img src="./upload/<?php echo $v['picurl'];?>" width="210" height="227"></a></th>
                </tr>
                <tr>
                    <td height="40" colspan="2"><a href="./ShopInfo.php?id=<?php echo $v['numbers'];?>"> <?php echo $helper->GetstrLeft($v['title'],15);?></a></td>
                </tr>
                <tr>
                    <td height="40" colspan="2">价格：<span style="color: red;">￥：<?php echo $v['price'];?></span></td>
                </tr>

            </table>
            </div>
<?php }?>
        </div>
        <div style="clear: both"></div>

    </div>

        </div>




</body>
</html>
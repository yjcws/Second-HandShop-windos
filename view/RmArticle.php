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

/*热门文章
 * 热门文章类型id=20
 *table:article
 *
 * */
$AtWhere = array(
    'table' => 'article',
    'field' => 'id,title,content,hits,addtime',
    'where'=>"typeid=20",
);

$AtRestful = $helper->getAll($AtWhere);

//$helper->dd($AtRestful);

?>

<!--    搜索栏-->

<div class="body">
    <div style="margin-top: 20px;">

        <!--    搜索栏-->
        <div align="center">
        <form action="">
            <input type="text" size="50">
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
        <font size="5" >热门文章</font>
        <hr size="1" noshade>
    </div>

    <div class="main">
        <div style="width: 79%;height: 100%;float: left">
            <?php foreach ($AtRestful as $val){?>
            <hr >
            <table width="100%" border="0" cellspacing="0"  bgcolor="#FFFFFF"">
                <tr>
                    <th width="253" height="155" rowspan="3" align="center" valign="middle" scope="col"><img src="image/aticle1.jpg" width="253" height="155"></th>
                    <th height="40" colspan="2" align="left" scope="col">&nbsp;&nbsp;<a href="XyKaibaoInfo.php?id=<?php echo $val['id'];?>"><?php echo $val['title'];?></a></th>
                </tr>
                <tr>
                    <td height="94" colspan="2" align="left">&nbsp;&nbsp;<?php echo $helper->GetstrLeft($helper->GetArticalHtml($val['content']));?></td>
                </tr>

                <tr>
<!--                    Gray:灰色-->
                    <td height="40">&nbsp;&nbsp;<font color="Gray" size="2"><?php echo date("Y-m-d",$val['addtime']);?></font></td>
                    <td height="40" align="right">&nbsp;<font color="Gray" size="2">浏览量（<?php echo "{$val['hits']}";?>）</font></td>
                </tr>
            </table>
            <?php }?>
            <hr >

        </div>
        <div style="float: left;width: 1%;height: 100%;">　</div>
        <div style="width: 20%;height: 100%;float: left">
<!--            <table width="100%" border="0" cellspacing="0" style="border:1px solid #CCCCCC;">-->
<!--                <tr>-->
<!--                    <th height="28" bgcolor="#BEEDC7" scope="col">热门文章</th>-->
<!--                </tr>-->
<!---->
<!--                --><?php //foreach ($RAtRestful as $val){?>
<!--                <tr>-->
<!--                    <td height="28" align="center"><a href="XyKaibaoRmInfo.php?id=--><?php //echo $val['id'];?><!--">--><?php //echo $helper->GetstrLeft($val['title'],10);?><!--</a></td>-->
<!--                </tr>-->
<!--                --><?php //}?>
<!---->
<!---->
<!---->
<!--                <tr>-->
<!--                    <td height="28" align="right"><a href="#"></a>-->
<!--                        <input type="button" name="Submit" value="更多热门文章" />    </td>-->
<!--                </tr>-->
<!--            </table>-->
        </div>
        <div class="floatclear"></div>
    </div>

</div>




</body>
</html>
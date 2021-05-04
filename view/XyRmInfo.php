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
//include "../controller/MysqlConnection.php";

//$helper->isUserLogin();


/*热门文章
 * 校园快报文章类型id=20
 *table:article
 *
 * */

$id = @$_GET['id'];
$AtWhere = array(
    'table' => 'article',
    'field' => 'title,content,author,com,addtime',
    'where'=>"id=".$id,
);

$AtRestful = $helper->getOne($AtWhere);

//$helper->dd($AtRestful);

/**
 *浏览量
 */

$IndrRs = $helper->Exec("UPDATE article SET hits=hits+1 WHERE id=".$id);



?>



<!--主体-->
<div style="background-color:#f1f1f1;margin-top: 20px;">
    <div class="main">
        <font size="5" ><a href="XyRm.php">热门活动</a>>><font color="" size="5"><?php echo $AtRestful['title'];?></font></font>
        <hr size="1" noshade>
    </div>

    <div class="main">
        <div style="width: 79%;height: 100%;float: left">
            <table width="100%" border="0" cellspacing="0" >
                <tr>
                    <th height="45" colspan="2" align="center" valign="middle" scope="col"><font color="" size="5"><?php echo $AtRestful['title'];?></font></th>
                </tr>
                <tr>
                    <td width="12%" height="45" align="left">作者：<font color="#3cb371"><?php echo $AtRestful['author'];?></td>
                    <td width="70%" height="45" align="left">时间：<font color="Gray"><?php echo date('Y-m-d',$AtRestful['addtime']);?></td>
                    <td width="18%" height="45" align="right">来源：<font color="Gray"><?php echo $AtRestful['com'];?></td>
                </tr>

            </table>
            <hr>
            <table width="100%" border="0" cellspacing="0" style="border: 1px solid #cccccc">
                <tr>
                    <td height="200" colspan="2" align="center" valign="middle">
                        <?php echo $helper->GetArticalHtml($AtRestful['content']);?>
                    </td>
                </tr>
            </table>

        </div>
        <div style="float: left;width: 1%;height: 100%;">　</div>
        <div style="width: 20%;height: 100%;float: left">
<!--            <table width="100%" border="0" cellspacing="0" style="border:1px solid #CCCCCC;">-->
<!--                <tr>-->
<!--                    <th height="28" bgcolor="#BEEDC7" scope="col">校园快报</th>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td height="28" align="center"><a href="#">文章1</a></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td height="28" align="center"><a href="#">文章1</a></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td height="28" align="center"><a href="#">文章1</a></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td height="28" align="center"><a href="#">文章1</a></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td height="28" align="center"><a href="#">文章1</a></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td height="28" align="center"><a href="#">文章1</a></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td height="28" align="right"><a href="#"></a>-->
<!--                        <input type="button" name="Submit" value="更多活动" />    </td>-->
<!--                </tr>-->
<!--            </table>-->
        </div>
        <div class="floatclear"></div>
    </div>

</div>




</body>
</html>
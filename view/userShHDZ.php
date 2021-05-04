
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
    'where'=>"username='{$helper->getUsernames()['username']}'",
    'order' => [
        'field' => 'id ',
        'order' => 'desc'
    ],

);

$SaRestful = $helper->getAll($ScWhere);


//echo '<pre>';
//var_dump($SaRestful);
//echo '</pre>';
?>

<hr>

<div class="main-box-top">
    <div class="main">
        <font size="25">我的收货地址</font>
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
            <div style="float: right;margin-bottom: 10px"><a href="user_ShouhAdd.php">添加新的收货地址</a> </div>

            <form action="" method="">

            <table width="100%" border="1" cellspacing="0" style="border: 1px #cccccc">
                <tr>
                    <th height="30" align="center" valign="middle" bgcolor="#CCCCCC" scope="col">收货人</th>
                    <th height="30" align="center" valign="middle" bgcolor="#CCCCCC" scope="col">地址</th>
                    <th height="30" align="center" valign="middle" bgcolor="#CCCCCC" scope="col">邮编</th>
                    <th height="30" align="center" valign="middle" bgcolor="#CCCCCC" scope="col">电话</th>
                    <th height="30" align="center" valign="middle" bgcolor="#CCCCCC" scope="col">手机</th>
                    <th height="30" align="center" valign="middle" bgcolor="#CCCCCC" scope="col">是否默认</th>
                    <th height="30" align="center" valign="middle" bgcolor="#CCCCCC" scope="col">操作</th>
                </tr>

                <?php foreach ($SaRestful as $val) {?>
                <tr>
                    <td height="30" align="center" valign="middle"><?php echo $val['shren'];?></td>
                    <td height="30" align="center" valign="middle"><?php echo $val['shdizhi'];?></td>
                    <td height="30" align="center" valign="middle"><?php echo $val['youbian'];?></td>
                    <td height="30" align="center" valign="middle"><?php echo $val['tel'];?></td>
                    <td height="30" align="center" valign="middle"><?php echo $val['mobile'];?></td>
                    <td height="30" align="center" valign="middle"><?php
                        if ($val['is_mr']){
                            echo '是';
                        }else{
                            echo "否";
                        }
                        ?></td>

                    <td height="30" align="center" valign="middle"><a href="user_ShouhEdi.php?id=<?php echo $val['id'];?>">修改</a> | <a href="../public/UserLogin.class.php?tab=ShdzDel" >删除 </a></td>
                </tr>

                <?php }?>
            </table>

            </form>

        </div>




        <div style="clear: both"></div>





    </div>
</div>


</body>
</html>
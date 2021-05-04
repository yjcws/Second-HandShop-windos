
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
    'table' => 'user',
    'field' => '*',
    'where'=>"username="."'{$helper->getUsernames()['username']}'",
);

$SaRestful = $helper->getOne($ScWhere);

//echo '<pre>';
//var_dump($SaRestful);
//echo '</pre>';
?>

<hr>

<div class="main-box-top">
    <div class="main">
        <font size="25">添加收货地址</font>
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
<!--            <div style="float: right;margin-bottom: 10px"><a href="">添加新的收货地址</a> </div>-->

            <form id="form1" name="form1" method="post" action="../public/UserLogin.class.php?tab=ShdzAdd" onsubmit="return test();">
                <table width="100%" height="245" border="0" cellspacing="0" id="form1"  style="border:1px solid #cccccc">
                    <tr>
                        <th width="16%" height="35" bgcolor="#999999" scope="col">管理收货地址</th>
                        <th width="84%" height="35" scope="col">&nbsp;</th>
                    </tr>
                    <tr>
                        <td height="35" align="center" valign="middle">收货人：</td>
                        <td height="35"><input name="shr" type="text" id="shr" size="30" /></td>
                    </tr>
                    <tr>
                        <td height="35" align="center" valign="middle">收货地址：</td>
                        <td height="35"><input name="shdizhi" type="text" id="shdizhi" size="30" /></td>
                    </tr>
                    <tr>
                        <td height="35" align="center" valign="middle">邮编：</td>
                        <td height="35"><input name="youbian" type="text" id="youbian" size="30" /></td>
                    </tr>
                    <tr>
                        <td height="35" align="center" valign="middle">固定电话 ：</td>
                        <td height="35"><input name="tel" type="text" id="tel" size="30" />
                            ＊可以不填</td>
                    </tr>
                    <tr>
                        <td height="35" align="center" valign="middle">是否默认：</td>

                        <td height="35">

                            <input name="is_mr" type="radio" value="1" checked/>
                            是
                            <input type="radio" name="is_mr" value="0" />
                            否</td>

                    </tr>

                    <tr>
                        <td height="35" align="center" valign="middle">手机 ：</td>
                        <td height="35"><input name="mobile" type="text" id="mobile" size="30" /></td>
                    </tr>
                    <tr>
                        <td height="35">&nbsp;</td>
                        <td height="35" align="left"><input type="submit" name="Submit" value="保存" /></td>
                    </tr>
                </table>
            </form>

        </div>




        <div style="clear: both"></div>





    </div>
</div>

<script>
    function test() {
        if (document.form1.shr.value == '') {
            alert('【收货人】不能为空');
            return false;
        }
        if (document.form1.shdizhi.value == '') {
            alert('【收货地址】不能为空');
            return false;
        }
        if (document.form1.middle.value == '') {
            alert('【手机】不能为空');
            return false;
        }
        if (document.form1.youbian.value == '') {
            alert('【邮编】不能为空');
            return false;
        }
        return true;

    }
</script>
</body>
</html>
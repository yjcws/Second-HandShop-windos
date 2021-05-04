
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
    'where'=>"email="."'{$helper->getUsernames()['username']}'",
);

$SaRestful = $helper->getOne($ScWhere);

//echo '<pre>';
//var_dump($SaRestful);
//echo '</pre>';
?>

<hr>

<div class="main-box-top">
    <div class="main">
        <font size="25">修改资料</font>
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

            <form id="form1" name="form1" method="post" action="../public/UserLogin.class.php?tab=edit" onsubmit="return test()">
                <table width="100%" height="245" border="0" cellspacing="0" id="form1" style="border:1px solid #cccccc">
                    <tr>
                        <th width="16%" height="35" bgcolor="#999999" scope="col">以下信息必填</th>
                        <th width="84%" height="35" scope="col">&nbsp;</th>
                    </tr>
                    <tr>
                        <td height="35" align="center" valign="middle">我的妮称：</td>
                        <td height="35"><input name="username" type="text" id="username" size="30" value="<?php echo $SaRestful['username']?>"/></td>
                    </tr>
                    <tr>
                        <td height="35" align="center" valign="middle">真实姓名：</td>
                        <td height="35"><input name="xingming" type="text" id="xingming" size="30" value="<?php echo $SaRestful['xingming']?>"/></td>
                    </tr>
                    <tr>
                        <td height="35" align="center" valign="middle">姓别：</td>
                        <td height="35"><select name="sex" id="sex">
                                <option value="0" <?php if($SaRestful['sex']==0) echo "selected";?>>保密</option>
                                <option value="1" <?php if($SaRestful['sex']==1) echo "selected";?>>男</option>
                                <option value="2" <?php if($SaRestful['sex']==2) echo "selected";?>>女</option>
                            </select>    </td>
                    </tr>
                    <tr>
                        <td height="35" align="center" valign="middle">手机号码 ：</td>
                        <td height="35"><input name="moblile" type="text" id="moblile" size="30"  value="<?php echo $SaRestful['mobile']?>"/></td>
                    </tr>
                    <tr>
                        <td height="35">&nbsp;</td>
                        <td height="35">&nbsp;</td>
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
        if (document.form1.username.value == '') {
            alert('【我的妮称】不能为空');
            return false;
        }
        if (document.form1.xingming.value == '') {
            alert('【真实姓名】不能为空');
            return false;
        }
        if (document.form1.sex.value == '') {
            alert('【姓别】不能为空');
            return false;
        }
        if (document.form1.moblile.value == '') {
            alert('【手机号码】不能为空');
            return false;
        }
        return true;

    }
</script>
</body>
</html>

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



//echo '<pre>';
//var_dump($SaRestful);
//echo '</pre>';
?>

<hr>

<div class="main-box-top">
    <div class="main">
        <font size="25">修改密码</font>
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

            <form id="form1" name="form1" method="post" action="../public/UserLogin.class.php?tab=editPw" onsubmit="return test()">
                <table width="100%" height="35" border="0" cellspacing="0" id="myfrom" style="border: 1px solid #cccccc">
                    <tr>
                        <th width="16%" height="35" bgcolor="#999999" scope="col">以下信息必填</th>
                        <th width="84%" height="35" scope="col">&nbsp;</th>
                    </tr>
                    <tr>
                        <td height="35" align="center" valign="middle">原始密码：</td>
                        <td height="35"><input type="password" name="pw" size="30"/></td>
                    </tr>
                    <tr>
                        <td height="35" align="center" valign="middle">新密码：</td>
                        <td height="35"><input type="password" name="pw1" size="30"/></td>
                    </tr>
                    <tr>
                        <td height="35" align="center" valign="middle">确认密码：</td>
                        <td height="35"><input type="password" name="pw2" size="30"/></td>
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
        if (document.form1.pw.value == '') {
            alert('【原始密码】不能为空');
            return false;
        }
        if (document.form1.pw1.value == '') {
            alert('【新密码】不能为空');
            return false;
        }
        if (document.form1.pw2.value == '') {
            alert('【确认密码】不能为空');
            return false;
        }
        if (document.form1.pw1.value != document.form1.pw2.value) {
            alert('两次密码不一致！请重新输入');
            return false;
        }
        return true;

    }
</script>
</body>
</html>
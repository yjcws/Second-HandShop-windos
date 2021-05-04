
<!--/*-->
<!--*author: yjc-->
<!--*createtime : 2021/3/27 15:38-->
<!--*description:yjcws毕业设计-->
<!--*/-->
<?php
include "../config/Webconfig.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>校园闲置</title>
    <title><?php echo $webname."-"."登陆";?></title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script>
        
        function login() {
           if (document.form1.email.value == '') {
                   alert('邮箱不能为空');
                   return false;
           }
           if (document.form1.pw.value == '') {
                   alert('密码不能为空');
                   return false;
           }
            return true;

        }
        
        function register() {
            if (document.form2.email.value == '') {
                alert('邮箱不能为空');
                return false;
            }
            if (document.form2.pw.value == '') {
                alert('密码不能为空');
                return false;
            }
            if (document.form2.pw.value == '') {
                alert('确认密码不能为空');
                return false;
            }
            if (document.form2.pw.value != document.form2.pw1.value) {
                alert('两次密码不一致');
                return false;
            }
            return true;
        }
        

    </script>
</head>
<body>

<?php include "./public/header.php";?>
<!--w登陆-->
<div style="margin-top: 30px;">
<div class="body">
    <div style="float: left;width: 50%;">
        <form id="form1" name="form1" method="post" action="../public/UserLogin.class.php?tab=login" onsubmit="return login();">
            <fieldset >
                <table width="60%" border="0" cellspacing="0" height="250">
                    <tr >
                        <th height="35" colspan="2" align="left" scope="col"><h1>会员登陆</h1></th>
                    </tr>
                    <tr>
                        <td width="50%" height="30" align="right">E-mail:</td>
                        <td width="40%"><input name="email" type="text" id="email" size="30" /></td>
                    </tr>
                    <tr>
                        <td height="21" align="right">密码：</td>
                        <td><input name="pw" type="password" id="pw" size="30" /></td>
                    </tr>
                    <tr>
                        <td height="30">&nbsp;</td>
                        <td><input type="submit" name="Submit" value="提交" />
                            <input type="reset" name="Submit2" value="重置" /></td>
                    </tr>
                    <tr>
                        <td height="30">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </fieldset>
        </form>

    </div>

<!--快速注册-->

    <div style="float: right;width: 50%;">
        <form id="form2" name="form2" method="post" action="../public/UserLogin.class.php?tab=register" onsubmit="return register()">
            <fieldset>
            <table width="70%" border="0" cellspacing="0" height="250">
                <tr>
                    <th height="35" colspan="2" align="left" scope="col"><h1>快速注册</h1></th>
                </tr>
                <tr>
                    <td width="60%" height="30" align="right">你的E-mail地址：</td>
                    <td width="30%" height="30"><input name="email" type="text" id="email"   size="30"/></td>
                </tr>
                <tr>
                    <td height="30" align="right">密码：</td>
                    <td height="30"><input name="pw" type="password" id="pw"  size="30"/></td>
                </tr>
                <tr>
                    <td height="30" align="right">确认密码：</td>
                    <td height="30"><input name="pw1" type="password" id="pw1"  size="30"/></td>
                </tr>
                <tr>
                    <td height="30">&nbsp;</td>
                    <td height="30"><input type="submit" name="Submit3" value="提交" />
                        <input type="reset" name="Submit4" value="重置" /></td>
                </tr>
            </table>
            </fieldset>
        </form>

    </div>

    <div class="floatclear"></div>
</div>

</div>

</body>

</html>


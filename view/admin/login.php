
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>校园闲置</title>

  <style>
      .add{width:500px;margin: 200px auto;background: #F8F8F8 }
      .submit{margin-left: 30px}
      .reset{margin-left: 40px}
      .botton{
          margin-top: 30px;
      }
    </style>
</head>
<body>
<div class="add">
    <form action="../../public/Admin/LoginSave.php" method="post" align="center" name="myform" onSubmit="return test();">
        <fieldset style="border-radius:8px;height: 250px;text-align:center;" >
            <legend ><font size="6">欢迎来到校园闲置物品交易系统管理后台:</font></legend>
            <font size="5">昵称: </font>
            <input type="text" size="30" name="username" id="username" style="margin-top:30px"><br>
            <font size="5">密码:</font>

             <input type="password" size="30" name="password" id="password" style="margin-top: 30px"><br>

            <div class="botton">
            <input class="submit" type="submit"  value="提交">
            <input class = "reset" type="reset" value="重置">
            </div>
        </fieldset>
    </form>
<!--    <a href="" style="float: right">没有帐号？点击注册</a>-->
</div>

</body>
<script language="JavaScript">

    function test()
    {
        if(document.myform.username.value=='')
        {
            alert('用户名不能为空');
            return false;
        }
        if(document.myform.password.value=='')
        {
            alert('密码不能为空');
            return false;
        }
        return true;
    }
</script>
</html>
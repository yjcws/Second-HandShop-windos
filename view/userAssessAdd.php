
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




?>

<hr>

<div class="main-box-top">
    <div class="main">
        <font size="25">我的订单</font>
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
            <form id="myform" name="myform" method="post" action="../public/UserLogin.class.php?tab=AssAdd" onSubmit="return test()">
                <table width="100%" border="0" cellspacing="0" >
                    <tr>
                        <td height="30" colspan="2" bordercolor="#000000" bgcolor="#999999">评论信息：</td>
                    </tr>
                    <tr>
                        <td width="15%" height="30" align="right" valign="middle" bordercolor="#000000">&nbsp;</td>
                        <td width="85%" height="30" bordercolor="#000000"><label>
                                <input name="OrderId" type="hidden" id="OrderId" size="30" value="<?php echo @$_GET['id'];?>"/>
                            </label></td>
                    </tr>
                    <tr>
                        <td height="30" align="right" valign="middle" bordercolor="#000000">评论等级：</td>
                        <td height="30" bordercolor="#000000"><label>
                                <select name="pinglun" id="pinglun">
                                    <option value="1">一星</option>
                                    <option value="2">二星</option>
                                    <option value="3">三星</option>
                                    <option value="4">四星</option>
                                    <option value="5">五星</option>
                                </select>
                            </label></td>
                    </tr>
                    <tr>
                        <td height="30" align="right" valign="middle" bordercolor="#000000">评价内容：</td>
                        <td height="30" bordercolor="#000000"><label>
                                <textarea name="content" cols="60" rows="10" id="content"></textarea>
                            </label></td>
                    </tr>
                    <tr>
                        <td height="30" align="right" valign="middle" bordercolor="#000000">&nbsp;</td>
                        <td height="30" bordercolor="#000000"><label></label>
                            <label>
                                <input type="submit" name="Submit" value="提交" />
                                <input type="reset" name="reset" value="重置" />
                            </label></td>
                    </tr>
                </table>
            </form>
        </div>




        <div style="clear: both"></div>





    </div>
</div>


</body>
</html>
<?php

include dirname(dirname(__DIR__)).'/controller/Helper.php';
/**
 * 初始化助手类
 */
$helper = new Helper();



?>

<div style="background:#f1f1f1;">
<div class="header">
    <div style="float: left;">
        <font >

            <a href="index.php">&nbsp;首页&nbsp;</a>
            <?php if (empty($helper->getUsernames())){?>
            <a href="login.php">| &nbsp;登录&nbsp;</a>
            <a href="login.php">|&nbsp;注册&nbsp;</a>

            <?php }else{
                echo "<span>欢迎你！".$helper->getUsernames()['username']."</span>";
                echo "<a href='../../public/UserLogin.class.php?tab=outlogin'>| 退出登陆</a>";
            }?>
        </font>
    </div>
    <div style="float: right;">
        <a href="userMain.php">个人中心</a>
        |
        <a href="userCart.php">查看购物车</a>
        |
        <a href="user_Shoucan.php">收藏夹</a>
        |
        <a href="XyKaibao.php">校园快报</a>
    </div>
    <!--    清除浮动-->
    <div style="clear:both"></div>
</div>
</div>



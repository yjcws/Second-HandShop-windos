
<?php
include  dirname(dirname(dirname(__DIR__)))."/controller/Helper.php";
$helper = new Helper();

//登陆检测
$helper->isAdminLogin();


?>

<div id="heading">

<table width="100%" height="5%" border="0" style="background-color: #333;" class="header">
    <tr>
        <th height="48" scope="col" width="20%" >
            <a  style="color: white;text-align:left;text-decoration:none;" href="./index.php">
                <font size="5" >校园闲置物品交易管理系统</font>
            </a>
        </th>
        <th scope="col" style="color: white;text-align:right;">欢迎回来
        <?php  echo $helper->getAdminname()['username'];?>
        </th>
        <th scope="col" width="10%"><a  style="color: white;text-decoration:none;" href="../../../public/Admin/outLogin.php" >退出</a></th>
    </tr>
</table>
</div>


<?php
include "../config/Webconfig.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $webname."-".$webUrl;?></title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        function goupdate(ziduan,zt) {

            document.info.ziduan.value = ziduan;
            document.info.zt.value = zt;
            document.info.action = "../../public/Shop.class.php?tab=up";
            document.info.submit();
        }
        function test()
        {
            if(document.formsearch.key.value=='')
            {
                alert('请输入一个查询的关键词');
                return false;
            }

            return true;
        }

    </script>
</head>
<body>
<!--头部-->

<?php
include "./public/header.php";
$helper->isUserLogin();

//
//$ScWhere = array(
//    'table' => 'receive',
//    'field' => '*',
//    'order' => [
//        'field' => 'id ',
//        'order' => 'desc'
//    ],
//);
//
//$SaRestful = $Mysql->getAll($ScWhere);


//$helper->dd($_SESSION['ScData']);

//foreach ($_SESSION['ScData'] as $val) {
//    var_dump($val);
//}

?>

<hr>

<div class="main-box-top">
    <div class="main">
        <font size="25">我的收藏</font>
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



            <form id="form1" name="form1" method="post" action="../public/Cart.class.php?tab=BatchDel" onsubmit="return Check();" >
                <table  width="100%" border="0" cellspacing="0"  style="border:1px solid #CCCCCC;">
                    <tr>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">&nbsp;</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">商品图片</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">商品名称</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">价格</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">状态</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">人气</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">收藏时间</th>
                        <th height="35" align="center" valign="middle" bgcolor="#999999" scope="col">操作</th>
                    </tr>
                    <?php
                    /**
                     * 如果为空就不输出
                     */

                    if (!empty($_SESSION['ScData'])){
                    foreach ($_SESSION['ScData'] as $k=>$val) {
                        if ($k=='ScTatol'){
                            continue;
                        }

                        ?>
                        <tr>
                            <td rowspan="2" align="center" valign="middle"><input type="checkbox" name="check[]" id='check' value="<?php echo $val['shopid'];?>" /></td>
                            <td rowspan="2" align="center" valign="middle"><img src="./upload/<?php echo $val['picurl'];?>" width="75" height="75" />&nbsp;</td>
                            <td height="35" style=" table-layout:fixed; width: 225px; white-space: normal; word-break : break-all;"  align="center" valign="middle" rowspan="2"><a href="ShopInfo.php?id=<?php echo $val['shopid'];?>" ><?php echo $val['title'];?></a></td>
                            <td rowspan="2" align="center" valign="middle"><font color="red">￥：<?php echo $val['price'];?></font></td>
                            <td rowspan="2" align="center" valign="middle"><?php echo $val['state'];?></td>
                            <td rowspan="2" align="center" valign="middle"><?php echo $val['hits'];?></td>
                            <td rowspan="2" align="center" valign="middle">&nbsp;<?php echo date('Y-m-d',$val['addtime']);?></td>

                        </tr>
                        <tr>
                            <td height="35" colspan="2" align="center" valign="middle"><a href="../public/Cart.class.php?tab=delSc&id=<?php echo $val['shopid'];?>">取消收藏</a><a href="#"></a></td>

                        </tr>
                        <tr>
                            <td height="35" colspan="8" align="center" valign="middle"><hr></td>
                        </tr>

                    <?php
                    }
                    }else{
                        echo "<tr>
                                <td height=\"50\" align=\"center\" valign=\"middle\" colspan='8'><font color='red'>你还没有收藏 商品喔！再去逛 逛 吧</font></td></tr>";
                    }
                    ?>
                </table>
                <table  width="100%" border="0" cellspacing="0"  style="border:1px solid #CCCCCC;">
                    <tr >
                        <th height="35"  align="left" valign="middle" ><input type="submit" name="Submit2" value="批量取消收藏" /></th>
                        <th width="40%" height="35" align="left" valign="middle">&nbsp;</th>
                        <th width="3%" height="35" align="center" valign="middle">&nbsp;</th>
                        <th width="3%" height="35" align="center" valign="middle">&nbsp;</th>
                        <th width="3%" height="35" align="center" valign="middle">&nbsp;</th>
                        <th width="3%" height="35" align="center" valign="middle">&nbsp;</th>
                        <th width="35%" height="35" align="center" valign="middle">共有<?php echo $_SESSION['ScData']['ScTatol'];?>个收藏 </th>
                    </tr>
                </table>


            </form>

        </div>




        <div style="clear: both"></div>





    </div>
</div>
<script>

    /**
     * 判断是否选中商品
     * @returns {*}
     */
    function Check() {
        // 获取checkbox元素  // 判断是否被拒选中，选中返回true，未选中返回false
        var box=document.getElementById("check").checked;

        // alert(!box);
        //
        if (!box){
            alert('请选中一个商品！');
            return false;
        }
        return true;
    }

</script>

</body>
</html>
<?php
include "../config/Webconfig.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $webname."-".$webUrl;?></title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script>
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
//include "../controller/MysqlConnection.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/page.class.php";

/**
 * 定义条件
 */
$FlShopWhere = array(
    'table' => 'product',
    'field' => 'numbers,title,hot,drops,recommend,picurl,price,yprice',
);




/**分类查询 页面
 * 通过分类id查询相应的商品,缺限：只能看到对应id的商品
 *table:product
 *
 * */

$typeid = @$_GET['typeid'];
//查询分类id对应下级id

if (!empty($typeid) && isset($_GET['typeid'])) {
    $XjWhere = array(
        'table' => 'productlist',
        'field' => 'id',
        'where' =>"idpath like '%_{$typeid}%'"
    );
    $XjRes =$helper->getAll($XjWhere);

    //$helper->dd($XjRes);

    //拼接下级 id
    $tid = 0 ;
    foreach ($XjRes as $v){
    $tid .= ','.$v['id'];
    }
    //$helper->dd($tid);

    $FlShopWhere['where'][] = '(typeid='.$typeid." or typeid in ($tid))";

}

/**
 * 搜索功能
 * 关键词：key
 */

$key = @$_GET['key'];

if (!empty($key) && isset($_GET['key'])) {
    $FlShopWhere['where'][] = "title like '%{$key}%'";

}

/**
 * 热销
 */


$Tab = @$_GET['tab'];
if(isset($Tab) && !empty($Tab) && ($Tab=='ys')){
    $FlShopWhere['where'][] = "hot=1 AND shelves=1 AND issh=1 AND kucun >0";
    $FlShopWhere['order']['field'] = "hits ";
    $FlShopWhere['order']['order'] = "desc";
}/**
 * 降价
 * shelves：上架
 */



if(isset($Tab) && !empty($Tab) && ($Tab=='jj')){
    $FlShopWhere['where'][] = "drops=1 AND shelves=1 AND issh=1 AND kucun >0";
    $FlShopWhere['order']['field'] = "(yprice-price) ";
    $FlShopWhere['order']['order'] = "desc";

}
/**
 * 推荐
 */

if(isset($Tab) && !empty($Tab) && ($Tab=='tj')){
    $FlShopWhere['where'][] = "recommend=1 AND shelves=1 AND issh=1 AND kucun >0";
    $FlShopWhere['order']['field'] = "addtime ";
    $FlShopWhere['order']['order'] = "desc";

}

/**
 * 结果 输出
 */

$FlNum = count($helper->getAll($FlShopWhere));
$page = new page($FlNum,12);

$FlShopWhere['limit'] = $page->limit();
$AtRes = $helper->getAll($FlShopWhere);



//$helper->dd($AtRes);




?>

<!--logo-->

<div class="main">
    <img src="image/logo.jpg" align="left" width="100" height="80" border="0" >

</div>
<!--    搜索栏-->


    <div style="margin-top: 20px;">
        <div class="main">

        <!--    搜索栏-->
        <div align="center">

            <form action="" method="get" name="formsearch" onsubmit="return test();">
            <input type="text" name="key" size="50" value="<?php echo $key;?>">
            <input class="submit" type="submit" value="搜索">
        </form>
            <div >
                <font size="2" color="Gray">搜索商品标题</font>
            </div>
        </div>

    </div>
</div>
<hr style="margin-top: 20px">


<!--主体-->
<div style="background-color:#f1f1f1;">
    <div class="main" >

        <div class="main-left" style="background-color:#f1f1f1;">　　</div>
        <!--        间隙-->
        <div class="main-jianxi">&nbsp;&nbsp;</div>
        <div style="float:left;width: 79%;height: 100%">
            <font size="4">你的位置：<a href="index.php">首页</a>&nbsp;&nbsp;>>&nbsp;&nbsp;<?php
                if (!empty($typeid)){
                    echo $helper->getFenlei($typeid);
                }else{
                    if ($Tab=='ys'){
                        echo '更多热销';
                    }elseif($Tab=='jj'){
                        echo '更多降价';
                    }elseif ($Tab=='tj'){
                        echo '更多推荐';
                    }else{
                        echo '搜索';
                    }
                }
                ?></font>
        </div>
        <div style="clear:both;"></div>

    </div>
    <div style="margin-bottom: 10px"></div>


    <div class="main">

        <!--        左边-->
        <div class="main-left" >
            <?php include "public/indexleft.php";?>
        </div>

        <!--        间隙-->
        <div class="main-jianxi">&nbsp;&nbsp;</div>

        <div style="float:left;width: 79%;height: 100%">


            <?php
            if ($FlNum > 0){
            foreach ($AtRes as $v){?>
                <div style="float: left;border:1px solid #CCCCCC;table-layout:fixed;width: 225px;white-space: normal;word-break : break-all;margin-right:10px; margin-bottom: 6px;">
            <table  width="100%" border="0" cellspacing="0" align="left" bordercoloer="#CCCCCC"  bgcolor="#FFFFFF">
                <tr>
                    <th width="220" height="200" colspan="2" align="left" scope="col"><a href="ShopInfo.php?id=<?php echo $v['numbers'];?>"><img src="./upload/<?php echo $v['picurl'];?>" width="219" height="227"></a></th>
                </tr>
                <tr >
                    <td height="60" colspan="2" >
                        <a href="ShopInfo.php?id=<?php echo $v['numbers'];?>"><?php echo $helper->GetstrLeft($v['title'],15);?></a>
                    </td>
                </tr>
                <tr>
                    <td height="40" width="220" colspan="2">
<!--                        如果是降价就显示//-->
                        <?php if (!empty($Tab) && $Tab=='jj'){?>
                    原价：<span style="color: red;text-decoration:line-through;">￥：<?php echo $v['yprice'];?></span><br>
                        现价：<span style="color: red;">￥：<?php echo $v['price'];?></span><br>
                            降价：<span style="color: red;">￥：<?php echo sprintf('%.2f',$v['yprice']-$v['price']);?></span><br>
                        <?php }else{?>
                        价格：<span style="color: red;">￥：<?php echo $v['price'];?></span>
                        <?php }?>
<!--                        降价显示 结束-->
                    </td>
                </tr>

            </table>
        </div>
            <?php
//                循环结束
            }
        }else{
          echo "<div  style='text-align: center;line-height: 300px'><font size='5' color=''>还没有你想要的商品喔！</font></div>";
    }
            ?>



        </div>

        <div style="clear: both"></div>
        <!--        页码-->
        <div align="center">
            <?php
            echo $page->showStyle();
            ?>
        </div>



    </div>


</div>




</body>
</html>
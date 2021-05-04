
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


</head>
<body>
<!--头部-->

<?php
include "./public/header.php";
$helper->isUserLogin();


/*校园快报
 * 校园快报文章类型id=19
 *table:article
 *
 * */
$AtWhere = array(
    'table' => 'article',
    'field' => 'id,title,content,hits,addtime,issh',
    'where'=>"author='{$helper->getUsernames()['username']}'",
);

$AtRestful = $helper->getAll($AtWhere);


//$helper->dd($SaRestful);




?>

<hr>

<div class="main-box-top">
    <div class="main">
        <font size="25">我的帖子</font>
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
            <div style="float: right;margin-bottom: 10px"><a href="user_TieziAdd.php"><input type="button" value="发布帖子"></a></div>



            <div style="clear: both"></div>


            <?php if (!empty($AtRestful)){
                foreach ($AtRestful as $val){
            ?>
            <table width="100%" border="0" cellspacing="0">
                <tr>
                    <th height="24" colspan="3" scope="col" colspan="2">            <hr></th>
                </tr>
                <tr>
                    <th height="40" colspan="2" scope="col" align="left" width="90%"><a href="XyKaibaoInfo.php?id=<?php echo $val['id'];?>"><font size="4"><?php echo $val['title'];?></font></a></th>
                    <th height="40" scope="col" align="right" width="10%">
                        <?php if ( $val['issh']== 0){?>
                            <font color="red">待审核</font>
                        <?php }?>
                    </th>

                </tr>
                <tr>
                    <td height="50" colspan="3" colspan="2"><font color="gray"><?php echo $helper->GetstrLeft($helper->GetArticalHtml($val['content']));?></font></td>
                </tr>
                <tr>
                    <td height="40" width="70%"><font color="gray">阅读(<?php echo "{$val['hits']}";?>)&nbsp;　　　　　　发布于:<?php echo date("Y-m-d",$val['addtime']);?></font></td>
                    <td height="40" colspan="2" align="right"><a href="../public/Article.class.php?id=<?php echo $val['id'];?>&tab=del">删除</a>  |    <a href="user_TieziEdi.php?id=<?php echo $val['id'];?>">编辑</a></td>
                </tr>


                <?}
                }else{?>
                <tr>
                    <th height="24" colspan="3" scope="col" align="center"><font color="red">你还没有发布过自己的帖子喔!赶紧行动起来吧</font></th>
                </tr>
            <?}?>

                <tr>
                    <th height="24" colspan="3" scope="col">            <hr></th>
                </tr>


            </table>


        </div>









    </div>
</div>
<!--<script>-->
<!---->
<!--    /**-->
<!--     * 判断是否选中商品-->
<!--     * @returns {*}-->
<!--     */-->
<!--    function Check() {-->
<!--        // 获取checkbox元素  // 判断是否被拒选中，选中返回true，未选中返回false-->
<!--        var box=document.getElementById("check").checked;-->
<!---->
<!--        // alert(!box);-->
<!--        //-->
<!--        if (!box){-->
<!--            alert('请选中一个商品！');-->
<!--            return false;-->
<!--        }-->
<!--        return true;-->
<!--    }-->
<!---->
<!--</script>-->

</body>
</html>
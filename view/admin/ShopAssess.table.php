<?php
include $_SERVER['DOCUMENT_ROOT']."/controller/page.class.php";

session_start();
$rights =$helper->getAdminname()['rights']; //权限标识
$Username =$helper->getAdminname()['username']; //当前 管理员name
//var_dump($rights);
$issh = @$_GET['issh'];
$istop = @$_GET['istop'];
//$recommend = @$_GET['recommend'];

//var_dump(isset($issh));

//查询 文章表的数据和权限管理
//1.超级管理员查询 条件
$ScWhere = array(
    'table' => 'assess',
    'field' => 'product.title,assess.*',
    "join"=>[
        'table'=>'product',
        'where'=>'assess.pid=product.numbers'
    ],
    'order' => [
        'field' => 'id ',
        'order' => 'desc'
    ],
);

//2.普通 管理员查询 条件
//如果不是普通管理员
if(!($rights == 1)) {
    $ScWhere['where'][] = "inputer='{$Username}'";
}


if($issh!="")
{
    $ScWhere['where'][] = "issh=$issh";
}
if($istop!="")
{
    $ScWhere['where'][] = "istop=$istop";
}
//if($recommend!="")
//{
//    $ScWhere['where'][] = "recommend=$recommend";
//}
//var_dump($ScWhere);


$keyword = @$_GET['key'];
$ziduan=@$_GET["ziduan"];
if($keyword!="")
{
    $ScWhere['where'][] = "$ziduan like '%$keyword%'";
}

$SaNum = count($helper->getAll($ScWhere));
//var_dump($SaNum);
$page = new page($SaNum,5);

$ScWhere['limit'] = $page->limit();

$SaRestful = $helper->getAll($ScWhere);


?>


<div id="content_body">

    <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 商品评论列表</font></div>


    <div class="body-center">


        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td  width="10%" height="30" align="center"><a href="ShopAssessAdd.php" ><font style="margin-left: 30px" size="3">添加评论</font></a></td>
                <td  width="30%" >&nbsp;</td>
                <td  align="right">&nbsp;按分类查看&nbsp;</td>

                <td   width="32%" height="30" align="left">
                    <select name="select" onchange="javascript:location.href=this.options[selectedIndex].value">
                        <option value="ShopAssess.php">查看全部评论</option>
                        <option value="ShopAssess.php?issh=0" <?php if(isset($issh) && $issh=='0'){ echo 'selected';}?>>待审核</option>
                        <option value="ShopAssess.php?issh=1"  <?php if(isset($issh) && $issh=='1'){ echo 'selected';}?> >已审核</option>
                        <option value="ShopAssess.php?istop=0" <?php if(isset($istop) && $istop=='0'){ echo 'selected';}?>>待置顶</option>
                        <option value="ShopAssess.php?istop=1" <?php if(isset($istop) && $istop=='1'){ echo 'selected';}?> >已置顶</option>
<!--                        <option value="ShopAssess.php?recommend=0">待推荐</option>-->
<!--                        <option value="ShopAssess.php?recommend=1">已推荐</option>-->

                    </select>
                </td>

            </tr>

        </table>
    </div>

    <hr>


    <form method="post" action="../../public/Admin/ShopAssess.class.php?tab=delAll" name="updateinfo">
    <table id="customers">
        <tr>
            <th>ID</th>
            <th>所属商品</th>
            <th>审核状态</th>
            <th>置顶状态</th>
<!--            <th>推荐状态</th>-->
            <th>评论等级</th>
            <th>显示姓名</th>
            <th>提交时间</th>
            <th>IP地址</th>
            <th>操作</th>
        </tr>

        <?php
        //如果数据小于1就不显示
        if ($SaNum >= 1){
        foreach($SaRestful as $key =>$val){

//表格隔行显示不同颜色
            $class = ($key%2 == 0)? 'class="alt"': '';
        ?>

            <tr <?php echo $class?> >
                <td ><input type="checkbox" name="check[]" id="check" value="<?php echo $val['id'];?>"></td>
                <td><?php echo $val['title'];?></td>
                <td><?php
                    if($val["issh"]==1)
                    {
                        echo "已审核";
                    }
                    else
                    {
                        echo "<span style='color:red;font-weight:bold;'>待审核</span>";
                    }


                    ?></td>
                <td><?php
                    if($val["istop"]==1)
                    {
                        echo "<span style='font-weight:bold;color:red'>已置顶</span>";
                    }
                    else
                    {
                        echo "待置顶";
                    }
                    ?></td>
<!--                <td>--><?php
//                    if($val["recommend"]==1)
//                    {
//                        echo "<span style='font-weight:bold;color:red'>已推荐</span>";
//                    }
//                    else
//                    {
//                        echo "待推荐";
//                    }
//                    ?><!--</td>-->
                <td><img src="<?php echo './image/icon_star_'.$val['pinglun'].'.gif';?>"></td>
                <td><?php echo $val['usernameshow'];?></td>
                <td><?php echo date("Y-m-d",$val['addtime']);?></td>
                <td><?php echo $val['ip'];?></td>

                <td><a href="../../public/Admin/ShopAssess.class.php?id=<?php echo $val['id'];?>&tab=Sadel">删除</a>|<a href="./ShopAssessEdi.php?id=<?php echo $val['id'];?>">修改</a></td>
            </tr>
            <?php
            }
        }else{
            echo "<tr><td colspan='9'>暂无数据 。。。</td></tr>";
            }
        ?>



    </table>
        <table border="0" whith="100%" style="margin-top: 10px">
        <tr>
            <td width="71%" align="left">
                <input name="" type="submit" value="删除所有" >
                <input type="button" name="button" id="button" value="设置审核"   onclick="goinfo('issh',1)" />
                <input type="button" name="button2" id="button2" value="取消审核" onclick="goinfo('issh',0)" />
                <input type="button" name="button3" id="button3" value="设置置顶" onclick="goinfo('istop',1)"/>
                <input type="button" name="button4" id="button4" value="取消置顶" onclick="goinfo('istop',0)" />
<!--                <input type="button" name="button5" id="button5" value="设置推荐" onclick="goinfo('recommend',1)"/>-->
<!--                <input type="button" name="button6" id="button6" value="取消推荐" onclick="goinfo('recommend',0)"/>-->
                <label for="ziduan"></label>
                <input type="hidden" name="ziduan" id="ziduan" />
                <label for="zt"></label>
                <input type="hidden" name="zt" id="zt" /></td></Tr>

            </td>
        </tr>
        </table>

    </form>
    <div style="font-size:12px;margin-top: 10px"><form action="" method="get"  id="formsearch" name="formsearch" onsubmit="return test();">
            标题关键字：<select name="ziduan" id="ziduan">
                <option value="title" selected="selected">商品名称</option>
                <option value="usernameshow" <?php if(!empty($ziduan) && $ziduan=='usernameshow'){echo 'selected';} ?>>评论者</option>
            </select>
            &nbsp;
            <input name="key" type="text" /> <input name="" type="submit" value="查询" />
        </form></div>

    <!--    页码-->

    <div style="margin-top: 20px;text-align: center">
        <?php


        echo $page->show();

        //var_dump($FlRestful);


        ?>
    </div>
</div>
<div id="floor"></div>

<script>
    function goinfo(ziduan,id)
    {
        //alert('测试');
        document.updateinfo.ziduan.value=ziduan;
        document.updateinfo.zt.value=id;
        document.updateinfo.action="../../public/Admin/ShopAssess.class.php?tab=up";
        document.updateinfo.submit();
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

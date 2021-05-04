<?php

include $_SERVER['DOCUMENT_ROOT']."/controller/page.class.php";

session_start();
$rights =$helper->getAdminname()['rights']; //权限标识
$Username =$helper->getAdminname()['username']; //当前 管理员name
//var_dump($rights);
$issh = @$_GET['issh'];
$istop = @$_GET['istop'];
$recommend = @$_GET['recommend'];

//查询 文章表的数据和权限管理
//1.超级管理员查询 条件
$ScWhere = array(
    'table' => 'receive',
    'field' => '*',
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
if($recommend!="")
{
    $ScWhere['where'][] = "recommend=$recommend";
}


/**
 * 搜索
 */
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

//var_dump($SaRestful);

?>


<div id="content_body">

    <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 收货地址列表</font></div>



    <hr>


    <form method="post" action="../../public/Admin/ShopShouHou.class.php?tab=delAll" name="updateinfo">
    <table id="customers">
        <tr>
            <th>ID</th>
            <th>收货人</th>
            <th>收货地址</th>
            <th>邮编</th>
            <th>电话</th>
            <th>手机</th>
            <th>会员姓名</th>
            <th>是否默认</th>
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
                <td><?php echo $val['shren'];?></td>
                <td><?php echo $val['shdizhi']; ?></td>
                <td><?php echo $val['youbian'];?></td>

                <td><?php echo $val['tel'];?></td>
                <td><?php echo $val['mobile'];?></td>
                <td><?php echo $val['username'];?></td>
<!--                <td>--><?php //echo date("Y-m-d H:i:s",$val['addtime']);?><!--</td>-->
                <td><?php
                    if ($val['is_mr']){
                        echo '是';
                    }else{
                        echo "否";
                    }
                    ?></td>

                <td><a href="../../public/Admin/ShopShouHou.class.php?id=<?php echo $val['id'];?>&tab=ShouDel">删除</a></td>
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

            </td>
        </tr>
        </table>

    </form>
    <div style="font-size:12px;margin-top: 10px"><form action="" method="get"  id="formsearch" name="formsearch" onsubmit="return test();">
            标题关键字：<select name="ziduan" id="ziduan">
                <option value="shren" selected="selected">收货人</option>
                <option value="username">会员姓名</option>
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

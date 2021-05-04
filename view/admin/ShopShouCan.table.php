<?php
include $_SERVER['DOCUMENT_ROOT']."/controller/page.class.php";

$rights =$helper->getAdminname()['rights']; //权限标识
$Username =$helper->getAdminname()['username']; //当前 管理员name
//var_dump($rights);
$issh = @$_GET['issh'];
$istop = @$_GET['istop'];
$recommend = @$_GET['recommend'];

//查询 文章表的数据和权限管理
//1.超级管理员查询 条件
$ScWhere = array(
    'table' => 'favorites as f',
    'field' => 'f.id,f.username,f.addtime,f.state,p.numbers,p.title,p.price,p.hot,p.drops,p.recommend',
    'join'=>[
        'table'=>'product as p',
        'where'=>'f.shopid = p.numbers'
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

//$helper->dd($SaRestful);

?>


<div id="content_body">

    <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 商品收藏列表</font></div>



    <hr>


    <form method="post" action="../../public/Admin/ShopShouCan.class.php?tab=delAll" name="updateinfo">
    <table id="customers">
        <tr>
            <th>ID</th>
            <th>商品ID</th>
            <th>商品名称</th>
            <th>商品价格</th>
            <th>商品状态</th>
            <th>会员姓名</th>
            <th>收藏时间</th>
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
                <td><?php echo $val['numbers'];?></td>
                <td><?php echo $val['title'];?></td>
                <td><?php echo $val['price']; ?></td>
                <td><?php echo $helper->getStateAttr($val['state']);?></td>

                <td><?php echo $val['username'];?></td>
                <td><?php echo date('Y-m-d',$val['addtime']);?></td>

                <td><a href="../../public/Admin/ShopShouCan.class.php?id=<?php echo $val['id'];?>&tab=ShouDel">删除</a></td>
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
                <option value="shopid" selected="selected">商品ID</option>
                <option value="title">商品名称</option>
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

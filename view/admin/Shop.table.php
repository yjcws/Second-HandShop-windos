<?php

include $_SERVER['DOCUMENT_ROOT']."/controller/page.class.php";
include "../../public/Admin/ShopWxCategories.class.php";

$rights =$helper->getAdminname()['rights']; //权限标识
$Username =$helper->getAdminname()['username']; //当前 管理员name
$typeid = @$_GET['typeid'];


//查询商品表的数据和权限管理
//1.超级管理员查询条件
$ShopWhere = array(
    'table' => 'product',
    'field' => 'product.*,productList.typename',
    'join' => [
        'table' => 'productlist',
        'where' => 'product.typeid=productList.id ',
    ],
    'order' => [
        'field' => 'id ',
        'order' => 'desc'
    ],
);

//2.普通 管理员查询 条件
//如果不是普通管理员
if(!($rights == 1)) {
    $ShopWhere['join']['where'] .= "AND product.inputer='{$Username}'";
    //var_dump( $ShopWhere['join']['where']);
}

//按分类查看
if($typeid!="")
{
    $ShopWhere['join']['where'] .= "AND product.typeid=$typeid";
}

//关键词搜索
$keyword = @$_GET['key'];
$ziduan=@$_GET["ziduan"];

if($keyword!="")
{
    $ShopWhere['join']['where'] .= "AND product.$ziduan like '%$keyword%'";
}

$ArticleNum = count($helper->getAll($ShopWhere));
$page = new page($ArticleNum,10);

$ShopWhere['limit'] = $page->limit();

$ShopRestful = $helper->getAll($ShopWhere);



?>


<div id="content_body">

    <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 商品管理列表</font></div>


    <div class="body-center">


        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td  width="10%" height="30" align="center"><a href="ShopAdd.php" ><font style="margin-left: 30px" size="3">添加新商品</font></a></td>
                <td  width="30%" >&nbsp;</td>
                <td  align="right">&nbsp;按分类查看&nbsp;</td>

                <td   width="32%" height="30" align="left">
                    <select name="select" onchange="javascript:location.href=this.options[selectedIndex].value">
                        <option value="Shop.php">查看全部商品</option>

                        <?php
                        echo (new ShopWxCategories())->ShopOption(0,$typeid);

                        ?>
                    </select>
                </td>

            </tr>

        </table>
    </div>

    <hr>


    <form method="post" action="../../public/Admin/Shop.class.php?tab=delAll" name="info" id="info">
    <table id="customers">
        <tr>
            <th></th>
            <th>商品编号</th>
            <th>商品名称</th>
            <th>所属分类</th>
            <th>商品属性</th>
            <th>审核状态</th>
            <th>上架状态</th>
            <th>库存</th>
            <th>浏览量</th>
            <th>录入员</th>
            <th>上架时间</th>
            <th>操作</th>
        </tr>

        <?php
        //如果数据小于1就不显示
        if ($ArticleNum >= 1){
        foreach($ShopRestful as $key =>$val){

//表格隔行显示不同颜色
            $class = ($key%2 == 0)? 'class="alt"': '';
        ?>

            <tr <?php echo $class?> >
                <td ><input type="checkbox" name="check[]" id="check" value="<?php echo $val['id'];?>"></td>
                <td><?php echo $val['numbers'];?></td>
                <td><?php echo $val['title'];?></td>
                <td>
                    <?php
                            echo $val['typename'];
                    ?>
                </td>
                <td><?php
                    if($val["hot"]==1)
                    {
                        echo "热销 ";
                    }
                    if($val["drops"]==1)
                    {
                        echo "降价 ";
                    }
                    if($val["recommend"]==1)
                    {
                        echo "推荐 ";
                    }

                    ?></td>
                <td><font color="red"><?php echo $helper->getIsshAttr($val["issh"]);?></font></td>
                <td><font color="red"><?php echo $helper->getStateAttr($val["shelves"]);?></font></td>
                <td><?php echo $val["kucun"];?></td>
                <td><?php echo $val['hits'];?></td>
                <td><?php echo $val['inputer'];?></td>
                <td><?php echo date("Y-m-d",$val['addtime']);?></td>

                <td><a href="../../public/Admin/Shop.class.php?id=<?php echo $val['id'];?>&tab=ShopDel">删除</a>|<a href="./ShopEdi.php?id=<?php echo $val['numbers'];?>">修改</a></td>
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
                <input type="button" name="button" id="button" value="设置热销" onclick="goupdate('hot',1)" />
                <input type="button" name="button2" id="button2" value="设置降价" onclick="goupdate('drops',1)"/>
                <input type="button" name="button3" id="button3" value="设置推荐"  onclick="goupdate('recommend',1)"/>
                <input type="button" name="button3" id="button3" value="设置上架"  onclick="goupdate('shelves',1)"/>
                <input type="button" name="button3" id="button3" value="设置审核"  onclick="goupdate('issh',1)"/>
                <input type="button" name="button4" id="button4" value="取消热销" onclick="goupdate('hot',0)"/>
                <input type="button" name="button5" id="button5" value="取消降价" onclick="goupdate('drops',0)"/>
                <input type="button" name="button6" id="button6" value="取消推荐" onclick="goupdate('recommend',0)"/>
                <input type="button" name="button6" id="button6" value="取消上架" onclick="goupdate('shelves',0)"/>
                <input type="button" name="button6" id="button6" value="取消审核" onclick="goupdate('issh',0)"/>
                <label for="ziduan"></label>
                <input type="hidden" name="ziduan" id="ziduan" />
                <label for="zt"></label>
                <input type="hidden" name="zt" id="zt" />
            </td>
        </tr>
        </table>

    </form>
    <div style="font-size:12px;margin-top:10px"><form action="Shop.php" method="get"  id="formsearch" name="formsearch" onsubmit="return test();">
            商品关键字：
            <select name="ziduan" id="ziduan">
                <option value="numbers" selected="selected">商品编号</option>
                <option value="title">商品名称</option>
                <option value="inputer">录入员</option>
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
    function goupdate(ziduan,zt) {

        document.info.ziduan.value = ziduan;
        document.info.zt.value = zt;
        document.info.action = "../../public/Admin/Shop.class.php?tab=up";
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

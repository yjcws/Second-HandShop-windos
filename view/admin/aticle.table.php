<?php
include $_SERVER['DOCUMENT_ROOT']."/controller/page.class.php";

$rights =$helper->getAdminname()['rights']; //权限标识
$Username =$helper->getAdminname()['username']; //当前 管理员name

$typeid = @$_GET['typeid'];



//查询 文章表的数据和权限管理
//1.超级管理员查询 条件
$UserWhere = array(
    'table' => 'article ',
    'field' => '*',
    'order' => [
        'field' => 'id ',
        'order' => 'desc'
    ],
);

//2.普通 管理员查询 条件
//如果不是普通管理员
if(!($rights == 1)) {
    $UserWhere['where'][] = "inputer='{$Username}'";
}


if($typeid!="")
{
    $UserWhere['where'][] = "typeid=$typeid";
}
//var_dump($UserWhere);
$keyword = $_GET['key'];
if($keyword!="")
{
    $UserWhere['where'][] = "title like '%$keyword%'";
}

$ArticleNum = count($helper->getAll($UserWhere));
//var_dump($ArticleNum);
$page = new page($ArticleNum,5);

$UserWhere['limit'] = $page->limit();

$UserRestful = $helper->getAll($UserWhere);

//选择按分类查看下拉

$FlWhere=array(
    'table' => 'articleType',
    'field' => '*',
);
$FlRestful = $helper->getAll($FlWhere);

?>


<div id="content_body">

    <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 文章管理列表</font></div>


    <div class="body-center">


        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td  width="10%" height="30" align="center"><a href="articleAdd.php" ><font style="margin-left: 30px" size="3">添加文章</font></a></td>
                <td  width="30%" >&nbsp;</td>
                <td  align="right">&nbsp;按分类查看&nbsp;</td>

                <td   width="32%" height="30" align="left">
                    <select name="select" onchange="javascript:location.href=this.options[selectedIndex].value">
                        <option value="aticle.php">查看全部文章</option>

                        <?php
                            foreach ($FlRestful as $v){
                                if ($v['id'] == $typeid){
                                    echo "<option value='aticle.php?typeid={$v['id']}' selected>".$v['typename']."</option>";
                                }else{
                                    echo "<option value='aticle.php?typeid={$v['id']}' >".$v['typename']."</option>";
                                }
                            }
                        ?>
                    </select>
                </td>

            </tr>

        </table>
    </div>

    <hr>


    <form method="post" action="../../public/Admin/Aticle.class.php?tab=delAll" name="myfrom" id="myfrom">
    <table id="customers">
        <tr>
            <th>ID</th>
            <th>标题</th>
            <th>所属分类</th>
            <th>状态</th>
            <th>作者</th>
            <th>来源</th>
            <th>浏览量</th>
            <th>录入员</th>
            <th>录入时间</th>
            <th>操作</th>
        </tr>

        <?php
        //如果数据小于1就不显示
        if ($ArticleNum >= 1){
        foreach($UserRestful as $key =>$val){

//表格隔行显示不同颜色
            $class = ($key%2 == 0)? 'class="alt"': '';
        ?>

            <tr <?php echo $class?> >
                <td ><input type="checkbox" name="check[]" id="check" value="<?php echo $val['id'];?>"></td>
                <td><?php echo $val['title'];?></td>
                <td><?php

                    //var_dump();
                    foreach ($FlRestful as $v){
                        if ($val['typeid'] == $v['id']){
                            echo $v['typename'];
                        }
                    }

                    ?></td>
                <td><font color="red"><?php echo $helper->getIsshAttr($val['issh']);?></font></td>
                <td><?php echo $val['author'];?></td>
                <td><?php echo $val['com'];?></td>
                <td><?php echo $val['hits'];?></td>
                <td><?php echo $val['inputer'];?></td>
                <td><?php echo date("Y-m-d",$val['addtime']);?></td>
<!--                <td>--><?php //echo $val['content'];?><!--</td>-->

                <td><a href="../../public/Admin/Aticle.class.php?id=<?php echo $val['id'];?>&tab=articleDel">删除</a>|<a href="./article.edi.php?id=<?php echo $val['id'];?>">修改</a></td>
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
                <input name="" type="button" value="设置审核" id="isshS">
                <input name="" type="button" value="取消审核" id="isshQ">
            </td>

        </tr>
        </table>

    </form>
    <div style="font-size:12px;"><form action="aticle.php" method="get"  id="formsearch" name="formsearch" onsubmit="return test();">
            标题关键字：<input name="key" type="text" /> <input name="" type="submit" value="查询" />
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

<script type="text/javascript">


    $(function () {

        $('#isshS').click(function () {
            if (!($("input[type='checkbox']:checked").val())){
                alert('请勾选选择框！');
                return false;
            }

            $('#myfrom').attr('action','../../public/Admin/Aticle.class.php?tab=up&issh=1');
            $('#myfrom').submit();
            // alert(123);

        });

        $('#isshQ').click(function () {
            if (!($("input[type='checkbox']:checked").val())){
                alert('请勾选选择框！');
                return false;
            }

            $('#myfrom').attr('action','../../public/Admin/Aticle.class.php?tab=up&issh=0');
            $('#myfrom').submit();
            // alert(123);

        });
    })
</script>

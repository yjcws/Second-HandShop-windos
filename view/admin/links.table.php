<?php
include $_SERVER['DOCUMENT_ROOT']."/controller/page.class.php";


$LinkWhere = array(
    'table' => 'links ',
    'field' => '*',
);

$LinkNum = count($helper->getAll($LinkWhere));
////var_dump($ArticleNum);
$page = new page($LinkNum,5);
//
$LinkWhere['limit'] = $page->limit();

$LinkRestful = $helper->getAll($LinkWhere);

//var_dump($LinkRestful);


?>


<div id="content_body">

    <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 友情链接列表</font></div>

    <hr>

    <div class="body-center">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td  width="10%" height="30" align="center"><a href="linksAdd.php" ><font style="margin-left: 30px" size="3">添加友情链接</font></a></td>
                <td  width="30%" >&nbsp;</td>
                <td  align="right">&nbsp;&nbsp;</td>

                <td   width="32%" height="30" align="left"></td>

            </tr>

        </table>
    </div>



    <form method="post" action="">
    <table id="customers">
        <tr>
            <th>网站名称</th>
            <th>网址</th>
            <th>链接类型</th>
            <th>LOGO</th>
            <th>加入时间</th>
            <th>操作</th>
        </tr>

        <?php
        //如果数据小于1就不显示
        if ($LinkNum >= 1){
        foreach($LinkRestful as $key =>$val){

//表格隔行显示不同颜色
            $class = ($key%2 == 0)? 'class="alt"': '';
        ?>

            <tr <?php echo $class?> >
                <td ><?php echo $val['webname'];?></td>
                <td><?php echo $val['weburl'];?></td>
                <td><?php
                    if($val["styleid"]==1)
                    {
                        echo "LOGO链接";
                    }
                    else
                    {
                        echo "文本链接";
                    }
                    ?></td>
                <td><?php echo $val['logourl'];?></td>
                <td><?php echo date("Y-m-s H:i:s",$val['addtime']);?></td>
<!--                <td>--><?php //echo $val['content'];?><!--</td>-->

                <td><a href="../../public/Links.class.php?id=<?php echo $val['id'];?>&tab=linksDel">删除</a>|<a href="./linksEdit.php?id=<?php echo $val['id'];?>">修改</a></td>
            </tr>
            <?php
            }
        }else{
            echo "<tr><td colspan='9'>暂无数据 。。。</td></tr>";
            }
        ?>

    </table>


    </form>

    <!--    页码-->

    <div style="margin-top:20px;text-align: center">
        <?php
        echo $page->show();
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

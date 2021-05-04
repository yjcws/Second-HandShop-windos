<div id="content_body">

<div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >>留言本分类列表</font></div>


    <div class="body-center"> <a href="FeedbackTypeAdd.php"><font style="margin-left: 30px" size="3">添加留言本分类</font></a></div>
    <hr>

    <form method="post" name="goinfo" action="../../public/Admin/FeedBackType.class.php?tab=DelAll">
    <table id="customers">
        <tr>
            <th></th>
            <th>排序</th>
            <th>分类名称</th>
            <th>ID</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        <?php
        include $_SERVER['DOCUMENT_ROOT']."/controller/page.class.php";

        //$helper = new Helper();

        $NumWhere=array(
            'table' => 'feedbackType',
            'field' => 'count(*)',
        );
        $Num = $helper->getOne($NumWhere);

        $infoNum = (int)$Num["count(*)"];
        //var_dump((int)$Num["count(*)"]);

        $page = new page($infoNum,5);

        $FbWhere = array(
            'table' => 'feedbackType ',
            'field' => '*',
            'order' => [
                'field'=>'id ',
                'order'=>'desc'
            ],
            'limit' => $page->limit(),
        );
        $FbRestful = $helper->getAll($FbWhere);

        if (!empty($FbRestful)) {


        foreach($FbRestful as $key =>$val){

            //表格隔行显示不同颜色
            $class = ($key%2 == 0)? 'class="alt"': '';
            ?>
            <tr <?php echo $class?> >
                <td ><input name="check[]" type="checkbox" value="<?php echo $val["id"];?>" /></td>
<!--                文本或命名区分不同-->
                <td><input name="typeorder<?php echo $val["typeorder"];?>" type="text" value="<?php echo $val["typeorder"]?>" size="5" /></td>
                <td><?php echo $val['typename'];?></td>
                <td><?php echo $val['id'];?></td>
                <td><?php
                    if($val["typezt"]==1)
                    {
                    echo "开启";
                    }
                    else
                    {
                    echo "<span style='color:red;font-weight:bold;'>关闭</span>";
                    }
                    ?>

                </td>
                <td><a href="../../public/Admin/FeedBackType.class.php?id=<?php echo $val['id'];?>&tab=FbDel">删除</a>|<a href="./FeedbackTypeEdi.php?id=<?php echo $val['id'];?>">修改</a></td>
            </tr>
            <?php
        }
    }else{
            echo " <td colspan='5'>暂无数据。。。</td>";
        }


        ?>

    </table>
        </table>
        <table border="0" whith="100%" style="margin-top: 10px">
            <tr>
                <td width="71%" align="left">
                    <input name="" type="submit" value="批量删除" />
                    <input name="" type="button" onclick="goupdate(1);" value="设置开启" />
                    <input name="input" type="button" onclick="goupdate(0);" value="设置关闭" />
                    <input name="zt" type="hidden" />
                </td>
            </tr>
        </table>


    </form>




    <!--    页码-->

    <div style="margin-top: 20px;text-align: center">
        <?php


        echo $page->show();


        ?>
    </div>
</div>
<div id="floor"></div>
<script>
    function goupdate(zt)
    {
        document.goinfo.zt.value=zt;
        document.goinfo.action="../../public/Admin/FeedBackType.class.php?tab=Up";
        document.goinfo.submit();
    }
</script>




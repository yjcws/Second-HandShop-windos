<div id="content_body">

    <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 文章分类列表</font></div>

    <div class="body-center"> <a href="article.classificationAdd.php"><font style="margin-left: 30px" size="3">添加新分类</font></a></div>
    <hr>
    <table id="customers">
        <tr>
            <th>id</th>
            <th>分类名称</th>
            <th>分类类型</th>
            <th>操作</th>
        </tr>
        <?php
        include $_SERVER['DOCUMENT_ROOT']."/controller/page.class.php";


        $NumWhere=array(
            'table' => 'articleType',
            'field' => 'count(*)',
        );
        $Num = $helper->getOne($NumWhere);

        $infoNum = (int)$Num["count(*)"];

        $page = new page($infoNum,5);

        $UserWhere = array(
            'table' => 'articleType ',
            'field' => '*',
            'order' => [
                'field'=>'id ',
                'order'=>'desc'
            ],
            'limit' => $page->limit(),
        );
        $UserRestful = $helper->getAll($UserWhere);

        foreach($UserRestful as $key =>$val){

            //表格隔行显示不同颜色
            $class = ($key%2 == 0)? 'class="alt"': '';
            ?>
            <tr <?php echo $class?> >
                <td ><?php echo $val['id'];?></td>
                <td><?php echo $val['typename'];?></td>
                <td><?php echo $val['leixing'];?></td>

                <td><a href="../../public/Admin/Aticle.class.php?id=<?php echo $val['id'];?>&tab=del">删除</a>|<a href="./article.classificationEdi.php?id=<?php echo $val['id'];?>">修改</a></td>
            </tr>
            <?php
        }
        ?>


    </table>

    <!--    页码-->

    <div style="margin-top: 20px;text-align: center">
        <?php


        echo $page->show();


        ?>
    </div>
</div>
<div id="floor"></div>

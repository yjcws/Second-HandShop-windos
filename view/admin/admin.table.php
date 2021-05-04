<div id="content_body">

<div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 管理员列表</font></div>


    <div class="body-center"> <a href="member_add.php"><font style="margin-left: 30px" size="3">添加管理员</font></a></div>
    <hr>
    <table id="customers">
        <tr>
            <th>登陆帐号</th>
            <th>权限</th>
            <th>最后登陆时间</th>
            <th>最后登陆ip</th>
            <th>登陆次数</th>
            <th>登陆操作</th>
        </tr>
        <?php
        include $_SERVER['DOCUMENT_ROOT']."/controller/page.class.php";


        $NumWhere=array(
            'table' => 'admin_user',
            'field' => 'count(*)',
        );
        $Num = $helper->getOne($NumWhere);

        $infoNum = (int)$Num["count(*)"];
        //var_dump((int)$Num["count(*)"]);

        $page = new page($infoNum,5);

        $UserWhere = array(
            'table' => 'admin_user ',
            'field' => '*',
            'order' => [
                'field'=>'loginTime ',
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
                <td ><?php echo $val['username'];//echo $val['id'];?></td>
                <td><?php
                    if($val["rights"]==1)
                    {
                        echo "超级管理员";
                    }
                    else
                    {
                        echo "普通管理员";
                    }
                    ?></td>
                <td><?php echo date("Y-m-d H:i:s",$val['loginTime']);?></td>
                <td><?php echo $val['ip'];?></td>
                <td><?php

                    echo $val["loginSum"];  echo "未做";

                    ?></td>
                <td><a href="../../public/Admin/adminEdit.php?id=<?php echo $val['id'];?>&tab=del">删除</a>|<a href="./admin_Edit.php?id=<?php echo $val['id'];?>&tab=edi">修改</a></td>
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
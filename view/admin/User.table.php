<div id="content_body">

<div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 用户列表</font></div>


    <div class="body-center"> <a href="UserAdd.php"><font style="margin-left: 30px" size="3">添加用户</font></a></div>
    <hr>
    <table id="customers">
        <tr>
            <th>登陆帐号</th>
            <th>状态</th>
            <th>邮箱</th>
            <th>姓名</th>
            <th>手机号码</th>
            <th>注册时间</th>
            <th>登陆操作</th>
        </tr>
        <?php
        include $_SERVER['DOCUMENT_ROOT']."/controller/page.class.php";

        //$helper = new Helper();

        $NumWhere=array(
            'table' => 'user',
            'field' => 'count(*)',
        );
        $Num = $helper->getOne($NumWhere);

        $infoNum = (int)$Num["count(*)"];
        //var_dump((int)$Num["count(*)"]);

        $page = new page($infoNum,5);

        $UserWhere = array(
            'table' => 'user ',
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
                <td ><?php echo $val['username'];//echo $val['id'];?></td>
                <td>
                    <?php

                    switch ($val["zt"])
                    {
                        case "1":
                            echo "<span style='color:red'>待审核</span>";
                            break;
                        case "2":
                            echo "正常";
                            break;
                        case "3":
                            echo "<span style='color:#fff000'>锁定</span>";
                            break;
                    }
                    ?>
                </td>
                <td><?php echo $val['email'];?></td>
                <td><?php echo $val['xingming'];?></td>
                <td><?php echo $val['mobile'];?></td>
                <td><?php echo date("Y-m-d H:i:s",$val['addtime']);?></td>
                <td><a href="../../public/Admin/User.class.php?id=<?php echo $val['id'];?>&tab=UsrDel">删除</a>|<a href="./UserEdi.php?id=<?php echo $val['id'];?>">修改</a></td>
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



<div id="content_body">

<div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 后台登陆日志</font></div>
    <hr>

<table id="customers">
    <tr>
        <th>登陆帐号</th>
        <th>登陆密码</th>
        <th>登陆时间</th>
        <th>登陆ip</th>
        <th>登陆状态</th>
        <th>登陆操作</th>
    </tr>
    <?php
    include $_SERVER['DOCUMENT_ROOT']."/controller/page.class.php";


    $NumWhere=array(
        'table' => 'adminlog',
        'field' => 'count(*)',
    );
    $Num = $helper->getOne($NumWhere);

    $infoNum = (int)$Num["count(*)"];
    //var_dump((int)$Num["count(*)"]);

    $page = new page($infoNum,10);

    $UserWhere = array(
        'table' => 'adminlog ',
        'field' => '*',
        'order' => [
                'field'=>'addtime ',
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
        <td>******</td>
        <td><?php echo date("Y-m-d H:i:s",$val['addtime']);?></td>
        <td><?php echo $val['ip'];?></td>
        <td><?php
            if($val['state'] == 1){
                echo "正常登陆";
            }elseif ($val['state'] == 2){
                echo "用户不存在";
            }else{
                echo "密码错误";
            }

            ?></td>
        <td><a href="../../public/Admin/logDelete.php?id=<?php echo $val['id'];?>">删除</a></td>
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



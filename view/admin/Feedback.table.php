<?php
include $_SERVER['DOCUMENT_ROOT']."/controller/page.class.php";


session_start();
$rights =$_SESSION['UserInfo']['rights']; //权限标识
$Username =$_SESSION['UserInfo']['username']; //当前 管理员name
//var_dump($rights);
$typeid = @$_GET['typeid'];


//查询商品表的数据和权限管理
//1.超级管理员查询条件
$FbaWhere = array(
    'table' => 'feedback',
    'field' => 'feedback.*,feedbackType.typename',
    'join' => [
        'table' => 'feedbackType',
        'where' => 'feedback.typeid=feedbackType.id ',
    ],
    'order' => [
        'field' => 'feedback.id ',
        'order' => 'desc'
    ],
);

//2.普通 管理员查询 条件
//如果不是普通管理员
if(!($rights == 1)) {
    $FbaWhere['join']['where'] .= "AND feedback.inputer='{$Username}'";
}

//按分类查看
if($typeid!="")
{
    $FbaWhere['join']['where'] .= "AND feedback.typeid=$typeid";
}

//关键词搜索
$keyword = @$_GET['key'];

if($keyword!="")
{
    $FbaWhere['join']['where'] .= "AND feedback.content like '%$keyword%'";
}

$FeedbackNum = count($helper->getAll($FbaWhere));
$page = new page($FeedbackNum,5);

$FbaWhere['limit'] = $page->limit();

$FeedBaRse = $helper->getAll($FbaWhere);

?>


<div id="content_body">

    <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 留言内容列表</font></div>


    <div class="body-center">


        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td  width="10%" height="30" align="center"><a href="FeedbackAdd.php" ><font style="margin-left: 30px" size="3">添加留言内容</font></a></td>
                <td  width="30%" >&nbsp;</td>
                <td  align="right">&nbsp;按分类查看&nbsp;</td>

                <td   width="32%" height="30" align="left">
                    <select name="select" onchange="javascript:location.href=this.options[selectedIndex].value">
                        <option value="Shop.php">查看全部</option>

                        <?php
                        $FbaWhere1 = array(
                            'table' => 'feedbacktype',
                            'field' => '*',
                        );
                        $FbaRestfuls = $helper->getAll($FbaWhere1);
                        foreach($FbaRestfuls as $row)
                        {
                            if($typeid==$row["id"])
                            {
                                echo "<option value='?typeid=".$row["id"]."' selected>".$row["typename"]."</option>";
                            }
                            else{
                                echo "<option value='?typeid=".$row["id"]."'>".$row["typename"]."</option>";
                            }

                        }
                        ?>
                    </select>
                </td>

            </tr>

        </table>
    </div>

    <hr>


    <form method="post" action="../../public/Admin/FeedBack.class.php?tab=DelAll" name="info" id="info">
    <table id="customers">
        <tr>
            <th></th>
            <th>ID</th>
            <th>所属分类</th>
            <th>审核状态</th>
            <th>回复状态</th>
            <th>显示姓名</th>
            <th>提交时间</th>
            <th>IP地址</th>
            <th>操作</th>
        </tr>

        <?php
        //如果数据小于1就不显示
        if ($FeedbackNum >= 1){
        foreach($FeedBaRse as $key =>$val){

//表格隔行显示不同颜色
            $class = ($key%2 == 0)? 'class="alt"': '';
        ?>

            <tr <?php echo $class?> >
                <td ><input type="checkbox" name="check[]" id="check" value="<?php echo $val['id'];?>"></td>
                <td><?php echo $val['id'];?></td>
                <td><?php echo $val['typename'];?></td>
                <td>
                    <?php
                    if($val["issh"]==1)
                    {
                        echo "已审核";
                    }
                    else
                    {
                        echo "<span style='color:#ff0000;font-weight:bold'>待审核</span>";
                    }
                    ?>
                </td>
                <td><?php
                    if($val["ishf"]==1)
                    {
                        echo "已回复";
                    }
                    else
                    {
                        echo "<span style='color:red;font-weight:bold'>待回复</span>";
                    }

                    ?></td>
                <td><?php echo $val["usernameshow"];?></td>
                <td><?php echo date("Y-m-d H:i:s",$val['addtime']);?></td>
                <td><?php echo $val['ip'];?></td>
                <td><a href="../../public/Admin/FeedBack.class.php?id=<?php echo $val['id'];?>&tab=FbDel">删除</a>|<a href="./FeedbackEdi.php?id=<?php echo $val['id'];?>">修改</a></td>
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
                <input name="" type="submit" value="批量删除"/>
                <input type="button" name="button" id="button" value="设置审核" onclick="goupdate('issh',1);" />
                <input type="button" name="button" id="button" value="设置回复" onclick="goupdate('ishf',1);" />
                <input type="button" name="button" id="button" value="取消审核" onclick="goupdate('issh',0);" />
                <input type="button" name="button" id="button" value="取消回复" onclick="goupdate('ishf',0);" />
                <input type="hidden" name="ziduan" id="ziduan" />
                <label for="zt"></label>
                <input type="hidden" name="zt" id="zt" /></td></tr>
            </td>
        </tr>
        </table>

    </form>
    <div style="font-size:12px;margin-top:10px"><form action="" method="get"  id="formsearch" name="formsearch" onsubmit="return test();">
            搜索：<input name="key" type="text" /> <input name="" type="submit" value="搜索" />
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
        document.info.action = "../../public/Admin/FeedBack.class.php?tab=Up";
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

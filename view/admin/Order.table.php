<?php
include $_SERVER['DOCUMENT_ROOT']."/controller/page.class.php";

$rights =$helper->getAdminname()['rights']; //权限标识
$Username =$helper->getAdminname()['username']; //当前 管理员name

$typeid = @$_GET['typeid'];



//查询 文章表的数据和权限管理
//1.超级管理员查询 条件
$OrderWhere = array(
    'table' => 'orderlist ',
    'field' => '*',
    'order' => [
        'field' => 'id ',
        'order' => 'desc'
    ],
);

//2.普通 管理员查询 条件
//如果不是普通管理员
if(!($rights == 1)) {
    $OrderWhere['where'][] = "inputer='{$Username}'";
}


/**
 * 分类查询 ：列表实现查询
 * 订单状态：1.待处理2.已发货3.已收货4.已取消5.交易完完成
 */

$Zdval = @$_GET['Zdval'];
//var_dump($Zdval);
if($Zdval!="")
{
    $OrderWhere['where'][] = "orderState=$Zdval";
}

/**
 * 输入文本查询
 */
$keyword = $_GET['key'];
if($keyword!="")
{
    $OrderWhere['where'][] = "orderID like '%$keyword%'";
}



$ArticleNum = count($helper->getAll($OrderWhere));
//var_dump($ArticleNum);
$page = new page($ArticleNum,10);

$OrderWhere['limit'] = $page->limit();

$OrderRs = $helper->getAll($OrderWhere);




//$helper->dd($OrderRs);

?>


<div id="content_body">

    <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 订单管理列表</font></div>


    <div class="body-center">


        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td  width="10%" height="30" align="center"></td>
                <td  width="30%" >&nbsp;</td>
                <td  align="right">&nbsp;按订单状态查看&nbsp;</td>

                <td   width="32%" height="30" align="left">
                    <select name="select" onchange="javascript:location.href=this.options[selectedIndex].value">
                        <option value="Order.php">查看全部订单</option>
                        <option value="Order.php?Zdval=1" <?php if(isset($Zdval) && $Zdval=='1'){ echo 'selected';}?>>待处理</option>
                        <option value="Order.php?Zdval=2" <?php if(isset($Zdval) && $Zdval=='2'){ echo 'selected';}?>>已发货</option>
                        <option value="Order.php?Zdval=3" <?php if(isset($Zdval) && $Zdval=='3'){ echo 'selected';}?>>已收货</option>
                        <option value="Order.php?Zdval=4" <?php if(isset($Zdval) && $Zdval=='4'){ echo 'selected';}?>>已取消</option>
<!--                        <option value="Order.php?Zdval=1">交易完完成</option>-->
                    </select>
                </td>

            </tr>

        </table>
    </div>

    <hr>


    <form method="post" action="../../public/Admin/Order.class.php?tab=Pfahuo"  name="info" id="info">
    <table id="customers" border="1">
        <tr>
            <th>ID</th>
            <th>订单号</th>
            <th>订单金额</th>
            <th>订单状态</th>
            <th>支付状态</th>
            <th>用户名</th>
            <th>商品编码</th>
            <th>商品名称</th>
            <th>数量</th>
            <th>单价</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>

        <?php
        //如果数据小于1就不显示
        if ($ArticleNum >= 1){
        foreach($OrderRs as $key =>$val){

//表格隔行显示不同颜色
            $class = ($key%2 == 0)? 'class="alt"': '';
        ?>

            <tr <?php echo $class?> >
                <td ><input type="checkbox" name="check[]" id="check" value="<?php echo $val['orderID'];?>"></td>
                <td><?php echo $val['orderID'];?></td>
                <td><?php  echo sprintf('%.2f',$val['Price']*$val['total']); ?></td>
                <td><font color="red"><?php echo $helper->getOrderStateAttr($val['orderState']);?></font></td>
                <td><font color="red"><?php echo $helper->getPaymentStateAttr($val['paymentState']);?></font></td>
                <td><?php echo $val['username'];?></td>
                <td><?php echo $val['shopid'];?></td>
                <td><?php echo $val['title'];?></td>
                <td><?php echo $val['total'];?></td>
                <td><?php echo $val['Price'];?></td>
                <td><?php echo date("Y-m-d",$val['addtime']);?></td>
<!--                <td>--><?php //echo $val['content'];?><!--</td>-->

                <td>

                    <?php if($val['orderState'] == 1){?>
                    <a href="../../public/Admin/Order.class.php?id=<?php echo $val['orderID'];?>&tab=fahuo"><input type="button" value="发货" ></a>
                    <?php }else{
                        if ($val['orderState']!= 4){
                        ?>
                        <input type="button"  value="已发货" disabled>

                    <?php }}?>

                    <?php if($val['paymentState'] == 3){?>
                    <a href="../../public/Admin/Order.class.php?id=<?php echo $val['orderID'];?>&tab=qrtk"><input type="button" value="确认退款" ></a>
                    <?php }else{
                        if ($val['paymentState']== 4){
                        ?>
                        <input type="button"  value="已退款" disabled>

                    <?php }}?>

                    <a href="OrderInfo.php?id=<?php echo $val['orderID'];?>"><input type="button" value="订单详情"></a></td>
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
                <input name="fahuo" id='fahuo' type="button" value="批量发货" >
                <input name="qrsk" id='qrsk' type="button" value="确认收款">

            </td>
        </tr>
        </table>

    </form>
    <div style="font-size:12px;"><form action="" method="get"  id="formsearch" name="formsearch" onsubmit="return test();">
            按订单号查询：<input name="key" type="text" /> <input name="" type="submit" value="查询" />
        </form></div>

    <!--    页码-->

    <div style="margin-top: 20px;text-align: center">
        <?php


        echo $page->show();



        ?>
    </div>
</div>
<div id="floor"></div>

<script type="text/javascript">

    $(function () {
        $('#fahuo').click(function () {
            // $("#tb tr").each(function(){
            //     var text = $(this).children("td:first").text();
            //     cols+=text+"|";
            // })
            // alert(cols);
            // console.log($("#info tr").find("td:eq(3)").text());


            var rs = true;
            $("input:checkbox:checked").each(function () {
                var chck = $(this).parents('tr').find('td').eq(3).text();
                if (chck!='待处理'){
                    alert('已经有商品发货');
                    rs = false;
                    return false;
                }

                // return true;

            });

            if (rs){
                $('#info').submit();
            }

            // $('#info').attr('action','')

        });
        $('#qrsk').click(function () {
            var rs = true;



            if (!($("input[type='checkbox']:checked").val())){
                alert('请勾选商品');
                return false;
            }


            $('input:checkbox:checked').each(function () {
                // if ($(this).val()==''){
                //     alert('请勾选商品！');
                //     return false;
                // }
                var chck = $(this).parents('tr').find('td').eq(4).text();
                console.log(chck);
                console.log(chck!='待支付');

                if (chck!='待支付'){
                    alert('选中的商品有付款项');
                    rs = false;
                    return false;
                }
            });
            if (rs){
                $('#info').attr('action','../../public/Admin/Order.class.php?tab=Pqrsk');
                $('#info').submit();

            }

        });



    });


</script>

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

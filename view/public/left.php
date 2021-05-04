

<?php

$listWhere = array(
    'table' => 'productlist',
    'field' => 'id,tid,typename,idpath',
);

$listRes = $helper->getAll($listWhere);

//$helper->dd($listRes);

?>

<table width="100%" border="1" cellspacing="0" style="border:1px solid #CCCCCC;">
    <?php
    //打印一级分类
    foreach ($listRes as  $val) {
        if ($val['idpath'] == '0'){
            //echo $val['typename']."</br>";

            echo "  <tr>
        <th height=\"40\" align=\"center\" valign=\"middle\" bgcolor=\"#BEEDC7\" scope=\"col\"><a href=\"./Fenlei.php?typeid={$val['id']}\"> {$val['typename']} </a></th>
    </tr>";

            //打印下级 分类
            foreach ($listRes as  $v) {
                if($val['id']==$v['tid']){
                    //echo  '-'.$val['typename']."<br>";
                    echo "    <tr align=\"left\" valign=\"middle\">
        <td height=\"40\" align=\"center\" valign=\"middle\" ><a href=\"./Fenlei.php?typeid={$v['id']}\">{$v['typename']}</a></td>
    </tr>";
                }
            }
        }

    }


    ?>

</table>
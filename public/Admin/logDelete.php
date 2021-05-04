<?php
include "../../controller/MysqlConnection.php";
require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";

$id = $_GET['id'];

//var_dump($_GET);
$helper = new Helper();

if(empty($id)){

    $helper->Redirect('参数错误','admin/index.php');
}else{
    $Delwhere = array(
        'table'=>'adminlog',
        'where'=>'id='.$id,
    );
    $Mysql->delete($Delwhere);

    $helper->Redirect("数据删除成功！","admin/index.php");

}


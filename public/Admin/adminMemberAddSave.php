<?php
require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";

$helper = new Helper();

$username = trim($_POST['zh']);
$password = trim($_POST['pw']);
$rights=$_POST["rights"];
//echo $username.$password.$rights;

//    //编辑查询 sql语句
$UserWhere = array(
    'table' => 'admin_user',
    'field' => '*',
    'where' => "username = "."'$username'"
);
//    //编辑新增 sql语句
$ip = $_SERVER['REMOTE_ADDR'];

$addUserWhere = array(
    'table' => 'admin_user',
    'data'=>[
        'username' => "$username",
        'password' => "$username",
        'rights' =>$rights,
        'loginTime' =>time(),
        'ip' => "$ip",
    ]
);
$UserRestful = $helper->getOne($UserWhere);


//var_dump($UserRestful);


if($UserRestful)
{
    echo "<script>alert('你建立的账号$username,已经存在,请更换一个！');location.href='../view/admin/member_add.php'</script>";
    exit;
}
$code = $helper->add($addUserWhere);


if($code==1)
{
    echo "<script>alert('管理员创建成功！');location.href='../../view/admin/member_add.php'</script>";
}
else
{
    echo "<script>alert('管理员创建失败！');location.href='../../view/admin/member_add.php'</script>";
}
?>


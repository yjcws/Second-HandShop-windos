<?php


require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";


$helper = new Helper();

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$ip = $_SERVER['REMOTE_ADDR'];
try{
//    //编辑sql语句
    $UserWhere = array(
        'table' => 'admin_user',
        'field' => 'id,username,password,rights',
        'where' => "username = "."'$username'"
    );

    $UserLog = array(
        'table' => 'adminlog',
        'data'=>[
        'username' => "$username",
        'password' => "$username",
        'addtime' =>time(),
        'ip' => "$ip",
    ]
    );
    $UserRestful = $helper->getOne($UserWhere);

//    echo "<pre>";
//    var_dump($UserRestful);
//    echo "</pre>";
    if (!empty($UserRestful)){
        if ($UserRestful['password']== $password){
            session_start();
            $_SESSION['AdminInfo'] = array(
                "userid" => $UserRestful['id'],
                "username" => $UserRestful['username'],
                "rights" => $UserRestful['rights']
            );


            //echo "<script>alert('欢迎'.$username);</script>";
            $UserLog['data']['state'] = 1;

            $helper->add($UserLog);

            $helper->Redirect("欢迎{$username}",'admin/index.php');

        }else{
            $UserLog['data']['state'] = 2;

            $helper->add($UserLog);

            $helper->Redirect("密码错误",'admin/login.php');

        }
    }else{
        $UserLog['data']['state'] = -2;

        $helper->add($UserLog);
        $helper->Redirect("用户不存在",'admin/login.php');

    }

}catch (Exception $exception){
    die("Exception:".$exception->getMessage());
}

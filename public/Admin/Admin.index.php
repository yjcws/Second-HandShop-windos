<?php

/*
*author: yjc
*createtime : 2021/3/18 9:19
*description:
*/

require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";

$helper = new Helper();
$ArgsArr = $helper->getArgs();
$filename="../../config/Webconfig.php";


//$helper->dd($ArgsArr);


$WebConfig = array(
    'table' => 'webconfig',
    'data'=>[
        'webname' => "{$ArgsArr['webname']}",
        'webUrl' => "{$ArgsArr['webUrl']}",
        'register' => "{$ArgsArr['register']}",
        'copyright' => "{$ArgsArr['copyright']}",
        'addtime' => time(),
    ],
    'where'=>'id=1'
);

$code = $helper->update($WebConfig);

if(file_exists($filename))
{
   // file_put_contents($file, ""); //清空文件内容

    //有得话，就开始对文件进行操作
    //写入
    $ft=fopen($filename, "w");
    flock($ft, 3);
    fwrite($ft, "<?php\r\n");

    foreach($WebConfig['data'] as $key => $row)
    {

        fwrite($ft, "$".$key."='".$row);
        fwrite($ft, "';\r\n");
    }
    fwrite($ft, "?>");

    fclose($ft);

} else
{

    file_put_contents($filename,"");
}


if ($code) {
    $helper->Redirect('修改成功','admin/index.php');
}else{
    $helper->Redirect('修改失败','admin/index.php');
}


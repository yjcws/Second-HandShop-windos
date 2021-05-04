<?php

/*
*author: yjc
*createtime : 2021/3/16 12:46
*description:
*/
//include "../controller/MysqlConnection.php";
require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";

class UserLogin extends Helper
{
    public function __construct()
    {

        parent::__construct();

//        $this->isUserLogin();

        if(!empty($this->ArgsArr['tab'])) {
            switch (trim($this->ArgsArr['tab'])) {
                case 'login':
                    $this->UserLogin();
                    break;
                case 'register':
                    $this->register();
                    break;
                case "outlogin":
                    $this->OutLogin();
                    break;
                case "editPw":
                    $this->EditPw();
                    break;
                case "edit":
                    $this->UserEdit();
                    break;
                case "ShdzAdd":
                    $this->ShdzAdd();
                    break;
                case "ShdzDel":
                    $this->ShdzDel();
                    break;
                case "ShdzEdi":
                    $this->ShdzEdi();
                    break;
                case "OrShEdi":
                    $this->OrderShdzEdi();
                    break;
                case "AssAdd":
                    $this->AssessAdd();
                    break;
                case "shopAdd":
                    $this->ShopAdd();
                    break;
                case "ShopEdi":
                    $this->ShopEdi();
                    break;
                case "ShopDel":
                    $this->QuXiaoFabu();
                    break;
                default:
                    $this->Redirect('参数错误','index.php');
            }
        }else{
            $this->Redirect('参数错误','index.php');
        }


    }

    //用户登陆
    public function UserLogin()
    {

        //$this->dd($this->ArgsArr);

        $UserWhere = array(
            'table' => 'user',
            'field' => '*',
            "where" => 'email='."'{$this->ArgsArr['email']}'",
        );
        $UserRestful = $this->getOne($UserWhere);
        //$this->dd($UserRestful);

        //数据校验
        if (empty($this->ArgsArr['email']) || empty($this->ArgsArr['pw'])) {
            $this->Redirect("【邮箱】或【密码】不能为空",'login.php');
        }elseif (empty($UserRestful['username'])){
            $this->Redirect("【用户名】不存在,请检查",'login.php');
        }elseif ($this->ArgsArr['pw']!=$UserRestful['password']){
            $this->Redirect("【密码】不正确,请检查",'login.php');
        }elseif ($UserRestful['zt']== 1){
            $this->Redirect("【帐号】未审核,请联系管理员",'login.php');
        }elseif ($UserRestful['zt']== 3){
            $this->Redirect("【帐号】被锁定,请联系管理员",'login.php');
        }

        session_start();
        $_SESSION['UserInfos'] = array(
            "userid" => $UserRestful['id'],
            "username" => $UserRestful['email'],
            "email" => $UserRestful['email'],
        );

        /**
         * 初始化自己的收藏，购物车，订单情况
         */
        $this->GetScInfo();
        $this->GetCartInfo();
        $this->GetOrderInfo();



        $this->Redirect("【". $UserRestful['username']."】登陆成功，欢迎回来!",'index.php');

    }

    //用户注册
    public function register()
    {

        $conWhere = array(
            'table' => 'webconfig',
            'field' => 'register',
        );
        $conRestful = $this->getOne($conWhere);

        if ($conRestful['register'] == '1') {
            $UserWhere = array(
                'table' => 'user',
                'field' => '*',
                "where" => 'email=' . "'{$this->ArgsArr['email']}'",
            );
            $UserRestful = $this->getOne($UserWhere);

//            var_dump($UserRestful);

            //数据校验
            if (empty($this->ArgsArr['email']) || empty($this->ArgsArr['pw']) || empty($this->ArgsArr['pw1'])) {
                $this->Redirect("【邮箱】或【密码】不能为空", 'login.php');
            } elseif (!empty($UserRestful)) {
                $this->Redirect("用户【" . $UserRestful['username'] . "】已经存在!请重新输入", 'login.php');
            } elseif ($this->ArgsArr['pw'] != $this->ArgsArr['pw1']) {
                $this->Redirect("两次密码不一致!请重新输入", 'login.php');
            }


            $UserEdi = array(
                'table' => 'user',
                'data' => [
                    'username' => $this->ArgsArr['email'],
                    'password' => "{$this->ArgsArr['pw']}",
                    'email' => "{$this->ArgsArr['email']}",
                    'addtime' => time(),
                    'zt'=>1
                ],

            );

            $code = $this->add($UserEdi);
            $this->CheckCode($code);
        }else{
            $this->Redirect('暂未开启注册功能！请联系管理员','index.php');
        }


    }

    //用户退出登陆
    public function OutLogin(){
//        session_start();
        $this->DelSession();//删除多个session
        unset($_SESSION['UserInfos']);
        $this->Redirect("退出成功！",'index.php');

    }

    //修改密码
    public function EditPw()
    {
        $UserWhere = array(
            'table' => 'user',
            'field' => 'password',
            "where" => 'email='."'{$this->getUsernames()['email']}'",
        );
        $UserRestful = $this->getOne($UserWhere);


        if (empty($this->ArgsArr['pw']) || empty($this->ArgsArr['pw1']) || empty($this->ArgsArr['pw2'])) {
            $this->Redirect("请输入【密码】!请重新输入",'user_EditPw.php');
        }elseif ($this->ArgsArr['pw1']!=$this->ArgsArr['pw2']) {
            $this->Redirect("两次密码不一致!请重新输入",'user_EditPw.php');
        }elseif ($UserRestful['password']!=$this->ArgsArr['pw']){
            $this->Redirect("【原始密码】不正确，请重新输入！",'user_EditPw.php');
        }

        $UserEdi = array(
            'table' => 'user',
            'data'=>[
                'password' => "{$this->ArgsArr['pw1']}",
                'addtime' => time(),
            ],
            'where'=>'email='."'{$this->getUsernames()['username']}'",

        );

        $code = $this->update($UserEdi);
        $this->CheckCode($code);


    }


    //修改用户资料
    public function UserEdit()
    {

        //数据校验
//        var_dump($this->ArgsArr);
        if (empty($this->ArgsArr['username']) ) {
            $this->Redirect("【我的妮称】不能为空，请重新输入",'user_Edit.php');
        }elseif (empty($this->ArgsArr['xingming'])) {
            $this->Redirect("【真实姓名】不能为空，请重新输入",'user_Edit.php');
        }
//        elseif (empty($this->ArgsArr['sex'])){
//            $this->Redirect("【姓别】不能为空，请重新输入！",'user_Edit.php');
//        }
        elseif (empty($this->ArgsArr['moblile'])){
            $this->Redirect("【手机号码】不能为空，请重新输入！",'user_Edit.php');
        }

        $UserEdi = array(
            'table' => 'user',
            'data'=>[
                'username' => "{$this->ArgsArr['username']}",
                'xingming' => "{$this->ArgsArr['xingming']}",
                'sex' => "{$this->ArgsArr['sex']}",
                'mobile' => "{$this->ArgsArr['moblile']}",
                'addtime' => time(),
            ],
            'where'=>'email='."'{$this->getUsernames()['username']}'",

        );

        $code = $this->update($UserEdi);
//        var_dump($code);
        $this->CheckCode($code);
    }

    //收货地址新增
    public function ShdzAdd(){
        //数据校验
        if (empty($this->ArgsArr['shr']) ) {
            $this->Redirect("【收货人】不能为空，请重新输入",'user_ShouhAdd.php');
        }elseif (empty($this->ArgsArr['shdizhi'])) {
            $this->Redirect("【收货地址】不能为空，请重新输入",'user_ShouhAdd.php');
        }elseif (empty($this->ArgsArr['youbian'])){
            $this->Redirect("【邮编】不能为空，请重新输入！",'user_ShouhAdd.php');
        }elseif (empty($this->ArgsArr['mobile'])){
            $this->Redirect("【手机】不能为空，请重新输入！",'user_ShouhAdd.php');
        }

        $UserEdi = array(
            'table' => 'receive',
            'data'=>[
                'shren' => "{$this->ArgsArr['shr']}",
                'shdizhi' => "{$this->ArgsArr['shdizhi']}",
                'youbian' => "{$this->ArgsArr['youbian']}",
                'tel' => "{$this->ArgsArr['tel']}",
                'mobile' => "{$this->ArgsArr['mobile']}",
                'username' => "{$this->getUsernames()['username']}",
                'is_mr' => 0,  //默认收货地址为否

            ],

        );

        $code = $this->add($UserEdi);

        $this->CheckCode($code);



    }

    //删除收货地址
    public function ShdzDel(){
        //删除条件
        $delWhere = [
            'table' =>'receive',
            'where' =>"id = $this->id",
        ];

        $code = $this->delete($delWhere);

        //var_dump($code);

        $this->CheckCode($code);


    }

    //修改收货地址
    public function ShdzEdi()
    {

        //数据校验
        if (empty($this->ArgsArr['shr']) ) {
            $this->Redirect("【收货人】不能为空，请重新输入",'user_ShouhEdi.php');
        }elseif (empty($this->ArgsArr['shdizhi'])) {
            $this->Redirect("【收货地址】不能为空，请重新输入",'user_ShouhEdi.php');
        }elseif (empty($this->ArgsArr['youbian'])){
            $this->Redirect("【邮编】不能为空，请重新输入！",'user_ShouhEdi.php');
        }elseif (empty($this->ArgsArr['mobile'])){
            $this->Redirect("【手机】不能为空，请重新输入！",'user_ShouhEdi.php');
        }

        if (empty($this->ArgsArr['is_mr']) && isset($this->ArgsArr['is_mr'])) {
            $is_mr = 0;
        }else {
            $is_mr = 1;
        }

        $UserEdi = array(
            'table' => 'receive',
            'data'=>[
                'shren' => "{$this->ArgsArr['shr']}",
                'shdizhi' => "{$this->ArgsArr['shdizhi']}",
                'youbian' => "{$this->ArgsArr['youbian']}",
                'tel' => "{$this->ArgsArr['tel']}",
                'mobile' => "{$this->ArgsArr['mobile']}",
                'username' => "{$this->getUsernames()['username']}",
                'is_mr' => $is_mr,

            ],
            'where'=>'id='.$this->ArgsArr['id'],

        );

        $code = $this->update($UserEdi);
        $this->CheckCode($code);

    }
    //订单修改收货地址
    public function OrderShdzEdi()
    {

        //数据校验
        if (empty($this->ArgsArr['shr']) ) {
            //$this->Redirect("【收货人】不能为空，请重新输入",'user_ShouhEdi.php');
            echo json_encode(2);
            exit;
        }elseif (empty($this->ArgsArr['shdizhi'])) {
//            $this->Redirect("【收货地址】不能为空，请重新输入",'user_ShouhEdi.php');
            echo json_encode(3);
            exit;

        }elseif (empty($this->ArgsArr['youbian'])){
            //$this->Redirect("【邮编】不能为空，请重新输入！",'user_ShouhEdi.php');
            echo json_encode(4);
            exit;

        }elseif (empty($this->ArgsArr['mobile'])){
//            $this->Redirect("【手机】不能为空，请重新输入！",'user_ShouhEdi.php');
            echo json_encode(5);
            exit;

        }


        if (empty($this->ArgsArr['is_mr']) && isset($this->ArgsArr['is_mr'])) {
            $is_mr = 0;
        }else {
            $is_mr = 1;
        }

        $UserEdi = array(
            'table' => 'receive',
            'data'=>[
                'shren' => "{$this->ArgsArr['shr']}",
                'shdizhi' => "{$this->ArgsArr['shdizhi']}",
                'youbian' => "{$this->ArgsArr['youbian']}",
                'tel' => "{$this->ArgsArr['tel']}",
                'mobile' => "{$this->ArgsArr['mobile']}",
                'username' => "{$this->getUsernames()['username']}",
                'is_mr' => $is_mr,

            ],
            'where'=>'id='.$this->ArgsArr['id'],

        );

        $code = $this->update($UserEdi);

        echo json_encode($code);

    }

    /**用户添加评论
     * @param $code
     */

    public function AssessAdd()
    {

        $ShoAssessAdd = array(
            'table' => 'productorder',
            'field' => 'shopid,orderID,title',
            "where" => 'orderID='.$this->ArgsArr['OrderId'],
        );
        $SaRestful = $this->getOne($ShoAssessAdd);

        if (!empty($SaRestful)){
            $SaAdd = array(
                'table' => 'assess',
                'data'=>[
                    'pid' =>$SaRestful['shopid'],
                    'OrderId' => $SaRestful['orderID'],
                    'issh' => 0,
                    'istop' =>0,
                    'recommend' => 0,
                    'pinglun' => "{$this->ArgsArr['pinglun']}",
                    'content' => "{$this->ArgsArr['content']}",
                    'usernameshow' => "{$this->getUsernames()['username']}",
                    'ip' => "{$this->GetIP()}",
                    'inputer' => "{$this->getUsernames()['email']}",
                    'addtime' => time(),
                ]
            );

            $code = $this->add($SaAdd);
            $this->CheckCode($code,$SaRestful['title']);

        }else{
            $this->Redirect('【'.$SaRestful['title']."】商品不存在，请检查商品ID！",'userOrder.php');
        }


    }

    public function ShopAdd(){
        $hot=empty($this->ArgsArr["hot"])?0:$this->ArgsArr["hot"];
        $drop=empty ($this->ArgsArr["drops"])?0:$this->ArgsArr["drops"];
        $recommend=empty($this->ArgsArr["recommend"])?0:$this->ArgsArr["recommend"];
        $inputer = $this->getUsernames()['username'];

        $ShopAdd = array(
            'table' => 'product ',
            'data'=>[
                'numbers' => $this->ArgsArr['numbers'],
                'title' => "{$this->ArgsArr['title']}",
                'typeid' => "{$this->ArgsArr['typeid']}",
                'hot' => "$hot",
                'drops' => "$drop",
                'recommend' => "$recommend",
                'shelves' => $this->ArgsArr['shelves'],
                'kucun' => "{$this->ArgsArr['kucun']}",
                'price' => "{$this->ArgsArr['price']}",
                'yprice' => "{$this->ArgsArr['yprice']}",
                'youhui' => "{$this->ArgsArr['youhui']}",
                'youfei' => "{$this->ArgsArr['youfei']}",
                'hits' => 0,
                'issh' => 0,
                'picurl' => "{$this->ArgsArr['picurl']}",
                'content' => "{$this->ArgsArr['content']}",
                'addtime' => time(),
                'inputer' => "$inputer",
            ]
        );

        $code = $this->add($ShopAdd);
        $this->CheckCode($code);

    }

    public function ShopEdi()
    {
        $hot=empty($this->ArgsArr["hot"])?0:$this->ArgsArr["hot"];
        $drop=empty ($this->ArgsArr["drops"])?0:$this->ArgsArr["drops"];
        $recommend=empty($this->ArgsArr["recommend"])?0:$this->ArgsArr["recommend"];
        $inputer = $this->getUsernames()['username'];
        $ProductId = $this->ArgsArr['numbers'];



        $ShopAdd = array(
            'table' => 'product ',
            'data'=>[
                'title' => "{$this->ArgsArr['title']}",
                'typeid' => "{$this->ArgsArr['typeid']}",
                'hot' => "$hot",
                'drops' => "$drop",
                'recommend' => "$recommend",
                'shelves' => $this->ArgsArr['shelves'],
                'kucun' => "{$this->ArgsArr['kucun']}",
                'price' => "{$this->ArgsArr['price']}",
                'yprice' => "{$this->ArgsArr['yprice']}",
                'youhui' => "{$this->ArgsArr['youhui']}",
                'youfei' => "{$this->ArgsArr['youfei']}",
                'picurl' => "{$this->ArgsArr['picurl']}",
                'issh' => 0,
                'content' => "{$this->ArgsArr['content']}",
                'addtime' => time(),
                'inputer' => "$inputer",
            ],
            "where" =>'numbers = '.$ProductId
        );

        $code = $this->update($ShopAdd);
//        var_dump($code);
        $this->CheckCode($code);
    }


    public function QuXiaoFabu()
    {

//        $this->dd($this->ArgsArr);
        $Delwhere = array(
            'table'=>'product',
            'where'=>'numbers='.$this->ArgsArr['id'],
        );
        $code = $this->delete($Delwhere);

        $this->CheckCode($code);

    }



    //code校验
    public function CheckCode($code,$Other=''){

        switch ($this->ArgsArr['tab'])
        {
            case "register":
                $code? $codeMassge = '用户【注册】成功！请登陆':$codeMassge = '用户【注册】失败';
                $code? $this->Redirect($codeMassge,'login.php'):$this->Redirect($codeMassge,"login.php");
                break;
            case "editPw":
                $code? $codeMassge = '【修改密码】成功，请重新登陆！':$codeMassge = '【修改密码】失败';
                if ($code){
                    session_start();
                    session_destroy();
                    $this->Redirect($codeMassge,'login.php');
                }else{
                    $this->Redirect($codeMassge,"user_EditPw.php");
                }
                break;
            case "edit":
                $code? $codeMassge = '用户修改成功':$codeMassge = '用户修改失败';
                $code?$this->Redirect($codeMassge,'userMain.php'):$this->Redirect($codeMassge,'user_Edit.php');
                break;
            case "ShdzAdd":
                $code? $codeMassge = '添加【收货地址】成功':$codeMassge = '添加【收货地址】失败';
                $code?$this->Redirect($codeMassge,'userShHDZ.php'):$this->Redirect($codeMassge,'user_ShouhAdd.php');
                echo $code?json_encode($code):json_encode($code);
                break;
            case "ShdzDel":
                $code? $codeMassge = '删除【收货地址】成功':$codeMassge = '删除【收货地址】失败';
                $this->Redirect($codeMassge,'userShHDZ.php');
                break;
            case "ShdzEdi":
                $code? $codeMassge = '修改【收货地址】成功':$codeMassge = '修改【收货地址】失败';
                //echo $this->ArgsArr['id'];
                $code? $this->Redirect($codeMassge,'userShHDZ.php'):$this->Redirect($codeMassge,"user_ShouhEdi.php?id=".$this->ArgsArr['id']);
                break;
            case "AssAdd":
                $code? $codeMassge = '【'.$Other.'】商品评论添加成功':$codeMassge = '【'.$Other.'】商品评论添加失败';
                $code? $this->Redirect($codeMassge,'userOrder.php'):$this->Redirect($codeMassge,"userOrder.php");
                break;
            case "shopAdd":
                $code? $codeMassge = '商品添加成功,请等待管理员审核':$codeMassge = '添加商品失败，请联系管理员';
                $code? $this->Redirect($codeMassge,'user_Fabu.php'):$this->Redirect($codeMassge,"user_FabuAdd.php");
                break;
            case "ShopEdi":
                $code? $codeMassge = '商品修改成功,请等待管理员审核':$codeMassge = '商品修改失败，请联系管理员';
                $code? $this->Redirect($codeMassge,'user_Fabu.php'):$this->Redirect($codeMassge,"user_FabuAdd.php?id=$this->ArgsArr['id']");
                break;
            case "ShopDel":
                $code? $codeMassge = '商品取消成功':$codeMassge = '商品取消失败';
                $this->Redirect($codeMassge,'user_Fabu.php');
                break;
            default:
                break;
        }


    }


}
new UserLogin();
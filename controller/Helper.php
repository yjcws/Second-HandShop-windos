<?php

include "db.php";

class Helper extends db{

        public $Mysql;
        public $ArgsArr =[];
        public function __construct()
        {
            $config = include  self::GetDiR()."/config/database.php";
            parent::__construct($config['mysql']['host'],$config['mysql']["user"],$config['mysql']['password'],$config['mysql']['dbname']);
            $this->ArgsArr = $this->getArgs();

        }

        /**获取当前目录
         * @var mixed
         */
        public static function GetDiR(){
            return  dirname(__DIR__);
        }

        public function  Redirect($content="",$url=""){
            if (empty($url)|| empty($content)){
                die( "没有跳转连接或请输入提示内容");
            }
            $urlLink = 'http://'.$_SERVER['SERVER_NAME'].'/view/'.$url;


            echo "<script  charset=\"UTF-8\">alert('{$content}');location.href='{$urlLink}';</script>";
            exit();

        }

        public function  isAdminLogin(){

            session_start();

            if(empty($this->getAdminname()['username'])){

                $this->Redirect('请正确登陆校园二手网后台管理系统 ','admin/login.php');
            }

        }

        public  function isUserLogin(){

            session_start();

            if (empty($_SESSION['UserInfos']['username'])){
               $this->Redirect("你还没登陆喔，请登陆！","login.php");
            }


        }

    /**
     * 获取 分类
     */
        public function getFenlei($id){
            $listWhere = array(
                'table' => 'productlist',
                'field' => 'id,typename',
            );

            $listRes = $this->getAll($listWhere);

            $Typename = array();

            foreach ($listRes as $v){
                $Typename[$v['id']]=$v['typename'];
            }


            return $Typename[$id];

        }


        //获取 post、get请求的值
        public function getArgs()
        {
            $argArr = [];

                foreach ($_REQUEST as $k => $v){
                    if ($k=='check'){
                        continue;
                    }
                    if(!get_magic_quotes_gpc())//检测是否转义过，如果没转义,就为true
                    {

                        $str=addslashes(trim($v));  //进行转义 ，即在每个双引号（"）前添加反斜杠
                        $argArr[$k] = htmlspecialchars($str);
                    }
                }

                if (!empty($_POST['check'])){
                    $argArr['check'] = $_POST['check'];
                }


            return $argArr;

        }

        //获取当前管理员名称
        public function getAdminname()
        {
            session_start();

            return $_SESSION['AdminInfo'];

        }

        //获取当前用户名称
        public function getUsernames()
        {

            session_start();

            return $_SESSION['UserInfos'];

        }

        //

        //获取上传文件
        public function getFile($FileName)
        {
            return $_FILES[$FileName];

        }

        //格式化打印
        public function dd($data=''){
            echo "<pre>";
            var_dump( $data);
            echo "</pre>";
        }


        //转化html标签
        public function GetArticalHtml($data){
        //htmlspecialchars 将<等转化为html格式
        //strip_tags 去掉html标记得到纯字符
            if (empty($data)){
                return "参数不能为空！";
            }

        return htmlspecialchars_decode($data);
        }


        //截取中文字符 串-----校园快报,标题使用
        public function GetstrLeft($str,$leng=40)
        {
            $sl='...';
            $str1 = trim($str);
            $strleng=mb_strlen($str1,"utf-8");
            if($strleng>$leng){
                return mb_substr($str1, 0,$leng,"utf-8").$sl;
            }else{
                return $str1;
            }
        }

        //生成id
        public function SetUuId()
        {
            return time().mt_rand(100,999);

        }

        public function GetIp()
        {
            return $_SERVER["REMOTE_ADDR"];

        }

        /**
         * 初始化收藏信息
         * 功能：1.通过shopid判断当前用户是否收藏
         * 功能2.在我的收藏中显示商品
         */
        public function GetScInfo()
        {
            session_start();
            $_SESSION['ShouCan'] =array();

            $ScWhere = array(
                'table' => 'favorites',
                'field' => 'shopid',
                "where" => 'username='."'{$this->getUsernames()['username']}'",
            );
            $ScRs = $this->getAll($ScWhere);

           // $this->dd($ScRs);
            foreach ($ScRs as $v){
                $_SESSION['ShouCan'][$v['shopid']] = $v['shopid'];
            }


            //数组分割为字符串
            $ShopId =implode(',',$_SESSION['ShouCan']);


            //查询shopid相对应的商品---我的收藏功能
            $ShopWhere = array(
                'table' => 'product as p',
                'field' => 'p.hot,p.drops,p.recommend,f.*',
                'join'=>[
                    'table'=>'favorites as f',
                    "where" => "p.numbers=f.shopid AND p.numbers in ($ShopId) AND f.username="."'{$this->getUsernames()['username']}'",
                ],
            );
            $ShopRs = $this->getAll($ShopWhere);


        //        $this->dd($ShopRs);

            $ScTatol = 0;
            foreach ($ShopRs as $v){
                if ($v['hot']==1) {
                    $state = '热销';
                }
                if ($v['recommend']==1) {
                    $state = '推荐';
                }
                if ($v['drops']==1) {
                    $state = '降价';
                }

                $_SESSION['ScData'][$v['shopid']]['title']=$v['title'];
                $_SESSION['ScData'][$v['shopid']]['price']=$v['price'];
                $_SESSION['ScData'][$v['shopid']]['hits']=$v['hits'];
                $_SESSION['ScData'][$v['shopid']]['picurl']=$v['picurl'];
                $_SESSION['ScData'][$v['shopid']]['addtime']=$v['addtime'];
                $_SESSION['ScData'][$v['shopid']]['shopid']=$v['shopid'];
                $_SESSION['ScData'][$v['shopid']]['username']=$v['username'];
                $_SESSION['ScData'][$v['shopid']]['state']=$state;
                $_SESSION['ScData']['ScTatol']=++$ScTatol;
            }

            return ;

        }

        /**
         * 初始我的购物车
         */

        public function GetCartInfo()
        {
            session_start();
            $_SESSION['productCart'] =array();

            $ResWhere = array(
                'table' => 'usercart',
                'field'=>'title,picurl,Price,numbers,yPrice,youfei,youhui,CartTotal',
                'where'=>"username="."'{$this->getUsernames()['username']}'",
            );
            $Res = $this->getAll($ResWhere);

            if (!empty($Res)) {
                $_SESSION["cartCount"] = 0;
                $_SESSION["cartPrice"] =0;
                foreach ($Res as $v) {
                    $_SESSION["productCart"][$v["numbers"]]["numbers"] = $v["numbers"];
                    $_SESSION["productCart"][$v["numbers"]]["title"] = $v["title"];
                    $_SESSION["productCart"][$v["numbers"]]["Price"] = $v["Price"];
                    $_SESSION["productCart"][$v["numbers"]]["CartTotal"] += $v["CartTotal"];
                    $_SESSION["productCart"][$v["numbers"]]["xiaoji"] += $v["Price"] * $v["CartTotal"];
                    $_SESSION["productCart"][$v["numbers"]]["picurl"] = $v["picurl"];
                    $_SESSION["productCart"][$v["numbers"]]["yPrice"] = $v["yPrice"];
                    $_SESSION["productCart"][$v["numbers"]]["youfei"] = $v["youfei"];
                    $_SESSION["productCart"][$v["numbers"]]["youhui"] = $v["youhui"];
                    $_SESSION["cartCount"] += $v["CartTotal"];
                    $_SESSION["cartPrice"] += $v["Price"] * $v["CartTotal"];

                }
            }

            return ;
        }

        /**
         * 初始化我的订单
         */

        public function GetOrder()
        {

            session_start();
            $_SESSION['orderList'] =array();

            $ResWhere = array(
                'table' => 'orderlist',
                'field'=>'*',
                'where'=>"username="."'{$this->getUsernames()['username']}'",
            );
            $Res = $this->getAll($ResWhere);

           // $this->dd($Res);

            if (!empty($Res)) {
                foreach ($Res as $v) {
                    $_SESSION["orderList"][$v["orderID"]]["shopid"] = $v["shopid"];
                    $_SESSION["orderList"][$v["orderID"]]["orderID"] = $v["orderID"];
                    $_SESSION["orderList"][$v["orderID"]]["PaymentState"] = $this->getPaymentStateAttr($v["paymentState"]);
                    $_SESSION["orderList"][$v["orderID"]]["OrderState"] = $this->getOrderStateAttr($v["orderState"]);
                    $_SESSION["orderList"][$v["orderID"]]["Price"] = $v["Price"];
                    $_SESSION["orderList"][$v["orderID"]]["total"] = $v["total"];
                    $_SESSION["orderList"][$v["orderID"]]["picurl"] = $v["picurl"];
                    $_SESSION["orderList"][$v["orderID"]]["addtime"] = $v["addtime"];
                    $_SESSION["orderList"][$v["orderID"]]["shr"] = $v["shr"];
                    $_SESSION["orderList"][$v["orderID"]]["title"] = $v["title"];
                }
            }

            return ;

        }

        /**
         * 初始化订单详情
         */

        public function GetOrderInfo(){

            session_start();
            $_SESSION['productOrder'] =array();

            $ResWhere = array(
                'table' => 'productorder',
                'field'=>'*',
                'where'=>"username="."'{$this->getUsernames()['username']}'",
            );
            $Res = $this->getAll($ResWhere);

            if (!empty($Res)) {
                foreach ($Res as $v) {
                    $_SESSION["productOrder"][$v["orderID"]]["orderID"] = $v["orderID"];
                    $_SESSION["productOrder"][$v["orderID"]]["yunfei"] = $v["yunfei"];
                    $_SESSION["productOrder"][$v["orderID"]]["youhui"] = $v["youhui"];
                    $_SESSION["productOrder"][$v["orderID"]]["price"] = $v["price"];
                    $_SESSION["productOrder"][$v["orderID"]]["payment"] = $this->getPaymentAttr($v["payment"]);
                    $_SESSION["productOrder"][$v["orderID"]]["songhu"] = $this->getSonghuAttr($v["songhu"]);
                    $_SESSION["productOrder"][$v["orderID"]]["shopid"] = $v["shopid"];
                    $_SESSION["productOrder"][$v["orderID"]]["total"] = $v["total"];
                    $_SESSION["productOrder"][$v["orderID"]]["picurl"] = $v["picurl"];
//                    $_SESSION["productOrder"][$v["orderID"]]["addtime"] = $v["addtime"];
                    $_SESSION["productOrder"][$v["orderID"]]["title"] = $v["title"];
                }
            }

            return ;

        }


        /**
         * 退出 时统一销毁系统所有session变量
         */

        public function DelSession()
        {
            session_start();

            unset($_SESSION['ShouCan']);
            unset($_SESSION['ScData']);
            unset($_SESSION['productCart']);
            unset($_SESSION['productOrder']);
            unset($_SESSION['orderList']);

        }

        /**
         * 我的订单：paymentState获取器
         * 支付状态1.待支付2.已支付3.待退款4.已退款
         */
        public function getPaymentStateAttr($State){
            switch ($State){
                case '1':
                    return "待支付";
                    break;
                case '2':
                    return "已支付";
                    break;
                case '3':
                    return "待退款";
                    break;
                case '4':
                    return "已退款";
                    break;
                default:
                    return '';
                    break;
            }

        }

        /**
         * 我的订单：OrderState获取器
         * 订单状态：1.待处理2.已发货3.已收货4.已取消5.交易完完成
         */
        public function getOrderStateAttr($State){

            switch ($State){
                case '1':
                    return "待处理";
                    break;
                case '2':
                    return "已发货";
                    break;
                case '3':
                    return "已收货";
                    break;
                case '4':
                    return "已取消";
                    break;
                case '5':
                    return "交易完完成";
                    break;
                default:
                    return $State;
                    break;
            }

        }

        /**
         * 订单详情：支付方式
         */

        public function getPaymentAttr($State)
        {
            switch ($State){
                case '1':
                    return "货到付款";
                    break;
                case '2':
                    return "在线付款";
                    break;
                case '3':
                    return "银行汇款";
                    break;
                default:
                    return $State;
                    break;
            }


        }

        /**
         * 订单详情：配送方式
         */

        public function getSonghuAttr($State)
        {
            switch ($State){
                case '1':
                    return "工作日、双休日和假日均可送货";
                    break;
                case '2':
                    return "只双休日、假日送货(工作日不送)";
                    break;
                case '3':
                    return "只工作日送货(双休日、假日不送)";
                    break;
                default:
                    return '';
                    break;
            }

        }

    /**
     * 商品是否审核
     */
        public function getIsshAttr($code){

            $data = [
                '0'=>'未审核',
                '1'=>'已审核'
            ];

            return $data[$code];

        }

    /**
     * 商品状态
     */
    public function getStateAttr($code)
    {
        $data = [
            '0' =>'未上架',
            '1' =>'已上架',
        ];

        return $data[$code];
        
    }

        /**
         * 是否评论过该商品
         */
        public function IsPingLun()
        {
            $ResWhere = array(
                'table' => 'assess',
                'field'=>'OrderId',
                'where'=>"inputer="."'{$this->getUsernames()['username']}'",
            );
            $Res = $this->getAll($ResWhere);

//            $this->dd($Res);
            foreach ($Res as $v){
                $Arr[] = $v['OrderId'];
            }
            return $Arr;


        }

        /**
         * 获取评论分数
         */

    public function GetSorce($shopid)
    {

        if (!isset($shopid)){
            $this->Redirect('参数错误！',"ShopInfo.php");
        }

        $ResWhere = array(
            'table' => 'assess',
            'field'=>'avg(pinglun) as score',
            'where'=>"pid=".$shopid
        );
        $Res = $this->getAll($ResWhere);

        if (empty($Res)){
            return 0;
        }

        return $Res[0]["score"];
        
    }

    /**增加
     * 用户主页支付状态提醒
     * 逻辑：如果有数据就更新，没有就新增
     * $Ziduan=[]格式：$Ziduan=['XXX','xxx']
     *
     * 可填字段：daiZhifu，yifahuo,daipjia,username
     */
    public function UserMainDecr($Ziduan=[],$username='')
    {

        if (!empty($username)) {
            $username1 = $username;
        }else{
            $username1 = $this->getUsernames()['username'];
        }
        $ResWhere = array(
            'table' => 'user_main',
            'field'=>'id',
            'where'=>"username="."'{$username1}'"
        );
        $Res = $this->getOne($ResWhere);
//        var_dump($Ziduan);


        /**
         * 已经有数据，更新
         */
        if (!empty($Res)){
            /**
             * 字段 拼接
             */
                foreach ($Ziduan as $v){
                    $Arr[]= $v.'='.$v.'+1';
            }

            if (count($Ziduan)>1){
                $ZiduanVal = \implode(',',$Arr);
            }else{
                $ZiduanVal = $Arr[0];
            }


            $sql = "UPDATE `user_main` SET {$ZiduanVal} WHERE username='{$this->getUsernames()['username']}'";
//            var_dump($sql);
            $IndrRs = $this->Exec($sql);
            if (!$IndrRs){
                $this->Redirect('用户首页数据更新失败','userMain.php');
            }

            return ;

        }

        $userAdd = array(
            'table' => 'user_main ',
        );

        foreach($Ziduan as  $v){
            $v=='daiZhifu'?$userAdd['data']['daiZhifu'] = 1:$userAdd['data']['daiZhifu']=0;
            $v=='yifahuo'?$userAdd['data']['yifahuo'] = 1:$userAdd['data']['yifahuo']=0;
            $v=='daipjia'?$userAdd['data']['daipjia'] = 1:$userAdd['data']['daipjia']=0;
        }

        $userAdd['data']['username'] = $username1;

        if (!($this->add($userAdd))){
            $this->Redirect('用户首页数据更新失败','userMain.php');
        }


    }

    /**减少
     * 用户主页支付状态提醒
     * 逻辑：如果有数据就更新，没有就新增
     * $Ziduan=[]格式：$Ziduan=['XXX','xxx']
     *
     * 可填字段：daiZhifu，yifahuo,daipjia,username
     */
    public function UserMainIncr($Ziduan=[],$username='')
    {

        if (!empty($username)) {
            $username1 = $username;
        }else{
            $username1 = $this->getUsernames()['username'];
        }
        $ResWhere = array(
            'table' => 'user_main',
            'field'=>'id',
            'where'=>"username="."'{$username1}'"
        );
        $Res = $this->getOne($ResWhere);
//        var_dump($Ziduan);


        /**
         * 已经有数据，更新
         */
        if (!empty($Res)){
            /**
             * 字段 拼接
             */
                foreach ($Ziduan as $v){
                    $Arr[]= $v.'='.$v.'-1';
            }

            if (count($Ziduan)>1){
                $ZiduanVal = \implode(',',$Arr);
            }else{
                $ZiduanVal = $Arr[0];
            }


            $sql = "UPDATE `user_main` SET {$ZiduanVal} WHERE username='{$this->getUsernames()['username']}'";
//            var_dump($sql);
            $IndrRs = $this->Exec($sql);
            if (!$IndrRs){
                $this->Redirect('用户首页数据更新失败','userMain.php');
            }

            return ;

        }

//        $userAdd = array(
//            'table' => 'user_main ',
//        );
//
//        foreach($Ziduan as  $v){
//            $v=='daiZhifu'?$userAdd['data']['daiZhifu'] = 1:$userAdd['data']['daiZhifu']=0;
//            $v=='yifahuo'?$userAdd['data']['yifahuo'] = 1:$userAdd['data']['yifahuo']=0;
//            $v=='daipjia'?$userAdd['data']['daipjia'] = 1:$userAdd['data']['daipjia']=0;
//        }
//
//        $userAdd['data']['username'] = $username1;
//
//        if (!($this->add($userAdd))){
//            $this->Redirect('用户首页数据更新失败','userMain.php');
//        }


    }









}


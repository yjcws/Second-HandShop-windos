<?php

/**
*author: yjc
*createtime : 2021/3/16 12:46
*description:
*/

require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";

class Cart extends Helper
{
    public $KuCun= 0; //商品总库存
    public $CartKCTotal= 0; //购物车商品现有库存
    public function __construct()
    {
        parent::__construct();

        if(!empty($this->ArgsArr['tab'])) {
            switch (trim($this->ArgsArr['tab'])) {
                case 'OrderAdd':
                    $this->addOrder();
                    break;
                case 'OrderAddS':
                    $this->OrderAddS();
                    break;
                case 'CartDel':
                    $this->CartDel();
                    break;
                case 'AddCart':
                    $this->AddCart();
                    break;
                case 'AddSc':
                    $this->AddShouCan();
                    break;
                case "delSc":
                    $this->delShoucan();
                    break;
                case "BatchDel":
                    $this->BatchDel();
                    break;
                case "delAll":
                    $this->BatchCartDel();
                    break;
                default:
                    $this->Redirect('参数错误','index.php');
            }
        }else{
            $this->Redirect('参数错误','index.php');
        }


    }


    /**
     * 数据校验:购物车库存校验
     */

    public function CheckKucun()
    {
        //数据校验

        $this->Islogin();

        //查库存
        $KucunWhere = array(
            'table' => 'product',
            'field' => 'numbers,kucun',
            "where" => 'numbers='.$this->ArgsArr['id'],
        );
        $KuCunRes = $this->getOne($KucunWhere);

        $this->KuCun = $KuCunRes['kucun'];

        if ($this->ArgsArr['sum']>$this->KuCun) {
            echo json_encode(2);//库存不足
            exit;
        }
        //$this->dd($_SESSION["productCart"][$this->ArgsArr['id']]);

        //如果多次加入购物车判断库存 是否足够
        $this->CartKCTotal = $_SESSION["productCart"][$this->ArgsArr['id']]["CartTotal"];//购物车已有库存总量
        //$this->dd($_SESSION["productCart"][$this->ArgsArr['id']]["CartTotal"]);

        if(( $this->CartKCTotal+$this->ArgsArr['sum'])>$this->KuCun){
            $this->dd($this->CartKCTotal);
            echo json_encode(2);//库存不足
            exit;
        }

        //$this->dd('总库存：'.$this->KuCun);
        //$this->dd('加入购物车后的库存：'.$this->CartKCTotal);


    }

    /**
     *检测是否登陆
     */
    public function Islogin()
    {
        session_start();
        if (empty($_SESSION['UserInfos']['username'])){
            echo json_encode(0);
            exit;
        }

    }

    /**加入购物车
     * @return array|mixed|null
     * 输出返回代码：0=》未登陆
     * 1=>购买成功
     * 2=>库存不足
     * 3=>购买失败
     */

    public function AddCart()
    {
        /**
         * 是否登陆
         */
        $this->Islogin();

        /**
         * 库存 检查
         */
        $this->CheckKucun();


        session_start();

        /**
         * 购物车初始化
         */
        if (empty($_SESSION["productCart"])){
            $_SESSION["productCart"]=array();
            $_SESSION["cartCount"]=0;
            $_SESSION["cartPrice"]=0;
        }


        /**
         * 如果购物车没有此商品
         */
        if(empty($_SESSION["productCart"][$this->ArgsArr['id']])){


            $ResWhere = array(
                'table' => 'product',
                'field'=>'title,picurl,price,numbers,yprice,youfei,youhui',
                'where'=>"numbers={$this->ArgsArr['id']}",
            );
            $Res = $this->getOne($ResWhere);

            /**
             * 商品不存在
             */
            if(!$Res){
                echo json_encode(4);
                exit;
            }

            $_SESSION["productCart"][$this->ArgsArr['id']]["numbers"]= $Res['numbers'];
            $_SESSION["productCart"][$this->ArgsArr['id']]["title"]= $Res["title"];
            $_SESSION["productCart"][$this->ArgsArr['id']]["Price"]= $Res["price"];
            $_SESSION["productCart"][$this->ArgsArr['id']]["xiaoji"]= $Res["price"]*$this->ArgsArr['sum'];
            $_SESSION["productCart"][$this->ArgsArr['id']]["picurl"]= $Res["picurl"];
            $_SESSION["productCart"][$this->ArgsArr['id']]["yPrice"]= $Res["yprice"];
            $_SESSION["productCart"][$this->ArgsArr['id']]["youfei"]= $Res["youfei"];
            $_SESSION["productCart"][$this->ArgsArr['id']]["youhui"]= $Res["youhui"];
            $_SESSION["productCart"][$this->ArgsArr['id']]["CartTotal"]= $this->ArgsArr['sum'];
//        $_SESSION["productCart"][$this->ArgsArr['id']]["CartTotal"]+= $Res['sum']; //库存 足够加入购物车
            $_SESSION["cartCount"]+= $this->ArgsArr['sum'];
            $_SESSION["cartPrice"]+=$Res["price"]* $this->ArgsArr['sum'];

            echo json_encode(1);//加入购物车成功
            return $_SESSION["productCart"];

        }

        /**
         * 如果购物车的商品存在
         */
        $_SESSION["productCart"][$this->ArgsArr['id']]["CartTotal"]+= $this->ArgsArr['sum'];
        $_SESSION["productCart"][$this->ArgsArr['id']]["xiaoji"]+=$_SESSION["productCart"][$this->ArgsArr['id']]["Price"]*$this->ArgsArr['sum'];
        $_SESSION["cartCount"]+= $this->ArgsArr['sum'];
        $_SESSION["cartPrice"]+=$_SESSION["productCart"][$this->ArgsArr['id']]["Price"]*$this->ArgsArr['sum'];


        /**
         * 加入数据库:usercart
         */
        foreach ($_SESSION["productCart"][$this->ArgsArr['id']] as $k=>$v ){
            if ($k=='xiaoji'){
                continue;
            }
            $CartData['data'][$k]=$v;
        }
        $CartData['data']['username']="{$this->getUsernames()['username']}";

        $CartData['table']='usercart';

//        $this->dd($CartData);
        $code = $this->add($CartData);
        echo json_encode($code);//加入购物车成功

        return $_SESSION["productCart"];


    }


    /**购物车购买生成订单
     * @return array|mixed|null
     * 输出返回代码：0=》未登陆
     * 1=>购买成功
     * 2=>库存不足
     * 3=>购买失败
     */
    public function addOrder()
    {


        //检测是否登陆
        $this->Islogin();

        $Cart = $_SESSION['productCart'][$this->ArgsArr['ShopId']];


        if (empty($Cart) && ($Cart['numbers']!=$this->ArgsArr['ShopId'])){
            echo json_encode(3);//商品不存在
            exit;
        }
//
        /**
         * 查库存
         */
        $KucunWhere = array(
            'table' => 'product',
            'field' => 'numbers,kucun',
            "where" => 'numbers='.$this->ArgsArr['ShopId'],
        );
        $KuCunRes = $this->getOne($KucunWhere);

        if ($Cart['CartTotal']>$KuCunRes['kucun']) {
            echo json_encode(2);//库存不足
            exit;
        }

        /**
         * 减库存
         */

        $SyuKc = $KuCunRes['kucun']-$Cart['CartTotal'];

        $OrderInc = array(
            'table' => 'product',
            'data'=>[
                'kucun' => $SyuKc,
            ],
            'where'=>'numbers='.$this->ArgsArr['ShopId'],

        );

        if (!($this->update($OrderInc))){
            echo json_encode(0);//库存扣除失败
            exit;
        }

        /**
         * paymentState：根据支付方式来判断
         * payment：支付方式1.货到付款2.在线付款3.银行汇款
         * 支付状态1.待支付2.已支付3.待退款4.已退款
         */
        if ($this->ArgsArr['payment']==1){
            /**
             * 用户首页支付提醒
             */
            $this->UserMainDecr(['daiZhifu']);
            $paymentState =1;
        }else{
            $paymentState =2;
        }
        /**
         * 订单状态：1.待处理2.已发货3.已收货4.已取消5.交易完完成
         * orderState：默认为1
         */


        /**
         * 生成订单:生成订单号,订单表，商品id,购买人，订单时间，付款时间，发货时间
         *
         * orderList：用户订单表
         *productOrder：订单详情表
         */
        $UOrderAdd = array(
            'table' => 'orderList',
            'data'=>[
                'orderid' => $this->ArgsArr['OrderId'],
                'shopid' => "{$this->ArgsArr['ShopId']}",
                'title' => "{$Cart['title']}",
                'Price' => "{$Cart['Price']}",
                'total' => "{$Cart['CartTotal']}",
                'picurl' => "{$Cart['picurl']}",
                'paymentState' =>$paymentState,
                'orderState' =>1,
                'shr' =>"{$this->ArgsArr['shren']}",
                'addtime' => time(),
                'username' => "{$this->getUsernames()['username']}",
            ],

        );

        if (!($this->add($UOrderAdd))){
            echo json_encode(0);//添加订单失败
            exit;
        }


        $OrderAdd = array(
            'table' => 'productorder',
            'data'=>[
                'orderId' => $this->ArgsArr['OrderId'],
                'paymentState' => $paymentState,
                'orderState' => 1,
                'shopid' => "{$this->ArgsArr['ShopId']}",
                'receive_id' => "{$this->ArgsArr['revice_id']}",
                'payment' => "{$this->ArgsArr['payment']}",
                'songhu' => "{$this->ArgsArr['songhu']}",
                'yunfei' => "{$Cart['youfei']}",
                'youhui' => "{$Cart['youhui']}",
                'kuaidi' => "{$this->SetUuId()}",
                'price' => "{$Cart['Price']}",
                'total' => "{$Cart['CartTotal']}",
                'feedback' => "{$this->ArgsArr['liuyan']}",
                'picurl' => "{$Cart['picurl']}",
                'ip' => "{$this->GetIp()}",
                'username' => "{$this->getUsernames()['username']}",
                'addtime' => time(),
                'title' => "{$Cart['title']}",
            ],

        );

        if (!($this->add($OrderAdd))){
            echo json_encode(0);//添加订单失败
            exit;
        }




        /**
         * 更新购物车缓存:总件数和总价格
         */
        $_SESSION['cartPrice']-=$_SESSION['productCart'][$this->ArgsArr['ShopId']]['xiaoji'];
        $_SESSION['cartCount']-=$_SESSION['productCart'][$this->ArgsArr['ShopId']]['CartTotal'];




        /**
         * 更新session值,加缓存
         * 更新对象：orderList（我的订单），productOrder（订单详情）
         */


        if(!isset($_SESSION["orderList"][$this->ArgsArr['OrderId']])){


            foreach ($UOrderAdd['data'] as $k => $v){
                if ($k == 'paymentState'){
                    $_SESSION["orderList"][$this->ArgsArr['OrderId']]['PaymentState']=$this->getPaymentStateAttr($v);
                    continue;
                }
                if ($k == 'orderState'){
                    $_SESSION["orderList"][$this->ArgsArr['OrderId']]['OrderState']=$this->getOrderStateAttr($v);
                    continue;
                }
                $_SESSION["orderList"][$this->ArgsArr['OrderId']][$k]=$v;
            }
        }


        /**
         * 购物车信息赋值给订单详情表
         */
        $_SESSION["productOrder"][$this->ArgsArr['OrderId']]=$_SESSION['productCart'][$this->ArgsArr['ShopId']];


            foreach ($OrderAdd['data'] as $k => $v){

                if ($k == 'payment'){
                    $_SESSION["productOrder"][$this->ArgsArr['OrderId']][$k]=$this->getPaymentAttr($v);
                }
                if ($k == 'songhu'){
                    $_SESSION["productOrder"][$this->ArgsArr['OrderId']][$k]=$this->getSonghuAttr($v);
                }
                continue;
            }
        /**
         * 删除购物车相对应商品
         */

        unset($_SESSION['productCart'][$this->ArgsArr['ShopId']]);


        echo json_encode(1);//添加订单成功
        return $_SESSION;

    }

    /**
     * 商品详情页面购买
     */
    public function OrderAddS()
    {
        //检测是否登陆
        $this->Islogin();

        $CartWhere = array(
            'table' => 'product',
            'field' => '*',
            "where" => 'numbers='.$this->ArgsArr['ShopId'],
        );
        $CartRes = $this->getOne($CartWhere);

        /**
         * 检测商品是否存在：3.商品不存在
         */
        if (empty($CartRes) && ($CartRes['numbers']!=$this->ArgsArr['ShopId'])){
            echo json_encode(3);
            exit;
        }

        /**
         * 查库存：2.库存不足
         */


        if ($this->ArgsArr['CartTotal']>$CartRes['kucun']) {
            echo json_encode(2);
            exit;
        }



        /**
         * 减库存
         */

        $SyuKc = $CartRes['kucun']-$this->ArgsArr['CartTotal'];

        $OrderInc = array(
            'table' => 'product',
            'data'=>[
                'kucun' => $SyuKc,
            ],
            'where'=>'numbers='.$this->ArgsArr['ShopId'],

        );

        if (!($this->update($OrderInc))){
            echo json_encode(0);//库存扣除失败
            exit;
        }

        /**
         * paymentState：根据支付方式来判断
         * payment：支付方式1.货到付款2.在线付款3.银行汇款
         * 支付状态1.待支付2.已支付3.待退款4.已退款
         */
        if ($this->ArgsArr['payment']==1){
            $this->UserMainDecr(['daiZhifu']);
            $paymentState =1;
        }else{
            $paymentState =2;
        }
        /**
         * 订单状态：1.待处理2.已发货3.已收货4.已取消5.交易完完成
         * orderState：默认为1
         */


        /**
         * 生成订单:生成订单号,订单表，商品id,购买人，订单时间，付款时间，发货时间
         *
         * orderList：用户订单表
         *productOrder：订单详情表
         */

        $UOrderAdd = array(
            'table' => 'orderList',
            'data'=>[
                'orderid' => $this->ArgsArr['OrderId'],
                'shopid' => "{$this->ArgsArr['ShopId']}",
                'title' => "{$CartRes['title']}",
                'Price' => "{$CartRes['price']}",
                'total' => "{$this->ArgsArr['CartTotal']}",
                'picurl' => "{$CartRes['picurl']}",
                'paymentState' =>$paymentState,
                'orderState' =>1,
                'shr' =>"{$this->ArgsArr['shren']}",
                'addtime' => time(),
                'username' => "{$this->getUsernames()['username']}",
            ],

        );

        if (!($this->add($UOrderAdd))){
            echo json_encode(0);//添加订单失败
            exit;
        }


        $OrderAdd = array(
            'table' => 'productorder',
            'data'=>[
                'orderId' => $this->ArgsArr['OrderId'],
                'paymentState' => $paymentState,
                'orderState' => 1,
                'shopid' => "{$this->ArgsArr['ShopId']}",
                'receive_id' => "{$this->ArgsArr['revice_id']}",
                'payment' => "{$this->ArgsArr['payment']}",
                'songhu' => "{$this->ArgsArr['songhu']}",
                'yunfei' => "{$CartRes['youfei']}",
                'youhui' => "{$CartRes['youhui']}",
                'kuaidi' => "{$this->SetUuId()}",
                'price' => "{$CartRes['price']}",
                'total' => "{$this->ArgsArr['CartTotal']}",
                'feedback' => "{$this->ArgsArr['liuyan']}",
                'picurl' => "{$CartRes['picurl']}",
                'ip' => "{$this->GetIp()}",
                'username' => "{$this->getUsernames()['username']}",
                'addtime' => time(),
                'title' => "{$CartRes['title']}",
            ],

        );

        if (!($this->add($OrderAdd))){
            echo json_encode(0);//添加订单失败
            exit;
        }




        /**
         * 更新session值,加缓存
         * 更新对象：orderList（我的订单），productOrder（订单详情）
         */


        if(!isset($_SESSION["orderList"][$this->ArgsArr['OrderId']])){


            foreach ($UOrderAdd['data'] as $k => $v){
                if ($k == 'title'){
                    continue;
                }
                if ($k == 'paymentState'){
                    $_SESSION["orderList"][$this->ArgsArr['OrderId']]['PaymentState']=$this->getPaymentStateAttr($v);
                    continue;
                }
                if ($k == 'orderState'){
                    $_SESSION["orderList"][$this->ArgsArr['OrderId']]['OrderState']=$this->getOrderStateAttr($v);
                    continue;
                }
                $_SESSION["orderList"][$this->ArgsArr['OrderId']][$k]=$v;
            }
        }


        /**
         * 购物车信息赋值给订单详情表
         * 过滤;receive_id,kuaidi,addtime,ip，feedback，paymentState，orderState，username
         */



        $GuiluiArr = ['receive_id','kuaidi','addtime','ip','feedback','paymentState','orderState','username'];

        foreach ($OrderAdd['data'] as $k => $v){

            if(in_array($k,$GuiluiArr)){
                continue;
            }
            if ($k == 'payment'){
                $_SESSION["productOrder"][$this->ArgsArr['OrderId']][$k]=$this->getPaymentAttr($v);
                continue;

            }
            if ($k == 'songhu'){
                $_SESSION["productOrder"][$this->ArgsArr['OrderId']][$k]=$this->getSonghuAttr($v);
                continue;

            }
            $_SESSION["productOrder"][$this->ArgsArr['OrderId']][$k]=$v;
        }


        echo json_encode(1);//添加订单成功
        return $_SESSION;


    }
    
    /**
     * @return bool
     * 删除购物车商品
     */
    public function CartDel(){
        session_start();
        if(!isset($_SESSION["productCart"][$this->ArgsArr['id']]))
        {

            $this->Redirect('商品不存在！','userCart.php');
        }

        $delWhere = [
            'table' =>'usercart',
            'where' =>"numbers={$this->ArgsArr['id']}",
        ];

        $code = $this->delete($delWhere);

//        var_dump($code);

        if (!$code) {
            $this->Redirect('删除购物车失败！','userCart.php');
        }



        $_SESSION["cartCount"]-=$_SESSION["productCart"][$this->ArgsArr['id']]['CartTotal'];
        $_SESSION["cartPrice"]-=$_SESSION["productCart"][$this->ArgsArr['id']]["xiaoji"];

        unset ($_SESSION["productCart"][$this->ArgsArr['id']]);
        $this->Redirect('删除成功！','userCart.php');
    }

    /**
     * 批量删除购物车
     */
    public function BatchCartDel(){
        session_start();

        foreach ($this->ArgsArr['check'] as $v){

            $delWhere = [
                'table' =>'usercart',
                'where' =>"numbers=$v",
            ];

            $code = $this->delete($delWhere);

            unset($_SESSION['productCart'][$v]);

        }

        if ($code) {

            $this->Redirect('删除购物车成功！','userCart.php');
        }else{
            $this->Redirect('删除购物车成功！','userCart.php');

        }



    }



    /**
     * 商品详情页面加入收藏
     */
    public function AddShouCan()
    {
        //$this->dd($this->ArgsArr);
        $this->Islogin();

        /**
         * 判断商品是否被 收藏
         * $_SESSION['ShouCan']:存储shopid
         */
       empty($_SESSION['ShouCan'])?$is_sc = false:$is_sc=in_array($this->ArgsArr['id'],$_SESSION['ShouCan']);


        if (!$is_sc) {

            /**
             * 加入缓存
             */
            $_SESSION['ScData'][$this->ArgsArr['id']]['shopid']=$this->ArgsArr['id'];
            $_SESSION['ScData'][$this->ArgsArr['id']]['title']=$this->ArgsArr['title'];
            $_SESSION['ScData'][$this->ArgsArr['id']]['hits']=$this->ArgsArr['hits'];
            $_SESSION['ScData'][$this->ArgsArr['id']]['picurl']=$this->ArgsArr['picurl'];
            $_SESSION['ScData'][$this->ArgsArr['id']]['state']=$this->ArgsArr['state'];
            $_SESSION['ScData'][$this->ArgsArr['id']]['addtime']=time();
            $_SESSION['ScData'][$this->ArgsArr['id']]['price']=$this->ArgsArr['price'];
            $_SESSION['ScData'][$this->ArgsArr['id']]['username']="{$this->getUsernames()['username']}";

            /**
             * 加入数据库
             */
            $UserEdi = array(
                'table' => 'favorites',
                'data'=>[
                    'shopid' => $this->ArgsArr['id'],
                    'title' => "{$this->ArgsArr['title']}",
                    'hits' => "{$this->ArgsArr['hits']}",
                    'picurl' => "{$this->ArgsArr['picurl']}",
                    'price' => $this->ArgsArr['price'],
                    'username' => "{$this->getUsernames()['username']}",
                    'addtime' => time(),
                ],

            );
            $code = $this->add($UserEdi);



            if (!$code){

                echo json_encode(3);//加入购物车失败
            }else{
                //作为缓存 写入数据，在商品详情页面判断是否收藏
                $_SESSION['ShouCan'][$this->ArgsArr['id']] = $this->ArgsArr['id'];

                echo json_encode($code);//加入购物车成功
            }

        }else{
            echo json_encode(3);//加入购物车失败

        }

    }


    /**
     * 取消收藏
     */
    public function delShoucan()
    {
        session_start();
        $delWhere = [
            'table' =>'favorites',
            'where' =>"shopid={$this->ArgsArr['id']}",
        ];

        $code = $this->delete($delWhere);

        if (!$code) {
            $this->Redirect('取消收藏失败！','user_Shoucan.php');
        }

        unset($_SESSION['ScData'][$this->ArgsArr['id']]);
        unset($_SESSION['ShouCan'][$this->ArgsArr['id']]);
        $_SESSION['ScData']['ScTatol']-=1;
        $this->Redirect('取消收藏成功！','user_Shoucan.php');

    }

    /**
     * 批量取消收藏
     */
    public function BatchDel(){
        session_start();

        foreach ($this->ArgsArr['check'] as $v){
            unset($_SESSION['ScData'][$v]);
            $delWhere = [
                'table' =>'favorites',
                'where' =>"shopid=$v",
            ];

            $code = $this->delete($delWhere);

        }

        if (!$code) {

            $this->Redirect('取消收藏失败！','user_Shoucan.php');
        }

        $this->Redirect('收藏成功！','user_Shoucan.php');

    }


}
new Cart();
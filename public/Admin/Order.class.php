<?php

/*
*author: yjc
*createtime : 2021/3/16 12:46
*description:
*/
require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";


class Order extends Helper
{
    public function __construct()
    {
        parent::__construct();

//        $this->isAdminLogin();

        if(!empty($this->ArgsArr['tab'])) {
            switch (trim($this->ArgsArr['tab'])) {
                case 'fahuo':
                    $this->Fahuo();
                    break;
                case 'Pfahuo':
                    $this->Pfahuo();
                    break;
                case 'quxiao':
                    $this->QuxiaoOrder();
                    break;
                case "qrsh":
                    $this->QueRenSh();
                    break;
                case "Pqrsk":
                    $this->Pqrsk();
                    break;
                case "tk":
                    $this->TuiKuan();
                    break;
                case "qrtk":
                    $this->QRTuiKuan();
                    break;
            }
        }else{

        }


    }

    /**
     * 后台订单状态：发货
     */

    public function Fahuo()
    {

//        var_dump($this->ArgsArr);
        $Order = array(
            'table' => 'productorder',
            'data'=>[
                'orderState' =>2,
            ],
            "where" =>'orderID = '.$this->ArgsArr['id']

        );
        $code1 = $this->update($Order);
        $Oderlist = array(
            'table' => 'orderlist',
            'data'=>[
                'orderState' =>2,
            ],
            "where" =>'orderID = '.$this->ArgsArr['id']

        );

        $code2 = $this->update($Oderlist);

        if (!($code1 && $code2)){
            $this->Redirect('订单状态修改失败-【发货】！','admin/Order.php');
        }

        session_start();
        $_SESSION["orderList"][$this->ArgsArr['id']]["OrderState"] = $this->getOrderStateAttr(2);

        /**
         * 用户个人中心列表更新发货状态
         */
        $ResWhere = array(
            'table' => 'productorder',
            'field'=>'username',
            "where" =>'orderID = '.$this->ArgsArr['id']
        );
        $Res = $this->getOne($ResWhere);

        $this->UserMainDecr(['yifahuo'],$Res[0]['username']);


        $this->Redirect('订单状态修改成功-【发货】！','admin/Order.php');

    }

    /**
     * 后台批量发货
     */
    public function Pfahuo()
    {
//        $this->dd($this->ArgsArr);

        foreach ($this->ArgsArr['check'] as $OrderId){
            $Oderlist = array(
                'table' => 'orderlist',
                'data'=>[
                    'orderState' =>2,
                ],
                "where" =>'orderID = '.$OrderId

            );
            $code1 = $this->update($Oderlist);

            $Oderlist = array(
                'table' => 'productorder',
                'data'=>[
                    'orderState' =>2,
                ],
                "where" =>'orderID = '.$OrderId

            );
            $code2 = $this->update($Oderlist);
            if (!($code1 && $code2)){
                $this->Redirect('订单【批量发货】失败！','admin/Order.php');
            }


            /**
             * 用户个人中心列表更新发货状态
             */
            $ResWhere = array(
                'table' => 'productorder',
                'field'=>'username',
                "where" =>'orderID = '.$OrderId
            );
            $Res = $this->getOne($ResWhere);

            $this->UserMainDecr(['yifahuo'],$Res[0]['username']);

            session_start();
            $_SESSION["orderList"][$OrderId]["OrderState"] = $this->getOrderStateAttr(2);

            $this->Redirect('订单【批量发货】成功！','admin/Order.php');
        }

    }

    /**
     * 用户取消订单
     */

    public function QuxiaoOrder()
    {
        $orderList = array(
            'table'=>'orderlist',
            'data'=>[
                'OrderState' =>4,
            ],
            'where'=>'orderID='.$this->ArgsArr['id'],
        );
        $code1 = $this->update($orderList);

        $Delwhere = array(
            'table'=>'productorder',
            'data'=>[
                'OrderState' =>4,
            ],

            'where'=>'orderID='.$this->ArgsArr['id'],
        );
        $code2 = $this->update($Delwhere);

        if (!($code1 && $code2)){
            $this->Redirect('订单取消失败-【取消订单】！','userOrder.php');
        }

        session_start();
        $_SESSION["orderList"][$this->ArgsArr['id']]['OrderState']='已取消';
//        $_SESSION["productOrder"][$this->ArgsArr['id']]['OrderState']='已取消';

        $this->Redirect('订单取消成功-【取消订单】！','userOrder.php');

    }


    /**
     *确认收货
     */
    public function QueRenSh()
    {
        $orderList = array(
            'table'=>'orderlist',
            'data'=>[
                'OrderState' =>3,
            ],
            'where'=>'orderID='.$this->ArgsArr['id'],
        );
        $code1 = $this->update($orderList);

        $Delwhere = array(
            'table'=>'productorder',
            'data'=>[
                'OrderState' =>3,
            ],

            'where'=>'orderID='.$this->ArgsArr['id'],
        );
        $code2 = $this->update($Delwhere);

        if (!($code1 && $code2)){
            $this->Redirect('确认收货失败-【确认收货】！','userOrder.php');
        }

        session_start();
        $_SESSION["orderList"][$this->ArgsArr['id']]['OrderState']='已收货';
//        $_SESSION["productOrder"][$this->ArgsArr['id']]['OrderState']='已收货';

        $this->Redirect('确认收货成功-【确认收货】！','userOrder.php');
    }


    /**用户退款
     * @param
     */

    public function TuiKuan(){
        $orderList = array(
            'table'=>'orderlist',
            'data'=>[
                'PaymentState' =>3,
            ],
            'where'=>'orderID='.$this->ArgsArr['id'],
        );
        $code1 = $this->update($orderList);

        $Delwhere = array(
            'table'=>'productorder',
            'data'=>[
                'PaymentState' =>3,
            ],

            'where'=>'orderID='.$this->ArgsArr['id'],
        );
        $code2 = $this->update($Delwhere);


        if (!($code1 && $code2)){
//            var_dump($code1,$code2);

            $this->Redirect('请求退款失败-【退款】！','userOrder.php');
        }

        session_start();
        $_SESSION["orderList"][$this->ArgsArr['id']]['PaymentState']='待退款';
//        $_SESSION["productOrder"][$this->ArgsArr['id']]['PaymentState']='已收货';

        $this->Redirect('请求退款成功-【退款】！','userOrder.php');
    }

    /**
     * 后台：确认退款
     */
    public function QRTuiKuan()
    {
        $orderList = array(
            'table'=>'orderlist',
            'data'=>[
                'PaymentState' =>4,
            ],
            'where'=>'orderID='.$this->ArgsArr['id'],
        );
        $code1 = $this->update($orderList);

        $Delwhere = array(
            'table'=>'productorder',
            'data'=>[
                'PaymentState' =>4,
            ],

            'where'=>'orderID='.$this->ArgsArr['id'],
        );
        $code2 = $this->update($Delwhere);


        if (!($code1 && $code2)){
//            var_dump($code1,$code2);

            $this->Redirect('确认【退款】失败！','admin/Order.php');
        }

        session_start();
        $_SESSION["orderList"][$this->ArgsArr['id']]['PaymentState']='已退款';
//        $_SESSION["productOrder"][$this->ArgsArr['id']]['PaymentState']='已收货';

        $this->Redirect('确认【退款】成功！','admin/Order.php');


    }

    /**
     * 后台：批量确认收款
     */

    public function Pqrsk()
    {
        $this->dd($this->ArgsArr);

        foreach ($this->ArgsArr['check'] as $OrderId){
            $Oderlist = array(
                'table' => 'orderlist',
                'data'=>[
                    'PaymentState' =>2,
                ],
                "where" =>'orderID = '.$OrderId

            );
            $code1 = $this->update($Oderlist);

            $Oderlist = array(
                'table' => 'productorder',
                'data'=>[
                    'PaymentState' =>2,
                ],
                "where" =>'orderID = '.$OrderId

            );
            $code2 = $this->update($Oderlist);
            if (!($code1 && $code2)){
                $this->Redirect('订单【确认收款】失败！','admin/Order.php');
            }


            /**
             * 用户个人中心列表更新发货状态
             */
            $ResWhere = array(
                'table' => 'productorder',
                'field'=>'username',
                "where" =>'orderID = '.$OrderId
            );
            $Res = $this->getOne($ResWhere);

            $this->UserMainIncr(['yifahuo'],$Res[0]['username']);
            session_start();
            $_SESSION["orderList"][$OrderId]["PaymentState"] = $this->getPaymentStateAttr(2);


            $this->Redirect('订单【确认收款】成功！','admin/Order.php');
        }
    }






}
new Order();
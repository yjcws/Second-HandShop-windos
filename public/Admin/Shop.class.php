<?php

/*
*author: yjc
*createtime : 2021/3/16 12:46
*description:
*/
require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";


class Shop extends Helper
{
    public function __construct()
    {
        parent::__construct();

        $this->isAdminLogin();

        if(!empty($this->ArgsArr['tab'])) {
            switch (trim($this->ArgsArr['tab'])) {
                case 'ShopAdd':
                    $this->ShopAdd();
                    break;
                case 'ShopEdi':
                    $this->ShopEdi();
                    break;
                case "ShopDel":
                    $this->ShopDel();
                    break;
                case "delAll":
                    $this->DelAll();
                    break;
                case "up":
                    $this->ShopUp();
                    break;
                default:
                    $this->Redirect('参数错误', 'admin/admin.php');
                    break;
            }
        }else{
            echo "首页";
            //$this->AddClassification();
        }


    }

    public function ShopAdd()
    {

        $hot=empty($this->ArgsArr["hot"])?0:$this->ArgsArr["hot"];
        $drop=empty ($this->ArgsArr["drops"])?0:$this->ArgsArr["drops"];
        $recommend=empty($this->ArgsArr["recommend"])?0:$this->ArgsArr["recommend"];
        $inputer = $this->getAdminname()['username'];


//        //商品图集
//        $picurls="";
//        foreach($_SESSION["urlfile_info"] as $row=>$v)
//        {
//            $picurls.=$v."@";
//        }

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
                'issh' => $this->ArgsArr['issh'],
                'picurl' => "{$this->ArgsArr['picurl']}",
//                'picurls' => "$picurls",
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
//        $inputer = $this->getAdminname()['username'];
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
//                'hits' => "{$this->ArgsArr['hits']}",
                'price' => "{$this->ArgsArr['price']}",
                'yprice' => "{$this->ArgsArr['yprice']}",
                'youhui' => "{$this->ArgsArr['youhui']}",
                'youfei' => "{$this->ArgsArr['youfei']}",
                'picurl' => "{$this->ArgsArr['picurl']}",
                'issh' => $this->ArgsArr['issh'],
//                'picurls' => "$picurls",
                'content' => "{$this->ArgsArr['content']}",
                'addtime' => time(),
//                'inputer' => "$inputer",
            ],
            "where" =>'numbers = '.$ProductId
        );

        $code = $this->update($ShopAdd);
//        var_dump($code);
        $this->CheckCode($code);
//echo 'ShopEdi';

    }


    public function ShopDel()
    {
        $Delwhere = array(
            'table'=>'product',
            'where'=>'id='.$this->ArgsArr['id'],
        );
        $code = $this->delete($Delwhere);

        $this->CheckCode($code);
    }

    public function delAll()
    {
        if(count($this->ArgsArr['check'])<1)
        {
            echo "<script>alert('请选择一个要删除的信息！');location.href='admin/aticle.php';</script>";
            exit;
        }

        foreach ($this->ArgsArr['check'] as $id)
        {
            $Delwhere = array(
                'table'=>'product',
                'where'=>'id='.$id,
            );
            $code = $this->delete($Delwhere);

        }
        $this->CheckCode($code);

    }

    public function ShopUp()
    {
        $id=@$_POST["check"];
        $ziduan= $this->ArgsArr["ziduan"];
        $zt= $this->ArgsArr["zt"];

        if(count($id)==0)
        {
            $this->Redirect('请选择您要更新的信息','admin/Shop.php');
        }

        foreach($id as $v)
        {

            $SaUP = array(
                'table' => 'product',
                'data'=>[
                    "$ziduan" => $zt,
                ],
                'where'=>"id=$v",
            );

            $code = $this->update($SaUP);
        }
        $this->CheckCode($code);

    }



    public function CheckCode($code){

        $codeMassge = '';


        switch ($this->ArgsArr['tab'])
        {
            case "ShopAdd":
                $code? $codeMassge = '商品添加成功':$codeMassge = '添加失败';
                $code? $this->Redirect($codeMassge,'admin/Shop.php'):$this->Redirect($codeMassge,"admin/Shop.php");
                break;
            case "ShopEdi":
                $code? $codeMassge = '修改成功':$codeMassge = '修改失败';
                $code? $this->Redirect($codeMassge,'admin/Shop.php'):$this->Redirect($codeMassge,"admin/Shop.php");
                break;
            case "ShopDel":
                $code? $codeMassge = '删除成功':$codeMassge = '删除失败';
                $this->Redirect($codeMassge,'admin/Shop.php');
                break;
            case "up":
                $code? $codeMassge = '批量更新成功':$codeMassge = '发生错误';
                $this->Redirect($codeMassge,'admin/Shop.php');
                break;
            default:
                break;
        }


    }


}
new Shop();
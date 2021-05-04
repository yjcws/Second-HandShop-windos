<?php

/*
*author: yjc
*createtime : 2021/3/16 12:46
*description:
*/
require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";


class ShopAssess extends Helper
{
    public function __construct()
    {
        parent::__construct();

        $this->isAdminLogin();

        if(!empty($this->ArgsArr['tab'])) {
            switch (trim($this->ArgsArr['tab'])) {
                case 'SaAdd':
                    $this->ShoAssessAdd();
                    break;
                case 'Sadel':
                    $this->ShoAssessDel();
                    break;
                case "SaEdi":
                    $this->ShoAssessEdi();
                    break;
                case "delAll":
                    $this->delAll();
                    break;
                case "up":
                    $this->ShopAssessUp();
                    break;
                default:
                    $this->Redirect('参数错误', 'admin/ShoAssess.php');
                    break;
            }
        }else{

        }


    }

    public function ShoAssessAdd()
    {

        //$this->dd($this->ArgsArr);

        $ShoAssessAdd = array(
            'table' => 'product',
            'field' => 'numbers,title',
            "where" => 'numbers='.$this->ArgsArr['pid'],
        );
        $SaRestful = $this->getOne($ShoAssessAdd);
        //var_dump($SaRestful);

        if (!empty($SaRestful)){
            $SaAdd = array(
                'table' => 'assess',
                'data'=>[
                    'pid' => $this->ArgsArr['pid'],
                    'issh' => "{$this->ArgsArr['issh']}",
                    'istop' =>"{$this->ArgsArr['istop']}",
                    'recommend' => "{$this->ArgsArr['recommend']}",
                    'pinglun' => "{$this->ArgsArr['pinglun']}",
                    'content' => "{$this->ArgsArr['content']}",
                    'usernameshow' => "{$this->ArgsArr['usernameshow']}",
                    'ip' => "管理员",
                    'inputer' => "{$this->getUsernames()['username']}",
                    'addtime' => time(),
                ]
            );

            $code = $this->add($SaAdd);
            $this->CheckCode($code,$SaRestful['title']);

        }else{
            $this->Redirect($this->ArgsArr['pid']."商品id不存在，请检查商品ID！",'admin/ShopAssessAdd.php');
        }



    }

    public function ShoAssessEdi()
    {
        $ShoAssessAdd = array(
            'table' => 'product',
            'field' => 'numbers,title',
            "where" => 'numbers='.$this->ArgsArr['pid'],
        );
        $SaRestful = $this->getOne($ShoAssessAdd);

        if (!empty($SaRestful)){
            $SaEdi = array(
                'table' => 'assess',
                'data'=>[
                    'pid' => $this->ArgsArr['pid'],
                    'issh' => "{$this->ArgsArr['issh']}",
                    'istop' =>"{$this->ArgsArr['istop']}",
                    'recommend' => "{$this->ArgsArr['recommend']}",
                    'pinglun' => "{$this->ArgsArr['pinglun']}",
                    'content' => "{$this->ArgsArr['content']}",
                    'usernameshow' => "{$this->ArgsArr['usernameshow']}",
                    'ip' => "管理员",
                    'inputer' => "{$this->getUsernames()['username']}",
                    'addtime' => time(),
                ],
                'where'=>'pid='.$this->ArgsArr['pid'],
            );

            $code = $this->update($SaEdi);
            $this->CheckCode($code,$SaRestful['title']);

        }else{
            $this->Redirect($this->ArgsArr['pid']."商品id不存在，请检查商品ID！",'admin/ShopAssessEdi.php');
        }

    }


    public function ShoAssessDel()
    {
        $Delwhere = array(
            'table'=>'assess',
            'where'=>'id='.$this->ArgsArr['id'],
        );
        $code = $this->delete($Delwhere);

        $this->CheckCode($code);
    }

    public function delAll()
    {

        //var_dump($_POST);

        if(empty($_POST['check']))
        {
            echo "<script>alert('请选择一个要删除的信息！');location.href='admin/ShopAssess.php';</script>";
            exit;
        }

        foreach ($_POST['check'] as $id)
        {
            $Delwhere = array(
                'table'=>'assess',
                'where'=>'id='.$id,
            );
            //var_dump($Delwhere);
           $code = $this->delete($Delwhere);

        }
//        $this->CheckCode($code);

    }

    public function ShopAssessUp()
    {
        $id=@$_POST["check"];
        $ziduan= $this->ArgsArr["ziduan"];
        $zt= $this->ArgsArr["zt"];

        if(count($id)==0)
        {
            $this->Redirect('请选择您要更新的信息','admin/ShopAssess.php');
        }

        foreach($id as $v)
        {
//            $ShoAssessUp = array(
//                'table' => 'assess',
//                'field' => '*',
//                "where" => 'id='.$v,
//            );
//            $SaRestful = $this->getOne($ShoAssessUp);
//
//            if(empty($SaRestful))
//            {
//                $this->Redirect('ID不存在','admin/ShopAssess.php');
//                exit;
//            }

            $SaUP = array(
                'table' => 'assess',
                'data'=>[
                    "$ziduan" => $zt,
                ],
                'where'=>"id=$v",
            );

            $code = $this->update($SaUP);
        }
        $this->CheckCode($code);

    }

    public function CheckCode($code,$Other=null){

        $codeMassge = '';


        switch ($this->ArgsArr['tab'])
        {
            case "SaAdd":
                $code? $codeMassge = $Other.'商品评论添加成功':$codeMassge = $Other.'商品评论添加失败';
                $code? $this->Redirect($codeMassge,'admin/ShopAssess.php'):$this->Redirect($codeMassge,"admin/ShopAssessAdd.php");
                break;
            case "SaEdi":
                $code? $codeMassge = '修改成功':$codeMassge = '修改失败';
                $code? $this->Redirect($codeMassge,'admin/ShopAssess.php'):$this->Redirect($codeMassge,"admin/ShopAssessEdi.php?id=$this->ArgsArr['id']");
                break;
            case "SaDel":
                $code? $codeMassge = '删除成功':$codeMassge = '删除失败';
                $this->Redirect($codeMassge,'admin/ShopAssess.php');
                break;
            case "delAll":
                $code? $codeMassge = '批量删除成功':$codeMassge = '删除失败';
                $this->Redirect($codeMassge,'admin/ShopAssess.php');
                break;
            case "up":
                $code? $codeMassge = '批量更新成功':$codeMassge = '发生错误';
                $this->Redirect($codeMassge,'admin/ShopAssess.php');
                break;
            default:
                break;
        }


    }


}
new ShopAssess();
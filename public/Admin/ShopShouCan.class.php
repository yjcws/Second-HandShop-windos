<?php

/*
*author: yjc
*createtime : 2021/3/16 12:46
*description:
*/
require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";

class ShopShouCan extends Helper
{
    public function __construct()
    {
        parent::__construct();

        $this->isAdminLogin();

        if(!empty($this->ArgsArr['tab'])) {
            switch (trim($this->ArgsArr['tab'])) {
                case 'ShouDel':
                    $this->ShouDel();
                    break;
                case "delAll":
                    $this->AllDel();
                    break;
                default:
                    $this->Redirect('参数错误','admin/ShopShouCan.php');
                    break;
            }
        }


    }


    public function AllDel(){
        if(count($this->ArgsArr['check'])<1)
        {
            $this->Redirect('请选择一个要删除的信息','admin/ShopShouCan.php');
        }

        foreach ($this->ArgsArr['check'] as $id)
        {
            $Delwhere = array(
                'table'=>'favorites',
                'where'=>'id='.$id,
            );
            $code = $this->delete($Delwhere);

        }
        $this->CheckCode($code);


    }


    public function ShouDel()
    {
        $Delwhere = array(
            'table'=>'favorites',
            'where'=>'id='.$this->ArgsArr['id'],
        );
        $code = $this->delete($Delwhere);

        $this->CheckCode($code);
    }



    public function CheckCode($code){



        switch ($this->ArgsArr['tab'])
        {
            case "ShouDel":
                $code? $codeMassge = '删除成功':$codeMassge = '删除失败';
                $this->Redirect($codeMassge,'admin/ShopShouCan.php');
                break;
            case "delAll":
                $code? $codeMassge = '批量删除成功':$codeMassge = '批量删除失败';
                $this->Redirect($codeMassge,'admin/ShopShouCan.php');
                break;
            default:
                break;
        }


    }


}
new ShopShouCan();
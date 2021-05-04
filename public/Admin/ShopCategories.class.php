<?php

/*
*author: yjc
*createtime : 2021/3/7 17:13
*description:
*/
require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";


class ShopCategories extends Helper
{

    public function __construct()
    {

        parent::__construct();

        $this->isAdminLogin();

        switch ($this->ArgsArr['tab'])
        {
            case "scAdd":
                $this->ShopCateAdd();
                break;
            case "ScEdit":
                $this->ShopCateEdit();
                break;
            case "ScDel":
                $this->ShopCateDel();
                break;
            default:
                $this->Redirect('参数错误', 'admin/shop.categories.php');
                break;
        }

    }

    public function ShopCateAdd()
    {
        $sd = 1;//默认深度
        $tid = $idpath = $this->ArgsArr['tid'];
        //$this->dd($this->ArgsArr);

        //不是一级分类需要获取上一级的sd
        if($this->ArgsArr['tid']!=0){
            $ShopWhere = array(
                'table' => 'productlist ',
                'field' => '*',
                'where'=>"id=".$this->ArgsArr['tid']
            );
            $ShopRestful = $this->getOne($ShopWhere);
            //$this->dd($ShopRestful);

            $sd = $ShopRestful['sd'] + 1;

            $idpath=$ShopRestful["idpath"]."_".$ShopRestful["id"];

        }
//        var_dump('tid:'.$this->ArgsArr['tid']);
//        var_dump("sd：".$sd);

        $ShopAdd = array(
            'table' => 'productlist ',
            'data'=>[
                'tid' => $tid,
                'typename' => "{$this->ArgsArr['typename']}",
                'sd' => $sd,
                'idpath' => $idpath,
            ]
        );

        $code = $this->add($ShopAdd);

        $this->CheckCode($code);

    }

    public function ShopCateDel($id = null)
    {
        ($id == null)?$Id = $this->ArgsArr['id']:$Id = $id;

        $ShopWhere = array(
            'table' => 'productlist ',
            'field' => '*',
            'where'=>"tid=".$Id
        );
        $ShopRestful = $this->getAll($ShopWhere);
//        $Rc = $this->getRowCount();


        //如果有下级，则循环删除
        if(count($ShopRestful)>=1){
//            echo "有下级";
            foreach($ShopRestful as $row)
            {

                $this->ShopCateDel($row["id"]);

                $Delwhere1 = array(
                    'table'=>'productlist',
                    'where'=>'id='.$row["id"],
                );

                $code = $this->delete($Delwhere1);

            }
            $this->CheckCode($code);



        }else{
            $this->Redirect('一级分类不能删除!','admin/shop.categories.php');
        }



    }



    public function ShopCateEdit()
    {

        $sd = 1;//默认深度
        $id = $this->ArgsArr['tid'];
        $this->dd($this->ArgsArr);

        $ShopScWhere = array(
            'table' => 'productlist ',
            'field' => '*',
            'where'=>"id=".$id
        );
        $ShopScRestful = $this->getOne($ShopScWhere);
       // var_dump($ShopScRestful);

        if (empty($ShopScRestful)){
            $this->Redirect('分类名称不存在！','admin/shop.categories.php');
        }
        /*
                //不是一级分类需要获取上一级的sd
                if($this->ArgsArr['tid']!=0){
                    $ShopWhere = array(
                        'table' => 'productlist ',
                        'field' => '*',
                        'where'=>"id=".$this->ArgsArr['tid']
                    );
                    $ShopRestful = $this->getOne($ShopWhere);
                    //$this->dd($ShopRestful);

                    $sd = $ShopRestful['sd'] + 1;

                    $idpath=$ShopRestful["idpath"]."_".$ShopRestful["id"];

                }
        //        var_dump('tid:'.$this->ArgsArr['tid']);
        //        var_dump("sd：".$sd);*/

        $ShopEdit = array(
            'table' => 'productlist ',
            'data'=>[
                'typename' => "{$this->ArgsArr['typename']}",
            ],
            'where'=>"id=".$id

        );

        $code = $this->update($ShopEdit);

        $this->CheckCode($code);


    }




    public function CheckCode($code){


        switch ($this->ArgsArr['tab'])
        {
            case "scAdd":
                $code? $codeMassge = '商品分类创建成功':$codeMassge = '商品分类创建失败';
                $this->Redirect($codeMassge,'admin/shop.categories.php');
                break;
            case "ScEdit":
                $code? $codeMassge = '修改成功':$codeMassge = '修改失败';
                $code? $this->Redirect($codeMassge,'admin/shop.categories.php'):$this->Redirect($codeMassge,"admin/linksEdit.php?id=$this->ArgsArr['id']");
                break;
            case "ScDel":
                $code? $codeMassge = '删除成功':$codeMassge = '删除失败';
                $this->Redirect($codeMassge,'admin/shop.categories.php');
                break;
            default:
                break;
        }


    }



}

(new ShopCategories());
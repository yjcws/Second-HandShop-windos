<?php

/*
*author: yjc
*createtime : 2021/3/8 16:15
*description:
*/



require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";

class ShopWxCategories extends Helper
{
    public function __construct()
    {
        parent::__construct();

       // $this->isAdminLogin();

    }

    //新增分类，下拉 菜单无限 分类
    public function Option($tid)
    {
        // global $Mysql;

        $LinkWhere = array(
            'table' => 'productlist ',
            'field' => '*',
            'where' => "tid=" . $tid
        );
        $ShopRestful = $this->getAll($LinkWhere);
//            echo "<pre>";
//            var_dump($ShopRestful);
//            echo "</pre>";
        $menu = "";
        $left = $sd = '';
        //    echo "</br>";
        foreach ($ShopRestful as $v) {
            $style = "background-color:#C0C0C0";
            for ($y = 2; $y <= $v['sd']; $y++) {
                $style = "background-color:##FFFFFF";

                $left = "|一";
                $sd .= "一";
            }
            $menu .= "<option value='{$v['id']}' style='{$style}'>" . $left . $sd . $v['typename'] . "</option>";
            $menu .= $this->Option($v['id']);
            $sd = '';
        }
    //
        return $menu;
    }


    /**
     * //修改分类，下拉 菜单无限 分类
     * @param $tid
     * @param int $dqid 当前id
     * @return string
     */
    public function OptionSelected($tid,$dqid=0)
    {
        // global $Mysql;

        $LinkWhere = array(
            'table' => 'productlist ',
            'field' => '*',
            'where' => "tid=" . $tid
        );
        $ShopRestful = $this->getAll($LinkWhere);
//            echo "<pre>";
//            var_dump($ShopRestful);
//            echo "</pre>";
        $menu = "";
        $left = $sd = '';
        //    echo "</br>";
        foreach ($ShopRestful as $v) {
            $style = "background-color:#C0C0C0";
            for ($y = 2; $y <= $v['sd']; $y++) {
                $style = "background-color:##FFFFFF";

                $left = "|一";
                $sd .= "一";
            }

            if ($dqid == $v['id']){
                $menu .= "<option value='{$v['id']}' style='{$style}' selected>" . $left . $sd . $v['typename'] . "</option>";
            }else{
                //一级分类不能被选中修改 ，原因：修改一级分类有很多麻烦
                if ($v['tid']==0){
                    $menu .= "<option value='{$v['id']}' style='{$style}' disabled>" . $left . $sd . $v['typename'] . "</option>";

                }else{
                    $menu .= "<option value='{$v['id']}' style='{$style}'>" . $left . $sd . $v['typename'] . "</option>";
                }

            }
            $menu .= $this->OptionSelected($v['id'],$dqid);
            $sd = '';
        }

    //
        return $menu;
    }


    //商品管理，按分类查看
    public function ShopOption($tid,$dqid=0)
    {
        $menu = "";
        $left = $sd = '';

        $LinkWhere = array(
            'table' => 'productlist ',
            'field' => '*',
            'where' => "tid=" . $tid
        );
        $ShopRestful = $this->getAll($LinkWhere);

        foreach ($ShopRestful as $v) {
            $style = "background-color:#C0C0C0";
            for ($y = 2; $y <= $v['sd']; $y++) {
                $style = "background-color:##FFFFFF";

                $left = "|一";
                $sd .= "一";
            }

            if ($v['id'] == $dqid) {

                $menu .= "<option value='Shop.php?typeid={$v['id']}' style='{$style}' selected>" . $left . $sd . $v['typename'] . "</option>";
            }else{
                $menu .= "<option value='Shop.php?typeid={$v['id']}' style='{$style}' >" . $left . $sd . $v['typename'] . "</option>";
            }


            $menu .= $this->ShopOption($v['id'],$dqid);
            $sd = '';
        }

        return $menu;
    }


    //商品管理更新修改，按分类查看
    public function ShopEdiOption($tid,$dqid=0)
    {
        $menu = "";
        $left = $sd = '';

        $LinkWhere = array(
            'table' => 'productlist ',
            'field' => '*',
            'where' => "tid=" . $tid
        );
        $ShopRestful = $this->getAll($LinkWhere);

        foreach ($ShopRestful as $v) {
            $style = "background-color:#C0C0C0";
            for ($y = 2; $y <= $v['sd']; $y++) {
                $style = "background-color:##FFFFFF";

                $left = "|一";
                $sd .= "一";
            }

            if ($v['id'] == $dqid) {

                $menu .= "<option value='{$v['id']}' style='{$style}' selected>" . $left . $sd . $v['typename'] . "</option>";
            }else{
                $menu .= "<option value='{$v['id']}' style='{$style}' >" . $left . $sd . $v['typename'] . "</option>";
            }


            $menu .= $this->ShopEdiOption($v['id'],$dqid);
            $sd = '';
        }

        return $menu;
    }



}




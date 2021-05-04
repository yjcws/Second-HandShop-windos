<?php

/*
*author: yjc
*createtime : 2021/3/21 15:40
*description:毕业设计
*/

require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";


class FeedBackType extends Helper
{
    public function __construct()
    {
        parent::__construct();

        $this->isAdminLogin();

        if(!empty($this->ArgsArr['tab'])) {
            switch (trim($this->ArgsArr['tab'])) {
                case 'FbAdd':
                    $this->FeedBackAdd();
                    break;
                case 'FbDel':
                    $this->FeedBackDel();
                    break;
                case "FbEdi":
                    $this->FeedBackEdi();
                    break;
                case "DelAll":
                    $this->DelAll();
                    break;
                case "Up":
                    $this->FeedbackUp();
                    break;
                default:
                    $this->Redirect('参数错误', 'admin/FeedbackType.php');
                    break;
            }
        }


    }

    public function FeedBackAdd()
    {

        //$this->dd($this->ArgsArr);

        $FeedBackAdd = array(
            'table' => 'feedbackType',
            'field' => 'typename',
            "where" => 'typename='.$this->ArgsArr['$typename'],
        );
        $FbRestful = $this->getOne($FeedBackAdd);
        //var_dump($SaRestful);

        if (empty($FbRestful)){
            $FbAdd = array(
                'table' => 'feedbackType',
                'data'=>[
                    'typename' => $this->ArgsArr['typename'],
                    'typeorder' => "{$this->ArgsArr['typeorder']}",
                    'typezt' =>"{$this->ArgsArr['typezt']}",
                ]
            );

            $code = $this->add($FbAdd);
            $this->CheckCode($code,$this->ArgsArr['typename']);

        }else{
            $this->Redirect("已有该分类名称【".$this->ArgsArr['typename']."】请检查后再进行添加",'admin/FeedbackTypeAdd.php');
        }



    }

    public function FeedBackEdi()
    {
        $FbEdi = array(
            'table' => 'feedbackType',
            'field' => 'id,typename',
            "where" => 'id='.$this->ArgsArr['id']." AND typename="."$this->ArgsArr['typename']",
        );
        $FbRestful = $this->getOne($FbEdi);


        //数据校验
        if (empty($this->ArgsArr['typename'])) {
            $this->Redirect("【分类名称】不能为空",'admin/FeedbackTypeEdi.php');
        }elseif (empty($FbRestful['id'])){
            $this->Redirect("修改【ID】不存在,请检查",'admin/FeedbackTypeEdi.php');
        }elseif (!empty($FbRestful)){
            $this->Redirect("【分类名称】重复,请检查",'admin/FeedbackTypeEdi.php');
        }

            $SaEdi = array(
                'table' => 'feedBackType',
                'data'=>[
                    'typename' => $this->ArgsArr['typename'],
                    'typeorder' => "{$this->ArgsArr['typeorder']}",
                    'typezt' =>"{$this->ArgsArr['typezt']}",
                ],
                'where'=>'id='.$this->ArgsArr['id'],
            );

            $code = $this->update($SaEdi);
            $this->CheckCode($code,$this->ArgsArr['typename']);


    }


    public function FeedBackDel()
    {
        $Delwhere = array(
            'table'=>'feedbackType',
            'where'=>'id='.$this->ArgsArr['id'],
        );
        $code = $this->delete($Delwhere);

        $this->CheckCode($code);
    }

    public function DelAll()
    {

        //var_dump($_POST);

        if(empty($this->ArgsArr['check']))
        {
            $this->Redirect('请选择一个要删除的信息','admin/FeedbackType.php');

            exit;
        }

        foreach ($this->ArgsArr['check'] as $id)
        {
            $Delwhere = array(
                'table'=>'assess',
                'where'=>'id='.$id,
            );
            //var_dump($Delwhere);
            $code = $this->delete($Delwhere);

        }
        $this->CheckCode($code);

    }

    public function FeedbackUp()
    {
        $id= $this->ArgsArr["check"];
        $ziduan= $this->ArgsArr["ziduan"];
        $zt= $this->ArgsArr["zt"];

        if(count($id)==0)
        {
            $this->Redirect('请选择您要更新的信息','admin/FeedbackType.php');
            exit();
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
                'table' => 'feedbackType',
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


        switch ($this->ArgsArr['tab'])
        {
            case "FbAdd":
                $code? $codeMassge = "【".$Other."】".'创建分类成功':$codeMassge ="【".$Other."】".'创建分类失败';
                $code? $this->Redirect($codeMassge,'admin/FeedbackType.php'):$this->Redirect($codeMassge,"admin/FeedbackTypeAdd.php");
                break;
            case "FbEdi":
                $code? $codeMassge = "分类【".$Other."】".'修改成功':$codeMassge = "分类【".$Other."】".'修改失败';
                $code? $this->Redirect($codeMassge,'admin/FeedbackType.php'):$this->Redirect($codeMassge,"admin/FeedbackTypeEdi.php?id=$this->ArgsArr['id']");
                break;
            case "FbDel":
                $code? $codeMassge = '删除成功':$codeMassge = '删除失败';
                $this->Redirect($codeMassge,'admin/FeedbackType.php');
                break;
            case "DelAll":
                $code? $codeMassge = '批量删除成功':$codeMassge = '删除失败';
                $this->Redirect($codeMassge,'admin/FeedbackType.php');
                break;
            case "Up":
                $code? $codeMassge = '批量更新成功':$codeMassge = '发生错误';
                $this->Redirect($codeMassge,'admin/FeedbackType.php');
                break;
            default:
                break;
        }


    }


}
new FeedBackType();
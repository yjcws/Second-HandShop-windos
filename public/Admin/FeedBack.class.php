<?php

/*
*author: yjc
*createtime : 2021/3/21 15:40
*description:毕业设计
*/


require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";


class FeedBack extends Helper
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
                    $this->Redirect('参数错误', 'admin/Feedback.php');
                    break;
            }
        }


    }

    public function FeedBackAdd()
    {

        //$this->dd($this->ArgsArr);
        //数据校验
        if (empty($this->ArgsArr['typeid'])) {
            $this->Redirect("【留言分类ID】不能为空",'admin/FeedbackAdd.php');
        }elseif (empty($this->ArgsArr['content'])){
            $this->Redirect("【留言内容】不能为空",'admin/FeedbackAdd.php');
        }


            $FbAdd = array(
                'table' => 'feedback',
                'data'=>[
                    'typeid' => $this->ArgsArr['typeid'],
                    'issh' => "{$this->ArgsArr['issh']}",
                    'ishf' =>"{$this->ArgsArr['ishf']}",
                    'content' =>"{$this->ArgsArr['content']}",
                    'recontent' =>"{$this->ArgsArr['recontent']}",
                    'usernameshow' =>"{$this->ArgsArr['usernameshow']}",
                    'addtime' =>time(),
                    'ip' =>"管理员",
                    'inputer' =>"{$this->getAdminname()['username']}",
                ]
            );

            $code = $this->add($FbAdd);
            $this->CheckCode($code);


    }

    public function FeedBackEdi()
    {
        $FbEdi = array(
            'table' => 'feedback',
            'field' => 'id',
            "where" => 'id='.$this->ArgsArr['id'],
        );
        $FbRestful = $this->getOne($FbEdi);


        //数据校验
        if (empty($this->ArgsArr['id'])) {
            $this->Redirect("【留言ID】不存在！",'admin/FeedbackEdi.php');
        }elseif (empty($FbRestful['id'])){
            $this->Redirect("修改【ID】不存在,请检查",'admin/FeedbackEdi.php');
        }

            $SaEdi = array(
                'table' => 'feedback',
                'data'=>[
                    'typeid' => $this->ArgsArr['typeid'],
                    'issh' => "{$this->ArgsArr['issh']}",
                    'ishf' =>"{$this->ArgsArr['ishf']}",
                    'content' =>"{$this->ArgsArr['content']}",
                    'recontent' =>"{$this->ArgsArr['recontent']}",
                    'usernameshow' =>"{$this->ArgsArr['usernameshow']}",
                    'addtime' =>time(),
                    'ip' =>"管理员",
                    'inputer' =>"{$this->getAdminname()['username']}",
                    ],
                'where'=>'id='.$this->ArgsArr['id'],
            );

            $code = $this->update($SaEdi);
            $this->CheckCode($code);


    }


    public function FeedBackDel()
    {
        $ShoAssessUp = array(
            'table' => 'feedback',
            'field' => 'id',
            "where" => 'id='.$this->ArgsArr['id'],
        );
        $SaRestful = $this->getOne($ShoAssessUp);

        //数据校验
        if (empty($this->ArgsArr['id']) && empty($SaRestful['id'])) {
            $this->Redirect("【参数ID】错误！",'admin/FeedbackEdi.php');
        }

        $Delwhere = array(
            'table'=>'feedback',
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
            $this->Redirect('请选择一个要删除的信息','admin/Feedback.php');
        }

        foreach ($this->ArgsArr['check'] as $id)
        {
            $Delwhere = array(
                'table'=>'feedback',
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
            $this->Redirect('请选择您要更新的信息','admin/Feedback.php');
        }

        foreach($id as $v)
        {
            $SaUP = array(
                'table' => 'feedback',
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
                $code? $codeMassge = '留言添加成功':$codeMassge ='留言添加失败';
                $code? $this->Redirect($codeMassge,'admin/Feedback.php'):$this->Redirect($codeMassge,"admin/FeedbackAdd.php");
                break;
            case "FbEdi":
                $code? $codeMassge = '修改成功':$codeMassge = '修改失败';
                $code? $this->Redirect($codeMassge,'admin/Feedback.php'):$this->Redirect($codeMassge,"admin/FeedbackEdi.php?id=$this->ArgsArr['id']");
                break;
            case "FbDel":
                $code? $codeMassge = '删除成功':$codeMassge = '删除失败';
                $this->Redirect($codeMassge,'admin/Feedback.php');
                break;
            case "DelAll":
                $code? $codeMassge = '批量删除成功':$codeMassge = '批量删除失败';
                $this->Redirect($codeMassge,'admin/Feedback.php');
                break;
            case "Up":
                $code? $codeMassge = '批量更新成功':$codeMassge = '发生错误';
                $this->Redirect($codeMassge,'admin/Feedback.php');
                break;
            default:
                break;
        }


    }


}
new FeedBack();
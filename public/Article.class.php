<?php

/**
*author: yjc
*createtime : 2021/3/16 12:46
*description:
*/

require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";

class Article extends Helper
{
    public function __construct()
    {
        parent::__construct();

        if(!empty($this->ArgsArr['tab'])) {
            switch (trim($this->ArgsArr['tab'])) {
                case 'ArticleAdd':
                    $this->ArticleAdd();
                    break;
                case 'del':
                    $this->delArticle();
                    break;
                case 'ArticleEdi':
                    $this->ArticleEdi();
                    break;
//                case 'AddCart':
//                    $this->AddCart();
//                    break;
//                case 'AddSc':
//                    $this->AddShouCan();
//                    break;
//                case "delSc":
//                    $this->delShoucan();
//                    break;
//                case "BatchDel":
//                    $this->BatchDel();
//                    break;
//                case "delAll":
//                    $this->BatchCartDel();
//                    break;
                default:
                    $this->Redirect('参数错误','index.php');
            }
        }else{
            $this->Redirect('参数错误','index.php');
        }


    }



    public function ArticleAdd()
    {

        $UserLog = array(
            'table' => 'article',
            'data'=>[
                'title' => "{$this->ArgsArr['title']}",
                'typeid' => 21,
                'author' => "{$this->getUsernames()['username']}",
                'com' => "{$this->ArgsArr['com']}",
                'hits' => 0,
                'issh' => 0,
                'content' => "{$this->ArgsArr['content']}",
                'inputer' => "{$this->getUsernames()['username']}",
                'addtime' => time(),
            ]
        );

        $code = $this->add($UserLog);

        $this->CheckCode($code);


    }


    public function delArticle()
    {
        $Delwhere = array(
            'table'=>'article',
            'where'=>'id='.$this->ArgsArr['id'],
        );
        $code = $this->delete($Delwhere);

        $this->CheckCode($code);
        
    }


    public function ArticleEdi()
    {
        $UserLog = array(
            'table' => 'article',
            'data'=>[
                'title' => "{$this->ArgsArr['title']}",
                'author' => "{$this->getUsernames()['username']}",
                'com' => "{$this->ArgsArr['com']}",
                'content' => "{$this->ArgsArr['content']}",
                'inputer' => "{$this->getUsernames()['username']}",
                'addtime' => time(),
            ],
            'where'=>'id='.$this->ArgsArr['id'],
        );

        $code = $this->update($UserLog);

        $this->CheckCode($code);

    }

    public function CheckCode($code){

        $codeMassge = '';

        if(empty($this->ArgsArr['tab'])){
            $codeMassge = '参数错误';
        }elseif (trim( $this->ArgsArr['tab']) == 'ArticleAdd'){
            $code? $codeMassge = '帖子添加成功！请等待管理员审核！':$codeMassge = '帖子添加失败';
        }elseif (trim( $this->ArgsArr['tab']) == 'del'){
            $code? $codeMassge = '帖子删除成功':$codeMassge = '帖子删除成功';
        }elseif (trim( $this->ArgsArr['tab']) == 'ArticleEdi'){
            $code? $codeMassge = '帖子修改成功':$codeMassge = '帖子修改失败';
        }elseif (trim( $this->ArgsArr['tab']) == 'articleDel'){
            $code? $codeMassge = '文章删除成功':$codeMassge = '文章删除失败';
            $this->Redirect($codeMassge,'admin/aticle.php');
            exit();

        }elseif (trim( $this->ArgsArr['tab']) == 'delAll'){
            $code? $codeMassge = '文章删除成功':$codeMassge = '文章删除失败';
            $this->Redirect($codeMassge,'admin/aticle.php');
            exit();

        }else{
            $this->Redirect('参数错误','user_Tiezi.php');
        }

        //var_dump($codeMassge);
        $this->Redirect($codeMassge,'user_Tiezi.php');

    }



}
new Article();
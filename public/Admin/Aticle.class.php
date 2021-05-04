<?php


require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";


class Aticle extends Helper{

    public function __construct()
    {

        parent::__construct();

        $this->isAdminLogin();
        //防止checkbox数组转值时转义进行报错
        if(!($_REQUEST['tab'] == 'delAll')){
            $this->ArgsArr = $this->getArgs();
        }else{
            $this->ArgsArr =$_REQUEST;
        }
        //var_dump($this->ArgsArr);

        if(!empty($this->ArgsArr['tab'])) {
            switch (trim($this->ArgsArr['tab'])) {
                case 'del':
                    $this->DelClassification();
                    break;
                case 'edi':
                    $this->EditClassification();
                    break;
                case "articleAdd":
                    $this->AddArticle();
                    break;
                case "articleEdi":
                    $this->EdiArticle();
                    break;
                case "articleDel":
                    $this->DelArticle();
                    break;
                case "delAll":
                    $this->DelAll();
                    break;
                case "up":
                    $this->ArticleUp();
                    break;
                default:
                    $this->Redirect('参数错误', 'admin/admin.php');
                    break;
            }
        }else{
            $this->AddClassification();
        }


    }



    //添加分类方法
   public function AddClassification(){

        if ($this->ArgsArr['leixing']==0) {
            $LeiXing = '校园快报';
        }elseif($this->ArgsArr['leixing']==1){
            $LeiXing = '热门活动';
        }elseif($this->ArgsArr['leixing']==2){
            $LeiXing = '校园帖子';
        }

       $UserLog = array(
           'table' => 'articleType',
           'data'=>[
               'typename' => "{$this->ArgsArr['fl']}",
               'leixing' => $LeiXing
           ]
       );

       $code = $this->add($UserLog);

       $this->CheckCode($code);


    }
    //删除分类方法
   public function DelClassification(){

       $Delwhere = array(
           'table'=>'articleType',
           'where'=>'id='.$this->ArgsArr['id'],
       );
       $code = $this->delete($Delwhere);

       $this->CheckCode($code);


    }

    /**
     * 修改分类方法
     */
   public function EditClassification(){

       $udataWhere = [
           'table' =>'articleType',
           'data' =>[
               'typename'=>"{$this->ArgsArr['fl']}",
           ],
           'where'=>"id=".$this->ArgsArr['id']
       ];



       $code = $this->update($udataWhere);

       $this->CheckCode($code);



    }

    /**
     * 添加文章
     */
    public function AddArticle()
    {

        $UserLog = array(
            'table' => 'article',
            'data'=>[
                'title' => "{$this->ArgsArr['title']}",
                'typeid' => "{$this->ArgsArr['typeid']}",
                'author' => "{$this->ArgsArr['author']}",
                'com' => "{$this->ArgsArr['com']}",
                'hits' => 0,
                'issh' => "{$this->ArgsArr['issh']}",
                'content' => "{$this->ArgsArr['content']}",
                'inputer' => $this->getAdminname()['username'],
                'addtime' => time(),
            ]
        );

        $code = $this->add($UserLog);

        $this->CheckCode($code);

    }
    /**
     * 添加文章
     */
    public function EdiArticle()
    {

        $UserLog = array(
            'table' => 'article',
            'data'=>[
                'title' => "{$this->ArgsArr['title']}",
                'typeid' => "{$this->ArgsArr['typeid']}",
                'author' => "{$this->ArgsArr['author']}",
                'com' => "{$this->ArgsArr['com']}",
//                'hits' => "{$this->ArgsArr['hits']}",
                'issh' => "{$this->ArgsArr['issh']}",
                'content' => "{$this->ArgsArr['content']}",
                'inputer' => $this->getAdminname()['username'],
                'addtime' => time(),
            ],
           'where'=>"id=".$this->ArgsArr['id']

        );

        $code = $this->update($UserLog);

        $this->CheckCode($code);

    }
    /**
     * 添加文章
     */
    public function DelArticle()
    {

        $Delwhere = array(
            'table'=>'article',
            'where'=>'id='.$this->ArgsArr['id'],
        );
        $code = $this->delete($Delwhere);

        $this->CheckCode($code);



    }

    public function DelAll()
    {

        if(count($this->ArgsArr['check'])<1)
        {
            echo "<script>alert('请选择一个要删除的信息！');location.href='admin/aticle.php';</script>";
            exit;
        }

        foreach ($this->ArgsArr['check'] as $id)
        {
            $Delwhere = array(
                'table'=>'article',
                'where'=>'id='.$id,
            );
            $code = $this->delete($Delwhere);

        }
        $this->CheckCode($code);


    }

    /**
     * 设置审核
     */
    public function ArticleUp()
    {

        if(count($this->ArgsArr['check'])<1)
        {
            $this->Redirect('请勾选一个要修改的信息！','admin/aticle.php');
        }

        foreach ($this->ArgsArr['check'] as $id)
        {
            $Delwhere = array(
                'table'=>'article',
                'data'=>[
                    'issh'=>$this->ArgsArr['issh']
                ],
                'where'=>'id='.$id,
            );
            $code = $this->update($Delwhere);

        }
        $this->CheckCode($code);

    }

    public function CheckCode($code){

        $codeMassge = '';

        if(empty($this->ArgsArr['tab'])){
            $code? $codeMassge = '创建分类成功':$codeMassge = '创建分类失败';
        }elseif (trim( $this->ArgsArr['tab']) == 'del'){
            $code? $codeMassge = '删除分类成功':$codeMassge = '删除分类失败';
        }elseif (trim( $this->ArgsArr['tab']) == 'edi'){
            $code? $codeMassge = '分类修改成功':$codeMassge = '分类修改失败';
        }elseif (trim( $this->ArgsArr['tab']) == 'articleAdd'){
            $code? $codeMassge = '文章添加成功':$codeMassge = '文章添加失败';
            $this->Redirect($codeMassge,'admin/aticle.php');

        }elseif (trim( $this->ArgsArr['tab']) == 'articleEdi'){
            $code? $codeMassge = '文章修改成功':$codeMassge = '文章修改失败';
            $this->Redirect($codeMassge,'admin/aticle.php');

        }elseif (trim( $this->ArgsArr['tab']) == 'articleDel'){
            $code? $codeMassge = '文章删除成功':$codeMassge = '文章删除失败';
            $this->Redirect($codeMassge,'admin/aticle.php');

        }elseif (trim( $this->ArgsArr['tab']) == 'delAll'){
            $code? $codeMassge = '文章删除成功':$codeMassge = '文章删除失败';
            $this->Redirect($codeMassge,'admin/aticle.php');

        }elseif (trim( $this->ArgsArr['tab']) == 'up'){
            $code? $codeMassge = '【设置】或【取消】审核成功':$codeMassge = '【设置】或【取消】审核失败';
            $this->Redirect($codeMassge,'admin/aticle.php');

        }else{
            $this->Redirect('参数错误','admin/aticle.classification.php');
        }

        //var_dump($codeMassge);
       $this->Redirect($codeMassge,'admin/aticle.classification.php');

    }


}

new Aticle();


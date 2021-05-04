<?php

/*
*author: yjc
*createtime : 2021/3/7 13:16
*description:
*/


include "../../check/isLogin.class.php";
include "../../controller/MysqlConnection.php";
require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";


(new AdminLogin())->isLogin();

class Links extends Helper
{

    public function __construct()
    {
        parent::__construct();

        $this->isAdminLogin();

        switch ($this->ArgsArr['tab'])
        {
            case "linksAdd":
                $this->linksAdd();
                break;
            case "linksEdit":
                $this->linksEdit();
                break;
            case "linksDel":
                $this->linksDel();
                break;
            default:
                $this->Redirect('参数错误', 'admin/links.php');

                break;
        }


    }

    public function linksAdd()
    {

        $File = $this->getFile("logourl");


//        var_dump($this->ArgsArr);

        if($this->ArgsArr['styleid']==1){

            if(($File['type']=="image/gif"||$File['type']=="image/jpeg"||$File['type']=="image/pjpeg") && $File['"size"']<102400)
            {
                //获取文件后缀
                $ext=pathinfo($File['name'],PATHINFO_EXTENSION );
               $filename= uniqid().'.'.$ext; // 重新组件文件名
                move_uploaded_file($File["tmp_name"], "../view/upload/".$filename);
                $logourl="upload/".$filename;
            }else{
                $this->Redirect('LOGO文件不合法', 'admin/links.php');
                exit;
            }
        } else{
            $logourl="文本链接";
        }

        $LinkWhere = array(
            'table' => 'links',
            'data'=>[
                'webname' => "{$this->ArgsArr['webname']}",
                'weburl' => "{$this->ArgsArr['weburl']}",
                'styleid' => "{$this->ArgsArr['styleid']}",
                'logourl' => "$logourl",
                'addtime' => time(),
                'intro' => "{$this->ArgsArr['intro']}",
            ]
        );

        $code = $this->Mysql->add($LinkWhere);

        $this->CheckCode($code);


    }

    public function linksEdit()
    {

        $File = $this->getFile("logourl");
        //var_dump($File);

        //$this->dd($this->ArgsArr);

        if($File['name']!==''){

            if(($File['type']=="image/gif"||$File['type']=="image/jpeg"||$File['type']=="image/pjpeg") && $File['"size"']<102400)
            {

                move_uploaded_file($File["tmp_name"], "../view/upload/".$File["name"]);
                $logourl="upload/".$File["name"];
                $LinkWhere['data']['logourl']= "$logourl";

            }else{
                $this->Redirect('LOGO文件不合法', 'admin/links.php');
                exit;
            }
        }

        if ($this->ArgsArr['styleid']== 2){
            $logourl="yys";
            $LinkWhere['data']['logourl']= "$logourl";
        }

        $LinkWhere = array(
            'table' => 'links',
            'data'=>[
                'webname' => "{$this->ArgsArr['webname']}",
                'weburl' => "{$this->ArgsArr['weburl']}",
                'styleid' => "{$this->ArgsArr['styleid']}",
                'addtime' => time(),
                'intro' => "{$this->ArgsArr['intro']}",
            ],
            'where'=>"id=".$this->ArgsArr['id']

        );



        $code = $this->Mysql->update($LinkWhere);

        $this->CheckCode($code);


    }

    public function linksDel(){

        $Delwhere = array(
            'table'=>'links',
            'where'=>'id='.$this->ArgsArr['id'],
        );
        $code = $this->Mysql->delete($Delwhere);

        $this->CheckCode($code);

    }

    public function CheckCode($code){

        $codeMassge = '';


        switch ($this->ArgsArr['tab'])
        {
            case "linksAdd":
                $code? $codeMassge = '友情链接添加成功':$codeMassge = '添加失败';
                $code? $this->Redirect($codeMassge,'admin/links.php'):$this->Redirect($codeMassge,"admin/linksAdd.php");
                break;
            case "linksEdit":
                $code? $codeMassge = '修改成功':$codeMassge = '修改失败';
                $code? $this->Redirect($codeMassge,'admin/links.php'):$this->Redirect($codeMassge,"admin/linksEdit.php?id=$this->ArgsArr['id']");
                break;
            case "linksDel":
                $code? $codeMassge = '删除成功':$codeMassge = '删除失败';
                $this->Redirect($codeMassge,'admin/links.php');
                break;
            default:
                break;
        }


    }


}

new Links();

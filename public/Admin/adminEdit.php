<?php
require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";


class AdminEdit extends Helper {

    public function __construct()
    {

        parent::__construct();

        $this->isAdminLogin();

        if ($this->ArgsArr['tab'] == 'del' ){
            $this->DelUser();
        }elseif ($this->ArgsArr['tab'] == 'edi'){
            $this->edit();
        }elseif ($this->ArgsArr['tab'] == 'ediPw'){
            $this->EditPw();
        }
        else{
            $this->Redirect('参数错误','admin/admin.php');
        }



    }

    public function DelUser(){
        //删除条件
        $delWhere = [
            'table' =>'admin_user',
            'where' =>"id = {$this->ArgsArr['id']}",
        ];

        $code = $this->delete($delWhere);
//        var_dump($code);
        $this->CheckCode($code);

    }

    public function edit(){
        //    $this->id=$_GET["id"];
        $username=$_POST["zh"];
        $password=$_POST["pw"];
        $rights=$_POST["rights"];
        //var_dump($this->id);

        $editWhere = [
            'table' =>'admin_user',
            'data' =>[
                'username'=>"$username",
                'password'=>"$password",
                'rights'=>"$rights",
            ],
            'where'=>"id={$this->ArgsArr['id']}"
        ];

        //var_dump($editWhere);

        $code = $this->update($editWhere);

        $this->CheckCode($code);


    }

    public function EditPw(){
        $username=$_POST["username"];
        $password=$_POST["password"];

        //var_dump($_POST);

//        exit();

        $editWhere = [
            'table' =>'admin_user',
            'data' =>[
                'password'=>"$password",
            ],
            'where'=>"username='{$username}'"
        ];

        //var_dump($editWhere);

        $code = $this->update($editWhere);
        //var_dump($code);

        $this->CheckCode($code);




    }

    public function CheckCode($code){


        if ($this->ArgsArr['tab'] == 'del' ){
            $code? $codeMassge = '管理员信息删除成功':$codeMassge = '管理员信息删除失败';
            $this->Redirect($codeMassge,'admin/admin.php');
        }elseif ($this->ArgsArr['tab'] == 'edi'){
            $code? $codeMassge = '管理员信息修改成功':$codeMassge = '管理员信息修改失败';
            $this->Redirect($codeMassge,'admin/admin.php');

        }elseif ($this->ArgsArr['tab'] == 'ediPw'){
            $code? $codeMassge = '001':$codeMassge = '管理员密码修改失败';

        }else{
            $this->Redirect('参数错误','admin/admin.php');
        }

        if ( $codeMassge = '001'){
            session_start();
            session_destroy();

            $this->Redirect('管理员密码修改成功,请重新登陆！','../admin.php');
        }else {
            $this->Redirect($codeMassge,'admin/admin.php');
        }



    }
}

new AdminEdit();




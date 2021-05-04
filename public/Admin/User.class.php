<?php

/*
*author: yjc
*createtime : 2021/3/16 12:46
*description:
*/
require_once $_SERVER['DOCUMENT_ROOT']."/controller/Helper.php";


class User extends Helper
{
    public function __construct()
    {
        parent::__construct();

        $this->isAdminLogin();

        if(!empty($this->ArgsArr['tab'])) {
            switch (trim($this->ArgsArr['tab'])) {
                case 'UserAdd':
                    $this->UserAdd();
                    break;
                case 'UsrDel':
                    $this->UserDel();
                    break;
                case "UserEdi":
                    $this->UserEdi();
                    break;
            }
        }else{

        }


    }

    public function UserAdd()
    {

        //$this->dd($this->ArgsArr);

        $UserWhere = array(
            'table' => 'user',
            'field' => '*',
            "where" => 'username='.$this->ArgsArr['username'],
        );
        $UserRestful = $this->getOne($UserWhere);
        //var_dump($UserRestful);

        if (empty($UserRestful)){
            $UserAdd = array(
                'table' => 'user',
                'data'=>[
                    'username' => $this->ArgsArr['username'],
                    'password' => "{$this->ArgsArr['pw']}",
                    'email' => "{$this->ArgsArr['email']}",
//                    'tiwen' =>"{$this->ArgsArr['twwt']}",
//                    'huida' => "{$this->ArgsArr['huida']}",
                    'zt' => "{$this->ArgsArr['zhuntai']}",
                    'xingming' => "{$this->ArgsArr['zsxm']}",
                    'sex' => "{$this->ArgsArr['xs']}",
                    'mobile' => "{$this->ArgsArr['phone']}",
                    'addtime' => time(),
                ]
            );

            $code = $this->add($UserAdd);
            $this->CheckCode($code);

        }else{
            $this->Redirect($this->ArgsArr['username']."已经存在,请更换登陆账号",'admin/UserAdd.php');

        }



    }

    public function UserEdi()
    {
        $UserEdi = array(
            'table' => 'user',
            'data'=>[
                'username' => $this->ArgsArr['username'],
                'password' => "{$this->ArgsArr['pw']}",
                'email' => "{$this->ArgsArr['email']}",
                'tiwen' =>"{$this->ArgsArr['twwt']}",
                'huida' => "{$this->ArgsArr['huida']}",
                'zt' => "{$this->ArgsArr['zhuntai']}",
                'xingming' => "{$this->ArgsArr['zsxm']}",
                'sex' => "{$this->ArgsArr['xs']}",
                'mobile' => "{$this->ArgsArr['phone']}",
                'addtime' => time(),
            ],
            "where" =>'id = '.$this->ArgsArr['id']

        );

        $code = $this->update($UserEdi);
        $this->CheckCode($code);

    }


    public function UserDel()
    {
        $Delwhere = array(
            'table'=>'user',
            'where'=>'id='.$this->ArgsArr['id'],
        );
        $code = $this->delete($Delwhere);

        $this->CheckCode($code);
    }



    public function CheckCode($code){


        switch ($this->ArgsArr['tab'])
        {
            case "UserAdd":
                $code? $codeMassge = '添加成功':$codeMassge = '添加失败';
                $code? $this->Redirect($codeMassge,'admin/User.php'):$this->Redirect($codeMassge,"admin/User.php");
                break;
            case "UserEdi":
                $code? $codeMassge = '修改成功':$codeMassge = '修改失败';
                $code? $this->Redirect($codeMassge,'admin/User.php'):$this->Redirect($codeMassge,"admin/UserEdi.php?id=$this->ArgsArr['id']");
                break;
            case "UsrDel":
                $code? $codeMassge = '删除成功':$codeMassge = '删除失败';
                $this->Redirect($codeMassge,'admin/User.php');
                break;
            default:
                break;
        }


    }


}
new User();
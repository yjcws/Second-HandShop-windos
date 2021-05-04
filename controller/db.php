<?php
/*
 * 数据库类
 */

class db{

    private $pdo = null;
    public $statement = null;
    public $data = null;
    public $RowCount = 0;


    public function __construct($host,$user="root",$pass="",$dbname=""){

        $dsn = "mysql:host={$host};dbname={$dbname}";
        try {
            $this->pdo = new \PDO($dsn,$user,$pass);
            $this->pdo->exec("set names utf8");
        } catch (PDOException $e) {
            print  "数据库连接失败" . $e->getMessage() . "<br>";
            die();
        }
    }

    /**
    生成一个编译好的sql语句模版
     */
    public function Prepare($sql=""){
        // addLog(array('file_name'=>'sqlPrepare','content'=>$sql));
        if($sql==""){
            return false;
        }
        try{
            $this->statement = $this->pdo->prepare($sql);
            $this->statement->execute();
            $this->data = $this->statement->fetchAll(PDO::FETCH_ASSOC);
            $this->RowCount = count($this->data);
            //$this->dd($this->data);
            return  $this->data;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function Exec($sql=""){
//        $this->dump($sql);

        if($sql==""){
            return false;
        }
        try {
            $this->data = $this->pdo->exec($sql);
           //$this->$this->dump($this->data);
            if (!$this->data){
                return $code = 0;  //执行失败返回0
            }
            return $code = 1;  //执行成功返回1

        }catch(PDOException $e){
            echo "sql执行失败".$e->getMessage();
            return $code = 0;  //执行失败返回0
        }
    }

    //addslashes() 函数返回在预定义字符之前添加反斜杠的字符串。
    private function addsla($data){
        if($this->is_addsla){
            return trim(addslashes($data));
        }
        return $data;
    }

    //简化操作--------------------------------------------------

    /**
    $select：要获取的属性
    $table：数据表名称
    where：获取条件
    $order：数据排序
    $limit：获取几条数据
    */
    public function doSelect($array) {
        $array = array_merge(array('field'=>'*','table'=>'','join'=>'','where'=>'','group'=>'','order'=>'','limit'=>''),$array);

        if( is_array($array['order']) && isset($array['order']['order']) && ( $array['order']['order'] == 'desc' || $array['order']['order'] == 'asc' ) && isset($array['order']['field']) ) {
            $array['order'] = " order by ".$array['order']['field']. $array['order']['order'];
        } elseif( $array['order'] && is_string($array['order']) ) {
            $array['order'] = " order by {$array['order']}";
        } else $array['order'] = '';

        if($array['group']) {
            $array['group'] = " GROUP BY ".$array['group'];
        }
        if($array['limit']) {
            $array['limit'] = " LIMIT ".$array['limit'];
        }

        if (is_array($array['join']) && !empty($array['join']['where']) && !empty($array['join']['table'])) {
            $sql =
                "SELECT ".  $array['field'].
                " FROM ". $array['table']. " JOIN " . $array['join']['table']." on " .$array['join']['where'];

        }else{
            $sql =
                "SELECT ".  $array['field'].
                " FROM ". $array['table']." ";
        }




        /*多个查询条件时
         *
         * 格式：‘where’=>[
        'id'=>'1',
        'name'=>'ukk'

        ]
         * */
        if(is_array($array['where'])){
            $x= 0;
            foreach($array['where'] as $val){
                if($x == 0){
                    $sql .=" WHERE ". $val;
                }else{
                    $sql .= " AND " .$val;
                }

                $x++;
            }
        }


        //单个查询 条件时
        if (!empty($array['where']) && !is_array($array['where'])){
            $sql .=" WHERE ". $array['where']." ";
        }

        $sql .=$array['group']. $array['order']. $array['limit'];




        return $sql;


    }

    /**
     * @param $array
     * @return array|bool
     * 格式：        $UserWhere = array(
    'table' => 'admin_user ',
    'field' => '*',
    'order' => [
    'field'=>'loginTime ',
    'order'=>'desc'
    ],
    'limit' => $page->limit(),
    );
    $UserRestful = $Mysql->getAll($UserWhere);

     */
    public function getAll($array) {
        $sql = $this->doSelect($array);
        $arrData = array();
        $arrData = $this->Prepare($sql);


//        $this->dump($sql);
       return $arrData;

    }



    /**
     * @param $array
     * @return mixed
     * 格式：$UserWhere = array(
    'table' => 'admin_user',
    'field' => '*',
    'where' => "username = "."'$username'"
    );
     *
     * $UserRestful = $Mysql->getOne($UserWhere);
     */
    //获取一条查询到的数据
    public function getOne($array) {
        $array['limit'] = '0,1';
        $sql = $this->doSelect($array);
//        $this->dump($sql);


         $arrData = $this->Prepare($sql);

        return $arrData[0];
    }

    public function add($array){

        if(!is_array($array['data'])){
            //var_dump();
            die('data必须是数组！');
        }
        $cols = array();
        $vals = array();
        foreach($array['data'] as $key=>$val){
            $cols[]=$key;
            $vals[]="'".$this->addsla($val)."'";
        }
        $sql  = "INSERT INTO {$array['table']} (";
        $sql .= implode(",",$cols).") VALUES (";
        $sql .= implode(",",$vals).")";


        return $this->Exec($sql);

    }

    /**
     * 代码格式：
     * $udataWhere = [
            'table' =>'admin_user',
            'data' =>[
                'password'=>"$password",
            ],
            'where'=>"username='{$username}'"
        ];



        $code = $this->Mysql->update($editWhere);
     *
     * */

    public function update($array){

        $array = array_merge(array('table'=>''),$array);

        if(!is_array($array['data'])){
            die('data必须是数组！');
        }
        $set = array();
        foreach($array['data'] as $key=>$val){
            $set[] = $key."='".trim($this->addsla($val))."'";
        }
//        if(!$array['table']){
//            $array['table'] = $this->getTable();
//        }
        $sql = "UPDATE {$array['table']} SET ";
        $sql .= implode(",",$set);
        $sql .= " WHERE ".$array['where'];

        return $this->Exec($sql);
    }

    /**
     *格式：$Delwhere = array(
           'table'=>'articleType',
           'where'=>'id='.$this->ArgsArr,
       );
       $code = $this->Mysql->delete($Delwhere);
     *
     * */

    public function delete($array){
        $sql = "DELETE FROM {$array['table']} ";
        if (!empty($array['where'])){
            $sql .= "WHERE ".$array['where'];
        }

//        var_dump($sql);
        return $this->exec($sql);
    }

    public function getRowCount()
    {
        return  $this->RowCount; //受影响的条数
    }



    //格式化打印
    function dump($sql=''){
    echo "<pre>";
    var_dump( $sql);
    echo "</pre>";
    }



    public function close(){
        $this->data = null;

        return $this->conn=null;
    }

}



?>
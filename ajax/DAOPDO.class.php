<?php
require_once "./i_DAOPDO.interface.php";
class DAOPDO implements i_DAOPDO{
    //服务器的地址
    private $host;
    //数据库名
    private $dbname;
    //端口号
    private $port;
    //字符集
    private $charset;
    //用户名
    private $user;
    //密码
    private $pass;
    //保存pdo对象的属性
    private $pdo;

    //添加静态属性，保存创建的实例的属性
    private static $instance;
    //创建私有的方法，在里面不写任何东西
    private function __clone(){ }
    //$options传递的实际参数数组
    private function __construct($options){
        $this->host=isset($options['host'])?$options['host']:'localhost';
        $this->dbname=isset($options['dbname'])?$options['dbname']:'text';
        $this->port=isset($options['port'])?$options['port']:'3306';
        $this->charset=isset($options['charset'])?$options['charset']:'utf8';
        $this->user=isset($options['user'])?$options['user']:'root';
        $this->pass=isset($options['pass'])?$options['pass']:'root';
        
        $dsn="mysql:localhost=$this->host;dbname=$this->dbname;port=$this->port;charset=$this->charset";

        $user=$this->user;
        $pass=$this->pass;

        try{
            $this->pdo=new PDO($dsn,$user,$pass);
        }catch(PDOException $e){
            echo "链接失败".$e->getMessage();
            die();
        }
    }

    //提供一个可以对外部调用创建对象的方法
    public static function getSingleton($options){
        //判断是否存在静态对象
        if(!self::$instance instanceof self){
            //创建对象
            self::$instance=new self($options);
        } 
        return self::$instance;
    }

    //查询全部
    public function fetchAll($sql){
        $pdo_fetchAll=$this->pdo->query($sql);
        //判断结果集是否获取
        if($pdo_fetchAll==false){
            echo "SQL语句有问题".$pdo->errorInfo()[2];
        }
        //查询所有数据
        $arr=$pdo_fetchAll->fetchAll(PDO::FETCH_ASSOC);
        return $arr;
    }
    //查询单条
    public function fetchRow($sql){
        $pdo_fetchRow=$this->pdo->query($sql);
        //判断结果集是否获取
        if($pdo_fetchRow==false){
            echo "SQL语句有问题".$pdo->errorInfo()[2];
            die();
        }
        $arr=$pdo_fetchRow->fetch(PDO::FETCH_ASSOC);
        return $arr;
    }
    //查询某个字段
    public function fetchOne($sql){
        $pdo_fetchOne=$this->pdo->query($sql);
        //判断结果集是否获取
        if($pdo_fetchOne==false){
            echo "SQL语句有问题".$pdo->errorInfo()[2];
        }
        //查询某个字段
        $arr=$pdo_fetchOne->fetchColumn();
        return $arr;
    }
    //增删改
    public function query($sql){
        $pdo_query=$this->pdo->exec($sql);
        //判断结果集是否获取
        if($pdo_query==false){
            echo "SQL语句有问题".$pdo->errorInfo()[2];
        }
        if($pdo_query>0){
            return true;
        }else{
            return false;
        }
    }
}
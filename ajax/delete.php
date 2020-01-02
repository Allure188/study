<?php
$id=$_POST['id'];

require_once 'DAOPDO.class.php';

$dao=DAOPDO::getSingleton($options);

$sql="delete from users where id=$id";
$res=$dao->query($sql);
if($res){
    echo "删除成功";
}else{
    echo "删除失败";
}
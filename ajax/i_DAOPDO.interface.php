<?php
interface i_DAOPDO{
    //查询全部
    public function fetchAll($sql);
    //查询单条
    public function fetchRow($sql);
    //查询某个字段
    public function fetchOne($sql);
    //增删改
    public function query($sql);
}
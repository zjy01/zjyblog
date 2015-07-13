<?php
/**
 * Created by PhpStorm.
 * User: zjy
 * Date: 2015/7/1
 * Time: 1:06
 */

class table {
    public $table;
    public $attr;
    public $query;
    public $where;
    public $order;
    public $li;
    public $inWord;
    function __construct($table=''){
        $this->table=$table;
        $this->attr=null;
        $this->order=null;
        $this->query=null;
        $this->inWord=null;
        $this->where=1;
    }
    function select($attr='*'){
        $this->attr=$attr;
        $this->query='select';
        return $this;
    }
    public function insert($attr=array()){
        $this->attr=$attr;
        $this->query='insert';
        return $this;
    }
    public function update($attr=array()){
        $this->attr=$attr;
        $this->query='update';
        return $this;
    }
    public function delete(){
        $this->query='delete';
        return $this;
    }
    public function where($where){
        $this->where=$where;
        return $this;
    }
    public function orderby($word,$or){
        $this->order['word']=$word;
        $this->order['order']=$or;
        return $this;
    }
    public function limit($start,$num){
        $this->li['start']=$start;
        $this->li['num']=$num;
        return $this;
    }
    public function in($word,$arr){
        $this->inWord['word']=$word;
        $this->inWord['include']=implode("','",$arr);
        return $this;
    }
    public function sql(){
        $returnValue='';
        switch($this->query){
            case 'insert':
                $tuple='';
                $value='';
                foreach($this->attr as $assoc=>$val){
                    $tuple.=$assoc.",";
                    $value.="'{$val}',";
                }
                $tuple=substr($tuple,0,-1);
                $value=substr($value,0,-1);
                $sql="insert into ".$this->table." (".$tuple.") values (".$value.")";
                if(mysql_query($sql)){
                    $returnValue= mysql_insert_id();
                }
                else{
                    $returnValue= false;
                    echo mysql_error();
                }
                break;
            case 'select':
                $sql="select ".$this->attr." from ".$this->table." where ".$this->where;
                if($this->inWord!=null){
                    $sql.=" and ".$this->inWord['word']." in ('".$this->inWord['include']."')";
                }
                if($this->order!=null){
                    $sql.=" order by ".$this->order['word']." ".$this->order['order'];
                }
                if($this->li!=null){
                    $sql.=" limit ".$this->li['start'].",".$this->li['num'];
                }
                if($re=mysql_query($sql)){
                    $r=array();
                    while($result=mysql_fetch_assoc($re)){
                        $r[]=$result;
                    }
                    if(count($r)==0){
                        $returnValue= 0;
                    }
                    else{
                        $returnValue= $r;
                    }
                }
                else{
                    $returnValue= false;
                    echo mysql_error();
                }
                break;
            case 'update':
                $tuple='';
                foreach($this->attr as $assoc=>$val){
                    $tuple.=$assoc."='$val',";
                }
                $tuple=substr($tuple,0,-1);
                $sql="update ".$this->table." set ".$tuple." where ".$this->where;
                if(mysql_query($sql)){
                    if(mysql_affected_rows()>0){
                        $returnValue=true;
                    }
                    else{
                        $returnValue= false;
                        echo mysql_error();
                    }
                }
                else{
                    $returnValue= false;
                    echo mysql_error();
                }
                break;
            case 'delete':
                $sql="delete from ".$this->table." where ".$this->where;
                if(mysql_query($sql)){
                    if(mysql_affected_rows()>0){
                        $returnValue=true;
                    }
                    else{
                        $returnValue= false;
                        echo mysql_error();
                    }
                }
                else{
                    $returnValue= false;
                    echo mysql_error();
                }
                break;
            default:$returnValue= false;
        }
        $this->__construct($this->table);
        return $returnValue;
    }
}
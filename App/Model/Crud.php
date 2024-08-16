<?php

namespace App\Model;

use \App\Model\Database;


class Crud extends Database
{
    public function __construct() 
    {
        $this->conn = parent::connect();
    }

    public function get($table,  $params='*', $where='' ,$order='', $limit='')
    {
        $SQL = 'SELECT ';
        $SQL.= strlen($params) ? $params : ' * ';
        $SQL.= ' FROM '.$table;
        $SQL.= strlen($where) ? ' WHERE '.$where : '';
        $SQL.= strlen($order) ? ' ORDER BY '.$order : '';
        $SQL.= strlen($limit) ? ' Limit'.$limit : '';
        $stmt = $this->conn->query($SQL);
        $result =  $stmt ->fetchAll(\PDO::FETCH_ASSOC);       
        return $result;
    }

    public function getAll($table,  $params='*', $order='', $limit='')
    {
       $SQL = 'SELECT ';
       $SQL.= strlen($params) ? $params : ' * ';
       $SQL.= ' FROM '.$table;
       $SQL.= strlen($order) ? ' ORDER BY '.$order : '';
       $SQL.= strlen($limit) ? ' Limit'.$limit : '';

        $stmt = $this->conn->query($SQL);
        $result =  $stmt ->fetchAll(\PDO::FETCH_ASSOC);       
        return $result;
    }

    public function getWhere($params, $table, $where)
    {   
        $SQL = 'SELECT ';
        $SQL.= strlen($params) ? $params : ' * ';
        $SQL.= ' FROM '.$table;
        $SQL.= strlen($where) ? ' WHERE '.$where : '';

        $stmt = $this->conn->query($SQL);
        $result =  $stmt ->fetchAll();       
        return $result;
    }

    public function update($table, $fileds, $where, array $params)
    {
        $SQL='UPDATE '.$table.' SET '.$fileds.' WHERE '.$where;
        $stmt = $this->conn->prepare($SQL);  
        if($stmt->execute($params)==true)
        {
            return true;
        }
        else return false;
    }

    public function insert($table, $fields, $values, array $params)
    {
        $SQL ='INSERT INTO '.$table.' '.$fields.' VALUES '.$values;
        $stmt = $this->conn->prepare($SQL);
        if($stmt->execute($params)==true)
        {
            return true;
        }
        else return false;
    }

    public function delete($table, $where)
    {
        $SQL ='DELETE FROM '.$table.' WHERE '.$where; 
        $stmt = $this->conn->prepare($SQL);
        if($stmt->execute()==true)
        {
            return true;
        }
        else return false;
    }

    public function aquery($SQL)
    {
        $stmt = $this->conn->query($SQL);
        $result =  $stmt ->fetchAll();  
        return $result;
    }

    private $conn;
}

?>
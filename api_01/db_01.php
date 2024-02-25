<?php 
date_default_timezone_set("Asia/Taipei");
session_start();

class DB {
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db15";
    protected $pdo;
    protected $table;

    function __construct($table){
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, 'root', '');
    }

    function all($where = [], $other = "") {
        $where = $this->eq($where, " && ") ?: "TRUE";
        $sql = "SELECT * FROM `$this->table` WHERE $where $other";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function find($where) {
        $where = $this->eq($where, " && ") ?: "TRUE";
        $sql = "SELECT * FROM `$this->table` WHERE $where";
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function math($select, $where = [], $other = "") {
        $where = $this->eq($where, " && ") ?: "TRUE";
        $sql = "SELECT $select FROM `$this->table` WHERE $where $other";
        return $this->pdo->query($sql)->fetchColumn();
    }

    function count($where = [], $other = "") {
        return $this->math("count(*)", $where, $other);
    }

    function sum($col, $where = [], $other = "") {
        return $this->math("sum(`$col`)", $where, $other);
    }

    function min($col, $where = [], $other = "") {
        return $this->math("min(`$col`)", $where, $other);
    }

    function max($col, $where = [], $other = "") {
        return $this->math("max(`$col`)", $where, $other);
    }

    function save($array) {
        $set = $this->eq($array, ", ");
        $sql = "INSERT INTO `$this->table` SET $set";

        if (isset($array["id"])) {
            $where = $this->eq(["id" => $array["id"]], " && ");
            $sql = "UPDATE `$this->table` SET $set WHERE $where";
        }

        return $this->pdo->exec($sql);
    }

    function del($where) {
        $where = $this->eq($where, " && ") ?: "FALSE";
        $sql = "DELETE FROM `$this->table` WHERE $where";
        return $this->pdo->exec($sql);
    }

    function eq($array, $join) {
        if (!is_array($array)) {
            return $array;
        }

        $tmp = [];

        foreach ($array as $col => $val) {
            $tmp[] = "`$col` = '$val'";
        }

        return join($join, $tmp);
    }
}

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function to($url){
    header("location:$url");
}

$Total=new DB('total');
$User=new DB('user');
$News=new DB('news');
$Que=new DB('que');
$Log=new DB('log');

if(!isset($_SESSION['visited'])){
    if($Total->count(['date' => date('Y-m-d')]) > 0){
        $total=$Total->find(['date'=>date('Y-m-d')]);
        $total['total']++;
        $Total->save($total);
    }else{
        $Total->save(['total'=>1,'date'=>date('Y-m-d')]);
    }
    $_SESSION['visited']=1;
}
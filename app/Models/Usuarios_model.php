<?php namespace App\Models;

use CodeIgniter\Model;

class Usuarios_model extends Model {
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['name', 'email', 'password'];
    protected $useTimestamps = false;

    public function include($table){
        $tableJoinSing = rtrim($table, "s");
        return $this->join($table, $this->table.'.'.$tableJoinSing.'_id = '.$table.'.id');
    }

    public function inverseInclude($table){
        $tableJoinSing = rtrim($table, "s");
        return $this->join($table, $this->table.'.id = '.$table.'.'.$tableJoinSing.'_id');
    }

    public function includeAnotherColumn($table, $column){
        return $this->join($table, $this->table.'.'.$column.' = '.$table.'.id');
    }

    public function inverseIncludeAnotherColumn($table, $column){
        return $this->join($table, $this->table.'.id = '.$table.'.'.$column);
    }
}
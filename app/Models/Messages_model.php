<?php namespace App\Models;

use CodeIgniter\Model;

class Messages_model extends Model {
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['message', 'user_id', 'recipient_id', 'chat_id'];
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
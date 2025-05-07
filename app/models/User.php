<?php
class User extends Model {
    protected $table = 'users'; // Specify the table name if different from the class name
    public function getUsers() {
        return $this->queryBuilder()
        ->table($this->table)
        ->select(['id', 'name'])
        ->orderBy('name', 'ASC')
        ->get();
    }
}
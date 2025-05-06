<?php
class User extends Model {
    public function getUsers() {
        return $this->queryBuilder()
        ->table('users')
        ->select(['id', 'name'])
        ->orderBy('name', 'ASC')
        ->get();
    }
}
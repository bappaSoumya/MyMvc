<?php
class QueryBuilder {
    protected $db;
    protected $table;
    protected $columns = '*';
    protected $where = [];
    protected $joins = [];
    protected $orderBy = '';
    protected $limit = '';
    protected $bindings = [];

    public function __construct($db) {
        $this->db = $db;
    }

    public function table($table) {
        $this->table = $table;
        return $this;
    }

    public function select($columns = '*') {
        $this->columns = is_array($columns) ? implode(', ', $columns) : $columns;
        return $this;
    }

    public function where($column, $operator, $value) {
        $this->where[] = "$column $operator ?";
        $this->bindings[] = $value;
        return $this;
    }

    public function join($table, $first, $operator, $second, $type = 'INNER') {
        $this->joins[] = "$type JOIN $table ON $first $operator $second";
        return $this;
    }

    public function orderBy($column, $direction = 'ASC') {
        $this->orderBy = "ORDER BY $column $direction";
        return $this;
    }

    public function limit($limit, $offset = null) {
        $this->limit = "LIMIT $limit" . ($offset !== null ? " OFFSET $offset" : '');
        return $this;
    }

    public function get() {
        $sql = "SELECT $this->columns FROM $this->table";

        if (!empty($this->joins)) {
            $sql .= ' ' . implode(' ', $this->joins);
        }

        if (!empty($this->where)) {
            $sql .= ' WHERE ' . implode(' AND ', $this->where);
        }

        if (!empty($this->orderBy)) {
            $sql .= ' ' . $this->orderBy;
        }

        if (!empty($this->limit)) {
            $sql .= ' ' . $this->limit;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($this->bindings);
        return $stmt->fetchAll();
    }

    public function first() {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? null;
    }
    public function toSql() {
        $sql = "SELECT $this->columns FROM $this->table";

        if (!empty($this->joins)) {
            $sql .= ' ' . implode(' ', $this->joins);
        }

        if (!empty($this->where)) {
            $sql .= ' WHERE ' . implode(' AND ', $this->where);
        }

        if (!empty($this->orderBy)) {
            $sql .= ' ' . $this->orderBy;
        }

        if (!empty($this->limit)) {
            $sql .= ' ' . $this->limit;
        }

        return $sql;
    }
    public function update($data) {
        $set = [];
        foreach ($data as $column => $value) {
            $set[] = "$column = ?";
            $this->bindings[] = $value;
        }
        $setString = implode(', ', $set);
        $sql = "UPDATE $this->table SET $setString";

        if (!empty($this->where)) {
            $sql .= ' WHERE ' . implode(' AND ', $this->where);
        }

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($this->bindings);
    }
    public function delete() {
        $sql = "DELETE FROM $this->table";

        if (!empty($this->where)) {
            $sql .= ' WHERE ' . implode(' AND ', $this->where);
        }

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($this->bindings);
    }
}

?>
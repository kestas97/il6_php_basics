<?php

namespace Core;

use Aura\SqlQuery\QueryFactory;

class CollectionAbstract
{
    protected $queryFactory;

    protected $db;

    protected $select;

    public function __construct()
    {
        $this->queryFactory = new QueryFactory('mysql');
        $this->db = new DB();
        $this->select = $this->queryFactory->newSelect();
        $this->select->cols(['id'])->from(static::TABLE);
    }

    public function fieldsToSelect(array $fields)
    {
        $this->select->cols($fields);
        return $this;
    }

    public function filter(string $field, string $value, string $operator = '=')
    {
        $statement = "$field $operator :$field";
        $this->select->where($statement);
        $this->select->bindValue($field, $value);
        return $this;
    }
}

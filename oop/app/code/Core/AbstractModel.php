<?php

declare(strict_types=1);

namespace Core;
use Helper\DBHelper;
use Helper\Logger;

class AbstractModel
{
    protected array $data;

    //protected $table;

    protected int $id;

    protected const TABLE = '';

    public function getId(): int
    {
        return $this->id;
    }


    public function save(): void
    {
        $this->assignData();
        if (!isset($this->id)) {
            $this->create();
//            Logger::log('create');
        } else {
//            Logger::log('update');
            $this->update();
        }
    }

    protected function update(): void
    {
        $db = new DBHelper();
        $db->update(static::TABLE, $this->data)->where('id', $this->id)->exec();
    }

    protected function create(): void
    {
        $db = new DBHelper();
        $db->insert(static::TABLE, $this->data)->exec();
    }

    protected function assignData(): void
    {
        $this->data = [];
    }

    public function delete(): void
    {
        $db = new DBHelper();
        $db->delete()->from(static::TABLE)->where('id', $this->id)->exec();
    }

    public static function isValuelUnic(string $colum, string $value): bool
    {
        $db = new DBHelper();
        $rez = $db->select()->from(static::TABLE)->where($colum, $value)->get();
        return empty($rez);
    }

    public static function count( bool $activeOnly = true): int
    {
        $db = new DBHelper();
        // SELECT count(*) FROM ads;
        $rez = $db->select('count(*)')->from(static::TABLE)->where('active', 1)->get();
        if ($activeOnly) {
            $db->where('active', 1);
        }
        $rez = $db->get();
        return $rez[0][0];

    }


}
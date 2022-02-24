<?php

namespace Core;

use Helper\DBHelper;

class AbstractModel
{
    protected $data;

    //protected $table;

    protected $id;

    protected const TABLE = '';

    public function getId()
    {
        return $this->id;
    }


    public function save()
    {
        $this->assignData();
        if (!isset($this->id)) {
            $this->create();
        } else {
            $this->update();
        }
    }

    protected function update()
    {
        $db = new DBHelper();
        $db->update(static::TABLE, $this->data)->where('id', $this->id)->exec();
    }

    protected function create()
    {
        $db = new DBHelper();
        $db->insert(static::TABLE, $this->data)->exec();
    }

    protected function assignData()
    {
        $this->data = [];
    }

    public function delete()
    {
        $db = new DBHelper();
        $db->delete()->from(static::TABLE)->where('id', $this->id)->exec();
    }

    public static function isValuelUnic($colum, $value)
    {
        $db = new DBHelper();
        $rez = $db->select()->from(static::TABLE)->where($colum, $value)->get();
        return empty($rez);
    }

    public static function count()
    {
        $db = new DBHelper();
        // SELECT count(*) FROM ads;
        $rez = $db->select('count(*)')->from(static::TABLE)->where('active', 1)->get();
        return $rez[0][0];

    }


}

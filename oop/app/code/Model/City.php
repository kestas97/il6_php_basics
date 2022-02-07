<?php
namespace Model;

use Helper\DBHelper;

class City
{
    private $id;
    private $name;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    private function create()
    {
        $data = ['name' => $this->name,];

        $db = new DBHelper();
        $db->insert('cities', $data)->exec();
    }

    private function update()
    {

    }

    public function delete()
    {
        $db = new DBHelper();
        $db->delete()->from("cities")->where("id", $this->id)->exec();
    }
        //loudas
    public function load($id)
    {
        $db = new DBhelper();
        $data = $db->select()->from("cities")->where("id", $id)->getOne();

        $this->id = $data['id'];
        $this->name = $data['name'];
    }

    private static function formatList($data)
    {
        $formatted = [];
        foreach ($data as $value) {
            $formatted[$value["id"]] = $value["name"];
        }

        return $formatted;
    }//getCities
//    public static function getCities()
//    {
//        $db = new DBHelper();
//        //$rez = $db->select()->from("cities")->get();
//
//        return self::formatList($db->select()->from("cities")->get());
    public static function getCities()
    {
        $db = new DBHelper();
        $data = $db->select()->from('cities')->get();
        $cities = [];
        foreach ($data as $element) {
            $city = new City();
            $city->load($element['id']);
            $cities[] = $city;
        }
        return $cities;
    }
}
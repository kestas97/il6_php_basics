<?php
namespace Model;

use Core\AbstractController;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;

class City extends AbstractController implements ModelInterface
{
    private $id;

    private $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function assignData()
    {

    }

    public function load($id)
    {
        $db = new DBHelper();
        $city = $db->select()->from('cities')->where('id', $id)->getOne();
        $this->id = $city['id'];
        $this->name = $city['name'];
        return $this;
    }

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
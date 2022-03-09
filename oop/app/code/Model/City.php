<?php
declare(strict_types=1);
namespace Model;

use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;

class City extends AbstractModel implements ModelInterface
{
    //private int $id;

    private string $name;

    protected const TABLE = 'cities';

    public function __construct(?int $id = null)
    {
        if ($id !== null){
            $this->load($id);
        }
    }

    /**
     * @return int
     */
//    public function getId()
//    {
//        return $this->id;
//    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function assignData(): void
    {

    }

    public function load(int $id): City
    {
        $db = new DBHelper();
        $city = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
        $this->id = (int)$city['id'];
        $this->name = $city['name'];
        return $this;
    }

    public static function getCities(): array
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->get();
        $cities = [];
        foreach ($data as $element) {
            $city = new City();
            $city->load((int)$element['id']);

            $cities[] = $city;
        }
        return $cities;
    }
}
<?php

namespace Model;

use Helper\DBHelper;
use Core\AbstractModel;

class Ad extends AbstractModel
{

    private $title;

    private $description;

    private $manufacturerId;

    private $modelId;

    private $price;

    private $year;

    private $typeId;

    private $userId;

    private $image;

    private $active;

    private $slug;

    private $createdAt;

    private $views;



    public function __construct()
    {
        $this->table = 'ads';
    }

    /**
     * @return mixed
     */
//    public function getId()
//    {
//        return $this->id;
//    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getManufacturerId()
    {
        return $this->manufacturerId;
    }

    /**
     * @param mixed $manufacturerId
     */
    public function setManufacturerId($manufacturerId)
    {
        $this->manufacturerId = $manufacturerId;
    }

    /**
     * @return mixed
     */
    public function getModelId()
    {
        return $this->modelId;
    }

    /**
     * @param mixed $modelId
     */
    public function setModelId($modelId)
    {
        $this->modelId = $modelId;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * @param mixed $typeId
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function isActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }



    public function getViews()
    {
        return $this->views;
    }


    public function setViews($views)
    {
        $this->views = $views;
    }




    protected function assignData()
    {
        $this->data = [
            'title' => $this->title,
            'description' => $this->description,
            'manufacturer_id' => $this->manufacturerId,
            'model_id' => $this->modelId,
            'price' => $this->price,
            'year' => $this->year,
            'type_id' => $this->typeId,
            'user_id' => $this->userId,
            'image' => $this->image,
            'active' => $this->active,
            'slug' => $this->slug,
            'views'=> $this->views
        ];
    }






    public function load($id)
    {
        $db = new DBHelper();
        $ad = $db->select()->from('ads')->where('id', $id)->getOne();
        if(!empty($ad)){
            $this->id = $ad['id'];
            $this->title = $ad['title'];
            $this->manufacturerId = $ad['manufacturer_id'];
            $this->description = $ad['description'];
            $this->modelId = $ad['model_id'];
            $this->price = $ad['price'];
            $this->year = $ad['year'];
            $this->typeId = $ad['type_id'];
            $this->userId = $ad['user_id'];
            $this->image = $ad['image'];
            $this->active = $ad['active'];
            $this->slug = $ad['slug'];
            $this->createdAt = $ad['created_at'];
            $this->views = $ad['views'];
        }

        return $this;
    }

    public function loadBySlug($slug)
    {
        $db = new DBHelper();
        $rez = $db->select()->from($this->table)->where('slug', $slug)->getOne();
        if(!empty($rez)){
            $this->load($rez['id']);
            return $this;
        }else{
            return false;
        }
    }


    public static function getAllAds()
    {
        $db = new DBHelper();
        $data = $db->select()->from('ads')->where('active', 1)->get();
        $ads = [];
        foreach ($data as $element) {
            $ad = new Ad();
            $ad->load($element['id']);
            $ads[] = $ad;
        }
        return $ads;
    }

    public static function getPopularOne($limit)
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from('ads')
            ->where('active', 1)
            ->orderBy("views", 'DESC')
            ->limit($limit)
            ->get();
        $ads = [];
        foreach ($data as $element) {
            $ad = new Ad();
            $ad->load($element['id']);
            $ads[] = $ad;
        }
        return $ads;


    }

    public static function getNewest($limit)
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from('ads')
            ->where('active', 1)
            ->orderBy("created_at", 'ASC')
            ->limit($limit)
            ->get();
        $ads = [];
        foreach ($data as $element) {
            $ad = new Ad();
            $ad->load($element['id']);
            $ads[] = $ad;
        }
        return $ads;

    }

    public static function getPagenes($offset, $limit)
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from('ads')
            ->where('active', 1)
            ->limit($limit)
            ->offSet($offset)
            ->get();
        $ads = [];
        foreach ($data as $element) {
            $ad = new Ad();
            $ad->load($element['id']);
            $ads[] = $ad;
        }
        return $ads;


    }

}
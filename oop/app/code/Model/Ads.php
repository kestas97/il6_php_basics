<?php

namespace Model;


use Helper\DBHelper;

class Ads {

    private $id;

    private $title;

    private $description;

    private $manufacturerId;

    private $modelId;

    private $price;

    private $years;

    private $typeId;

    private $userId;


    public function getId()
    {
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getManufacturerId(){
        return $this->manufacturerId;
    }

    public function setManufacturerId($manufacturerId)
    {
        $this->manufacturerId = $manufacturerId;
    }

    public function getModelId()
    {
        return $this->modelId;
    }

    public function setModelId($modelId)
    {
        $this->modelId = $modelId;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getYears()
    {
        return $this->years;
    }

    public function setYears($years)
    {
        $this->years = $years;
    }

    public function getTypeId()
    {
        return $this->typeId;
    }

    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function load($id)
    {
        $db = new DBHelper();
        $data = $db->select()->from()->getOne();
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->manufacturerId = $data['manufacturer_id'];
        $this->modelId = $data['model_id'];
        $this->price = $data['price'];
        $this->years = $data['years'];
        $this->typeId = $data['type_id'];
        $this->userId = $data['user_id'];
    }

    public function save(){
        if (!isset($this->id)){
            $this->update();
        }else{
            $this->create();
        }
    }

    private function update()
    {
        $db = new DBHelper();

        $data = [
          'title'=>$this->title,
            'description'=>$this->description,
            'manufacturer_id'=>$this->manufacturerId,
            'model_id'=>$this->modelId,
            'price'=>$this->price,
            'years'=>$this->years,
            'type_id'=>$this->typeId,
            'user_id'=>$this->userId
        ];

        $db->update('ads', $data)->where('id', $this->id)->exec();
    }

    private function cerate()
    {
        $db = new DBHelper();

        $data = [
          'title'=>$this->title,
            'description'=>$this->description,
            'manufacturer_id'=>$this->manufacturerId,
            'model_id'=>$this->modelId,
            'price'=>$this->price,
            'years'=>$this->years,
            'type_id'=>$this->typeId,
            'user_id'=>$this->userId

        ];

        $db->insert('ads', $data)->exec();
    }
}

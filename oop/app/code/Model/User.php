<?php

namespace  Model;

use Core\Interfaces\ModelInterface;
use Helper\DBHelper;
use Helper\FormHelper;
use Model\City;
use Core\AbstractModel;
use Helper\Logger;

class User extends AbstractModel implements ModelInterface
{


    private $name;

    private $lastName;

    private $email;

    private $password;

    private $phone;

    private $cityId;

    private $city;

    private $active;

    private $roleId;

    private $nickName;

    protected const TABLE = 'users';

    public function __construct($id = null)
    {

        if ($id !== null){
            $this->load($id);
        }
    }

    public function assignData()
    {
        $this->data = [
            'nick_name' => $this->nickName,
            'name' => $this->name,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => $this->password,
            'phone' => $this->phone,
            'city_id' => $this->cityId,
            'role_id' =>$this->roleId
        ];
    }


    public function getNickName()
    {
        return $this->nickName;
    }

    public function setNickName($nickName)
    {
        $this->nickName = $nickName;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getCityId()
    {
        return $this->cityId;
    }

    public function getCity()
    {
        return $this->city;
    }


    public function setCityId($id)
    {
        $this->cityId = $id;
    }

    public function isActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getRoleId()
    {
        return $this->roleId;
    }

    public function setRoleId($id)
    {
        $this->roleId = $id;
    }


    public function load($id)
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
        $this->id = $data['id'];
        $this->nickName = $data['nick_name'];
        $this->name = $data['name'];
        $this->lastName = $data['last_name'];
        $this->phone = $data['phone'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->cityId = $data['city_id'];
        $this->roleId =$data['role_id'];
        $this->active = $data['active'];
        $city = new City();
        $this->city = $city->load($this->cityId);
        return $this;
    }




    public static function checkLoginCredentionals($email, $pass)
    {
        $db = new DBHelper();
        $rez = $db
            ->select('id')
            ->from(self::TABLE)
            ->where('email', $email)
            ->andWhere('password', $pass)
            ->getOne();

        if (isset($rez['id'])) {
            return $rez['id'];
        } else {
            return false;
        }
        //return isset($rez['id']) ? $rez['id'] : false;
    }

    public static function getAllUsers()
    {
        $db = new DBHelper();
        $data = $db->select('id')->from(self::TABLE)->get();
        $users = [];
        foreach ($data as $element) {
            $user = new User();
            $user->load($element['id']);
            $users[] = $user;
        }

        return $users;
    }




}
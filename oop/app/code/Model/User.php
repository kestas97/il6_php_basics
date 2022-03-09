<?php

declare(strict_types=1);
namespace  Model;

use Core\Interfaces\ModelInterface;
use Helper\DBHelper;
use Helper\FormHelper;
use Model\City;
use Core\AbstractModel;
use Helper\Logger;

class User extends AbstractModel implements ModelInterface
{


    private string $name;

    private string $lastName;

    private string $email;

    private string $password;

    private string $phone;

    private int $cityId;

    private  City $city;

    private int $active;

    private int $roleId;

    private string $nickName;

    protected const TABLE = 'users';

    public function __construct(?int $id = null)
    {

        if ($id !== null){
            $this->load($id);
        }
    }


    public function getNickName():string
    {
        return $this->nickName;
    }

    public function setNickName(string $nickName): void
    {
        $this->nickName = $nickName;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getCityId(): int
    {
        return $this->cityId;
    }

    public function setCityId(int $id): void
    {
        $this->cityId = $id;
    }

    public function getCity(): City
    {
        return $this->city;
    }


    public function isActive(): int
    {
        return $this->active;
    }

    public function setActive(int $active): void
    {
        $this->active = $active;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function setRoleId(int $id): void
    {
        $this->roleId = $id;
    }

    public function assignData(): void
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

    public function load(int $id): User
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
        $this->id = (int)$data['id'];
        $this->nickName = $data['nick_name'];
        $this->name = $data['name'];
        $this->lastName = $data['last_name'];
        $this->phone = $data['phone'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->cityId = (int)$data['city_id'];
        $this->roleId = (int)$data['role_id'];
        $this->active = (int)$data['active'];
        $city = new City();
        $this->city = $city->load($this->cityId);
        return $this;
    }




    public static function checkLoginCredentionals(string $email, string $pass): ?int
    {
        $db = new DBHelper();
        $rez = $db
            ->select('id')
            ->from(self::TABLE)
            ->where('email', $email)
            ->andWhere('password', $pass)
            ->getOne();

        if (isset($rez['id'])) {
            return (int)$rez['id'];
        } else {
            return null;
        }
        //return isset($rez['id']) ? $rez['id'] : false;
    }

    public static function getAllUsers(): array
    {
        $db = new DBHelper();
        $data = $db->select('id')->from(self::TABLE)->get();
        $users = [];
        foreach ($data as $element) {
            $user = new User();
            $user->load((int)$element['id']);
            $users[] = $user;
        }

        return $users;
    }

    public static function getRecipient(string $nickName): string
    {
        $db = new DBHelper();
        $data = $db->select('id')->from(self::TABLE)->where('nick_name', $nickName)->getOne();
        return (string)$data[0];
    }


}
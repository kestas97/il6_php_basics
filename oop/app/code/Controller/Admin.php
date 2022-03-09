<?php

declare(strict_types=1);
namespace Controller;

use Core\AbstractController;
use Core\Interfaces\ControllerInterface;
use Helper\FormHelper;
use Helper\Logger;
use Helper\Url;
use Model\City;
use Model\User as UserModel;
use Helper\Validator;
use Model\Ad;

class Admin extends AbstractController implements ControllerInterface
{
    public const ACTIVE = 1;

    public const NOT_ACTIVE = 0;

    public const DELETE = 2;

    public function __construct()
    {
        parent::__construct();
        if (!$this->isUserAdmin()) {
            Url::redirect('');
        }

    }

    public function index(): void
    {
        $this->renderAdmin('index');
    }

    public function users(): void
    {
        $this->data['users'] = UserModel::getAllUsers();
        $this->renderAdmin('users/list');
    }

    public function ads(): void
    {
        $this->data['ads'] = Ad::getAllAds();
        $this->renderAdmin('ads\list');
    }

    public function useredit(int $id): void
    {
        $user = new UserModel();
        $form = new FormHelper('admin/userupdate', 'POST');
        $user->load($id);


        $form->input([
            'name' => 'user_id',
            'type' => 'hidden',
            'value' => $id
        ]);

        $form->input([
            'name' => 'name',
            'type' => 'text',
            'id' => 'name',
            'value' => $user->getName()
        ]);


        $form->input([
            'name' => 'last_name',
            'type' => 'text',
            'placeholder' => 'Pavarde',
            'value' => $user->getLastName()
        ]);
        $form->input([
            'name' => 'phone',
            'type' => 'text',
            'placeholder' => '+3706*******',
            'value' => $user->getPhone()
        ]);
        $form->input([
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Email',
            'value' => $user->getEmail()
        ]);
        $form->input([
            'name' => 'password',
            'type' => 'password',
            'placeholder' => '* * * * * *'
        ]);
        $form->input([
            'name' => 'password2',
            'type' => 'password',
            'placeholder' => '* * * * * *'
        ]);

        $cities = City::getCities();
        $options = [];
        foreach ($cities as $city) {
            $id = $city->getId();
            $options[$id] = $city->getName();
        }

        $form->select([
            'name' => 'city_id',
            'options' => $options,
            'selected' => $user->getCityId()
        ]);

        $form->select([
            'name' => 'active',
            'options' => [0 => 'not active', 1 => 'active'],
            'selected' => $user->isActive()
        ]);



        $form->input([
            'name' => 'create',
            'type' => 'submit',
            'value' => 'Save'
        ]);

        $this->data['form'] = $form->getForm();
        $this->renderAdmin('users/edit');
    }

    public function userUpdate(): void
    {
        $userId = (int)$_POST['user_id'];
        $user = new UserModel();
        $user->load((int)$userId);

        $user->setName((string)$_POST['name']);
        $user->setLastName((string)$_POST['last_name']);
        $user->setPhone((string)$_POST['phone']);
        $user->setCityId((int)$_POST['city_id']);
        $user->setActive((int)$_POST['active']);
        $user->setRoleId((int)$_POST['role_id']);

        if ($_POST['password'] != '' && Validator::checkPassword($_POST['password'], $_POST['password2'])) {
            $user->setPassword(md5($_POST['password']));
        }

        if ($user->getEmail() != $_POST['email']) {
            if (Validator::checkEmail($_POST['email']) && UserModel::isValueUnic('email', $_POST['email'], 'users')) {
                $user->setEmail($_POST['email']);
            }
        }

        $user->save();
        Url::redirect('admin/users');
    }



    public function adedit(int $id): void
    {
        $ad = new Ad($id);
        $form = new FormHelper('admin/adupdate', 'POST');
        $form->input([
            'name' => 'title',
            'type' => 'text',
            'placeholder' => 'Pavadinimas',
            'value' => $ad->getTitle()
        ]);

        $form->input([
            'name' => 'id',
            'type' => 'hiden',
            'value' => $ad->getId()

        ]);

        $form->textArea('description', $ad->getDescription());
        $form->input([
            'name' => 'price',
            'type' => 'text',
            'placeholder' => 'Kaina',
            'value' => $ad->getPrice()
        ]);
        $form->input([
            'name' => 'image',
            'type' => 'text',
            'placeholder' => 'Kaina',
            'value' => $ad->getImage()
        ]);
        $form->input([
            'name' => 'year',
            'type' => 'text',
            'placeholder' => 'Metai',
            'value' => $ad->getYear()
        ]);

        $form->select([
            'name' => 'active',
            'options' => [0 => 'not active', 1 => 'active'],
            'selected' => $ad->isActive()
        ]);

        $form->input([
            'type' => 'submit',
            'value' => 'sukurti',
            'name' => 'create'
        ]);

        $this->data['form'] = $form->getForm();
        $this->renderAdmin('ads/edit');
    }

    public function adupdate()
    {
        $adId = $_POST['id'];
        $ad = new Ad($adId);
        $ad->setTitle($_POST['title']);
        $ad->setDescription($_POST['description']);
        $ad->setManufacturerId((int)$_POST['manufacturer_id']);
        $ad->setModelId((int)$_POST['model_id']);
        $ad->setImage($_POST['image']);
        $ad->setPrice((float)$_POST['price']);
        $ad->setYear((int)$_POST['year']);
        $ad->setTypeId((int)$_POST['year']);
        $ad->setActive((int)$_POST['active']);
        $ad->save();
        Url::redirect('admin/ads');
    }

    public function changeUserStatus(): void
    {
        $collection = [];
        if (isset($_POST['collection']))
        {
            $collection = $_POST['collection'];
        }
        foreach ($collection as $item)
        {
            $user = new UserModel();
            $user->load((int)$item);
            $user->setActive((int)$_POST['action']);
            $user->save();

        }
        Url::redirect('admin/users');
    }

    public function massadsupdate(): void
    {
        $action = $_POST['action'];
        $ids = $_POST['ad_id'];
        if ($action == self::ACTIVE || $action == self::NOT_ACTIVE) {
            foreach ($ids as $id) {
                $ad = new Ad((int)$id);
                $ad->setActive((int)$action);
                $ad->save();
            }
        } elseif ($action == self::DELETE)
        {
            foreach ($ids as $id)
            {
                $ad = new Ad((int)$id);
                $ad->delete();
            }
            Url::redirect('admin/ads');
        }

    }
}

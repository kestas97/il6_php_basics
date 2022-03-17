<?php

declare(strict_types=1);
namespace Controller;

use Core\Interfaces\ControllerInterface;
use Helper\DBHelper;
use Helper\FormHelper;
use Helper\Validator;
use Helper\Url;
use Model\City;
use Model\SavedAd;
use Model\User as UserModel;
use Core\AbstractController;
class User extends AbstractController implements ControllerInterface
{
    public function index(): void
    {
        $this->data['users'] = UserModel::getAllUsers();
        $this->render('user/list');
    }


    public function show(int $id = null): void
    {
        echo 'User controller ID: ' . $id;
    }

    public function register(): void
    {

        $form = new FormHelper('user/create', 'POST');

        $form->input([
            'name' => 'nick_name',
            'type' => 'text',
            'placeholder' => 'Slapyvardis'
        ]);

        $form->input([
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Vardas'
        ]);
        $form->input([
            'name' => 'last_name',
            'type' => 'text',
            'placeholder' => 'Pavarde'
        ]);
        $form->input([
            'name' => 'phone',
            'type' => 'text',
            'placeholder' => '+3706*******'
        ]);
        $form->input([
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Email'
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
        $form->select(['name' => 'city_id', 'options' => $options]);
        $form->input([
            'name' => 'create',
            'type' => 'submit',
            'value' => 'register'
        ]);

        $this->data['form'] = $form->getForm();
        $this->render('user/register');
    }

    public function edit(): void
    {
        if (!isset($_SESSION['user_id'])) {
            Url::redirect('user/login');
        }

        $userId = $_SESSION['user_id'];
        $user = new UserModel();
        $user->load($userId);

        $form = new FormHelper('user/update', 'POST');
        $form->input([
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Vardas',
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

        $form->input([
            'name' => 'create',
            'type' => 'submit',
            'value' => 'Edit'
        ]);

        $this->data['form'] = $form->getForm();
        $this->render('user/edit');

    }

    public function update(): void
    {
        $userId = $_SESSION['user_id'];
        $user = new UserModel();
        $user->load($userId);

       // $user->setNickName($_POST['nick_name']);
        $user->setName($_POST['name']);
        $user->setLastName($_POST['last_name']);
        $user->setPhone($_POST['phone']);
        $user->setCityId((int)$_POST['city_id']);

        if ($_POST['password'] != '' && Validator::checkPassword($_POST['password'], $_POST['password2'])) {
            $user->setPassword(md5($_POST['password']));
        }

        if ($user->getEmail() != $_POST['email']) {
            if (Validator::checkEmail($_POST['email']) && UserModel::isValueUnic('email', $_POST['email'], 'users')) {
                $user->setEmail($_POST['email']);
            }
        }

        $user->save();
        Url::redirect('');
    }

    public function login(): void
    {
        $form = new FormHelper('user/check', 'POST');
        $form->input([
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Email'
        ]);
        $form->input([
            'name' => 'password',
            'type' => 'password',
            'placeholder' => '* * * * * *'
        ]);
        $form->input([
            'name' => 'login',
            'type' => 'submit',
            'value' => 'login'
        ]);

        $this->data['form'] = $form->getForm();
        $this->render('user/login');
    }

    public function create(): void
    {
        $passMatch = Validator::checkPassword($_POST['password'], $_POST['password2']);
        $isEmailValid = Validator::checkEmail($_POST['email']);
        $isEmailUnic = UserModel::isValuelUnic('email', $_POST['email'], 'users');
        $isNickNameUnic = UserModel::isValuelUnic('nick_name', $_POST['nick_name']);
        if ($passMatch && $isEmailValid && $isEmailUnic && $isNickNameUnic) {
            $user = new UserModel();
            $user->setNickName($_POST['nick_name']);
            $user->setName($_POST['name']);
            $user->setLastName($_POST['last_name']);
            $user->setPhone($_POST['phone']);
            $user->setPassword(md5($_POST['password']));
            $user->setEmail($_POST['email']);
            $user->setCityId((int)$_POST['city_id']);
            $user->setActive((int)$_POST['active']);
            $user->setRoleId((int)$_POST['role_id']);
            $user->save();
            Url::redirect('user/login');
        } else {
            echo 'Patikrinkite duomenis';
        }
    }

    public function check(): void
    {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $userId = UserModel::checkLoginCredentionals($email, $password);
        if ($userId) {
            $user = new UserModel();
            $user->load($userId);
            $_SESSION['logged'] = true;
            $_SESSION['user_id'] = $userId;
            $_SESSION['user'] = $user;
            Url::redirect('/');
        } else {
            Url::redirect('user/login');
        }
    }

    public function logout(): void
    {
        session_destroy();
        Url::redirect('');
    }

    public function favorite(): void
    {
        $this->data['list'] = SavedAd::getUsersFavoriteAds((int)$_SESSION['user_id']);
        $this->render('user/favorite');
    }


}
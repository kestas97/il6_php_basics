<?php
namespace Controller;
use Couchbase\UpsertUserOptions;
use Helper\FormHelper;
use Helper\Validator;
use Model\User as UserModel;
use Model\City;
use Helper\Url;
class User


{
    public function show($id)
    {
        echo 'User controller ID: '. $id;
    }

    public function register(){
        //$cities = city::getCities();
       $form = new FormHelper('user/create', 'POST');
       $form->input([
           'name' => 'name',
           'type' => 'text',
           'placeholder' => 'Vardas'
       ]);

        $form->input([
            "name"=>"last_name",
            "type"=>"text",
            "placeholder"=>"Last name"
        ]);

        $form->input([
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'email'
        ]);

        $form->input([
            "name"=>"phone",
            "type"=>"text",
            "placeholder"=>"Telefonas"
        ]);

        $form->input([
            'name' => 'password',
            'type' => 'password',
            'placeholder' => 'password'
        ]);


        $form->input([
            'name' => 'password2',
            'type' => 'password',
            'placeholder' => 'password'
        ]);

//        $cities = City::getCities();
//        $options = [];
//        foreach ($cities as $city) {
//            $key = $city->getId();
//            $options[$key] = $city->getName();
//        }
//        $form->select([
//            'name' => 'city_id',
//            'options' => City::getCities()
//        ]);
//
//
//
//        $form->input([
//            'name' => 'create',
//            'type' => 'submit',
//            'placeholder' => 'register'
//        ]);
        $cities = City::getCities();
        $options = [];
        foreach ($cities as $city) {
            $key = $city->getId();
            $options[$key] = $city->getName();
        }
        //print_r($cities);
        $form->select(['name' => 'city_id', 'options' => $options]);
        $form->input([
            'name' => 'create',
            'type' => 'submit',
            'value' => 'register'
        ]);



        echo $form->getForm();
    }
    public function login()
    {
        $form = new FormHelper('user/check', 'POST');
        $form->input([
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'email@mail.com'
        ]);
        $form->input([
            'name' => 'password',
            'type' => 'password',
            'placeholder' => 'Password'
        ]);
        $form->input([
            'name' => 'create',
            'type' => 'submit',
            'value' => 'login'
        ]);

        echo $form->getForm();
    }

    public function create()
    {
        $passMatch = Validator::checkPassword($_POST['password'], $_POST['password2']);
        $isEmailValid = Validator::checkEmail($_POST['email']);
        $isEmailUniq = UserModel::emailUniq($_POST['email']);


        if ($passMatch && $isEmailValid && $isEmailUniq) {
            $user = new UserModel();

            $user->setName($_POST["name"]);
            $user->setLastName($_POST["last_name"]);
            $user->setEmail($_POST["email"]);
            $user->setPhone($_POST["phone"]);
            $user->setPassword(md5($_POST["password"]));
            $user->setCityId($_POST["city_id"]);

            $user->save();

            Url::redirect('user/login');
        } else {
            echo "Patikrinkite duomenis";
        }

        print_r($_POST);
    }






    public function check()
    {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $userId = UserModel::checkLoginCredentionals($email, $password);
        if ($userId){
            $user = new UserModel();
            $user->load($userId);
            $_SESSION['user_id'] = $userId;
            $_SESSION['logged'] = true;
            $_SESSION['user'] = $user;
            Url::redirect('/');
            //$user->getCity()->getName;
//            echo "<pre>";
//            print_r($user);
        }else{
            Url::redirect('user/login');
        }
    }
    public function logout()
    {
        session_destroy();
    }

    public function edit()
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
            'value' => 'edit'
        ]);

        echo $form->getForm();


    }

    public function update()
    {
        $userId = $_SESSION['user_id'];
        $user = new UserModel();
        $user->load($userId);

        $user->setName($_POST['name']);
        $user->setLastName($_POST['last_name']);
        $user->setPhone($_POST['phone']);
        $user->setCityId($_POST['city_id']);

        if ($_POST['password'] != '' && Validator::checkPassword($_POST['password'], $_POST['password2'])) {
            $user->setPassword(md5($_POST['password']));
        }

        if ($user->getEmail() != $_POST['email']) {
            if (Validator::checkEmail($_POST['email']) && UserModel::emailUnic($_POST['email'])) {
                $user->setEmail($_POST['email']);
            }
        }

        $user->save();
        Url::redirect('user/edit');
    }



}


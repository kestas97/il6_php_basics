<?php

namespace Controller;
use Core\AbstractController;
use Helper\FormHelper;
use Helper\Url;
use Model\Ad;
use Model\User as UserModel;
class Catalog extends AbstractController

{

    public function index()
    {
        $ads = Ad::getAllAds();
        $adsPerPage = 5;
        $adCount = count($ads);
        $pageCount = ceil($adCount / $adsPerPage);
        $options = [];
        for ($y = 1; $y <=$pageCount; $y++){
            $options[$y] = $y;
        }
        $select = new FormHelper('catalog/', 'GET');
        $select->select(['name'=>'page', 'options'=>$options]);
        $select->input(['type'=>'submit', 'value'=>'submit']);
        if (empty($_GET['page']))
        {
            $_GET['page'] = 1;
        }
        $firstAd = ($_GET['page'] - 1) * $adsPerPage;
        $ads = Ad::getPagenes($firstAd, $adsPerPage);
        $this->data['select'] = $select->getForm();
        $this->data['ads'] = $ads;
        $this->render('catalog/all');
    }


    public function add()
    {

        if (!isset($_SESSION['user_id'])) {
            Url::redirect('');
        }
        $form = new FormHelper('catalog/create', 'POST');
        $form->input([
            'name' => 'title',
            'type' => 'text',
            'placeholder' => 'Pavadinimas'
        ]);

        $form->textArea('description', 'Aprasymas');
        $form->input([
            'name' => 'price',
            'type' => 'text',
            'placeholder' => 'Kaina'
        ]);

        $form->input([
            'name' => 'year',
            'type' => 'text',
            'placeholder' => 'Metai'
        ]);

        $form->input([
            'name' => 'image',
            'type' => 'text',
            'placeholder' => 'image'
        ]);


        $form->input([
            'type' => 'submit',
            'value' => 'sukurti',
            'name' => 'create'
        ]);

        $this->data['form'] = $form->getForm();
        $this->render('catalog/create');

    }

    public function create()
    {
        $slug = Url::slug($_POST['title']);
        while (!Ad::isValuelUnic('slug', $slug, 'ads')){
            $slug = $slug . rand(0, 100);
        }
        $ad = new Ad();
        $ad->setTitle($_POST['title']);
        $ad->setDescription($_POST['description']);
        $ad->setManufacturerId(1);
        $ad->setModelId(1);
        $ad->setPrice($_POST['price']);
        $ad->setYear($_POST['year']);
        $ad->setTypeId(1);
        $ad->setActive(1);
        $ad->setImage($_POST['image']);
        $ad->setUserId($_SESSION['user_id']);
        $ad->setSlug($slug);
        $ad->save();

        Url::redirect('');
    }

    public function edit($id)
    {
        if (!isset($_SESSION['user_id'])) {
            Url::redirect('');
        }
        $ad = new Ad();
        $ad->load($id);

        if ($_SESSION['user_id'] != $ad->getUserId()) {
            Url::redirect('');
        }

        $form = new FormHelper('catalog/update', 'POST');
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
            'name' => 'year',
            'type' => 'text',
            'placeholder' => 'Metai',
            'value' => $ad->getYear()
        ]);

        $form->input([
            'name' => 'image',
            'type' => 'text',
            'placeholder' => 'image',
            'value' => $ad->getImage()
        ]);

        $form->input([
            'type' => 'submit',
            'value' => 'sukurti',
            'name' => 'create'
        ]);

        $this->data['form'] = $form->getForm();
        $this->render('catalog/create');
    }

    public function update()
    {
        $adId = $_POST['id'];
        $ad = new Ad();
        $ad->load($adId);
        $ad->setTitle($_POST['title']);
        $ad->setDescription($_POST['description']);
        $ad->setManufacturerId(1);
        $ad->setModelId(1);
        $ad->setPrice($_POST['price']);
        $ad->setYear($_POST['year']);
        $ad->setTypeId(1);
        $ad->setImage($_POST['image']);
        $ad->save();
    }




        public function show($slug)
    {
        $ad = new Ad();
        $this->data['ad'] = $ad->loadBySlug($slug);
        $views = $ad->getViews();
        $views = $views+1;
        $ad->setViews($views);
        $ad->save();
        if($this->data['ad']){
            $this->render('catalog/show');
        }else{
            echo '404';
        }
    }



}
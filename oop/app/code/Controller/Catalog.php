<?php
declare(strict_types=1);

namespace Controller;
use Core\AbstractController;
use Core\Interfaces\ControllerInterface;
use Helper\FormHelper;
use Helper\Logger;
use Helper\Url;
use Model\Comment;
use Model\Ad;
use Model\User as UserModel;
class Catalog extends AbstractController implements ControllerInterface

{

    public function index(): void
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


    public function add(): void
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
        $ad->setPrice((float)$_POST['price']);
        $ad->setYear((int)$_POST['year']);
        $ad->setTypeId(1);
        $ad->setActive(1);
        $ad->setImage((string)$_POST['image']);
        $ad->setUserId((int)$_SESSION['user_id']);
        $ad->setViews(1);
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

    public function update(): void
    {
        $adId = $_POST['id'];
        $ad = new Ad((int)$_POST['id']);
        $ad->load((int)$adId);
        $ad->setTitle($_POST['title']);
        $ad->setDescription($_POST['description']);
        $ad->setManufacturerId((int)$_POST['manufacturer_id']);
        $ad->setModelId((int)$_POST['model_id']);
        $ad->setPrice((float)$_POST['price']);
        $ad->setYear((int)$_POST['year']);
        $ad->setTypeId((int)$_POST['type_id']);
        $ad->setImage($_POST['image']);
        $ad->save();
    }




    public function show(string $slug): void
    {
        $ad = new Ad();
        $ad->loadBySlug($slug);
        $adId = $ad->getId();
        $form = new FormHelper('catalog/addcomment/?id=' . $adId . '&back=' . $slug, 'POST');


        $form->textArea('comment', 'Komentaras');
        $form->input([
            'name' => 'submit',
            'type' => 'submit',
            'value' => 'Comment'
        ]);

        if (!$ad->isActive()){
            //Logger::log($ad->isActive());
            Url::redirect('catalog/show');


        }


        $views = $ad->getViews();
        $views = $views+1;
        $ad->setViews($views);
        $ad->save();
        $this->data['ad'] = $ad;
        if($this->data['ad']){
            $this->data['comments'] = Comment::getAdComments($ad->getId());
            $this->data['comment_box'] = $form->getForm();
            $this->render('catalog/show');

        }else{
            $error = new Error();
            $error->error404();
        }
    }

    public function addComment(): void
    {
        if (!isset($_POST['comment'])){
            Url::redirect('catalog/show' .$_GET['back']);
        }
        if (!isset($_SESSION['user_id'])){

            Url::redirect('catalog/show/' .$_GET['back']);
        }

        $comment = new Comment();
        $comment->setComment($_POST['comment']);
        $comment->setAdId((int)$_GET['id']);
        $comment->setUserId((int)$_SESSION['user_id']);
        $comment->save();

        Url::redirect('catalog/show/' .$_GET['back']);

    }



}
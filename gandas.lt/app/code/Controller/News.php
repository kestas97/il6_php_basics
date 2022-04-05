<?php

namespace Controller;

use Core\ControllerAbstract;

class News extends ControllerAbstract
{
    public function show(string $slug){
        $new = new \Model\News();
        $new->loadBySlug($slug);
        echo $this->twig->render('news/single.html', ['new'=> $new]);
    }

    public function all()
    {
        $news = new \Model\Collections\News();
        $news->filter('active', 1);



        echo $this->twig->render('news/all.html', ['news'=> $news->get()]);
    }

}

<?php

namespace Model\Collections;

use Core\CollectionAbstract;

class News extends CollectionAbstract
{
    const TABLE = 'news';



    public function get(): array
    {

        $rez = $this->db->getAll($this->select);
        $news = [];
        if (!empty($rez)){
            foreach ($rez as $element){
                $new = new \Model\News();
                $news[] = $new->load((int) $element['id']);

            }
        }

        return $news;

    }

    public function getArray()
    {
        return $this->db->getAll($this->select);
    }

}
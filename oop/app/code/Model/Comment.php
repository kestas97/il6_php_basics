<?php

namespace Model;

use Core\AbstractModel;
use Helper\DBHelper;

class Comment extends AbstractModel
{
    protected const TABLE = 'comments';
    private $comment;
    private $userId;
    private $adId;
    private $createdAt;

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getAdId()
    {
        return $this->adId;
    }

    public function setAdId($adId)
    {
        $this->adId = $adId;
    }

    public function getCreated()
    {
        return $this->createdAt;
    }

    protected function assignData()
    {
        $this->data = [
          'comment' => $this->comment,
          'user_id' => $this->userId,
          'ad_id' => $this->adId
        ];
    }

    public function load($id)
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where("id", $id)->getOne();
        if (!empty($comment)) {
            $this->comment = $comment['comment'];
            $this->adId = $comment['ad_id'];
            $this->userId = $comment['user_id'];
            $this->createdAt = $comment['created_at'];
        }
        return $this;
    }

    public static function getAllComments()
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->get();
        $comments = [];

        foreach ($data as $element){
            $comment = new Comment();
            $comment->load($element['id']);
            $comments[] = $comment;
        }

        return $comments;
    }

    public static function getAdComments($adId)
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('ad_id', $adId)->orderBy('created_at', 'DESC')->get();

        foreach ($data as $element) {
            $comment = new Comment();
            $comment->load($element['id']);
            $comments[] = $comment;
        }
        return $comments;
    }

    public static function getUserComments($userId)
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('user_id', $userId)->get();
        $comments = [];

        foreach ($data as $element) {
            $comment = new Comment();
            $comment->load($element['id']);
            $comments[] = $comment;
        }
        return $comments;
    }


}

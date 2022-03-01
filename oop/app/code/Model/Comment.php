<?php

namespace Model;

use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;
use Helper\Logger;

class Comment extends AbstractModel implements ModelInterface
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

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUser()
    {
        return new User($this->userId);
    }

    public function getAd()
    {
        return new Ad($this->adId);
    }

    protected function assignData()
    {
        $this->data = [
          'comment' => $this->comment,
          'user_id' => $this->userId,
          'ad_id' => $this->adId,
        ];
    }

    public function load($id)
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where("id", $id)->getOne();
        if (!empty($data)) {
            $this->comment = $data['comment'];
            $this->adId = $data['ad_id'];
            $this->userId = $data['user_id'];
            $this->createdAt = $data['created_at'];
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
        $comments = [];
        Logger::log(print_r($data, true));

        foreach ($data as $element) {
            $comment = new Comment();
            $comment->load($element['id']);
            Logger::log(print_r($comment, true));
            Logger::log($element['id']);
            $comments[] = $comment;
        }
        Logger::log(print_r($comments, true));
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

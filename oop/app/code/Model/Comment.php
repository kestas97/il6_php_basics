<?php

declare(strict_types=1);
namespace Model;

use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;
use Helper\Logger;

class Comment extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'comments';
    private string $comment;
    private int $userId;
    private int $adId;
    private string $createdAt;

    public function __construct(?int $id = null)
    {
        if ($id !== null){
            $this->load($id);
        }
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getAdId(): int
    {
        return $this->adId;
    }

    public function setAdId(int $adId): void
    {
        $this->adId = $adId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUser(): User
    {
        return new User($this->userId);
    }

    public function getAd(): Ad
    {
        return new Ad($this->adId);
    }

    public function assignData(): void
    {
        $this->data = [
            'comment' => $this->comment,
            'user_id' => $this->userId,
            'ad_id' => $this->adId,
        ];
    }

    public function load(int $id): Comment
    {
        $db = new DBHelper();
        $comment = $db->select()->from(self::TABLE)->where("id", $id)->getOne();
        if (!empty($comment)) {
            $this->comment = $comment['comment'];
            $this->adId = (int)$comment['ad_id'];
            $this->userId = (int)$comment['user_id'];
            $this->createdAt = $comment['created_at'];
        }
        return $this;
    }

    public static function getAllComments(): array
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->get();
        $comments = [];

        foreach ($data as $element){
            $comment = new Comment();
            $comment->load((int)$element['id']);
            $comments[] = $comment;
        }

        return $comments;
    }

    public static function getAdComments(int $adId): array
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('ad_id', $adId)->orderBy('created_at', 'DESC')->get();
        $comments = [];
        Logger::log(print_r($data, true));

        foreach ($data as $element) {
            $comment = new Comment();
            $comment->load((int)$element['id']);
            Logger::log(print_r($comment, true));
            Logger::log($element['id']);
            $comments[] = $comment;
        }
        Logger::log(print_r($comments, true));
        return $comments;
    }

    public static function getUserComments(int $userId): array
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('user_id', $userId)->get();
        $comments = [];

        foreach ($data as $element) {
            $comment = new Comment();
            $comment->load((int)$element['id']);
            $comments[] = $comment;
        }
        return $comments;
    }


}